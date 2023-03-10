<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 ">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="p-12 overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <div class="flex justify-between">
                            <div>
                                <p class="text-3xl font-bold">Invoice #</p>
                            </div>
                            <div class="text-right">
                                <div class="font-semibold text-lg">
                                    Kentuke Fried Chicken
                                </div>
                                <div class="m-2 font-normal text-sm">
                                    291 N 4th St, San Jose, CA 95112, USA
                                </div>
                                <div class="m-2 font-normal text-sm text-gray-500">
                                    01 August, 2023
                                </div>
                            </div>
                        </div>
                        <div class="w-72">
                            <p class="mb-4 text-2xl font-bold">Bill To</p>
                            <p class="text-gray-500 text-base italic">
                                Themesberg Inc., LOUISVILLE, Selby 3864  Johnson Street, United States of America
                                VAT Code: AA-1234567890
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
                                    <th scope="col" class="px-6 py-3">
                                        <span class="sr-only">Edit</span>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="" v-for="item in order?.order_items">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <img class="h-10 w-10 rounded-full" :src="item?.menu_item.image" alt="" />
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">{{ item.menu_item.name }}</div>
                                                <div class="text-gray-500">{{ item.menu_item.description }}</div>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{item.menu_item.price}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{item.qty}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{item.price * item.qty}}
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <a href="#" class="font-medium text-rose-600 dark:text-blue-500 hover:underline">Edit</a>
                                    </td>
                                </tr>
                                </tbody>
                                <tfoot class="space-y-6 border-t border-gray-200 pt-6 text-sm font-medium text-gray-500">
                                    <tr>
                                        <th id="total" colSpan="3" class="text-right">
                                            Total Paid:
                                        </th>
                                        <td class="text-left px-3 py-3.5 border-b border-gray-200 sm:px-6 font-bold">
                                            10,000
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="mt-4 flex justify-end gap-3">
                            <button class="btn-secondary">Print</button>
                            <button class="btn-sm-submit">Reject</button>
                            <button class="btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import useOrders from "../../composables/orders";
import {onMounted} from "vue";
import {useRoute} from "vue-router";

const {order, getOrder} = useOrders()

const router = useRoute()

onMounted(()=>{
    getOrder(router.params.id)
})

</script>

