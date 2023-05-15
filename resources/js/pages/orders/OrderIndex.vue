<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center flex-row-reverse">
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
            </div>
        </div>
        <div class="mt-4 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <TableSearch @searchData="searchMenuByName" />
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Order</th>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Table</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-if="isFetching">
                                <td colSpan="5">
                                    <SkeletonPlaceHolder />
                                </td>
                            </tr>
                            <tr v-for="order in orders" :key="order.id">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                    <div class="font-medium text-gray-900">Order # {{ order.id }}</div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{order.table?.name}}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    <span :class="[statusStyles[order.status], 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize']">
                                        {{ order.status }}
                                    </span>
                                </td>
                                <td>
                                    <router-link :to="`/orders/${order.id}/details`" class="px-3 py-4 text-rose-600 hover:text-rose-900">Edit</router-link>
                                </td>
                            </tr>
                            <tr v-if="orders?.length === 0 && ! isFetching">
                                <td colSpan="5">
                                    <NoDataSVG
                                        class="flex flex-col justify-center items-center mt-10"
                                        message="Oops! There are no buses Yet."
                                    />
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end mt-2">
                        <Pagination v-if="orders?.length !== 0"
                                    @on-prev-clicked="onPrevClicked"
                                    @on-next-clicked="onNextClicked"
                                    :is-next="paginationLinks?.next"
                                    :is-prev="paginationLinks?.prev"
                                    :meta="paginationMetaData"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import {onMounted, ref, watch, watchEffect} from "vue";
import Pagination from "../../components/Pagination.vue";
import TableSearch from "../../components/TableSearch.vue";
import useMenus from "../../composables/menus";
import SkeletonPlaceHolder from "../../components/SkeletonPlaceHolder.vue";
import NoDataSVG from "../../components/NoDataSVG.vue";
import useOrders from "../../composables/orders";
import utils from "../../utils/utils";

const searchName = ref('')
const {
    order,
    orders,
    getOrders,
    isFetching,
    paginationLinks,
    changeTenantsUrl,
    paginationMetaData,

} = useOrders()



const onNextClicked = () => {
    changeTenantsUrl(paginationLinks.value.next)
}

const onPrevClicked =() =>{
    changeTenantsUrl(paginationLinks.value.prev)
}

onMounted(()=>{
    //if URL changes perform side effects
    watchEffect(()=>getOrders())
})



watch(searchName, (currentName) => {
    getOrders(currentName)
})

const searchMenuByName = (ev) => {
    searchName.value = ev.target.value
}

const statusStyles = {
    Confirmed: 'bg-green-100 text-green-800',
    Paid: 'bg-green-100 text-green-800',
    Pending: 'bg-yellow-100 text-yellow-800',
    Rejected: 'bg-gray-100 text-gray-800',
}

utils.has_perm('orders.view')
</script>
