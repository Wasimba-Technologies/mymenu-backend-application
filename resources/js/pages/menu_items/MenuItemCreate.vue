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
    import {onMounted, provide, ref, watchEffect} from "vue";
    import useMenuItems from "../../composables/menu_items";
    import MenuItemFormComponent from "./components/MenuItemFormComponent.vue";
    import useMenus from "../../composables/menus";
    import utils from "../../utils/utils";
    import {useAbility} from "@casl/vue";
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

    onMounted(()=>{
        watchEffect(()=>getMenus(""))
    })
    const {can} = useAbility()
    const {logout} = useAuth()

    if(!can('menu_items.create')){
        logout()
    }
    //utils.has_perm('menu_items.create')
</script>

