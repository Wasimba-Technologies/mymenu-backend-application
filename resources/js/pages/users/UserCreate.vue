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
import {inject, onMounted, provide, ref} from "vue";
import useAuth from "../../composables/auth";
import UserFormComponent from "./components/UserFormComponent.vue";
import utils from "../../utils/utils";
import {ABILITY_TOKEN, useAbility} from "@casl/vue";

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

const {can} = useAbility()
const {logout} = useAuth()
const ability = inject(ABILITY_TOKEN)
const {getAbilities} = useAuth()

//getAbilities()
onMounted(async () => {
    await getAbilities()
    if (!can('users.create')) {
        await logout()
    }
})

</script>
