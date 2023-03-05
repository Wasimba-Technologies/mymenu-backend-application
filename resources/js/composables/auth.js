import {reactive, ref} from "vue";
import {useRouter} from "vue-router";

export default function useAuth(){
    const isLoading = ref(false)
    const errors = ref({})
    const router = useRouter()

    const loginForm = reactive(
        {
            'email': '',
            'password': '',
        }
    )

    const registerForm = reactive(
        {
            'name': '',
            'username': '',
            'phone_number': '',
            'email': '',
            'password': '',
            'password_confirmation': ''
        }
    )

    const user = reactive({
        'name' : '',
        'email': ''
    })


    const submitLogin = async () => {
        if (isLoading.value) return

        isLoading.value = true
        await axios.post('/api/auth/login', loginForm).then(async response =>{
            loginUser(response)
        }).catch(err =>{
            if(err.response?.data){
                errors.value=err.response.data.errors
            }
        }).finally(
            () => isLoading.value = false
        )
        //router.push('dashboard');
    }


    const submitRegister = async () => {
        if (isLoading.value) return

        isLoading.value = true
        await axios.post('api/auth/register', registerForm).then(async response =>{
            await loginUser(response)
        }).catch(err =>{
            if(err.response?.data){
                errors.value=err.response.data.errors
            }
            console.log(err)
        }).finally(
            () => isLoading.value = false
        )
    }

    const loginUser  = async (response) => {
        localStorage.setItem('access_token', response.data.access_token)
        if(response.data.user.tenant_id === null){
            await router.push({path: '/register-restaurant'})
        }else{
            localStorage.setItem('X-Tenant-ID', response.data.user.tenant_id)
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


    return {
        submitLogin,
        submitRegister,
        logout,
        isLoading,
        loginForm,
        registerForm,
        errors
    }
}
