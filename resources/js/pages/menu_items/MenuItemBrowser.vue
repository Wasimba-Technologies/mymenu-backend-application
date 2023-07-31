<template>
    <div class="mt-10 p-4 flex flex-col">
        <title>MyMenu | Browse Menu</title>
        <div class="mb-4 flex justify-between">
            <h1 :style="`color: ${tenant?.secondary_color}`" :class="`text-2xl font-bold`">{{tenant?.name}}</h1>
            <div class="flex space-x-2">
<!--                <div class="border-2 border-solid border-gray-500  rounded-lg cursor-pointer">-->
<!--                    <svg class="m-2 w-4 h-4 flex-shrink-0 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">-->
<!--                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>-->
<!--                    </svg>-->
<!--                </div>-->
                <div class="relative border-2 border-solid border-gray-500  rounded-lg cursor-pointer" @click="shopping_cart.length !== 0 ? open = true: open = false">
                    <svg class="m-2 h-4 w-4 flex-shrink-0 text-gray-500 group-hover:text-gray-500" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z"></path>
                    </svg>
                    <div class="">
                        <span :class="`absolute -top-1 -right-2 inline-flex items-center rounded-full bg-rose-100 px-1.5 py-0.5 text-xs font-medium text-rose-800`">
                            {{shopping_cart?.length === undefined ? 0 : shopping_cart?.length}}
                        </span>
                    </div>
                </div>
                <div class="border-2 border-solid border-gray-500  rounded-lg cursor-pointer">
                    <svg class="m-2 h-4 w-4 flex-shrink-0 text-gray-500 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"></path>
                    </svg>
                </div>
            </div>
        </div>
        <div class="flex overflow-auto">
            <button  type="button" :style="[activeFilter===null || activeFilter===undefined ? activeFilterStyle : inactiveFilterStyle]" :class="[activeFilter===null || activeFilter===undefined ? activeFilterClass : inactiveFilterClass]" @click="filterMenuItems('All')" @mouseover="addMouseOverStyle($event)" @mouseout="removeMouseOverStyle($event)">
                All
            </button>
            <button id="menuFilterBtn" v-for="menu in menus" :key="menu.id" type="button" :style="[activeFilter=== menu.id ? activeFilterStyle : inactiveFilterStyle]" :class="[activeFilter=== menu.id ? activeFilterClass : inactiveFilterClass]" @click="filterMenuItems(menu)" @mouseover="addMouseOverStyle($event)" @mouseout="removeMouseOverStyle($event)">
                {{menu.name}}
            </button>
        </div>
        <div class="">
            <div class="mt-4 flow-root">
                <div class="-my-2">
                    <div class="relative box-content h-24 overflow-x-auto py-2 xl:overflow-visible">
                        <div class="min-w-screen-xl absolute flex space-x-8 px-4 sm:px-6 lg:px-8 xl:relative xl:grid xl:grid-cols-5 xl:gap-x-8 xl:space-x-0 xl:px-0">
                            <router-link v-for="menu in menus" :key="menu.id" to="" class="bg-white border border-gray-200 rounded-lg shadow relative flex h-24 w-52 flex-col overflow-hidden p-6 hover:opacity-75 xl:w-auto">
                              <span aria-hidden="true" class="absolute inset-0">
                                <img :src="menu.image" loading="lazy" class="h-full w-full object-cover object-center"  alt=""/>
                              </span>
                                <span aria-hidden="true" class="absolute inset-x-0 bottom-0 h-2/3 bg-gradient-to-t from-gray-800 opacity-50" />
                                <span class="relative align-text-bottom text-lg font-bold text-white">51% OFF</span>
                                <span class="relative  align-text-bottom text-sm font-semibold text-white">{{ menu.name }}</span>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2">
            <div v-for="product in menu_products" :key="product.id" class="relative flex items-center space-x-2 rounded-lg border border-gray-300 bg-white px-4 py-3 shadow-sm hover:border-[#740053]">
                <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                    <img :src="product.image == null ? product.menu.image : product.image" :alt="product.name" class="h-full w-full object-cover object-center" />
                </div>

                <div class="ml-4 flex flex-1 flex-col justify-between">
                    <div class="flex flex-col">
                        <div class="flex justify-between text-base font-medium text-gray-900">
                            <p class="font-medium">
                                {{product.name}}
                            </p>
                        </div>
                    </div>
                    <div class="mt-3 flex flex-1 items-end justify-between text-xs">
                        <p class="text-gray-500">{{ product.description }}</p>
                    </div>
                    <div class="mt-4 flex justify-between">
                        <p :style="`color: ${tenant?.primary_color};`" :class="`text-xs font-extrabold`">Tsh {{ new Intl.NumberFormat().format(product.price) }}</p>
                        <span class="" @click="addToShoppingCart(product)">
                            <svg :style="`background-color: ${tenant?.secondary_color}`" class="h-4 w-4 rounded-full font-bold text-white cursor-pointer" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <p class="flex flex-col justify-center items-center mt-10 italic" v-if="menu_products.length === 0">
            Oops! There are no items in this category
        </p>
    </div>

    <ShoppingCart
        @handle-qty-change="handleQtyChange"
        @remove-cart-item="removeItem"
        @place-order="placeOrder"
        :grand-total="numFormat(grandTotal)"
        :secondary-color="tenant?.secondary_color"
    />

    <LoginModal />
