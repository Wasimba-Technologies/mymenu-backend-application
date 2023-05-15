<template>
    <div  class="bg-gray-100 z-10 h-full overflow-y-auto ">
        <title>MyMenu | Home</title>
        <TransitionRoot as="template" :show="sidebarOpen">
            <Dialog as="div" class="relative z-40 md:hidden" @close="sidebarOpen = false">
                <TransitionChild as="template" enter="transition-opacity ease-linear duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="transition-opacity ease-linear duration-300" leave-from="opacity-100" leave-to="opacity-0">
                    <div class="fixed inset-0 bg-gray-600 bg-opacity-75" />
                </TransitionChild>
                <div class="fixed inset-0 flex z-40">
                    <TransitionChild as="template" enter="transition ease-in-out duration-300 transform" enter-from="-translate-x-full" enter-to="translate-x-0" leave="transition ease-in-out duration-300 transform" leave-from="translate-x-0" leave-to="-translate-x-full">
                        <DialogPanel class="relative flex-1 flex flex-col max-w-xs w-full bg-white">
                            <TransitionChild as="template" enter="ease-in-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in-out duration-300" leave-from="opacity-100" leave-to="opacity-0">
                                <div class="absolute top-0 right-0 -mr-12 pt-2">
                                    <button type="button" class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" @click="sidebarOpen = false">
                                        <span class="sr-only">Close sidebar</span>
                                        <XMarkIcon class="h-6 w-6 text-white" aria-hidden="true" />
                                    </button>
                                </div>
                            </TransitionChild>
                            <div class="flex-1 h-0 pt-5 pb-4 overflow-y-auto">
                                <div class="flex-shrink-0 flex items-center px-4">
                                    <h1 class="text-rose-600 font-bold text-2xl text-center">MyMenu</h1>
                                </div>
                                <nav class="mt-5 px-2 space-y-1">
                                    <a v-for="item in navigation" :key="item.name" :href="item.href" :class="[item.current ? 'bg-gray-100 text-gray-900' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group flex items-center px-2 py-2 text-base font-medium rounded-md']">
                                        <component v-if="can(item.perm)" :is="item.icon" :class="[item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-4 flex-shrink-0 h-6 w-6']" aria-hidden="true" />
                                        {{ item.name }}
                                    </a>
                                </nav>
                            </div>
                            <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                                <a href="#" class="flex-shrink-0 group block">
                                    <div class="flex items-center">
                                        <div>
                                            <img class="inline-block h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-base font-medium text-gray-700 group-hover:text-gray-900">{{user?.name}}</p>
                                            <p class="text-sm font-medium text-gray-500 group-hover:text-gray-700">View profile</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </DialogPanel>
                    </TransitionChild>
                    <div class="flex-shrink-0 w-14">
                        <!-- Force sidebar to shrink to fit close icon -->
                    </div>
                </div>
            </Dialog>
        </TransitionRoot>


        <!-- Static sidebar for desktop -->
        <div class="flex min-h-full">
            <div v-if="sidebarStaticOpen" class="hidden md:flex md:w-64 md:flex-col" >
                <div class="flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white">
                    <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
                        <div class="flex items-center flex-shrink-0 px-4">
                            <h1 class="text-rose-600 font-bold text-3xl text-center">MyMenu</h1>
                        </div>
                        <nav class="mt-5 flex-1 px-2 bg-white space-y-1">
                            <div v-for="item in navigation">
                            <router-link v-if="can(item.perm)"  :key="item.name" :to="item.href"   :class="['text-gray-600 hover:bg-gray-50 hover:text-gray-900', 'group flex items-center px-2 py-2 text-sm font-medium rounded-md']">
                                <component  :is="item.icon" :class="[item.current ? 'text-gray-500' : 'text-gray-400 group-hover:text-gray-500', 'mr-3 flex-shrink-0 h-6 w-6']" aria-hidden="true" />
                                {{ item.name }}
                                <span v-if="item.name === 'Live Orders'" class="animate-ping ml-3 h-3 w-3 rounded-full bg-red-400 opacity-75"></span>
                            </router-link>
                            </div>
                        </nav>
                    </div>
                    <div class="flex-shrink-0 flex border-t border-gray-200 p-4">
                        <a href="#" class="flex-shrink-0 w-full group block">
                            <div class="flex items-center">
                                <div>
                                    <img class="inline-block h-9 w-9 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-700 group-hover:text-gray-900">{{user?.name}}</p>
                                    <p class="text-xs font-medium text-gray-500 group-hover:text-gray-700">View profile</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class=" flex flex-col w-full">
                <div class="hidden md:inline-block pl-1 pt-1 sm:pl-3 sm:pt-3">
                    <div class="flex-1 flex justify-between px-4 md:px-0">
                        <button type="button" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-rose-500" @click="sidebarStaticOpen = !sidebarStaticOpen">
                            <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                        </button>
                        <div class="mr-4 hidden sm:ml-6 sm:flex sm:items-center">
