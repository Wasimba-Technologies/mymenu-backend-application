<template>
    <h2 class="mx-auto mt-8 px-4 text-lg leading-6 font-medium text-gray-900 sm:px-6 lg:px-8">Recent activity</h2>

    <!-- Activity list (smallest breakpoint only) -->
    <div class="shadow sm:hidden">
        <ul role="list" class="mt-2 divide-y divide-gray-200 overflow-hidden shadow sm:hidden">
            <li v-for="order in orders" :key="order.id">
                <a :href="order.href" class="block px-4 py-4 bg-white hover:bg-gray-50">
                  <span class="flex items-center space-x-4">
                    <span class="flex-1 flex space-x-2 truncate">
                      <ShoppingBagIcon class="flex-shrink-0 h-5 w-5 text-gray-400" aria-hidden="true" />
                      <span class="flex flex-col text-gray-500 text-sm truncate">
                        <span class="truncate">{{ order.name }}</span>
                        <span
                        ><span class="text-gray-900 font-medium">{{ order.amount }}</span> {{ order.currency }}</span
                        >
                        <time :datetime="order.datetime">{{ order.date }}</time>
                      </span>
                    </span>
                    <ChevronRightIcon class="flex-shrink-0 h-5 w-5 text-gray-400" aria-hidden="true" />
                  </span>
                </a>
            </li>
        </ul>

        <nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200" aria-label="Pagination">
            <div class="flex-1 flex justify-between">
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"> Previous </a>
                <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:text-gray-500"> Next </a>
            </div>
        </nav>
    </div>

    <!-- Activity table (small breakpoint and up) -->
    <div class="hidden sm:block">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col mt-2">
                <div class="align-middle min-w-full overflow-x-auto shadow overflow-hidden sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" scope="col">Order</th>
                            <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider" scope="col">Amount</th>
                            <th class="hidden px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider md:block" scope="col">Status</th>
                            <th class="px-6 py-3 bg-gray-50 text-right text-xs font-medium text-gray-500 uppercase tracking-wider" scope="col">Date</th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        <tr v-for="order in orders" :key="order.id" class="bg-white">
                            <td class="max-w-0 w-full px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex">
                                    <a :href="order.href" class="group inline-flex space-x-2 truncate text-sm">
                                        <ShoppingBagIcon class="flex-shrink-0 h-5 w-5 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                                        <p class="text-gray-500 truncate group-hover:text-gray-900">
                                            {{ order?.table.name }}
                                        </p>
                                    </a>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                <span class="text-gray-900 font-medium">{{ order.amount }} </span>
                                {{ order.currency }}
                            </td>
                            <td class="hidden px-6 py-4 whitespace-nowrap text-sm text-gray-500 md:block">
                              <span :class="[statusStyles[order.status], 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize']">
                                {{ order.status }}
                              </span>
                            </td>
                            <td class="px-6 py-4 text-right whitespace-nowrap text-sm text-gray-500">
                                <time :datetime="order.datetime">{{ order?.created_at }}</time>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- Pagination -->
                    <!-- Pagination -->
                    <nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6" aria-label="Pagination" v-if="orders.length !== 0">
                        <div class="hidden sm:block">
                            <p class="text-sm text-gray-700">
                                Showing
                                {{ ' ' }}
                                <span class="font-medium">{{paginationMetaData.from}}</span>
                                {{ ' ' }}
                                to
                                {{ ' ' }}
                                <span class="font-medium">{{paginationMetaData.to}}</span>
                                {{ ' ' }}
                                of
                                {{ ' ' }}
                                <span class="font-medium">{{ paginationMetaData.total }}</span>
                                {{ ' ' }}
                                results
                            </p>
                        </div>
                        <div class="flex-1 flex justify-between sm:justify-end">
                            <button @click="onPrevClicked" :disabled="!paginationLinks?.prev" class="disabled:cursor-not-allowed relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Previous </button>
                            <button @click="onNextClicked" :disabled="!paginationLinks?.next" class="disabled:cursor-not-allowed ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50"> Next </button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

</template>


<script setup>
import {
    ShoppingBagIcon,
    ChevronRightIcon,
} from '@heroicons/vue/20/solid'

// const orders = [
//     {
//         id: 1,
//         name: 'Table Zebra Inside',
//         href: '#',
//         amount: '$900',
//         currency: 'USD',
//         status: 'success',
//         date: 'July 11, 2022',
//         datetime: '2020-07-11',
//     },
//     {
//         id: 2,
//         name: 'Table Lion Inside',
//         href: '#',
//         amount: '$200',
//         currency: 'USD',
//         status: 'rejected',
//         date: 'July 11, 2022',
//         datetime: '2020-07-11',
//     },
//     {
//         id: 1,
//         name: 'Table Antelope Outside',
//         href: '#',
//         amount: '$600',
//         currency: 'USD',
//         status: 'processing',
//         date: 'July 11, 2022',
//         datetime: '2020-07-11',
//     },
//     // More orders...
// ]

const statusStyles = {
    Processing: 'bg-yellow-100 text-yellow-800',
    Confirmed: 'bg-blue-100 text-blue-800',
    Paid: 'bg-green-100 text-green-800',
    Shipped: 'bg-purple-100 text-purple-800',
    Delivered: 'bg-pink-100 text-pink-800',
    Rejected: 'bg-gray-100 text-gray-800',
}

const props = defineProps([
    'orders', 'paginationMetaData', 'paginationLinks'
])

const emit = defineEmits([
    'onNextClicked', 'onPrevClicked'
])

const onNextClicked = () =>{
    emit('onNextClicked')
}

const onPrevClicked = () =>{
    emit("onPrevClicked")
}
</script>