</template>

<script setup>


import {computed, onMounted, provide, ref, watch} from "vue";
import AutoComplete from "../../components/AutoComplete.vue";
import BrowserNav from "./components/BrowserNav.vue";
import ShoppingCart from "./components/ShoppingCart.vue";
import {useRoute} from "vue-router";
import useMenuItems from "../../composables/menu_items";
import useMenus from "../../composables/menus";
import useOrders from "../../composables/orders";
import LoginModal from "./components/LoginModal.vue";
import NoDataSVG from "../../components/NoDataSVG.vue";

const {menu_items, browseMenuByTable} = useMenuItems()
const {menus, getMenus} = useMenus()
const {storeOrder, numFormat} = useOrders()
const open = ref(false)
const openLoginModal = ref(false)
const router = useRoute()
const shopping_cart = ref([])
const menu_products = ref([])
const activeFilter = ref(null)

onMounted(async () => {
    await getMenus('')
    await browseMenuByTable(router.params.id)
    if (localStorage.getItem('shopping_cart') !== null) {
        shopping_cart.value = JSON.parse(localStorage.getItem('shopping_cart'))
    }
})

watch(menu_items,() =>{
    //re-assign into new variable to enable non db filtering, see filter fn below
    menu_products.value = menu_items.value
})

const addToShoppingCart = (product) => {
    console.log(product)
    let index = shopping_cart.value
        .map(function (el) {
            return el.menu_item.id;
        })
        .indexOf(product.id);

    if (index === -1) {
        shopping_cart.value.push({
            'menu_item_id': product.id,
            'menu_item': product,
            'qty': 1
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
            item.qty = event.target.value
        }
        return item;
    })
}

const placeOrder =  () => {
    if (localStorage.getItem('access_token') === null){
        openLoginModal.value = true
        open.value = false
        localStorage.setItem('shopping_cart', JSON.stringify(shopping_cart.value))
        return
    }
    storeOrder(
        {
            'table_id': router.params.id,
            'sub_total': parseFloat(grandTotal.value),
            'discount': 0,
            'shipping': 0,
            'tax': 0,
            'grand_total': parseFloat(grandTotal.value),
            'menu_items': shopping_cart.value,
            'delivery_method': 'Dine-In'
        }
    )
    if (localStorage.getItem('shopping_cart') !== null){
        localStorage.removeItem('shopping_cart')
    }
}


watch(shopping_cart, (new_cart) => {
    shopping_cart.value = new_cart
})

const grandTotal = computed(() => {
    return shopping_cart.value.reduce(
        (total, item) => (item.qty * item.menu_item.price) + total, 0
    )
});

const filterMenuItems = (item) =>{
    if (item === 'All'){
        activeFilter.value = null
        menu_products.value = menu_items.value
    }else{
        activeFilter.value = item.id
        menu_products.value = menu_items.value?.filter((menu_item)=>{
            return menu_item?.menu.id === item.id
        })
    }
}

const currentPageTitle = computed(() =>{
    return router.meta.title;
})

const tenant = JSON.parse(sessionStorage.getItem('tenant'))

const activeFilterStyle = `background-color: ${tenant?.secondary_color}; color: "white"; outline-color:${tenant?.secondary_color};`
const activeFilterClass = `text-white flex-shrink-0  hover:text-white border border-[${tenant?.secondary_color}] focus:outline-none focus:ring-2 focus:ring-[${tenant?.secondary_color}] font-medium rounded-full text-xs px-2.5 py-1 mr-2 mb-2`

const inactiveFilterStyle = `background-color: "white"; color: ${tenant?.secondary_color};`
const inactiveFilterClass = `flex-shrink-0  hover:text-white border border-[${tenant?.secondary_color}] focus:outline-none focus:ring-2 focus:ring-[${tenant?.secondary_color}] font-medium rounded-full text-xs px-2.5 py-1 mr-2 mb-2`

const addMouseOverStyle = (event) =>{
    event.currentTarget.style.backgroundColor = tenant.secondary_color
    event.currentTarget.style.color = "white"
}

const removeMouseOverStyle = (event) =>{
    event.currentTarget.style.backgroundColor = "white"
    event.currentTarget.style.color = tenant.secondary_color
}


provide('open', open)
provide('openLoginModal', openLoginModal)
provide('menu_items', menu_items)
provide('shopping_cart', shopping_cart)


</script>

