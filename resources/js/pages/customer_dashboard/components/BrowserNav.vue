<template>
    <nav class="relative flex items-center justify-between sm:h-10 lg:justify-start" aria-label="Global">
        <div class="flex items-center flex-grow flex-shrink-0 lg:flex-grow-0">
            <div class="flex flex-row justify-between w-full md:w-auto">
                <p class="font-bold text-rose-600 text-xl"> MyMenu </p>
                <div class="-mr-2 flex items-center">
                    <button class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-rose-600" type="button" @click="shopping_cart.length !== 0 ? open = true: open = false">
                        <span class="sr-only">Open Shopping cart</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </button>
                    <span class="ml-2 inline-flex items-center rounded-full bg-rose-100 px-2.5 py-1.5 text-xs font-medium text-rose-800">
                        {{shopping_cart?.length === undefined ? 0 : shopping_cart?.length}}
                    </span>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import {inject} from "vue";

    const open = inject('open')
    const shopping_cart = inject('shopping_cart')

</script>

