import {inject, reactive, ref} from "vue";
import {useRouter} from "vue-router";
import { AbilityBuilder, createMongoAbility } from '@casl/ability';
import {ABILITY_TOKEN} from "@casl/vue";
import router from "../router";

export default function useAuth(){
    const isLoading = ref(false)
    const isFetching = ref(false)
    const errors = ref({})
    const roles = ref({})
    const users = ref([])
    const user = ref({})
    //const router = useRouter()
    const paginationMetaData = ref({})
    const paginationLinks = ref({})
    const userURL = ref('/api/users?page=1')
    const swal = inject('$swal')
    const ability = inject(ABILITY_TOKEN)




    const loginForm = reactive(
        {
            'email': '',
            'password': '',
        }
    )

    const ownerForm = reactive(
        {
            'name': '',
            'username': '',
            'phone_number': '',
            'email': '',
            'password': '',
            'password_confirmation': ''
        }
    )

    const userForm = reactive(
        {
            'role_id': '',
            'name': '',
            'username': '',
            'phone_number': '',
            'email': '',
            'password': '',
            'password_confirmation': '',
            'logo': '',
        }
    )



    const submitLogin = async () => {
        if (isLoading.value) return

        isLoading.value = true
        await axios.post('/api/auth/login', loginForm).then(async response =>{
            await loginUser(response)
        }).catch(err =>{
            if(err.response?.data){
                errors.value=err.response.data.errors
            }
        }).finally(
            () => isLoading.value = false
        )
        //router.push('dashboard');
    }


    const registerOwner = async () => {
        if (isLoading.value) return

        isLoading.value = true
        await axios.post('api/auth/register', ownerForm).then(async response =>{
            localStorage.setItem('access_token', response.data.access_token)
            await router.push({path: '/register-restaurant'})
        }).catch(err =>{
            if(err.response?.data){
                errors.value=err.response.data.errors
            }
        }).finally(
            () => isLoading.value = false
        )
    }

    const loginUser  = async (response) => {
        localStorage.setItem('access_token', response.data.access_token)
        if(response.data.user.tenant_id === undefined || response.data.user.tenant_id === null){
            await router.push({path: '/register-restaurant'})
            await getAbilities()
        }else{
            localStorage.setItem('X-Tenant-ID', response.data.user.tenant_id)
            localStorage.setItem('tenant', JSON.stringify(response.data.user.tenant))
            localStorage.setItem('user', JSON.stringify(response.data.user))
            await getAbilities()
            await router.push({path: '/dashboard'})
        }
    }

    const logout = async () => {
        if (isLoading.value) return

        isLoading.value = true

        axios.post('api/auth/logout')
            .then(response => {
                    if (localStorage.getItem('access_token')) {
                        localStorage.removeItem('access_token')
                        localStorage.removeItem('X-Tenant-ID')
                        localStorage.removeItem('user')
                        localStorage.removeItem('tenant')
                    }
                    router.push({ name: 'login' })
                }
            ).catch(err => {
            if(err.response?.data){
                errors.value=err.response.data.errors
            }
        })
            .finally(() => {
                isLoading.value = false
            })
    }

    const getAbilities = () =>{
        axios.get('/api/abilities')
            .then(response => {
                const permissions = response.data
                const { can, rules } = new AbilityBuilder(createMongoAbility)

                can(permissions)

                ability.update(rules)

                console.log(ability.rules)
                console.log(ability.can('restaurants.create'));
            })
    }

    const getRoles = async () =>{
        isFetching.value = true
        await axios.get('/api/auth/roles').then(response =>{
            roles.value = response.data.data
        }).catch(error =>{
            swal({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }

    const getUsers = async () => {
        isFetching.value = true
        //searchName = searchName === undefined ? '' : searchName
        await axios.get(userURL.value).then(response => {
            users.value = response.data.data
            paginationMetaData.value = response.data.meta
            paginationLinks.value = response.data.links
        }).catch(error => {
            swal({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }

    const getUser = async (id) => {
        isFetching.value = true
        await axios.get('/api/users/' + id).then(response => {
            user.value = response.data.data
        }).catch(error => {
            swal({
                icon: 'error',
                title: error.message
            })
        }).finally(
            () => isFetching.value = false
        )
    }

    const storeUser = async (data) => {
        isLoading.value = true;

        //Serialization of formData to include file uploads
        let formData = new FormData();
        for (let item in data) {
            if (data.hasOwnProperty(item)) {
                formData.append(item, data[item])
            }
        }


        await axios.post('/api/users', formData)
            .then(response => {
                user.value = response.data.data
                router.push({name: 'users.index'})
                swal({
                    icon: 'success',
                    title: 'Information Stored successfully'
                })
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

    const updateUser = async (id, data) => {
        isLoading.value = true

        let formData = new FormData();

        for (let item in data) {
            if (data.hasOwnProperty(item)) {
                formData.append(item, data[item])
            }
        }

        // formData = Object.assign(formData, data)
        //Method Spoofing, for laravel put/patch handling
        formData.append("_method", "put");

        //Delete image key if form has no image
        if (!(data.image instanceof File)) {
            formData.delete('image')
        }


        await axios.post('/api/users/' + id, formData)
            .then(response => {
                router.push({name: 'user.index'})
                swal({
                    icon: 'success',
                    title: 'User Updated successfully'
                })
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


    return {
        submitLogin,
        registerOwner,
        logout,
        isLoading,
        isFetching,
        loginForm,
        ownerForm,
        userForm,
        errors,
        roles,
        getAbilities,
        getRoles,
        getUsers,
        getUser,
        storeUser,
        updateUser,
        user,
        users,
        paginationMetaData,
        paginationLinks
    }
}
