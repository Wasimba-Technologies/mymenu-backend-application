import router from "../router";
import {inject, ref} from "vue";
import config from "tailwindcss/defaultConfig";


export default function usePaymentProcessor(){
    const swal = inject('$swal')
    const paymentLoading = ref(false)
    const AZAMPAY_MNO_CHECKOUT_URL = 'https://sandbox.azampay.co.tz/azampay/mno/checkout'
    const AZAMPAY_AUTHENTICATOR_URL = 'https://authenticator-sandbox.azampay.co.tz/AppRegistration/GenerateToken'
    const getAzamPayAccessToken = async () => {
        const data = {
            appName: import.meta.env.VITE_APP_NAME,
            clientId: import.meta.env.VITE_AZAMPAY_CLIENT_ID,
            clientSecret: import.meta.env.VITE_AZAMPAY_SECRET_KEY
        }

        try {
            const response = await fetch(AZAMPAY_AUTHENTICATOR_URL, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(data),
            })
            const result = await response.json();
            if (result.statusCode === 200){
                sessionStorage.setItem('azam_api_key', result?.data?.accessToken)
                sessionStorage.setItem('azam_api_expiry', result?.data?.expire)
            }else{
                swal({
                    icon: 'error',
                    title: result.title
                })
            }
        }catch(err){
            console.error(err);
            swal({
                icon: 'error',
                title: err.message
            })
        }

    }

    const initiateAzamPayPayment = async (data) => {
        paymentLoading.value = true

        const AZAM_API_KEY = sessionStorage.getItem('azam_api_key')
        const AZAM_KEY_EXPIRY = sessionStorage.getItem('azam_api_expiry')
        if (AZAM_API_KEY && AZAM_KEY_EXPIRY){
            if (AZAM_KEY_EXPIRY < Date.now()) {
                console.log('Not expired')
            }
        }
        try {
            const response = await fetch(AZAMPAY_MNO_CHECKOUT_URL, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "Authorization": "Bearer "+AZAM_API_KEY
                },
                body: JSON.stringify(data),
            })
            const result = await response.json();
            if (result.success){
                swal({
                    icon: 'success',
                    title: 'Payment is Processing'
                })
            }else{
                swal({
                    icon: 'error',
                    title: result.message
                })
            }
        }catch(err){
            console.error(err);
            swal({
                icon: 'error',
                title: err.message
            })
        }

    }

    const checkAzamPayTransactionStatus = async(channelStr, eventStr) =>{
        Echo.private(channelStr)
            .listen(eventStr, (e) => {
                console.log(e.subscription);
                if (e.subscription.status === 'active'){
                    swal({
                        icon: 'success',
                        title: 'Subscription Paid successfully'
                    })
                    router.push({name: 'subscriptions.index'})
                }else{
                    swal({
                        icon: 'error',
                        title: 'Subscription Could not Paid! Contact support'
                    })
                }
                paymentLoading.value = false
            })
    }

    return {
        paymentLoading,
        getAzamPayAccessToken,
        initiateAzamPayPayment,
        checkAzamPayTransactionStatus
    }
}
