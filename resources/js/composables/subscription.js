import {inject, reactive, ref} from "vue";
import router from "../router";


export default function useSubscriptions() {
    const subscriptions = ref([]);
    const subscription = ref({});
    const errors = ref({})
    const isLoading = ref(false)
    const isFetching = ref(false)
    const paginationMetaData = ref({})
    const paginationLinks = ref({})
    const subURL = ref('/api/subscriptions?page=1')

    const swal = inject('$swal')


    const getSubscriptions = async () => {
        isLoading.value = true
        await axios.get(subURL.value).then(response =>{
            subscriptions.value = response.data.data
            paginationMetaData.value = response.data.meta
            paginationLinks.value = response.data.links
        }).catch(error =>{
            swal({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isLoading.value = false
        )
    }

    const getSubscription = async (id) => {
        isFetching.value = true
        await axios.get('/api/subscriptions/'+id).then(response =>{
            subscription.value = response.data.data
        }).catch(error =>{
            swal({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }

    const storeSubscription = async (subscription) =>{
        await axios.post('/api/subscriptions', subscription)
            .then(response => {
                router.push({name: 'dashboard'})
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



    const updateSubscription = async (id) =>{
        isLoading.value = true
        //check if user is updating file
        let data = {...subscription.value}
        await axios.put('/api/subscriptions/'+id, data)
            .then(response =>{
                router.push({name: 'tables.index'})
                swal({
                    icon: 'success',
                    title: 'Subscription Updated successfully'
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
        errors,
        isLoading,
        isFetching,
        subscription,
        subscriptions,
        paginationLinks,
        getSubscription,
        getSubscriptions,
        storeSubscription,
        updateSubscription,
        paginationMetaData,
    }

}
