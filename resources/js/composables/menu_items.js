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

    const menuItemForm = reactive(
        {
            name: '',
            description: '',
            price: '',
            image: '',
            menu_id: ''
        }
    )


    const storeMenuItem = async (data) => {
        isLoading.value = true;

        //Serialization of formData to include file uploads
        let formData = new FormData();
        for(let item in data){
            if(data.hasOwnProperty(item)){
                formData.append(item, data[item])
            }
        }

        await axios.post('/api/menu_items', formData)
            .then(response =>{
                menu_item.value = response.data.data
                router.push({name: 'menu_item.index'})
                swal({
                    icon: 'success',
                    title: 'Information Stored successfully'
                })
            }).catch(error =>{
                if(error.response?.data){
                    errors.value = error.response.data.errors
                }else{
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
        storeMenuItem,
        isFetching,
        isLoading,
        menuItemForm,
    }

}
