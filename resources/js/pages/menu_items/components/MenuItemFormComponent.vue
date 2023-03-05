<template>
    <form class="space-y-6 mt-6" @submit.prevent="submitMenuItem">
        <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Menu item information</h3>
                    <p class="mt-1 text-sm text-gray-500">{{formDescription}}</p>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6">
                            <label for="menu" class="block text-sm font-medium text-gray-700">Menu</label>
                            <select id="menu" name="menu" v-model="menuItemForm.menu_id"
                                    :class="[errors?.menu_id === undefined ? 'valid-select' : 'invalid-select']">
                                <option value="" selected>--Select Menu--</option>
                                <option v-for="menu in menus" :value="menu.id">{{menu.name}}</option>
                            </select>
                            <p class="mt-2 text-sm text-red-600" id="menu-error" v-for="error in errors?.menu_id">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">Item Name</label>
                            <input type="text" name="name" id="name"  placeholder="Item name" v-model="menuItemForm.name"
                                   :class="[errors?.name === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="name-error" v-for="error in errors?.name">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" id="price"  placeholder="Price" v-model="menuItemForm.price"
                                   :class="[errors?.price === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="price-error" v-for="error in errors?.price">{{error}}</p>
                        </div>


                        <div class="col-span-6 sm:col-span-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <input type="text" name="description" id="description"  placeholder="Description" v-model="menuItemForm.description"
                                   :class="[errors?.description === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="description-error" v-for="error in errors?.description">{{error}}</p>
                        </div>

                        <div class="col-span-2 sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Image</label>
                            <div class="mt-1 flex items-center">
                                <div class="flex-shrink-0 h-28 w-28" v-if="menuItemForm.image">
                                    <img class="h-28 w-28 rounded-full"
                                         :src="imgUrl ==null ? menuItemForm.image : imgUrl"
                                         alt="">
                                </div>
                                <span class="inline-block h-28 w-28 overflow-hidden rounded-full bg-gray-100" v-if="!menuItemForm.image">
                                    <svg class="w-full h-full text-gray-200" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" fill="currentColor" viewBox="0 0 640 512">
                                        <path d="M480 80C480 35.82 515.8 0 560 0C604.2 0 640 35.82 640 80C640 124.2 604.2 160 560 160C515.8 160 480 124.2 480 80zM0 456.1C0 445.6 2.964 435.3 8.551 426.4L225.3 81.01C231.9 70.42 243.5 64 256 64C268.5 64 280.1 70.42 286.8 81.01L412.7 281.7L460.9 202.7C464.1 196.1 472.2 192 480 192C487.8 192 495 196.1 499.1 202.7L631.1 419.1C636.9 428.6 640 439.7 640 450.9C640 484.6 612.6 512 578.9 512H55.91C25.03 512 .0006 486.1 .0006 456.1L0 456.1z"/>
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="col-span-2 sm:col-span-4">
                            <label class="block text-sm font-medium text-gray-700"></label>
                            <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="logo" class="relative cursor-pointer rounded-md bg-white font-medium text-rose-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-rose-500 focus-within:ring-offset-2 hover:text-rose-500">
                                            <span>Upload a file</span>
                                            <input id="logo" name="logo" type="file" class="sr-only" @change="loadFile"/>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-red-600" id="logo-error" v-for="error in errors?.logo">{{error}}</p>
                        </div>
                    </div>


                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 mt-6">
                <button type="submit" class="btn-sm-submit" :class="{'disabled:opacity-25' : isLoading}" :disabled="isLoading">
                    <LoadingSpinner :is-loading="isLoading" />
                    {{btnMessage}}
                </button>
            </div>
        </div>
    </form>
</template>

<script setup>

import LoadingSpinner from "../../../components/LoadingSpinner.vue";

    let props = defineProps([
        'menuItemForm', 'errors', 'isLoading',
        'isFetching', 'imgUrl', 'btnMessage', 'formDescription', 'menus'
    ])

    const emit = defineEmits(['submitMenuItem', 'loadImage'])



    const loadFile = (event) => {
        emit('loadImage', event)
    }

    const submitMenuItem = () =>{
        emit('submitMenuItem')
    }

</script>
