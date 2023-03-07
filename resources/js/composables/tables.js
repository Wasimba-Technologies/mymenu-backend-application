import {inject, reactive, ref} from "vue";
import router from "../router";


export default function useTables() {
    const tables = ref([]);
    const table = ref({});
    const errors = ref({})
    const isLoading = ref(false)
    const isFetching = ref(false)
    const paginationMetaData = ref({})
    const paginationLinks = ref({})
    const tableURL = ref('/api/tables')

    const swal = inject('$swal')

    const tableForm = reactive(
        {
            name: '',
        }
    )

    const getTables = async () => {
        isFetching.value = true
        //searchName = searchName === undefined ? '' : searchName
        await axios.get(tableURL.value).then(response =>{
            tables.value = response.data.data
            paginationMetaData.value = response.data.meta
            paginationLinks.value = response.data.links
        }).catch(error =>{
            swal({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }

    const getTable = async (id) => {
        isFetching.value = true
        await axios.get('/api/tables/'+id).then(response =>{
            table.value = response.data.data
        }).catch(error =>{
            swal({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }

    const storeTable = async (data) => {
        isLoading.value = true;

        await axios.post('/api/tables', data)
            .then(response =>{
                table.value = response.data.data
                router.push({name: 'tables.index'})
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


    const updateTable = async (id) =>{

        isLoading.value = true

        //check if user is updating file
        let data = {...table.value}


        await axios.post('/api/tables/'+id, data)
            .then(response =>{
                router.push({name: 'tables.index'})
                swal({
                    icon: 'success',
                    title: 'Table Updated successfully'
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
        tables,
        errors,
        getTables,
        getTable,
        storeTable,
        updateTable,
        isFetching,
        isLoading,
        tableForm,
        paginationMetaData,
        paginationLinks
    }

}
