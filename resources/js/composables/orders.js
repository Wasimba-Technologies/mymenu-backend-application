import {inject, reactive, ref} from "vue";
import router from "../router";


export default function useOrders() {
    const orders = ref([]);
    const order = ref({});
    const errors = ref({})
    const isLoading = ref(false)
    const isFetching = ref(false)
    const isRejecting = ref(false)
    const paginationMetaData = ref({})
    const paginationLinks = ref({})
    const ordersURL = ref('/api/orders')

    const swal = inject('$swal')

    const orderForm = reactive(
        {
            // name: '',
            // start_time: '',
            // end_time: ''
        }
    )

    const getOrders = async () => {
        isFetching.value = true
        await axios.get('/api/orders')
        .then(response =>{
            orders.value = response.data.data
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

    const getOrder = async (id) => {
        isFetching.value = true
        await axios.get('/api/orders/'+id).then(response =>{
            order.value = response.data.data
        }).catch(error =>{
            swal({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }

    const storeOrder = async (data) => {
        data['table_id'] = localStorage.getItem('table_id')
        isLoading.value = true;
        await axios.post('/api/orders', data)
            .then(async response => {
                data['order_id'] = response.data.order.id
                await axios.post('/api/order_items', data).then(response =>{
                    swal({
                        icon: 'success',
                        title: 'Order placed successfully'
                    })
                    order.value = response.data
                }
                ).catch(error => {
                        if (error.response?.data) {
                            errors.value = error.response.data.errors
                        } else {
                            swal({
                                icon: 'error',
                                title: error.message
                            })
                        }
                    }
                ).finally(
                    () => isLoading.value = false
                )
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


    const updateOrderStatus = async (id, data) =>{

        if(data.status !=='Confirmed'){
            isRejecting.value = true
        }
        isLoading.value = true

        await axios.put('/api/orders/'+id, data)
            .then(response =>{
                //window.location.reload()
                swal({
                    icon: 'success',
                    title: response.data.message
                })
                order.value = response.data.data
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
                () => {
                    isLoading.value = false
                    isRejecting.value = false
                }
            )
    }

    const printReceipt = async (order_id) => {
        await axios.get('/api/print/' + order_id, {responseType: 'blob'})
            .then(response => {
                console.log(response)
                let url = window.URL.createObjectURL(new Blob([response.data],{type: 'application/pdf'}));
                //Open the URL on new Window
                const pdfWindow = window.open();
                pdfWindow.location.href = url;
                window.URL.revokeObjectURL(response.data)
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
                () => {
                    isLoading.value = false
                    isRejecting.value = false
                }
            )
    }

    const numFormat= (num) =>{
        return new Intl.NumberFormat().format(num)
    }

    return {
        order,
        orders,
        errors,
        getOrders,
        getOrder,
        storeOrder,
        updateOrderStatus,
        isFetching,
        isLoading,
        isRejecting,
        orderForm,
        paginationMetaData,
        paginationLinks,
        numFormat,
        printReceipt
    }

}
