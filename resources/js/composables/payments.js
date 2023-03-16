import {inject, reactive, ref} from "vue";
import router from "../router";


export default function usePayments() {
    const payments = ref([]);
    const payment = ref({});
    const errors = ref({})
    const isLoading = ref(false)
    const isFetching = ref(false)
    const paginationMetaData = ref({})
    const paginationLinks = ref({})

    const swal = inject('$swal')

    const paymentForm = reactive(
        {
            // name: '',
            // start_time: '',
            // end_time: ''
        }
    )

    const getPayments = async () => {
        isFetching.value = true
        await axios.get('/api/orders')
            .then(response =>{
                payments.value = response.data.data
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

    const getPayment = async (id) => {
        isFetching.value = true
        await axios.get('/api/payments/'+id).then(response =>{
            payment.value = response.data.data
        }).catch(error =>{
            swal({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }

    const storePayment = async (data) => {
        isLoading.value = true;
        await axios.post('/api/payments', data)
            .then(async response => {
                let order_id = response.data.payment.order_id
                await axios.put('/api/orders/'+order_id,
                {
                    'status': 'Paid'
                }).then(response =>{
                        swal({
                            icon: 'success',
                            title: 'Payment recorded successfully'
                        })
                        router.push({name:'orders.index'})
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


    const numFormat= (num) =>{
        return new Intl.NumberFormat().format(num)
    }

    return {
        payment,
        payments,
        errors,
        getPayments,
        getPayment,
        storePayment,
        isFetching,
        isLoading,
        paymentForm,
        paginationMetaData,
        paginationLinks,
        numFormat
    }

}
