<template>
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="relative z-10" @close="open = false">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="hidden sm:fixed sm:inset-0 sm:block sm:bg-gray-500 sm:bg-opacity-75 sm:transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-stretch justify-center text-center sm:items-center sm:px-6 lg:px-8">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 scale-105" enter-to="opacity-100 scale-100" leave="ease-in duration-200" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-105">
                        <DialogPanel class="flex w-full max-w-xl transform text-left text-base transition sm:my-8">
                            <form class="relative flex w-full flex-col overflow-hidden bg-white pt-6 pb-8 sm:rounded-lg sm:pb-6 lg:py-8">
                                <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8">
                                    <h2 class="text-lg font-medium text-gray-900">Login </h2>
                                    <button type="button" class="text-gray-400 hover:text-gray-500" @click="open = false">
                                        <span class="sr-only">Close</span>
                                        <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                    </button>
                                </div>

                                <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-[480px]">
                                    <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
                                        <div class="relative mt-2">
                                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                                <div class="w-full border-t border-gray-200" />
                                            </div>
                                            <div class="relative flex justify-center text-sm font-medium leading-6">
                                                <span class="bg-white px-6 text-gray-900">Login with</span>
                                            </div>
                                        </div>
                                        <div class="flex flex-col">
                                            <a href="/api/auth/login/twitter" class="m-4 flex w-full items-center justify-center gap-3 rounded-md bg-[#1D9BF0] px-3 py-1.5 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#1D9BF0]">
                                                <svg class="h-5 w-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84" />
                                                </svg>
                                                <span class="text-sm font-semibold leading-6">Sign in with Twitter</span>
                                            </a>

                                            <a href="/api/auth/login/facebook" class="m-4 flex w-full items-center justify-center gap-3 rounded-md bg-[#3b5998] hover:bg-[#3b5998]/90 px-3 py-1.5 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#3b5998]">
                                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 8 19">
                                                    <path fill-rule="evenodd" d="M6.135 3H8V0H6.135a4.147 4.147 0 0 0-4.142 4.142V6H0v3h2v9.938h3V9h2.021l.592-3H5V3.591A.6.6 0 0 1 5.592 3h.543Z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="text-sm font-semibold leading-6">Sign in with Facebook</span>
                                            </a>

                                            <a href="/api/auth/login/google" class="m-4 flex w-full items-center justify-center gap-3 rounded-md bg-[#4285F4] hover:bg-[#4285F4]/90 px-3 py-1.5 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-[#4285F4]">
                                                <svg class="w-4 h-4 mr-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 19">
                                                    <path fill-rule="evenodd" d="M8.842 18.083a8.8 8.8 0 0 1-8.65-8.948 8.841 8.841 0 0 1 8.8-8.652h.153a8.464 8.464 0 0 1 5.7 2.257l-2.193 2.038A5.27 5.27 0 0 0 9.09 3.4a5.882 5.882 0 0 0-.2 11.76h.124a5.091 5.091 0 0 0 5.248-4.057L14.3 11H9V8h8.34c.066.543.095 1.09.088 1.636-.086 5.053-3.463 8.449-8.4 8.449l-.186-.002Z" clip-rule="evenodd"/>
                                                </svg>
                                                <span class="text-sm font-semibold leading-6">Sign in with Google</span>
                                            </a>

                                            <div class="relative mt-2">
                                                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                                                    <div class="w-full border-t border-gray-200" />
                                                </div>
                                            </div>
                                            <p class="mt-4 text-center text-gray-500">
                                                We collect your user information from social media to help you place Order!
                                            </p>
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </DialogPanel>
                    </TransitionChild>
                </div>
            </div>
        </Dialog>
    </TransitionRoot>
</template>

<script setup>
import {
    Dialog,
    DialogPanel,
    TransitionChild,
    TransitionRoot
} from "@headlessui/vue";

import {
    XMarkIcon
} from '@heroicons/vue/24/outline';
import {computed, inject, onMounted, ref, watch, watchEffect} from "vue";
import useOrders from "../../../composables/orders";

const props = defineProps(['show','grandTotal'])
const emit = defineEmits(['handleQtyChange', 'removeCartItem', 'placeOrder'])
const open = inject('openLoginModal')
const products = inject('shopping_cart')


const handleQtyChange = (ev, product) => {
    emit('handleQtyChange', ev, product)
}

const removeCartItem = product =>{
    emit('removeCartItem', product)
}

const placeOrder =  () =>{
    emit('placeOrder')
}

</script>
