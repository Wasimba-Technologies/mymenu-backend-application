
<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 ">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <main class="flex-1">
                            <div class="relative mx-auto max-w-4xl">
                                <div class="pt-4 pb-16">
                                    <div class="px-4 sm:px-6 lg:px-0">
                                        <div class="py-6">
                                            <!-- Tabs -->
                                            <div class="lg:hidden">
                                                <label for="selected-tab" class="sr-only">Select a tab</label>
                                                <select id="selected-tab" name="selected-tab" class="mt-1 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-rose-500 sm:text-sm sm:leading-6">
                                                    <option v-for="tab in tabs" :key="tab.name" :selected="tab.current">{{ tab.name }}</option>
                                                </select>
                                            </div>
                                            <div class="hidden lg:block">
                                                <div class="border-b border-gray-200">
                                                    <nav class="-mb-px flex space-x-8">
                                                        <a v-for="tab in tabs" :key="tab.name" :href="tab.href" :class="[tab.current ? 'border-rose-500 text-rose-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium']">{{ tab.name }}</a>
                                                    </nav>
                                                </div>
                                            </div>

                                            <!--Tab here -->
                                            <div>
                                                <form class="mt-5 space-y-6" @submit.prevent="changeTenant">
                                                    <div>
<!--                                                        <h2 class="text-gray-400 mb-2">Restaurant Information</h2>-->
                                                        <div>
                                                            <label for="restaurant_name" class="block text-sm font-medium text-gray-700"> Restaurant name </label>
                                                            <div class="mt-1">
                                                                <input id="name"
                                                                       name="name" type="text"
                                                                       autocomplete="restaurant_name"
                                                                       required
                                                                       placeholder="Restaurant name here..."
                                                                       class="valid-input"
                                                                       v-model="tenant.name"/>
                                                                <p class="mt-2 text-sm text-red-600" id="phone-number-error" v-for="error in errors?.name">{{error}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mt-2">
                                                        <div class="grid grid-cols-6 gap-4">
                                                            <div class="col-span-3 sm:col-span-3">
                                                                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone number </label>
                                                                <div class="mt-1">
                                                                    <input id="phone_number" name="phone_number" type="tel"
                                                                           autocomplete="phone" required placeholder="0xxx xxx xxx"
                                                                           class="valid-input" v-model="tenant.phone_number"
                                                                    />
                                                                </div>
                                                                <p class="mt-2 text-sm text-red-600" id="phone-number-error" v-for="error in errors?.phone_number">{{error}}</p>
                                                            </div>
                                                            <div class="col-span-3 sm:col-span-3">
                                                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                                                <div class="mt-1">
                                                                    <input id="email" name="email" type="email" autocomplete="email"
                                                                           required placeholder="mymenu@example.com" class="valid-input"
                                                                           v-model="tenant.email"/>
                                                                </div>
                                                                <p class="mt-2 text-sm text-red-600" id="owner-name-error" v-for="error in errors?.email">{{error}}</p>
                                                            </div>

                                                            <div class="col-span-3 sm:col-span-3">
                                                                <label for="address_one" class="block text-sm font-medium text-gray-700"> Address One </label>
                                                                <div class="mt-1">
                                                                    <input id="address_one" name="address_one" type="text" autocomplete="name"
                                                                           required placeholder="Address Line 1" class="valid-input"
                                                                           v-model="tenant.address_one"/>
                                                                </div>
                                                                <p class="mt-2 text-sm text-red-600" id="address-one-error" v-for="error in errors?.address_one">{{error}}</p>
                                                            </div>
                                                            <div class="col-span-3 sm:col-span-3">
                                                                <label for="address_two" class="block text-sm font-medium text-gray-700"> Address Two </label>
                                                                <div class="mt-1">
                                                                    <input id="address_two" name="address_two" type="text" autocomplete="name"
                                                                           required placeholder="Address Line 2" class="valid-input"
                                                                           v-model="tenant.address_two"/>
                                                                </div>
                                                                <p class="mt-2 text-sm text-red-600" id="owner-name-error" v-for="error in errors?.address_two">{{error}}</p>
                                                            </div>

                                                            <div class="col-span-3 sm:col-span-3">
                                                                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                                                <div class="mt-1">
                                                                    <input id="country" name="country" type="text"
                                                                           autocomplete="country" required
                                                                           placeholder="Country" class="valid-input"
                                                                           v-model="tenant.country"/>
                                                                </div>
                                                                <p class="mt-2 text-sm text-red-600" id="owner-name-error" v-for="error in errors?.country">{{error}}</p>
                                                            </div>

                                                            <div class="col-span-3 sm:col-span-3">
                                                                <label for="address_one" class="block text-sm font-medium text-gray-700">Currency Symbol</label>
                                                                <div class="mt-1">
                                                                    <input id="currency" name="currency" type="text" autocomplete="currency"
                                                                           required placeholder="Currency symbol e.g Tsh, $"
                                                                           class="valid-input" v-model="tenant.currency"/>
                                                                </div>
                                                                <p class="mt-2 text-sm text-red-600" id="address-one-error" v-for="error in errors?.currency">{{error}}</p>
                                                            </div>

                                                            <div class="col-span-3 sm:col-span-3">
                                                                <label for="primary-color" class="block text-sm font-medium text-gray-700">Primary color</label>
                                                                <div class="mt-1">
                                                                    <input type="color" name="primary_color" id="primary_color"  placeholder="Hex Color" v-model="tenant.primary_color"
                                                                           :class="[errors?.primary_color === undefined ? 'h-10 valid-input' : 'invalid-input']" required/>
                                                                </div>
                                                                <p class="mt-2 text-sm text-red-600" id="primary-color-error" v-for="error in errors?.primary_color">{{error}}</p>
                                                            </div>

                                                            <div class="col-span-3 sm:col-span-3">
                                                                <label for="secondary-color" class="block text-sm font-medium text-gray-700">Secondary color</label>
                                                                <div class="mt-1">
                                                                    <input type="color" name="secondary_color" id="secondary_color"  placeholder="Hex Color" v-model="tenant.secondary_color"
                                                                           :class="[errors?.secondary_color === undefined ? 'h-10 valid-input' : 'invalid-input']" required/>                                </div>
                                                                <p class="mt-2 text-sm text-red-600" id="secondary-color-error" v-for="error in errors?.secondary_color">{{error}}</p>
                                                            </div>

                                                            <div class="col-span-6 sm:col-span-6">
                                                                <div class="mt-1">
                                                                    <label for="plan" class="block text-sm font-medium text-gray-700">Subscription Plan</label>
                                                                    <select id="plan" name="plan" v-model="tenant.plan_id"
                                                                            :class="[errors?.plan_id === undefined ? 'valid-select' : 'invalid-select']">
                                                                        <option value="" disabled>--Select Plan--</option>
                                                                        <option v-for="plan in plans" :value="plan.id"
                                                                                :selected='parseInt(tenant?.plan?.id) === parseInt(plan?.id)' :key="plan.id" disabled>
                                                                            {{plan?.name}} - {{Intl.NumberFormat().format(plan?.price)}}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <p class="mt-2 text-sm text-red-600" id="plan-error" v-for="error in errors?.plan_id">{{error}}</p>
                                                            </div>

                                                            <div class="col-span-2 sm:col-span-2">
                                                                <label class="block text-sm font-medium text-gray-700">Logo</label>
                                                                <div class="mt-1 flex items-center">
                                                                    <div class="flex-shrink-0 h-12 w-12" v-if="tenant.logo">
                                                                        <img class="h-12 w-12 rounded-full"
                                                                             :src="tempImgUrl ==null ? tenant.logo : tempImgUrl"
                                                                             alt="">
                                                                    </div>
                                                                    <span class="inline-block h-28 w-28 overflow-hidden rounded-full bg-gray-100" v-if="!tenant.logo">
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
                                                        <button type="submit" class="w-full btn-sm-submit">Update</button>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

    import useTenants from "../../composables/restaurant";

    const tabs = [
        { name: 'General', href: '#', current: true },
        //{ name: 'Business Info', href: '#', current: false },
    ]

    import {computed, inject, onMounted, ref, watch} from "vue";
    import usePlans from "../../composables/plans";
    import utils from "../../utils/utils";
    import {ABILITY_TOKEN, useAbility} from "@casl/vue";
    import useAuth from "../../composables/auth";

    const {tenant, getTenant, updateTenant, errors} = useTenants();
    const {plans, getPlans} = usePlans();

    const tempImgUrl = ref(null)

    const changeTenant = async () => {
        await updateTenant(localStorage.getItem('X-Tenant-ID'));
    }

    const loadImage = (event) => {
        tenant.value.logo = event.target.files[0]
        //Preview Image
        tempImgUrl.value = window.URL.createObjectURL(event.target.files[0])
        URL.revokeObjectURL(event.target.files[0])
    }


    onMounted(()=>{
        getTenant(localStorage.getItem('X-Tenant-ID'))
        getPlans()
    })

    watch(tenant, ()=>{
        //change the object plan:{} to plan_id to make the default selected
        tenant.value.plan_id = tenant.value.plan.id
    })

    //utils.has_perm('restaurants.update')
    const {can} = useAbility()
    const {logout} = useAuth()
    const ability = inject(ABILITY_TOKEN)
    const {getAbilities} = useAuth()

    // getAbilities()
    // if(!can('restaurants.update')){
    //     logout()
    // }

    onMounted(async () => {
        await getAbilities()

        if (!can('restaurants.update')) {
            await logout()
        }
    })
</script>
