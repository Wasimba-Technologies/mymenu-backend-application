<template>
    <BlurredSpinner v-if="isFetching" />
    <CustomerNav />
    <div class="p-4 flex flex-col">
        <title>MyMenu | My Orders</title>
        <div class="bg-white">
        <div class="mx-auto max-w-7xl px-4 py-2 sm:px-6 lg:px-8 lg:pb-24">
            <div class="max-w-xl">
                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">Order summary</h1>
                <p class="mt-2 text-sm text-gray-500">Check the status of recent orders, pay for orders</p>
            </div>

            <div class="mt-8">
                <h2 class="sr-only">Recent orders</h2>
                <div class="space-y-20">
                    <div>
                        <h3 class="sr-only">
                            Order placed on <time :datetime="order.datetime">{{ order.created_at }}</time>
                        </h3>
                        <div class="rounded-lg bg-gray-50 px-4 py-3 sm:flex sm:items-center sm:justify-between sm:space-x-6 sm:px-6 lg:space-x-8">
                            <dl class="flex-auto space-y-6 divide-y divide-gray-200 text-sm text-gray-600 sm:grid sm:grid-cols-3 sm:gap-x-6 sm:space-y-0 sm:divide-y-0 lg:w-1/2 lg:flex-none lg:gap-x-8">
                                <div class="flex justify-between pt-2 sm:block sm:pt-0">
                                    <dt class="font-medium text-gray-900">Bill To</dt>
                                    <dd class="sm:mt-1">{{ order.table?.name }}</dd>
                                </div>
                                <div class="flex justify-between pt-6 font-medium text-gray-900 sm:block sm:pt-0">
                                    <dt>Order Status</dt>
                                    <dd class="sm:mt-1">
                                        <span :class="[statusStyles[order.status], 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize']">
                                            {{ order.status }}
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <table class="mt-4 w-full text-gray-500 sm:mt-6">
                            <caption class="sr-only">
                                Products
                            </caption>
                            <thead class="sr-only text-left text-sm text-gray-500 sm:not-sr-only">
                            <tr>
                                <th scope="col" class="py-3 pr-8 font-normal sm:w-2/5 lg:w-1/3">Product</th>
                                <th scope="col" class="hidden w-1/5 py-3 pr-8 font-normal sm:table-cell">Price</th>
                                <th scope="col" class="hidden py-3 pr-8 font-normal sm:table-cell">Status</th>
                                <th scope="col" class="w-0 py-3 text-right font-normal">Info</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 border-b border-gray-200 text-sm sm:border-t">
                            <tr v-for="product in order.order_items" :key="product.id">
                                <td class="py-6 pr-8">
                                    <div class="flex items-center">
                                        <img :src="product.image" :alt="product.name" class="mr-6 h-16 w-16 rounded object-cover object-center" />
                                        <div>
                                            <div class="font-medium text-gray-900">{{ product.name }}</div>
                                            <div class="mt-1 sm:hidden">{{tenant.currency}} {{ numFormat(product.price) }}x{{ product.pivot.qty }} = {{ numFormat(product.price * product.pivot.qty)}} </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="hidden py-6 pr-8 sm:table-cell">{{tenant.currency}} {{ numFormat(product.price) }}</td>
                                <td class="hidden py-6 pr-8 sm:table-cell">{{ product.status }}</td>
                                <td class="whitespace-nowrap py-6 text-right font-medium">
                                    <a :href="product.href" :style="`${tenant.value?.secondary_color}`">View<span class="hidden lg:inline"> Product</span><span class="sr-only">, {{ product.name }}</span></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="mt-2">
                            <section aria-labelledby="summary-heading" class="mt-8 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8">
                                <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>

                                <dl class="mt-6 space-y-4">
                                    <div class="flex items-center justify-between">
                                        <dt class="text-sm text-gray-600">Subtotal</dt>
                                        <dd class="text-sm font-medium text-gray-900">Tsh {{numFormat(order.grand_total)}}</dd>
                                    </div>
                                    <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                        <dt class="flex items-center text-sm text-gray-600">
                                            <span>Shipping estimate</span>
                                            <a href="#" class="ml-2 flex-shrink-0 text-gray-400 hover:text-gray-500">
                                                <span class="sr-only">Learn more about how shipping is calculated</span>
                                                <QuestionMarkCircleIcon class="h-5 w-5" aria-hidden="true" />
                                            </a>
                                        </dt>
                                        <dd class="text-sm font-medium text-gray-900">+Tsh {{numFormat(order.shipping)}}</dd>
                                    </div>
                                    <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                        <dt class="flex text-sm text-gray-600">
                                            <span>Tax estimate</span>
                                            <a href="#" class="ml-2 flex-shrink-0 text-gray-400 hover:text-gray-500">
                                                <span class="sr-only">Learn more about how tax is calculated</span>
                                                <QuestionMarkCircleIcon class="h-5 w-5" aria-hidden="true" />
                                            </a>
                                        </dt>
                                        <dd class="text-sm font-medium text-gray-900">+Tsh {{numFormat(order.tax)}}</dd>
                                    </div>
                                    <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                                        <dt class="text-base font-medium text-gray-900">Order total</dt>
                                        <dd class="text-base font-medium text-gray-900">Tsh {{numFormat(order.grand_total)}}</dd>
                                    </div>
                                </dl>

                                <div class="mt-6" v-if="order.status !== 'Paid'">
                                    <a :href="`/checkout?orderNo=${order.id}`" :style="`background-color: ${tenant?.secondary_color};`" type="submit" class="w-full hover:opacity-90 text-center rounded-md border border-transparent px-4 py-3 text-base font-medium text-white shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
                                        Pay Now
                                    </a>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

