<template>
<div class="px-4">
    <div class="relative pt-6 px-4 sm:px-6 lg:px-8">
        <BrowserNav />
    </div>
    <div class="mt-4">
        <AutoComplete label="Filter Menu" :items="menus" />
    </div>
    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
        <div v-for="product in menu_items" :key="product.id" class="relative flex items-center space-x-2 rounded-lg border border-gray-300 bg-white px-4 py-3 shadow-sm focus-within:ring-2 focus-within:ring-rose-500 focus-within:ring-offset-2 hover:border-gray-400">
            <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                <img :src="product.image" :alt="product.name" class="h-full w-full object-cover object-center" />
            </div>

            <div class="ml-4 flex flex-1 flex-col justify-between">
                <div class="flex flex-col">
                    <div class="flex justify-between text-base font-medium text-gray-900">
                        <p class="font-medium">
                             {{product.name}}
                        </p>
                        <select :id="`quantity-${product.id}`" :name="`quantity-${product.id}`" class="max-w-full rounded-md border border-gray-300 py-1 text-left text-base font-medium leading-5 text-gray-700 shadow-sm focus:border-rose-500 focus:outline-none focus:ring-1  focus:ring-rose-500 sm:text-xs">
                            <option v-for="option in 10" :value="option">{{option}}</option>
                        </select>
                        <p class="ml-4 text-xs font-extrabold">Tsh {{ new Intl.NumberFormat().format(product.price) }}</p>
                    </div>
                </div>
                <div class="mt-3 flex flex-1 items-end justify-between text-xs">
                    <p class="text-gray-500">{{ product.description }}</p>
                    <div class="flex">
                        <button type="button" class="font-medium text-rose-600 hover:text-rose-500" @click="addToShoppingCart(product)">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <ShoppingCart
        @handle-qty-change="handleQtyChange"
        @remove-cart-item="removeItem"
        :grand-toal = "grandTotal"
    />
</div>
</template>

<script setup>


import {onMounted, provide, ref, watch} from "vue";
import AutoComplete from "../../components/AutoComplete.vue";
import BrowserNav from "./components/BrowserNav.vue";
import ShoppingCart from "./components/ShoppingCart.vue";
import {useRoute} from "vue-router";
import useMenuItems from "../../composables/menu_items";
import useMenus from "../../composables/menus";

const {menu_items, browseMenuByTable} = useMenuItems()
const {menus, getMenus} = useMenus()

const open = ref(false)
const router = useRoute()

const shopping_cart = ref([])

const grandTotal = ref(0.0)


onMounted(()=>{
    getMenus('')
    browseMenuByTable(router.params.id)
})

const addToShoppingCart = (product) => {
    let index = shopping_cart.value
        .map(function (el) {
            return el.menu_item.id;
        })
        .indexOf(product.id);

    if (index === -1) {
        shopping_cart.value.push({
            'menu_item': product,
            'qty': parseInt(document.getElementById(`quantity-${product.id}`).value)
        })
    } else {
        //Increment if Product exists and update state
        shopping_cart.value = shopping_cart.value.map((item) => {
            if (item.menu_item.id === product.id) {
                item.qty++;
            }
            return item;
        })
    }

}

const removeItem = (product) =>{
    //remove product from products
    shopping_cart.value = shopping_cart.value.filter((item) => item.menu_item.id !== product.menu_item.id)
}

const handleQtyChange = (event, product) =>{
    shopping_cart.value = shopping_cart.value.map((item) => {
        if (item.menu_item.id === product.menu_item.id) {
            console.log('change this product')
            item.qty = event.target.value
        }
        return item;
    })
}




provide('open', open)

provide('menu_items', menu_items)

watch(shopping_cart, (new_cart) => {
    shopping_cart.value = new_cart
    //grandTotal.value = calculateOrderTotal()
})


provide('shopping_cart', shopping_cart)


</script>

