<template>
<div class="px-4">
    <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
        <BrowserNav />
    </div>
    <div class="mt-4">
        <AutoComplete label="Filter Menu" :items="menus"/>
    </div>
    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-3">
        <div v-for="product in menu_items" :key="product.id" class="relative flex items-center space-x-2 rounded-lg border border-gray-300 bg-white px-4 py-3 shadow-sm focus-within:ring-2 focus-within:ring-rose-500 focus-within:ring-offset-2 hover:border-gray-400">
            <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                <img :src="product.image" :alt="product.imageAlt" class="h-full w-full object-cover object-center" />
            </div>

            <div class="ml-4 flex flex-1 flex-col justify-between">
                <div class="flex flex-col">
                    <div class="flex justify-between text-base font-medium text-gray-900">
                        <p>
                             {{product.name}}
                        </p>
                        <select :id="`quantity-${product.id}`" :name="`quantity-${product.id}`" class="max-w-full rounded-md border border-gray-300 py-1 text-left text-base font-medium leading-5 text-gray-700 shadow-sm focus:border-rose-500 focus:outline-none focus:ring-1  focus:ring-rose-500 sm:text-xs">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                        <p class="ml-4 text-xs">{{ product.price }}</p>
                    </div>
                </div>
                <div class="mt-3 flex flex-1 items-end justify-between text-xs">
                    <p class="text-gray-500">{{ product.description }}</p>
                    <div class="flex">
                        <button type="button" class="font-medium text-rose-600 hover:text-rose-500">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ShoppingCart />
</div>
</template>

<script setup>


import {onMounted, provide, ref} from "vue";
import AutoComplete from "../../components/AutoComplete.vue";
import BrowserNav from "./components/BrowserNav.vue";
import ShoppingCart from "./components/ShoppingCart.vue";
import {useRoute} from "vue-router";
import useMenuItems from "../../composables/menu_items";
import useMenus from "../../composables/menus";

const {menu_items, browseMenuByTable} = useMenuItems()
const {menus, getMenus} = useMenus()

const products = [
    {
        id: 1,
        name: 'Throwback Hip Bag',
        href: '#',
        color: 'Salmon',
        price: '$90.00',
        quantity: 1,
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg',
        imageAlt: 'Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt.',
    },
    {
        id: 2,
        name: 'Medium Stuff Satchel',
        href: '#',
        color: 'Blue',
        price: '$32.00',
        quantity: 1,
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-02.jpg',
        imageAlt:
            'Front of satchel with blue canvas body, black straps and handle, drawstring top, and front zipper pouch.',
    },
    {
        id: 1,
        name: 'Throwback Hip Bag',
        href: '#',
        color: 'Salmon',
        price: '$90.00',
        quantity: 1,
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg',
        imageAlt: 'Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt.',
    },
    {
        id: 2,
        name: 'Medium Stuff Satchel',
        href: '#',
        color: 'Blue',
        price: '$32.00',
        quantity: 1,
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-02.jpg',
        imageAlt:
            'Front of satchel with blue canvas body, black straps and handle, drawstring top, and front zipper pouch.',
    },
    {
        id: 1,
        name: 'Throwback Hip Bag',
        href: '#',
        color: 'Salmon',
        price: '$90.00',
        quantity: 1,
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg',
        imageAlt: 'Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt.',
    },
    {
        id: 2,
        name: 'Medium Stuff Satchel',
        href: '#',
        color: 'Blue',
        price: '$32.00',
        quantity: 1,
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-02.jpg',
        imageAlt:
            'Front of satchel with blue canvas body, black straps and handle, drawstring top, and front zipper pouch.',
    },
    {
        id: 1,
        name: 'Throwback Hip Bag',
        href: '#',
        color: 'Salmon',
        price: '$90.00',
        quantity: 1,
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg',
        imageAlt: 'Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt.',
    },
    {
        id: 2,
        name: 'Medium Stuff Satchel',
        href: '#',
        color: 'Blue',
        price: '$32.00',
        quantity: 1,
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-02.jpg',
        imageAlt:
            'Front of satchel with blue canvas body, black straps and handle, drawstring top, and front zipper pouch.',
    },    {
        id: 1,
        name: 'Throwback Hip Bag',
        href: '#',
        color: 'Salmon',
        price: '$90.00',
        quantity: 1,
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg',
        imageAlt: 'Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt.',
    },
    {
        id: 2,
        name: 'Medium Stuff Satchel',
        href: '#',
        color: 'Blue',
        price: '$32.00',
        quantity: 1,
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-02.jpg',
        imageAlt:
            'Front of satchel with blue canvas body, black straps and handle, drawstring top, and front zipper pouch.',
    },
    {
        id: 1,
        name: 'Throwback Hip Bag',
        href: '#',
        color: 'Salmon',
        price: '$90.00',
        quantity: 1,
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-01.jpg',
        imageAlt: 'Salmon orange fabric pouch with match zipper, gray zipper pull, and adjustable hip belt.',
    },
    {
        id: 2,
        name: 'Medium Stuff Satchel',
        href: '#',
        color: 'Blue',
        price: '$32.00',
        quantity: 1,
        imageSrc: 'https://tailwindui.com/img/ecommerce-images/shopping-cart-page-04-product-02.jpg',
        imageAlt:
            'Front of satchel with blue canvas body, black straps and handle, drawstring top, and front zipper pouch.',
    },
]
const open = ref(false)
const router = useRoute()


onMounted(()=>{
    getMenus('')
    browseMenuByTable(router.params.id)
})

provide('open', open)

provide('menu_items', menu_items)



</script>

