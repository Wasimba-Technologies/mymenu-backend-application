<template>
    <MenuFormComponent
        :menu-form="menuForm"
        :is-loading="isLoading"
        @submitMenu="saveMenu"
        form-description="Register your menu by filling the form below"
        btn-message="Register"
        :errors="errors"
        :img-url="tempImgUrl"
        @load-image="loadImage"
    />
</template>

<script setup>
import {inject, onMounted, provide, ref} from "vue";
import useMenus from "../../composables/menus";
import MenuFormComponent from "./components/MenuFormComponent.vue";
import {ABILITY_TOKEN, useAbility} from "@casl/vue";
import useAuth from "../../composables/auth";
const {can} = useAbility()
const {logout} = useAuth()
const ability = inject(ABILITY_TOKEN)
const {getAbilities} = useAuth()
const tempImgUrl = ref(null)
const {errors, menuForm, isLoading, storeMenu} = useMenus()


onMounted(async () => {
    await getAbilities()

    if (!can('menus.create')) {
        await logout()
    }
})


const saveMenu = async () => {
    await storeMenu({...menuForm});
}

const loadImage = (event) => {
    menuForm.image = event.target.files[0]
    //Preview Image
    tempImgUrl.value = window.URL.createObjectURL(event.target.files[0])
    URL.revokeObjectURL(event.target.files[0])
}


provide('isLoading', isLoading)

</script>
