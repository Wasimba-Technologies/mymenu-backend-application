<template>
    <UserFormComponent
        :user-form="userForm"
        :roles="roles"
        :is-loading="isLoading"
        @submitUser="saveUser"
        :img-url="tempImgUrl"
        @load-image="loadImage"
        form-description="Register your Users by filling the form below"
        btn-message="Register"
        :errors="errors"
    />
</template>

<script setup>
import {onMounted, provide, ref} from "vue";
import useAuth from "../../composables/auth";
import UserFormComponent from "./components/UserFormComponent.vue";

const {errors, userForm, isLoading, roles, getRoles, storeUser} = useAuth()


const saveUser = async () => {
    await storeUser({...userForm});
}

const tempImgUrl = ref(null)


const loadImage = (event) => {
    userForm.image = event.target.files[0]
    console.log(event.target.files[0])
    //Preview Image
    tempImgUrl.value = window.URL.createObjectURL(event.target.files[0])
    URL.revokeObjectURL(event.target.files[0])
}


provide('isLoading', isLoading)

onMounted(()=>{
    getRoles()
})

</script>
