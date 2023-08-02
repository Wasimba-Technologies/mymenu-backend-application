<template>
    <TransitionRoot as="template" :show="sideBarOpen">
        <Dialog as="div" class="relative z-40 md:hidden" @close="sideBarOpen = false">
            <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                <div class="fixed inset-0 bg-gray-600 bg-opacity-75" />
            </TransitionChild>
            <div class="fixed inset-0 flex z-40">
                <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="-translate-x-0" leave-to="-translate-x-full">
                    <DialogPanel class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
                        <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
                            <div class="absolute top-0 right-0 -mr-12 pt-2">
                                <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="sideBarOpen = false">
                                    <span class="sr-only">Close sidebar</span>
                                    <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                                </button>
                            </div>
                        </TransitionChild>
                        <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                            <div class="flex-shrink-0 flex items-center px-4">
                                <h1 :style="`color: ${tenant.secondary_color};`" class="font-bold text-2xl text-center">{{tenant?.name}}</h1>
                            </div>
                            <nav class="mt-5 px-2 space-y-1">
                                <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group flex items-center px-2 py-2 text-base font-medium rounded-md']">
                                    <component  :is="item.icon" :class="[item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-4 flex-shrink-0 h-6 w-6']" aria-hidden="true" />
                                    {{ item.name }}
                                </a>
                            </nav>
                        </div>
                        <!--                        <div class="flex-shrink-0 flex border-t border-gray-200 p-4">-->
                        <!--                            <a href="#" class="flex-shrink-0 group block">-->
                        <!--                                <div class="flex items-center">-->
                        <!--                                    <div>-->
                        <!--                                        <img class="inline-block h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />-->
                        <!--                                    </div>-->
                        <!--                                    <div class="ml-3">-->
                        <!--                                        <p class="text-base font-medium text-gray-700 group-hover:text-gray-900">{{user?.name}}</p>-->
                        <!--                                        <p class="text-sm font-medium text-gray-500 group-hover:text-gray-700">View profile</p>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </a>-->
                        <!--                        </div>-->
                    </DialogPanel>
                </TransitionChild>
                <div class="flex-shrink-0 w-14">
                    <!-- Force sidebar to shrink to fit close icon -->
                </div>
            </div>
        </Dialog>
    </TransitionRoot>

</template>

<script setup>
import {Dialog, DialogPanel, TransitionChild, TransitionRoot} from "@headlessui/vue";
import {ComputerDesktopIcon, ShoppingBagIcon, XMarkIcon} from "@heroicons/vue/24/outline";
import {inject} from "vue";

const table_id = localStorage.getItem('table_id')

const navigation = [
    { name: 'Browse Menu', href: '/browse/'+table_id, icon: ComputerDesktopIcon, perm: 'menu_items.view'},
    { name: 'My Orders', href: '/my_orders', icon: ShoppingBagIcon, perm: 'orders.view'},
]

const sideBarOpen = inject('sideBarOpen')
const tenant = inject('tenant')


</script>

