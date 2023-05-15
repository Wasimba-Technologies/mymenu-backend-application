<template>
    <MenuFormComponent
        :menu-form="menuForm"
        :is-loading="isLoading"
        @submitMenu="saveMenu"
        form-description="Register your menu by filling the form below"
        btn-message="Register"
        :errors="errors"
    />
</template>

<script setup>
import {provide} from "vue";
import useMenus from "../../composables/menus";
import MenuFormComponent from "./components/MenuFormComponent.vue";
import utils from "../../utils/utils";
import {useAbility} from "@casl/vue";
import useAuth from "../../composables/auth";

const {errors, menuForm, isLoading, storeMenu} = useMenus()


const saveMenu = async () => {
    await storeMenu({...menuForm});
}

//utils.has_perm('menus.create')
const {can} = useAbility()
const {logout} = useAuth()

if(!can('menus.create')){
    logout()
}
provide('isLoading', isLoading)

</script>
