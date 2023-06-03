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
import {inject, onMounted, provide} from "vue";
import useMenus from "../../composables/menus";
import MenuFormComponent from "./components/MenuFormComponent.vue";
import utils from "../../utils/utils";
import {ABILITY_TOKEN, useAbility} from "@casl/vue";
import useAuth from "../../composables/auth";
const {can} = useAbility()
const {logout} = useAuth()
const ability = inject(ABILITY_TOKEN)
const {getAbilities} = useAuth()

onMounted(async () => {
    await getAbilities()

    if (!can('menus.create')) {
        await logout()
    }
})

const {errors, menuForm, isLoading, storeMenu} = useMenus()


const saveMenu = async () => {
    await storeMenu({...menuForm});
}

//utils.has_perm('menus.create')


provide('isLoading', isLoading)

</script>
