import {inject, reactive, ref} from "vue";
import router from "../router";


export default function useOrders() {
    const orders = ref([]);
    const order = ref({});
    const errors = ref({})
    const isLoading = ref(false)
    const isFetching = ref(false)
    const paginationMetaData = ref({})
    const paginationLinks = ref({})
    const ordersURL = ref('/api/orders')

    const swal = inject('$swal')

    const orderForm = reactive(
        {
            name: '',
            start_time: '',
            end_time: ''
        }
    )

    const getOrders = async () => {
        isFetching.value = true
        await axios.get(ordersURL)
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
        isLoading.value = true;

        await axios.post('/api/orders', data)
            .then(response =>{
                order.value = response.data.data
                router.push({name: 'orders.index'})
                swal({
                    icon: 'success',
                    title: 'Order placed successfully'
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


    const updateOrder = async (id) =>{

        isLoading.value = true

        //check if user is updating file
        let data = {...order.value}



        await axios.post('/api/orders/'+id, data)
            .then(response =>{
                router.push({name: 'orders.index'})
                swal({
                    icon: 'success',
                    title: 'Order Updated successfully'
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
        orders,
        errors,
        getOrders,
        getOrder,
        storeOrder,
        updateOrder,
        isFetching,
        isLoading,
        orderForm,
        paginationMetaData,
        paginationLinks
    }

}
