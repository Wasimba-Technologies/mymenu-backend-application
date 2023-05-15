<template>
    <BlurredSpinner v-if="isFetching" />
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
import BlurredSpinner from "../../components/BlurredSpinner.vue";
import utils from "../../utils/utils";

const {errors, menu, isLoading, isFetching, updateMenu, getMenu} = useMenus()
const route = useRoute()

const changeMenu = async () => {
    await updateMenu(route.params.id);
}

onMounted(()=>{
    getMenu(route.params.id)
})


provide('isLoading', isLoading)

utils.has_perm('menus.update')
</script>
