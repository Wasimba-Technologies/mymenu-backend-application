import {inject, reactive, ref} from "vue";
import router from "../router";


export default function useMenuItems() {
    const menu_items = ref([]);
    const menu_item = ref({});
    const errors = ref({})
    const isLoading = ref(false)
    const isFetching = ref(false)
    const paginationMetaData = ref({})
    const paginationLinks = ref({})
    const swal = inject('$swal')
    const menuURL = ref('api/menu_items')

    const menuItemForm = reactive(
        {
            name: '',
            description: '',
            price: '',
            image: '',
            menu_id: ''
        }
    )

    const getMenuItems = async (searchName) => {
        isFetching.value = true
        //searchName = searchName === undefined ? '' : searchName
        await axios.get(menuURL.value).then(response =>{
            menu_items.value = response.data.data
            paginationMetaData.value = response.data.meta
            paginationLinks.value = response.data.links
            console.log(response.data.links)
        }).catch(error =>{
            swal({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }

    const getMenuItem = async (id) => {
        isFetching.value = true
        await axios.get('/api/menu_items/'+id).then(response =>{
            menu_item.value = response.data.data
        }).catch(error =>{
            swal({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }


    const storeMenuItem = async (data) => {
        isLoading.value = true;

        //Serialization of formData to include file uploads
        let formData = new FormData();
        for (let item in data) {
            if (data.hasOwnProperty(item)) {
                formData.append(item, data[item])
            }
        }

        await axios.post('/api/menu_items', formData)
            .then(response => {
                menu_item.value = response.data.data
                router.push({name: 'menu_items.index'})
                swal({
                    icon: 'success',
                    title: 'Information Stored successfully'
                })
            }).catch(error => {
                if (error.response?.data) {
                    errors.value = error.response.data.errors
                } else {
                    swal({
                        icon: 'error',
                        title: error.message
                    })
                }
            }).finally(
                () => isLoading.value = false
            )
    }
    const updateMenuItem = async (id) => {

        isLoading.value = true

        //check if user is updating file
        let data = {...menu_item.value}

        let formData = new FormData();

        for (let item in data) {
            if (data.hasOwnProperty(item)) {
                formData.append(item, data[item])
            }
        }
        //Method Spoofing, for laravel put/patch handling
        formData.append("_method", "put");

        //Delete Logo key if form has no image
        if (!(data.logo instanceof File)) {
            formData.delete('image')
        }


        await axios.post('/api/menu_items/' + id, formData)
            .then(response => {
                router.push({name: 'menus.index'})
                swal({
                    icon: 'success',
                    title: 'Menu item Updated successfully'
                })
            }).catch(error => {
                if (error.response?.data) {
                    errors.value = error.response.data.errors
                } else {
                    swal({
                        icon: 'error',
                        title: error.message
                    })
                }
            }).finally(
                () => isLoading.value = false
            )
    }

    return {
        menu_items,
        errors,
        getMenuItems,
        getMenuItem,
        storeMenuItem,
        updateMenuItem,
        isFetching,
        isLoading,
        menuItemForm,
        paginationMetaData,
        paginationLinks
    }

}
