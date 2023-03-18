<template>
    <form class="space-y-6 mt-6" @submit.prevent="submitPlan">
        <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Plan information</h3>
                    <p class="mt-1 text-sm text-gray-500">{{formDescription}}</p>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-3 sm:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">Plan</label>
                            <input type="text" name="name" id="name"  placeholder="Plan name" v-model="planForm.name"
                                   :class="[errors?.name === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="name-error" v-for="error in errors?.name">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                            <input type="number" name="price" id="price"  placeholder="Price" v-model="planForm.price"
                                   :class="[errors?.price === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="price-error" v-for="error in errors?.price">{{error}}</p>
                        </div>


                        <div class="col-span-3 sm:col-span-3">
                            <label for="menu-items" class="block text-sm font-medium text-gray-700">Items</label>
                            <input type="number" name="menu_items" id="menu_items"  placeholder="Number of menu items" v-model="planForm.menu_items"
                                   :class="[errors?.menu_items === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="menu-items-error" v-for="error in errors?.menu_items">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="orders" class="block text-sm font-medium text-gray-700">Orders</label>
                            <input type="number" name="orders" id="orders"  placeholder="Number of Orders" v-model="planForm.orders"
                                   :class="[errors?.orders === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="orders-error" v-for="error in errors?.orders">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="users" class="block text-sm font-medium text-gray-700">Users</label>
                            <input type="number" name="users" id="users"  placeholder="System Users" v-model="planForm.users"
                                   :class="[errors?.users === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="users-error" v-for="error in errors?.users">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="views" class="block text-sm font-medium text-gray-700">views</label>
                            <input type="number" name="views" id="views"  placeholder="Menu views" v-model="planForm.views"
                                   :class="[errors?.views === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="views-error" v-for="error in errors?.users">{{error}}</p>
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <label for="dedicated-support" class="block text-sm font-medium text-gray-700">
                                Dedicated support
                                <input type="checkbox" name="dedicated_support" id="dedicated_support" v-model="planForm.dedicated_support"
                                       :class="[errors?.dedicated_support === undefined ? 'valid-input' : 'invalid-input']" required/>
                            </label>
                            <p class="mt-2 text-sm text-red-600" id="dedicated-support-error" v-for="error in errors?.dedicated_support">{{error}}</p>
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
    'planForm', 'errors', 'isLoading',
    'isFetching', 'btnMessage', 'formDescription',
])

const emit = defineEmits(['submitPlan'])



const submitPlan = () =>{
    emit('submitPlan')
}

</script>
