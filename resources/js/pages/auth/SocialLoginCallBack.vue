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

await axios.get('/api/auth/login/google/callback?code='+callBackCode)
    .then(res =>{
        isLoading.value = false
        localStorage.setItem('access_token', res.data.access_token)
        let table_id = localStorage.getItem('table_id')
        window.location.href = '/browse/'+table_id
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

