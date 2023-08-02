<template>
    <BlurredSpinner v-if="isFetching" />
    <div class="mt-10 p-4 flex flex-col">
        <title>MyMenu | My Orders</title>
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
        <div class="">
            <h2 class="text-xl text-gray-700 font-bold md:text-2xl lg:text-3xl">
                {{currentPageTitle}}
            </h2>
        </div>
        <div class="px-4 sm:px-6 lg:px-8">
            <div class="mt-8 ">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="p-12 overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-3xl font-bold">Invoice # {{order.id}}</p>
                                </div>
                                <div class="text-right">
                                    <div class="font-semibold text-lg">
                                        {{order.restaurant?.name}}
                                    </div>
                                    <div class="m-2 font-normal text-sm">
                                        {{order?.restaurant?.address_one}},
                                        {{order?.restaurant?.address_two}},
                                        {{order?.restaurant?.country}}
                                    </div>
                                    <div class="m-2 font-normal text-sm text-gray-500">
                                        {{order?.created_at}}
                                    </div>
                                </div>
                            </div>
                            <div class="w-72">
                                <p class="mb-4 text-2xl font-bold">Bill To</p>
                                <p class="text-gray-500 text-base italic">
                                    {{order.table?.name}}
                                </p>
                            </div>
                            <div class="mt-6 relative overflow-x-auto sm:rounded-lg">
                                <table class="w-full text-sm text-left text-gray-500">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Product name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Qty
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            SubTotal
                                        </th>
                                        <!--                                    <th scope="col" class="px-6 py-3">-->
                                        <!--                                        <span class="sr-only">Edit</span>-->
                                        <!--                                    </th>-->
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="" v-for="item in order?.order_items" :key="item.id">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex-shrink-0">
                                                    <img class="h-10 w-10 rounded-full" :src="item?.image" alt="" />
                                                </div>
                                                <div class="ml-4">
                                                    <div class="font-medium text-gray-900">{{ item.name }}</div>
                                                    <div class="text-gray-500">{{ item.description }}</div>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="px-6 py-4">
                                            {{numFormat(item.price)}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{item.pivot.qty}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{numFormat(item.price * item.pivot.qty)}}
                                        </td>
                                        <!--                                    <td class="px-6 py-4 text-right">-->
                                        <!--                                        <a href="#" class="font-medium text-rose-600 hover:underline">Edit</a>-->
                                        <!--                                    </td>-->
                                    </tr>
                                    </tbody>
                                    <tfoot class="space-y-6 border-t border-gray-200 pt-6 text-sm font-medium text-gray-500">
                                    <tr>
                                        <th id="total" colSpan="3" class="text-right">
                                            Total Paid:
                                        </th>
                                        <td class="text-left px-3 py-3.5 border-b border-gray-200 sm:px-6 font-bold">
                                            {{grandTotal}}
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
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
    import usePayments from "../../composables/payments";
    import {useRoute} from "vue-router";
    import {computed, inject, onMounted, provide, watchEffect} from "vue";
    import BlurredSpinner from "../../components/BlurredSpinner.vue";
    import RibbonConfirmed from "../../components/RibbonConfirmed.vue";
    import RibbonRejected from "../../components/RibbonRejected.vue";
    import RibbonPending from "../../components/RibbonPending.vue";
    import {ABILITY_TOKEN, useAbility} from "@casl/vue";
    import useAuth from "../../composables/auth";

    const {
        order,
        isLoading,
        isRejecting,
        isFetching,
        numFormat,
        getOrder
    } = useOrders()

    const {storePayment, errors} = usePayments()
    const {can} = useAbility()
    const {logout} = useAuth()
    const ability = inject(ABILITY_TOKEN)
    const {getAbilities} = useAuth()

    const router = useRoute()

    const swal = inject('$swal')

    onMounted(()=>{
        console.log((router.params.id))
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


    const currentPageTitle = computed(() =>{
        return router.meta.title;
    })
</script>


