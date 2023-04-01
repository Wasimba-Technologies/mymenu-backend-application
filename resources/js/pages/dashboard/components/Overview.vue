<template>
    <div class="mt-8">
        <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-lg leading-6 font-medium text-gray-900">Overview</h2>
            <dl class="mt-5 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
                <div v-for="item in stats" :key="item.id" class="relative overflow-hidden rounded-lg bg-white px-4 pb-12 pt-5 shadow sm:px-6 sm:pt-6">
                    <dt>
                        <div class="absolute rounded-md p-3" :class="item.color">
                            <component :is="item.icon" class="h-6 w-6 text-white" aria-hidden="true" />
                        </div>
                        <p class="ml-16 truncate text-sm font-medium text-gray-500">{{ item.name }}</p>
                    </dt>
                    <dd class="ml-16 flex items-baseline pb-6 sm:pb-7">
                        <p class="text-2xl font-semibold text-gray-900">{{ item.stat }}</p>
                        <p :class="[item.changeType === 'increase' ? 'text-green-600' : 'text-red-600', 'ml-2 flex items-baseline text-sm font-semibold']">
                            <ArrowUpIcon v-if="item.changeType === 'increase'" class="h-5 w-5 flex-shrink-0 self-center text-green-500" aria-hidden="true" />
                            <ArrowDownIcon v-else class="h-5 w-5 flex-shrink-0 self-center text-red-500" aria-hidden="true" />
                            <span class="sr-only"> {{ item.changeType === 'increase' ? 'Increased' : 'Decreased' }} by </span>
                            {{ item.change }}
                        </p>
                        <div class="absolute inset-x-0 bottom-0 bg-gray-50 px-4 py-4 sm:px-6">
                            <div class="text-sm">
                                <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                    View all<span class="sr-only"> {{ item.name }} stats</span></a
                                >
                            </div>
                        </div>
                    </dd>
                </div>
            </dl>

        </div>
    </div>
</template>

<script setup>
import {
    FolderIcon,
    ArrowTrendingUpIcon,
    ShoppingCartIcon
} from '@heroicons/vue/24/outline'
import { ArrowDownIcon, ArrowUpIcon } from '@heroicons/vue/20/solid'

const stats = [
    { id: 1, name: 'Sales Volume (30 Days)', href: '#', icon: ArrowTrendingUpIcon, change: '122', changeType: 'increase', stat: 'TZS 3,654,000',color: "bg-indigo-500" },
    { id:2, name: 'Orders (30 Days)', href: '#', icon: ShoppingCartIcon,change: '5.4%',changeType: 'increase',  stat: '213', color: "bg-green-500" },
    { id:3, name: 'Number of Items', href: '#', icon: FolderIcon, change: '3.2%', changeType: 'decrease', stat: '26 Items', color: "bg-yellow-500" },
    // More items...
]



</script>
