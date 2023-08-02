<template>
    <BlurredSpinner v-if="isLoading"/>
</template>

<script setup>

import BlurredSpinner from "../../components/BlurredSpinner.vue";
import {useRoute} from "vue-router";
import {inject, ref} from "vue";
const isLoading = ref(true)
const swal = inject('$swal')
const route = useRoute()
const callBackCode = route.query.code
const provider = ref('google')

if (route.query.path === '/auth/login/facebook/callback'){
    provider.value = 'facebook'
}else if (route.query.path === '/auth/login/google/callback'){
    provider.value = 'google'
}else if (route.query.path === '/auth/login/twitter/callback'){
    provider.value = 'twitter'
}else {
    provider.value = 'google'
}

await axios.get('/api/auth/login/'+provider.value+'/callback?code='+callBackCode)
    .then(res =>{
        isLoading.value = false
        localStorage.setItem('access_token', res.data.access_token)
        let table_id = localStorage.getItem('table_id')
        window.location.href = import.meta.env.VITE_APP_URL + '/browse/'+table_id
    }).catch(err => {
        swal({
            title: "Error",
            text: 'Login was not successful',
            icon: "error",
            button: "OK",
        });
        isLoading.value = false
    })
</script>

