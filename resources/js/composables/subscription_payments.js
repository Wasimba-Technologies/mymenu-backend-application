import {inject, reactive, ref} from "vue";
import router from "../router";


export default function useSubscriptionPayments() {
    const subscription_payments = ref([]);
    const subscription_payment = ref({});
    const errors = ref({})
    const isLoading = ref(false)
    const isFetching = ref(false)
    const paginationMetaData = ref({})
    const paginationLinks = ref({})


    const getSubscriptionPayments = async (subscription_id) => {
        isLoading.value = true
        await axios.get('/api/subscriptions/'+subscription_id+'/payments').then(response =>{
            subscription_payments.value = response.data.data
            paginationMetaData.value = response.data.meta
            paginationLinks.value = response.data.links
        }).catch(error =>{
            Toast.fire({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isLoading.value = false
        )
    }


    const storeSubscriptionPayment = async (subscription_id, payment) =>{
        await axios.post('/api/subscriptions/'+subscription_id+'/payments', payment)
            .then(response => {
                router.push({name: 'dashboard'})
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


    const numFormat =  (num) => {
        return new Intl.NumberFormat().format(num)
    }



    return {
        errors,
        isLoading,
        numFormat,
        isFetching,
        paginationLinks,
        paginationMetaData,
        subscription_payment,
        subscription_payments,
        getSubscriptionPayments,
        storeSubscriptionPayment,
    }

}
