<template>
    <TransitionRoot as="template" :show="open">
        <Dialog as="div" class="relative z-10" @close="open = false">
            <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0" enter-to="opacity-100" leave="ease-in duration-200" leave-from="opacity-100" leave-to="opacity-0">
                <div class="hidden sm:fixed sm:inset-0 sm:block sm:bg-gray-500 sm:bg-opacity-75 sm:transition-opacity" />
            </TransitionChild>

            <div class="fixed inset-0 z-10 overflow-y-auto">
                <div class="flex min-h-full items-stretch justify-center text-center sm:items-center sm:px-6 lg:px-8">
                    <TransitionChild as="template" enter="ease-out duration-300" enter-from="opacity-0 scale-105" enter-to="opacity-100 scale-100" leave="ease-in duration-200" leave-from="opacity-100 scale-100" leave-to="opacity-0 scale-105">
                        <DialogPanel class="flex w-full max-w-3xl transform text-left text-base transition sm:my-8">
                            <form class="relative flex w-full flex-col overflow-hidden bg-white pt-6 pb-8 sm:rounded-lg sm:pb-6 lg:py-8">
                                <div class="flex items-center justify-between px-4 sm:px-6 lg:px-8">
                                    <h2 class="text-lg font-medium text-gray-900">Shopping Cart</h2>
                                    <button type="button" class="text-gray-400 hover:text-gray-500" @click="open = false">
                                        <span class="sr-only">Close</span>
                                        <XMarkIcon class="h-6 w-6" aria-hidden="true" />
                                    </button>
                                </div>

                                <section aria-labelledby="cart-heading">
                                    <h2 id="cart-heading" class="sr-only">Items in your shopping cart</h2>

                                    <ul role="list" class="divide-y divide-gray-200 px-4 sm:px-6 lg:px-8">
                                        <li v-for="(product, productIdx) in products" :key="product.menu_item.id" class="flex py-8 text-sm sm:items-center">
                                            <img :src="product.menu_item.image" :alt="product.menu_item.name" class="h-24 w-24 flex-none rounded-lg border border-gray-200 sm:h-32 sm:w-32" />
                                            <div class="ml-4 grid flex-auto grid-cols-1 grid-rows-1 items-start gap-y-3 gap-x-5 sm:ml-6 sm:flex sm:items-center sm:gap-0">
                                                <div class="row-end-1 flex-auto sm:pr-6">
                                                    <h3 class="font-medium text-gray-900">
                                                        {{ product.menu_item.name }}
                                                    </h3>
                                                </div>
                                                <p class="row-span-2 row-end-2 text-gray-900 sm:order-1 sm:ml-6 sm:w-1/3 sm:flex-none sm:text-right font-extrabold">Tsh {{ new Intl.NumberFormat().format(product.qty * product.menu_item.price) }}</p>
                                                <div class="flex items-center sm:block sm:flex-none sm:text-center">
                                                    <label :for="`quantity-${productIdx}`" class="sr-only">Quantity, {{ product.menu_item.name }}</label>
                                                    <select :id="`quantity-${productIdx}`" :name="`quantity-${productIdx}`" class="block max-w-full rounded-md border
                                                    border-gray-300 py-1.5 text-left text-base font-medium leading-5 text-gray-700
                                                    shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-1 focus:ring-indigo-500
                                                    sm:text-sm" @change="handleQtyChange($event, product)">
                                                        <option v-for="option in 10" :value="option" :selected="parseInt(product.qty) === parseInt(option)">{{option}}</option>
                                                    </select>
                                                    <button type="button" class="ml-4 font-medium text-rose-600 hover:text-rose-500 sm:ml-0 sm:mt-2" @click="removeCartItem(product)">
                                                        <span>Remove</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </section>

                                <section aria-labelledby="summary-heading" class="mt-auto sm:px-6 lg:px-8">
                                    <div class="bg-gray-50 p-6 sm:rounded-lg sm:p-8">
                                        <h2 id="summary-heading" class="sr-only">Order summary</h2>
                                        <div class="flow-root">
                                            <dl class="-my-4 divide-y divide-gray-200 text-sm">
                                                <div class="flex items-center justify-between py-4">
                                                    <dt class="text-gray-600">Subtotal</dt>
                                                    <dd class="font-medium text-gray-900">Tsh {{grandTotal}}</dd>
                                                </div>
                                                <div class="flex items-center justify-between py-4">
                                                    <dt class="text-base font-medium text-gray-900">Order total</dt>
                                                    <dd class="text-base font-medium text-gray-900">Tsh {{grandTotal}}</dd>
                                                </div>
                                            </dl>
                                        </div>
                                    </div>
                                </section>

                                <div class="mt-8 flex justify-end px-4 sm:px-6 lg:px-8">
                                    <button type="submit" class="btn-sm-submit" @click.prevent="placeOrder">
                                        Place Order
                                    </button>
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
const open = inject('open')
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