<!--                            <button type="button" class="rounded-full bg-white p-1 text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">-->
<!--                                <span class="sr-only">View notifications</span>-->
<!--                                <BellIcon class="h-6 w-6" aria-hidden="true" />-->
<!--                            </button>-->
                            <!-- Profile dropdown -->
                            <Menu as="div" class="relative ml-3">
                                <div>
                                    <MenuButton class="flex max-w-xs items-center rounded-full bg-white text-sm focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2">
                                        <span class="sr-only">Open user menu</span>
                                        <img class="h-8 w-8 rounded-full"
                                             src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                             alt=""
                                        />
                                    </MenuButton>
                                </div>
                                <transition enter-active-class="transition ease-out duration-200" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                    <MenuItems class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <MenuItem v-for="item in userNavigation" :key="item.name" v-slot="{ active }">
                                            <a :href="item.href" :class="[active ? 'bg-gray-100' : '', 'block px-4 py-2 text-sm text-gray-700']">{{ item.name }}</a>
                                        </MenuItem>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                </div>
                <div class="sticky top-0 z-10 md:hidden pl-1 pt-1 sm:pl-3 sm:pt-3 bg-gray-100">
                    <button type="button" class="-ml-0.5 -mt-0.5 h-12 w-12 inline-flex items-center justify-center rounded-md text-gray-500 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-rose-500" @click="sidebarOpen = true">
                        <Bars3Icon class="h-6 w-6" aria-hidden="true" />
                    </button>
                </div>
                <main class="flex-1">
                    <div class="py-6">
                        <div class="mx-auto max-w-7xl px-4 sm:px-6 md:px-8">
                            <h2 class="text-xl text-gray-700 font-bold md:text-2xl lg:text-3xl">
                                {{currentPageTitle}}
                            </h2>
                        </div>
                        <div class="mx-auto px-4 sm:px-6 md:px-8">
                            <!-- Content goes here -->
                            <router-view />
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </div>
</template>

<style>
.router-link-exact-active{
    @apply bg-gray-100 text-gray-900
}
</style>



<script setup>
import {computed, inject, ref} from 'vue'
import {Dialog, DialogPanel, MenuButton, Menu, MenuItem, MenuItems, TransitionChild, TransitionRoot} from '@headlessui/vue'
import {
    HomeIcon,
    Bars3Icon,
    XMarkIcon,
    ComputerDesktopIcon,
    ShoppingBagIcon,
    TableCellsIcon,
    QrCodeIcon,
    CreditCardIcon,
    Squares2X2Icon,
    DocumentDuplicateIcon, CogIcon, UsersIcon
} from '@heroicons/vue/24/outline'

import {useRoute} from "vue-router";
import {useAbility} from "@casl/vue";
import useAuth from "../../composables/auth";

const navigation = [
    { name: 'Dashboard', href: '/dashboard', icon: ComputerDesktopIcon, perm: 'restaurants.update'},
    // { name: 'Live Orders', href: '/live-orders', icon: BoltIcon },
    { name: 'Orders', href: '/orders', icon: ShoppingBagIcon,perm: 'orders.view'},
    { name: 'restaurants', href: '/restaurants', icon: HomeIcon , perm: 'restaurants.view'},
    { name: 'Menu', href: '/menu', icon: DocumentDuplicateIcon, perm: 'menus.view'},
    { name: 'Menu Items', href: '/menu-items', icon: Squares2X2Icon, perm: 'menu_items.view'},
    { name: 'Tables', href: '/tables', icon: TableCellsIcon, perm: 'tables.view'},
    { name: 'QR Builder', href: '/qr-builder', icon: QrCodeIcon, perm: 'qr_codes.view' },
    // { name: 'Plan', href: '/plans', icon: CreditCardIcon },
    { name: 'Users', href: '/users', icon: UsersIcon, perm: 'users.create' },
    { name: 'Settings', href: '/settings', icon: CogIcon, perm: 'restaurants.update'},
]

const userNavigation = [
    { name: 'Your Profile', href: '#' },
    { name: 'Subscription', href: '/subscriptions' },
    { name: 'Sign out', href: '/logout' },
]

const sidebarOpen = ref(false)
const sidebarStaticOpen = ref(true)
const route = useRoute()
const { can } = useAbility()

const {getAbilities} = useAuth()

getAbilities()



const currentPageTitle = computed(() =>{
    return route.meta.title;
})

const user = JSON.parse(localStorage.getItem('user'))

</script>
