<template>
    <NavDrawer />
    <div class="m-4 flex justify-between">
        <h1 :style="`color: ${tenant?.secondary_color}`" :class="`text-2xl font-bold`">{{tenant?.name}}</h1>
        <div class="flex space-x-2">
            <div class="relative border-2 border-solid border-gray-500  rounded-lg cursor-pointer" @click="shopping_cart.length !== 0 ? open = true: open = false">
                <svg class="m-2 h-4 w-4 flex-shrink-0 text-gray-500 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                </svg>
                <div>
                        <span :class="`absolute -top-1 -right-2 inline-flex items-center rounded-full bg-rose-100 px-1.5 py-0.5 text-xs font-medium text-rose-800`">
                            {{shopping_cart?.length === undefined ? 0 : shopping_cart?.length}}
                        </span>
                </div>
            </div>
            <div class="border-2 border-solid border-gray-500  rounded-lg cursor-pointer" @click="sideBarOpen = !sideBarOpen">
                <svg class="m-2 h-4 w-4 flex-shrink-0 text-gray-500 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                </svg>
            </div>
        </div>
    </div>
</template>

<script setup>
import {inject, provide, ref} from "vue";
import NavDrawer from "./NavDrawer.vue";
const sideBarOpen = ref(false)


const open = inject('open')
const shopping_cart = inject('shopping_cart')
const tenant = inject('tenant')

provide('sideBarOpen', sideBarOpen)
</script>

