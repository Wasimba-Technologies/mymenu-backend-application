<template>
    <div class="flex flex-col justify-center py-12 bg-gray-50 sm:px-6 lg:px-8">
        <title>MyMenu |  Register</title>
        <div class="sm:mx-auto sm:w-full sm:max-w-md md:max-w-lg  lg:max-w-xl xl:max-w-2xl 2xl:max-w-3xl">
            <h1 class="text-rose-600 font-bold text-4xl text-center">MyMenu</h1>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Register your restaurant, hotel or bar</h2>
        </div>

        <div class="mt-6 sm:mx-auto sm:w-full sm:max-w-md md:max-w-lg  lg:max-w-xl xl:max-w-2xl 2xl:max-w-3xl">
            <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <form class="space-y-6" @submit.prevent="saveTenant">
                    <div>
                        <h2 class="text-gray-400 mb-2">Restaurant Information</h2>
                        <div>
                            <label for="restaurant_name" class="block text-sm font-medium text-gray-700"> Restaurant name </label>
                            <div class="mt-1">
                                <input id="name"
                                       name="name" type="text"
                                       autocomplete="restaurant_name"
                                       required
                                       placeholder="Restaurant name here..."
                                       class="valid-input"
                                        v-model="tenantForm.name"/>
                                <p class="mt-2 text-sm text-red-600" id="phone-number-error" v-for="error in errors?.name">{{error}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <div class="grid grid-cols-6 gap-4">
                        <div class="col-span-3 sm:col-span-3">
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone number </label>
                            <div class="mt-1">
                                <input id="phone_number" name="phone_number" type="tel" autocomplete="phone" required placeholder="0xxx xxx xxx" class="valid-input" v-model="tenantForm.phone_number"/>
                            </div>
                            <p class="mt-2 text-sm text-red-600" id="phone-number-error" v-for="error in errors?.phone_number">{{error}}</p>
                        </div>
                        <div class="col-span-3 sm:col-span-3">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="mt-1">
                                <input id="email" name="email" type="email" autocomplete="email" required placeholder="mymenu@example.com" class="valid-input" v-model="tenantForm.email"/>
                            </div>
                            <p class="mt-2 text-sm text-red-600" id="owner-name-error" v-for="error in errors?.email">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="address_one" class="block text-sm font-medium text-gray-700"> Address One </label>
                            <div class="mt-1">
                                <input id="address_one" name="address_one" type="text" autocomplete="name" required placeholder="Address Line 1" class="valid-input" v-model="tenantForm.address_one"/>
                            </div>
                            <p class="mt-2 text-sm text-red-600" id="address-one-error" v-for="error in errors?.address_one">{{error}}</p>
                        </div>
                        <div class="col-span-3 sm:col-span-3">
                            <label for="address_two" class="block text-sm font-medium text-gray-700"> Address Two </label>
                            <div class="mt-1">
                                <input id="address_two" name="address_two" type="text" autocomplete="name" required placeholder="Address Line 2" class="valid-input" v-model="tenantForm.address_two"/>
                            </div>
                            <p class="mt-2 text-sm text-red-600" id="owner-name-error" v-for="error in errors?.address_two">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                            <div class="mt-1">
                                <input id="country" name="country" type="text" autocomplete="country" required placeholder="Country" class="valid-input" v-model="tenantForm.country"/>
                            </div>
                            <p class="mt-2 text-sm text-red-600" id="owner-name-error" v-for="error in errors?.country">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="address_one" class="block text-sm font-medium text-gray-700">Currency Symbol</label>
                            <div class="mt-1">
                                <input id="currency" name="currency" type="text" autocomplete="currency" required placeholder="Currency symbol e.g Tsh, $" class="valid-input" v-model="tenantForm.currency"/>
                            </div>
                            <p class="mt-2 text-sm text-red-600" id="address-one-error" v-for="error in errors?.currency">{{error}}</p>
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <div class="mt-1">
                                <label for="plan" class="block text-sm font-medium text-gray-700">Subscription Plan</label>
                                <select id="plan" name="plan" v-model="tenantForm.plan_id"
                                        :class="[errors?.plan_id === undefined ? 'valid-select' : 'invalid-select']">
                                    <option value="" selected>--Select Plan--</option>
                                    <option v-for="plan in plans" :value="plan.id"
                                            :selected="parseInt(plan.id) === parseInt(tenantForm.plan_id)" :key="plan.id">
                                        {{plan.name}} - {{Intl.NumberFormat().format(plan.price)}}
                                    </option>
                                </select>
                            </div>
                            <p class="mt-2 text-sm text-red-600" id="plan-error" v-for="error in errors?.plan_id">{{error}}</p>
                        </div>

                        <div class="col-span-2 sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Logo</label>
                            <div class="mt-1 flex items-center">
                                <div class="flex-shrink-0 h-12 w-12" v-if="tenantForm.logo">
                                    <img class="h-12 w-12 rounded-full"
                                         :src="tempImgUrl ==null ? tenantForm.logo : tempImgUrl"
                                         alt="">
                                </div>
                                <span class="inline-block h-28 w-28 overflow-hidden rounded-full bg-gray-100" v-if="!tenantForm.logo">
                                <svg class="h-full w-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                                  <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                            </span>
                            </div>
                        </div>

                        <div class="col-span-4 sm:col-span-4">
                            <label class="block text-sm font-medium text-gray-700">Company Logo</label>
                            <div class="mt-1 flex justify-center rounded-md border-2 border-dashed border-gray-300 px-6 pt-5 pb-6">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="logo" class="relative cursor-pointer rounded-md bg-white font-medium text-rose-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-rose-500 focus-within:ring-offset-2 hover:text-rose-500">
                                            <span>Upload a file</span>
                                            <input id="logo" name="logo" type="file" class="sr-only" @change="loadImage"/>
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
                    <div>
                        <button type="submit" class="w-full btn-sm-submit">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>


<script setup>
    import useTenants from "../../composables/restaurant";
    import {computed, onMounted, ref} from "vue";
    import usePlans from "../../composables/plans";
    const {tenantForm, storeTenant, errors} = useTenants();
    const {plans, getPlans} = usePlans();

    const tempImgUrl = ref(null)

    const saveTenant = async () => {
        await storeTenant({...tenantForm});
    }

    const loadImage = (event) => {
        tenantForm.logo = event.target.files[0]
        //Preview Image
        tempImgUrl.value = window.URL.createObjectURL(event.target.files[0])
        URL.revokeObjectURL(event.target.files[0])
    }

    const plan = computed(()=>{

    })

    onMounted(()=>{
        getPlans()
    })

</script>

