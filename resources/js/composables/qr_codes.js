import {inject, reactive, ref} from "vue";
import router from "../router";


export default function useQRCodes() {
    const qr_code = ref([]);
    const errors = ref({})
    const isLoading = ref(false)
    const isFetching = ref(false)

    const swal = inject('$swal')

    const qrCodeForm = reactive(
        {
            table_id: '',
            color: '#000000',
            label: 'Point your Camera here to access our menu'
        }
    )

    const generateQR = async (data) =>{
        isLoading.value = true;

        await axios.post('/api/generate_qr', data)
            .then(response =>{
                qr_code.value = response.data
                swal({
                    icon: 'success',
                    title: response.data.message
                })
                console.log(qr_code.value)
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

    const getQRCode = async () => {

    }


    return {
        errors,
        isFetching,
        isLoading,
        qrCodeForm,
        generateQR,
        qr_code
    }

}
