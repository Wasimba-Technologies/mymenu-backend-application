<template>
    <CustomerNav />
    <div class="bg-white mx-10">
        <div class="mx-auto max-w-3xl">
            <div class="max-w-xl">
                <h1 id="your-orders-heading" class="text-3xl font-bold tracking-tight text-gray-900">Your Orders</h1>
                <p class="mt-2 text-sm text-gray-500">Check the status of recent orders, manage returns, and discover similar products.</p>
            </div>

            <div class="mt-12 space-y-16 sm:mt-16">
                <section v-for="order in orders" :key="order?.id" :aria-labelledby="`${order?.id}-heading`">
                    <div class="space-y-1 md:flex md:items-baseline md:space-x-4 md:space-y-0">
                        <h2 :id="`${order.id}-heading`" class="text-lg font-medium text-gray-900 md:flex-shrink-0">Order #{{ order.id }}</h2>
                        <div class="space-y-5 sm:flex sm:items-baseline sm:justify-between sm:space-y-0 md:min-w-0 md:flex-1">
                            <p class="text-sm font-medium text-gray-500">
                              <span :class="[statusStyles[order?.status], 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize']">
                                            {{ order.status }}
                              </span>
                                on {{order.updated_at}}
                            </p>
                            <div class="flex text-sm font-medium">
                                <a :href="`/order_details/${order.id}`" class="text-rose-600 hover:text-rose-500">Manage order</a>
                                <div class="ml-4 border-l border-gray-200 pl-4 sm:ml-6 sm:pl-6">
                                    <a :href="`/order_details/${order.id}`" class="text-rose-600 hover:text-rose-500">View Invoice</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="-mb-6 mt-6 flow-root divide-y divide-gray-200 border-t border-gray-200">
                        <div v-for="item in order?.order_items" :key="item.id" class="py-6 sm:flex">
                            <div class="flex space-x-4 sm:min-w-0 sm:flex-1 sm:space-x-6 lg:space-x-8">
                                <img :src="item?.image" :alt="item.name" class="h-10 w-10 flex-none rounded-md object-cover object-center sm:h-24 sm:w-24" />
                                <div class="min-w-0 flex-1 pt-1.5 sm:pt-0">
                                    <h3 class="text-sm font-medium text-gray-900">
                                        <router-link :to="`/menu_items/${item.id}`">{{ item.name }}</router-link>
                                    </h3>
                                    <p class="truncate text-sm text-gray-500">
                                      <span v-for="(value,index) in item.values">
                                          {{ value?.name }}  {{ ' ' }}
                                         <span class="mx-1 text-gray-400" aria-hidden="true" v-if="item.values.length !== index">&middot;</span>
                                      </span>
                                    </p>
                                    <p class="mt-1 font-medium text-rose-500">Tsh {{ numFormat(item.price) }}</p>
                                </div>
                            </div>
                            <div class="mt-6 space-y-4 sm:ml-6 sm:mt-0 sm:w-40 sm:flex-none" v-if="order.status === 'Paid' || order.status === 'Shipped' || order.status === 'Delivered'">
                                <button type="button" class="flex w-full items-center justify-center rounded-md border border-transparent bg-rose-600 px-2.5 py-2 text-sm font-medium text-white shadow-sm hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 sm:w-full sm:flex-grow-0" @click="add2ShoppingCart(item)">
                                    Buy again
                                </button>
                            </div>
                            <div class="mt-6 space-y-4 sm:ml-6 sm:mt-0 sm:w-40 sm:flex-none" v-if="order.status === 'Pending'">
                                <RouterLink :to="`/checkout?orderNo=${order.id}`" class="flex w-full items-center justify-center rounded-md border border-transparent bg-rose-600 px-2.5 py-2 text-sm font-medium text-white shadow-sm hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 sm:w-full sm:flex-grow-0">
                                    Checkout
                                </RouterLink>
                            </div>
                        </div>
                    </div>
                </section>
                <div v-if="orders?.length === 0" class="ml-14">
                    <NoDataSVG  />
                    <h3 class="italic text-gray-500">Oops! No orders, place order now!</h3>
                </div>
            </div>
        </div>
    </div>
    <ShoppingCart
        @place-order="placeOrder"
        :currency="tenant?.currency"
        @remove-cart-item="removeCartItem"
        :grand-total="numFormat(grandTotal)"
        :secondary-color="tenant?.secondary_color"
        @handle-qty-change="handleCartItemQtyChange"
    />

    <LoginModal />

</template>

<script setup>
import NoDataSVG from "../../components/NoDataSVG.vue";
import useOrders from "../../composables/orders";
import {computed, onMounted, provide, ref, watch} from "vue";
import CustomerNav from "./components/CustomerNav.vue";
import ShoppingCart from "./components/ShoppingCart.vue";
import LoginModal from "./components/LoginModal.vue";
const tenant = ref(null)
const openLoginModal = ref(false)
const open = ref(false)

const {
    orders,
    numFormat,
    getOrders,
    storeOrder,
    shoppingCart,
    removeCartItem,
    add2ShoppingCart,
    handleCartItemQtyChange,
}= useOrders()

onMounted(async () => {
    await getOrders()
    tenant.value = JSON.parse(sessionStorage.getItem('tenant'))

})

watch(shoppingCart, (new_cart) => {
    shoppingCart.value = new_cart
})

const grandTotal = computed(() => {
    return shoppingCart.value.reduce(
        (total, item) => (item.qty * item.menu_item.price) + total, 0
    )
});

const placeOrder =  () => {
    if (localStorage.getItem('access_token') === null){
        openLoginModal.value = true
        open.value = false
        localStorage.setItem('shopping_cart', JSON.stringify(shoppingCart.value))
        return
    }
    storeOrder(
        {
            'table_id': localStorage.getItem('table_id'),
            'sub_total': parseFloat(grandTotal.value),
            'discount': 0,
            'shipping': 0,
            'tax': 0,
            'grand_total': parseFloat(grandTotal.value),
            'menu_items': shoppingCart.value,
            'delivery_method': 'Dine-In'
        }
    )
    if (localStorage.getItem('shopping_cart') !== null){
        localStorage.removeItem('shopping_cart')
    }
}

const statusStyles = {
    Pending: 'bg-yellow-100 text-yellow-800',
    Confirmed: 'bg-blue-100 text-blue-800',
    Paid: 'bg-green-100 text-green-800',
    Shipped: 'bg-purple-100 text-purple-800',
    Delivered: 'bg-pink-100 text-pink-800',
    Rejected: 'bg-gray-100 text-gray-800',
}

provide('open', open)
provide('tenant', tenant)
provide('shopping_cart', shoppingCart)
provide('openLoginModal', openLoginModal)
provide('openLoginModal', openLoginModal)

</script>

