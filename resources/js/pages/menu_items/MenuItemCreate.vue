<template>
    <MenuItemFormComponent
        :menu-item-form="menuItemForm"
        :menus="menus"
        :is-loading="isLoading"
        @submitMenuItem="saveMenuItem"
        :img-url="tempImgUrl"
        @load-image="loadImage"
        form-description="Register your menu items by filling the form below"
        btn-message="Register"
        :errors="errors"
    />
</template>

<script setup>
import {inject, onMounted, provide, ref, watchEffect} from "vue";
    import useMenuItems from "../../composables/menu_items";
    import MenuItemFormComponent from "./components/MenuItemFormComponent.vue";
    import useMenus from "../../composables/menus";
    import utils from "../../utils/utils";
import {ABILITY_TOKEN, useAbility} from "@casl/vue";
    import useAuth from "../../composables/auth";

    const {errors, menuItemForm, isLoading, storeMenuItem} = useMenuItems()

    const {menus, getMenus} = useMenus();

    const saveMenuItem = async () => {
        await storeMenuItem({...menuItemForm});
    }

    const tempImgUrl = ref(null)


    const loadImage = (event) => {
        menuItemForm.image = event.target.files[0]
        console.log(event.target.files[0])
        //Preview Image
        tempImgUrl.value = window.URL.createObjectURL(event.target.files[0])
        URL.revokeObjectURL(event.target.files[0])
    }


    provide('isLoading', isLoading)

    onMounted(async () => {
        watchEffect(() => getMenus(""))

        await getAbilities()

        if (!can('menu_items.create')) {
            await logout()
        }
    })
    const {logout} = useAuth()
    const ability = inject(ABILITY_TOKEN)
    const { can } = useAbility()
    const {getAbilities} = useAuth()


    //utils.has_perm('menu_items.create')
</script>