</template>


<script setup>
    import useOrders from "../../composables/orders";
    import {useRoute} from "vue-router";
    import {computed, inject, onMounted, provide, ref} from "vue";
    import BlurredSpinner from "../../components/BlurredSpinner.vue";
    import {ABILITY_TOKEN, useAbility} from "@casl/vue";
    import useAuth from "../../composables/auth";
    import {  QuestionMarkCircleIcon} from '@heroicons/vue/20/solid'
    import CustomerNav from "./components/CustomerNav.vue";
    import ShoppingCart from "./components/ShoppingCart.vue";
    import LoginModal from "./components/LoginModal.vue";


    const {
        order,
        isLoading,
        isRejecting,
        isFetching,
        numFormat,
        getOrder
    } = useOrders()
    const {can} = useAbility()
    const {logout} = useAuth()
    const ability = inject(ABILITY_TOKEN)
    const {getAbilities} = useAuth()

    const router = useRoute()

    const swal = inject('$swal')

    onMounted(()=>{
        getOrder(router.params.id)
    })

    const grandTotal = computed(() => {
        return numFormat(order.value.order_items?.reduce((total, item) => (item.pivot.qty*item.price) + total, 0))
    });

    const isDisabled = computed(() =>{
        return isLoading.value || isRejecting.value || order.value.status !== "Pending"
    })

    const active = computed(() =>{
        return  order.value.status === "Pending"
    })

    onMounted(async () => {
        //if URL changes perform side effects
        await getAbilities()
        if (!can('orders.view')) {
            await logout()
        }
    })

    const tenant = JSON.parse(sessionStorage.getItem('tenant'))

    const statusStyles = {
        Confirmed: 'bg-green-100 text-green-800',
        Paid: 'bg-green-100 text-green-800',
        Done: 'bg-green-100 text-green-800',
        Pending: 'bg-yellow-100 text-yellow-800',
        Rejected: 'bg-gray-100 text-gray-800',
    }

    const currentPageTitle = computed(() =>{
        return router.meta.title;
    })

    provide('tenant', tenant)

</script>


