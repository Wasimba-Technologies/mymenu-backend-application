<template>
    <BlurredSpinner v-if="isFetching" />
    <UserFormComponent
        :user-form="modified_user"
        :roles="roles"
        :is-loading="isLoading"
        @submitUser="changeUser"
        :img-url="tempImgUrl"
        @load-image="loadImage"
        form-description="Update your User by filling the form below"
        btn-message="Update"
        :errors="errors"
    />
</template>

<script setup>
import {onMounted, provide, ref, watch, } from "vue";
import {useRoute} from "vue-router";
import useAuth from "../../composables/auth";
import UserFormComponent from "./components/UserFormComponent.vue";
import BlurredSpinner from "../../components/BlurredSpinner.vue";

const {
    errors,
    user,
    roles,
    isLoading,
    isFetching,
    updateUser,
    getUser,
    getRoles,
} = useAuth()

const route = useRoute()

const modified_user = ref({})

const changeUser = async () => {
    await updateUser(route.params.id, {...modified_user.value});
}

const tempImgUrl = ref(null)


const loadImage = (event) => {
    modified_user.value.image = event.target.files[0]
    //Preview Image
    tempImgUrl.value = window.URL.createObjectURL(event.target.files[0])
    URL.revokeObjectURL(event.target.files[0])
}


provide('isLoading', isLoading)

onMounted(()=>{
    console.log(route.params.id)
    getUser(route.params.id)
    getRoles()
})

watch(user, ()=>{
    modified_user.value.name = user.value.name
    modified_user.value.gender = user.value.gender
    modified_user.value.email = user.value.email
    modified_user.value.phone_number = user.value.phone_number
    modified_user.value.image =  user.value.image
    modified_user.value.role_id = user.value.role_id
})

</script>
