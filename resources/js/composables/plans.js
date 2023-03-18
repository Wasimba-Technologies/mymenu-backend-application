import {inject, reactive, ref} from "vue";
import router from "../router";


export default function usePlans() {
    const plans = ref([]);
    const plan = ref({});
    const errors = ref({})
    const isLoading = ref(false)
    const isFetching = ref(false)
    const paginationMetaData = ref({})
    const paginationLinks = ref({})
    const planURL = ref('/api/plans')

    const swal = inject('$swal')

    const planForm = reactive(
        {
            menu_items: '',
            views: '',
            orders: '',
            users: '',
            dedicated_support: '',
            price: ''
        }
    )

    const getPlans = async () => {
        isFetching.value = true
        //searchName = searchName === undefined ? '' : searchName
        await axios.get(planURL.value).then(response =>{
            plans.value = response.data.data
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

    const getPlan = async (id) => {
        isFetching.value = true
        await axios.get('/api/plans/'+id).then(response =>{
            plan.value = response.data.data
        }).catch(error =>{
            swal({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }

    const storePlan = async (data) => {
        isLoading.value = true;

        await axios.post('/api/plans', data)
            .then(response =>{
                plan.value = response.data.data
                router.push({name: 'plans.index'})
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


    const updatePlan = async (id) =>{

        isLoading.value = true

        //check if user is updating file
        let data = {...plan.value}


        await axios.post('/api/plans/'+id, formData)
            .then(response =>{
                router.push({name: 'plans.index'})
                swal({
                    icon: 'success',
                    title: 'Plan Updated successfully'
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
        plan,
        plans,
        errors,
        getPlans,
        getPlan,
        storePlan,
        updatePlan,
        isFetching,
        isLoading,
        planForm,
        paginationMetaData,
        paginationLinks
    }

}
