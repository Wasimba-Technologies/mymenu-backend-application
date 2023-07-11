<template>
    <BlurredSpinner v-if="isFetching" />
    <MenuFormComponent
        :menu-form="menu"
        :is-loading="isLoading"
        @submitMenu="changeMenu"
        form-description="Update your menu by filling the form below"
        btn-message="Update"
        :errors="errors"
        :img-url="tempImgUrl"
        @load-image="loadImage"
    />
</template>

<script setup>
import {inject, onMounted, provide, ref} from "vue";
import useMenus from "../../composables/menus";
import MenuFormComponent from "./components/MenuFormComponent.vue";
import {useRoute} from "vue-router";
import BlurredSpinner from "../../components/BlurredSpinner.vue";
import {ABILITY_TOKEN, useAbility} from "@casl/vue";
import useAuth from "../../composables/auth";

const {errors, menu, isLoading, isFetching, updateMenu, getMenu} = useMenus()
const route = useRoute()
const tempImgUrl = ref(null)

const changeMenu = async () => {
    await updateMenu(route.params.id);
}

onMounted(()=>{
    getMenu(route.params.id)
})
const {can} = useAbility()
const {logout} = useAuth()
const ability = inject(ABILITY_TOKEN)
const {getAbilities} = useAuth()

onMounted(async () => {
    await getAbilities()

    if (!can('menus.update')) {
        await logout()
    }
})

const loadImage = (event) => {
    menu.value.image = event.target.files[0]
    //Preview Image
    tempImgUrl.value = window.URL.createObjectURL(event.target.files[0])
    URL.revokeObjectURL(event.target.files[0])
}

provide('isLoading', isLoading)

</script>
