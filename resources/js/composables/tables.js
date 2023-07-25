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
            Toast.fire({
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
            Toast.fire({
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


    const updateTable = async (id) =>{

        isLoading.value = true

        //check if user is updating file
        let data = {...table.value}


        await axios.put('/api/tables/'+id, data)
            .then(response =>{
                router.push({name: 'tables.index'})
                Toast.fire({
                    icon: 'success',
                    title: 'Table Updated successfully'
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

    const printQR = async (table) => {
        await axios.get('/api/print_qr/' + table.id, {responseType: 'blob'})
            .then(response => {
                let url = window.URL.createObjectURL(new Blob([response.data],{type: 'application/pdf'}));
                //Open the URL on new Window
                const pdfWindow = window.open();
                pdfWindow.location.href = url;
                window.URL.revokeObjectURL(response.data)
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
                () => {
                    isLoading.value = false
                }
            )
    }

    return {
        table,
        tables,
        errors,
        getTables,
        getTable,
        storeTable,
        updateTable,
        printQR,
        isFetching,
        isLoading,
        tableForm,
        paginationMetaData,
        paginationLinks
    }

}
