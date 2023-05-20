import {inject, reactive, ref} from "vue";
import router from "../router";
import useSubscriptions from "./subscription";

export default function useTenants(){
    const tenants = ref({});
    const tenant = ref({});
    const errors = ref({})
    const isLoading = ref(false)
    const isFetching = ref(false)
    const paginationMetaData = ref({})
    const paginationLinks = ref({})
    const tenantsURL = ref('/api/tenants?page=1')
    const {storeSubscription} = useSubscriptions()
    const swal = inject('$swal')

    const tenantForm = reactive(
        {
            name: '',
            email: '',
            phone_number: '',
            address_one: '',
            address_two: '',
            country: '',
            currency: '',
            plan_id: '',
            logo: ''
        }
    )


    const getTenants = async (searchName) => {
        isFetching.value = true
        searchName = searchName === undefined ? '' : searchName
        await axios.get(tenantsURL.value+'&name='+searchName).then(response =>{
            tenants.value = response.data.data
            paginationMetaData.value = response.data.meta
            paginationLinks.value = response.data.links
        }).catch(error =>{
            //console.log(error)
            swal({
                icon: 'error',
                title: error.response.data.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }

    const getTenant = async (id) => {
        isFetching.value = true
        await axios.get('/api/tenants/'+id).then(response =>{
            tenant.value = response.data.data
        }).catch(error =>{
            swal({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }

    const storeTenant = async (data) =>{
        isLoading.value = true
        //Serialization of formData to include file uploads
        let formData = new FormData();
        for(let item in data){
            if(data.hasOwnProperty(item)){
                formData.append(item, data[item])
            }
        }

        await axios.post('/api/tenants', formData)
            .then(async response => {
                tenants.value = response.data.data
                localStorage.setItem('X-Tenant-ID', response.data.data.id)
                const subscription = {
                    'plan': response.data.data.plan
                }
                //After creating a Tenant, Start a 7 days Subscription immediately
                await storeSubscription(subscription)
                swal({
                    icon: 'success',
                    title: ' Information saved successfully'
                })
                //await router.push({name: 'dashboard'})
            }).catch(error =>{
                console.log(error)
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

    const updateTenant = async (id) =>{

        isLoading.value = true

        //check if user is updating file
        let data = {...tenant.value}
        let formData = new FormData();
        for(let item in data){
            if(data.hasOwnProperty(item)){
                formData.append(item, data[item])
            }
        }
        //Method Spoofing, for laravel put/patch handling
        formData.append("_method", "put");

        //Delete Logo key if form has no image
        if (!(data.logo instanceof File)){
            formData.delete('logo')
        }

        // for (const pair of formData.entries()) {
        //     console.log(`${pair[0]}, ${pair[1]}`);
        // }

        await axios.post('/api/tenants/'+id, formData)
            .then(response =>{
                router.push({name: 'settings'})
                swal({
                    icon: 'success',
                    title: 'Information Updated successfully'
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

    const changeTenantsUrl = (pageUrl) =>{
        tenantsURL.value = pageUrl
    }

    const changeFilteringUrl = (name) =>{
        tenantsURL.value = 'api/tenants?page=1'
        tenantsURL.value = tenantsURL.value+'&name='+name
    }



    return {
        tenants,
        tenant,
        errors,
        getTenant,
        getTenants,
        storeTenant,
        updateTenant,
        isFetching,
        isLoading,
        tenantForm,
        paginationMetaData,
        paginationLinks,
        changeTenantsUrl,
        changeFilteringUrl
    }
}
