<template>
    <MenuFormComponent
        :menu-form="menu"
        :is-loading="isLoading"
        @submitMenu="changeMenu"
        form-description="Update your menu by filling the form below"
        btn-message="Update"
        :errors="errors"
    />
</template>

<script setup>
import {onMounted, provide} from "vue";
import useMenus from "../../composables/menus";
import MenuFormComponent from "./components/MenuFormComponent.vue";
import {useRoute} from "vue-router";

const {errors, menu, isLoading, updateMenu, getMenu} = useMenus()
const route = useRoute()

const changeMenu = async () => {
    await updateMenu(route.params.id);
}

onMounted(()=>{
    getMenu(route.params.id)
})


provide('isLoading', isLoading)

</script>
