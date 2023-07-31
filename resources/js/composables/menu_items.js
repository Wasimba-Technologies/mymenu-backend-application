import { reactive, ref} from "vue";
import router from "../router";


export default function useMenuItems() {
    const menu_items = ref([]);
    const menu_item = ref({});
    const errors = ref({})
    const isLoading = ref(false)
    const isFetching = ref(false)
    const paginationMetaData = ref({})
    const paginationLinks = ref({})
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
        await axios.get(menuURL.value+'?name='+searchName).then(response =>{
            menu_items.value = response.data.data
            paginationMetaData.value = response.data.meta
            paginationLinks.value = response.data.links
        }).catch(error =>{
            Toast.fire({
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
            Toast.fire({
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

        //Delete image key if form has no image
        if (!(data.image instanceof File)) {
            formData.delete('image')
        }

        await axios.post('/api/menu_items', formData)
            .then(response => {
                menu_item.value = response.data.data
                router.push({name: 'menu_items.index'})
                Toast.fire({
                    icon: 'success',
                    title: response.data.message
                })
            }).catch(error => {
                if (error.response?.data) {
                    errors.value = error.response.data.errors
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: error.message
                    })
                }
            }).finally(
                () => isLoading.value = false
            )
    }
    const updateMenuItem = async (id, data) => {

        isLoading.value = true
        let formData = new FormData();

        for (let item in data) {
            if (data.hasOwnProperty(item)) {
                formData.append(item, data[item])
            }
        }

        //Method Spoofing, for laravel put/patch handling
        formData.append("_method", "put");

        //Delete image key if form has no image
        if (!(data.image instanceof File)) {
            formData.delete('image')
        }


        await axios.post('/api/menu_items/' + id, formData)
            .then(response => {
                router.push({name: 'menu_items.index'})
                Toast.fire({
                    icon: 'success',
                    title: 'Menu item Updated successfully'
                })
            }).catch(error => {
                if (error.response?.data) {
                    errors.value = error.response.data.errors
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: error.message
                    })
                }
            }).finally(
                () => isLoading.value = false
            )
    }

    const browseMenuByTable = async (id)  =>{
        isFetching.value = true
        await axios.get('/api/browse/'+id).then(response =>{
            menu_items.value = response.data.menu_items
            localStorage.setItem('X-Tenant-ID',response.data.tenant_id)
            localStorage.setItem('table_id', id)
            sessionStorage.setItem('tenant' , JSON.stringify({
                name: response.data.tenant.name,
                currency: response.data.tenant.currency,
                primary_color: response.data.tenant.primary_color,
                secondary_color: response.data.tenant.secondary_color
            }))
        }).catch(error =>{
            Toast.fire({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }

    return {
        menu_item,
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
        paginationLinks,
        browseMenuByTable
    }

}
