<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="sm:flex sm:items-center flex-row-reverse">
            <div class="mt-4 sm:mt-0 sm:ml-16 sm:flex-none">
                <router-link v-if="can('menu_items.create')" to="/menu-items/create"
                             class="inline-flex items-center justify-center rounded-md border border-transparent
                                         bg-rose-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-rose-700
                                         focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 sm:w-auto">
                    Add Item
                </router-link>
            </div>
        </div>
        <div class="mt-4 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <TableSearch @searchData="searchMenuItemsByName" />
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Menu Item</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Price</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Menu Category</th>
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
                            <tr v-for="menu_item in menu_items" :key="menu_item.id">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                    <div class="flex items-center">
                                        <div class="h-10 w-10 flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full" :src="menu_item?.image" alt="" />
                                        </div>
                                        <div class="ml-4">
                                            <div class="font-medium text-gray-900">{{ menu_item.name }}</div>
                                            <div class="text-gray-500">{{ menu_item.description }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{Intl.NumberFormat().format(menu_item.price)}}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{menu_item.menu?.name}}
                                </td>
                                <td>
                                    <router-link :to="`/menu-items/${menu_item.id}/update`" class="px-3 py-4 text-rose-600 hover:text-rose-900" :disabled="can('menu_items.update')">Edit</router-link>
                                </td>
                            </tr>
                            <tr v-if="menu_items?.length === 0 && ! isFetching">
                                <td colSpan="5">
                                    <NoDataSVG
                                        class="flex flex-col justify-center items-center mt-10"
                                        message="Oops! There are no menu items Yet."
                                    />
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end mt-2">
                        <Pagination v-if="menu_items?.length !== 0"
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
import SkeletonPlaceHolder from "../../components/SkeletonPlaceHolder.vue";
import NoDataSVG from "../../components/NoDataSVG.vue";
import useMenuItems from "../../composables/menu_items";
import utils from "../../utils/utils";
import {useAbility} from "@casl/vue";
import useAuth from "../../composables/auth";

const searchName = ref('')
const {
    menu_items,
    getMenuItems,
    paginationLinks,
    paginationMetaData,
    changeTenantsUrl,
    isFetching
} = useMenuItems()



const onNextClicked = () => {
    changeTenantsUrl(paginationLinks.value.next)
}

const onPrevClicked =() =>{
    changeTenantsUrl(paginationLinks.value.prev)
}

onMounted(()=>{
    //if URL changes perform side effects
    watchEffect(()=>getMenuItems(searchName.value))
})



watch(searchName, (currentName) => {
    getMenuItems(currentName)
})

const searchMenuItemsByName = (ev) => {
    searchName.value = ev.target.value
}

//utils.has_perm('menu_items.view')
const {can} = useAbility()
const {logout} = useAuth()

if(!can('menu_items.viewAny')){
    logout()
}
</script>

