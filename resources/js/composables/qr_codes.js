import {inject, reactive, ref} from "vue";
import router from "../router";


export default function useQRBuilder() {
    const qr_code = ref([]);
    const errors = ref({})
    const isLoading = ref(false)
    const isFetching = ref(false)

    const swal = inject('$swal')

    const qrCodeForm = reactive(
        {
            color: '#000000',
            width: 200,
            caption_line_one: 'Point your Camera here: ',
            caption_line_two: 'to access our menu',
            sub_caption: 'Cant Scan? Visit the below link for the menu:',
            logo: ''
        }
    )

    const storeQRFeatures = async (data) =>{
        isLoading.value = true;

        //Delete image key if form has no image
        if (!(data.logo instanceof File)) {
            delete data.logo
        }

        await axios.post('/api/qr_appearance', data)
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
        storeQRFeatures,
        qr_code
    }

}
