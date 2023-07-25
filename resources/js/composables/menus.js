import {inject, reactive, ref} from "vue";
import router from "../router";


export default function useMenus() {
    const menus = ref([]);
    const menu = ref({});
    const errors = ref({})
    const isLoading = ref(false)
    const isFetching = ref(false)
    const paginationMetaData = ref({})
    const paginationLinks = ref({})
    const menuURL = ref('/api/menus')


    const menuForm = reactive(
        {
            name: '',
            start_time: '',
            end_time: '',
            image: ''
        }
    )

    const getMenus = async (searchName) => {
        isFetching.value = true
        await axios.get(menuURL.value+'?name='+searchName).then(response =>{
            menus.value = response.data.data
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

    const getMenu = async (id) => {
        isFetching.value = true
        await axios.get('/api/menus/'+id).then(response =>{
            menu.value = response.data.data
        }).catch(error =>{
            Toast.fire({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }

    const storeMenu = async (data) => {
        isLoading.value = true;

        //Serialization of formData to include file uploads
        let formData = new FormData();
        for (let item in data) {
            if (data.hasOwnProperty(item)) {
                formData.append(item, data[item])
            }
        }

        await axios.post('/api/menus', formData)
            .then(response =>{
                menu.value = response.data.data
                router.push({name: 'menu.index'})
                Toast.fire({
                    icon: 'success',
                    title: 'Information Stored successfully'
                })
            }).catch(error =>{
                if(error.response?.data){
                    errors.value = error.response.data.errors
                }else{
                    Toast.fire({
                        icon: 'error',
                        title: error.message
                    })
                }
            }).finally(
                () => isLoading.value = false
            )
    }


    const updateMenu = async (id) =>{

        isLoading.value = true

        //check if user is updating file
        let data = {...menu.value}

        let formData = new FormData();

        for(let item in data){
            if(data.hasOwnProperty(item)){
                formData.append(item, data[item])
            }
        }
        //Method Spoofing, for laravel put/patch handling
        formData.append("_method", "put");

        //Delete Logo key if form has no image
        if (!(data.image instanceof File)){
            formData.delete('image')
        }


        await axios.post('/api/menus/'+id, formData)
            .then(response =>{
                router.push({name: 'menu.index'})
                Toast.fire({
                    icon: 'success',
                    title: 'Menu Updated successfully'
                })
            }).catch(error =>{
                if(error.response?.data){
                    errors.value = error.response.data.errors
                }else{
                    Toast.fire({
                        icon: 'error',
                        title: error.message
                    })
                }
            }).finally(
                () => isLoading.value = false
            )
    }

    return {
        menu,
        menus,
        errors,
        getMenu,
        menuForm,
        getMenus,
        storeMenu,
        isLoading,
        updateMenu,
        isFetching,
        paginationLinks,
        paginationMetaData,
    }

}
