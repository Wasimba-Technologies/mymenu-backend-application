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
    const ordersURL = ref('/api/orders?page=1')

    const swal = inject('$swal')

    const orderForm = reactive(
        {
            // name: '',
            // start_time: '',
            // end_time: ''
        }
    )

    const getOrders = async (
        order_status='',
        start_date='',
        end_date=''
    ) => {
        isFetching.value = true
        await axios.get(ordersURL.value+
            "&status="+order_status+
            "&start_date="+start_date+
            "&end_date="+ end_date
        )
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
                console.log(response.data)
                if (response.data.status !== 'failure'){
                    data['order_id'] = response.data.order.id
                    await axios.post('/api/order_items', data).then(response =>{
                        swal({
                            icon: 'success',
                            title: 'Order placed successfully'
                        })
                        order.value = response.data
                        router.push(
                            {
                                name: 'order_details.guest',
                            }
                        )
                    }).catch(error => {
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
                }else{
                    swal({
                        icon: 'warning',
                        title: response.data.message
                    })
                }
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

    const changeOrdersUrl = (pageUrl) =>{
        ordersURL.value = pageUrl
    }

    return {
        order,
        orders,
        errors,
        orderForm,
        getOrders,
        getOrder,
        storeOrder,
        numFormat,
        isFetching,
        isLoading,
        isRejecting,
        printReceipt,
        paginationLinks,
        changeOrdersUrl,
        updateOrderStatus,
        paginationMetaData,
    }

}
