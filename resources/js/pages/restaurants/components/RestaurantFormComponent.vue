<template>
    <form class="space-y-6 mt-6" @submit.prevent="submitTenant">
        <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Company information</h3>
                    <p class="mt-1 text-sm text-gray-500">{{formDescription}}</p>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Company Name</label>
                            <input type="text" name="name" id="name" autocomplete="organization" placeholder="Company name" v-model="tenantForm.name"
                                   :class="[errors?.name === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="name-error" v-for="error in errors?.name">{{error}}</p>
                        </div>

<!--                        <div class="col-span-6 sm:col-span-6">-->
<!--                            <label for="owner-name" class="block text-sm font-medium text-gray-700">Owner Names</label>-->
<!--                            <input type="text" name="owner_name" id="owner_name" autocomplete="name" placeholder="Owner Names" v-model="tenantForm.owner_name"-->
<!--                                   :class="[errors?.owner_name === undefined ? 'valid-input' : 'invalid-input']" required/>-->
<!--                            <p class="mt-2 text-sm text-red-600" id="owner-name-error" v-for="error in errors?.owner_name">{{error}}</p>-->
<!--                        </div>-->

                        <div class="col-span-6 sm:col-span-3">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                            <input type="text" name="email" id="email" autocomplete="email" placeholder="email" v-model="tenantForm.email"
                                   :class="[errors?.email === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="email-error" v-for="error in errors?.email">{{error}}</p>
                        </div>


                        <div class="col-span-6 sm:col-span-3">
                            <label for="phone-number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number" autocomplete="tel" placeholder="Phone Number" v-model="tenantForm.phone_number"
                                   :class="[errors?.phone_number === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="phone-number-error" v-for="error in errors?.phone_number">{{error}}</p>
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="address-one" class="block text-sm font-medium text-gray-700">Address Line 1</label>
                            <input type="text" name="address_one" id="address_one" autocomplete="address" placeholder="Address Line 1" v-model="tenantForm.address_one"
                                   :class="[errors?.address_one === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="address-one-error" v-for="error in errors?.address_one">{{error}}</p>
                        </div>


                        <div class="col-span-6 sm:col-span-2">
                            <label for="address-two" class="block text-sm font-medium text-gray-700">Address Line 2</label>
                            <input type="text" name="address_two" id="address_two" autocomplete="address" placeholder="Address Line 2" v-model="tenantForm.address_two"
                                   :class="[errors?.address_two === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="address-two-error" v-for="error in errors?.address_two">{{error}}</p>
                        </div>

                        <div class="col-span-6 sm:col-span-2">
                            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                            <select id="country" name="country" autocomplete="country-name" v-model="tenantForm.country"
                                    :class="[errors?.country === undefined ? 'valid-select' : 'invalid-select']">
                                <option value="" selected>--Select Country--</option>
                                <option value="Tanzania">Tanzania</option>
                            </select>
                            <p class="mt-2 text-sm text-red-600" id="country-error" v-for="error in errors?.country">{{error}}</p>
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Logo</label>
                            <div class="mt-1 flex items-center">
                                <div class="flex-shrink-0 h-28 w-28" v-if="tenantForm.logo">
                                    <img class="h-28 w-28 rounded-full"
                                         :src="imgUrl ==null ? tenantForm.logo : imgUrl"
                                         alt="">
                                </div>
                                <span class="inline-block h-28 w-28 overflow-hidden rounded-full bg-gray-100" v-if="!tenantForm.logo">
                                    <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                      <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                </span>
                            </div>
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <label class="block text-sm font-medium text-gray-700">Company Logo</label>
                            <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="logo" class="relative cursor-pointer rounded-md bg-white font-medium text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 hover:text-indigo-500">
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
    'tenantForm', 'errors', 'isLoading',
    'isFetching', 'imgUrl', 'btnMessage', 'formDescription'
])

const emit = defineEmits(['submitTenant','loadImage'])


const submitTenant = () =>{
    emit('submitTenant')
}

const loadFile = (event) => {
    emit('loadImage', event)
}
</script>
