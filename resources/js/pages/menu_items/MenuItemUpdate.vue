<template>
    <MenuItemFormComponent
        :menu-item-form="modified_menu_item"
        :menus="menus"
        :is-loading="isLoading"
        @submitMenuItem="changeMenuItem"
        :img-url="tempImgUrl"
        @load-image="loadImage"
        form-description="Update your menu items by filling the form below"
        btn-message="Update"
        :errors="errors"
    />
</template>

<script setup>
import {onMounted, provide, ref, watch, watchEffect} from "vue";
import useMenuItems from "../../composables/menu_items";
import MenuItemFormComponent from "./components/MenuItemFormComponent.vue";
import useMenus from "../../composables/menus";
import {useRoute} from "vue-router";

const {
    errors,
    menu_item,
    isLoading,
    updateMenuItem,
    getMenuItem
} = useMenuItems()

const {menus, getMenus} = useMenus();
const route = useRoute()

const modified_menu_item = ref({})

const changeMenuItem = async () => {
    await updateMenuItem(route.params.id, {...modified_menu_item.value});
}

const tempImgUrl = ref(null)


const loadImage = (event) => {
    modified_menu_item.value.image = event.target.files[0]
    //Preview Image
    tempImgUrl.value = window.URL.createObjectURL(event.target.files[0])
    URL.revokeObjectURL(event.target.files[0])
}


provide('isLoading', isLoading)

onMounted(()=>{
    getMenuItem(route.params.id)
    watchEffect(()=>getMenus(""))
})

watch(menu_item, ()=>{
    modified_menu_item.value.name = menu_item.value.name
    modified_menu_item.value.description = menu_item.value.description
    modified_menu_item.value.price = menu_item.value.price
    modified_menu_item.value.image =  menu_item.value.image
    modified_menu_item.value.menu_id = menu_item.value.menu.id
})

</script>

