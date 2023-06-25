<template>
    <form class="space-y-6 mt-6" @submit.prevent="submitUser">
        <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">User information</h3>
                    <p class="mt-1 text-sm text-gray-500">{{formDescription}}</p>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6">
                            <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                            <select id="role" name="role" v-model="userForm.role_id"
                                    :class="[errors?.role_id === undefined ? 'valid-select' : 'invalid-select']">
                                <option value="" selected>--Select Role--</option>
                                <option v-for="role in roles" :value="role.id"
                                        :selected="parseInt(role.id) === parseInt(userForm.role_id)" :key="role.id">
                                    {{role.name}}
                                </option>
                            </select>
                            <p class="mt-2 text-sm text-red-600" id="role-error" v-for="error in errors?.role_id">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" name="name" id="name"  placeholder="Names" v-model="userForm.name"
                                   :class="[errors?.name === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="name-error" v-for="error in errors?.name">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                            <select id="gender" name="gender" v-model="userForm.gender"
                                    :class="[errors?.gender === undefined ? 'valid-select' : 'invalid-select']">
                                <option value="" selected>--Select Gender--</option>
                                <option v-for="gender in genders" :value="gender.name"
                                        :selected="parseInt(gender.name) === parseInt(userForm.gender)" :key="gender.id">
                                    {{gender.name}}
                                </option>
                            </select>
                            <p class="mt-2 text-sm text-red-600" id="gender-error" v-for="error in errors?.gender">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email"  placeholder="Email" v-model="userForm.email"
                                   :class="[errors?.price === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="price-error" v-for="error in errors?.email">{{error}}</p>
                        </div>


                        <div class="col-span-3 sm:col-span-3">
                            <label for="phone-number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                            <input type="text" name="phone_number" id="phone_number"  placeholder="Phone Number" v-model="userForm.phone_number"
                                   :class="[errors?.phone_number === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="phone-number-error" v-for="error in errors?.phone_number">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="password"  placeholder="Password" v-model="userForm.password"
                                   :class="[errors?.password === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="password-error" v-for="error in errors?.password">{{error}}</p>
                        </div>


                        <div class="col-span-3 sm:col-span-3">
                            <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"  placeholder="Confirm Password" v-model="userForm.password_confirmation"
                                   :class="[errors?.password === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="confirm-password-error" v-for="error in errors?.password">{{error}}</p>
                        </div>

                        <div class="col-span-2 sm:col-span-2">
                            <label class="block text-sm font-medium text-gray-700">Image</label>
                            <div class="mt-1 flex items-center">
                                <div class="flex-shrink-0 h-28 w-28" v-if="userForm.image">
                                    <img class="h-28 w-28 rounded-full"
                                         :src="imgUrl ==null ? userForm.image : imgUrl"
                                         alt="">
                                </div>
                                <span class="inline-block h-28 w-28 overflow-hidden rounded-full bg-gray-100" v-if="!userForm.image">
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
                                        <label for="image" class="relative cursor-pointer rounded-md bg-white font-medium text-rose-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-rose-500 focus-within:ring-offset-2 hover:text-rose-500">
                                            <span>Upload a file</span>
                                            <input id="image" name="image" type="file" class="sr-only" @change="loadFile"/>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                            <p class="mt-2 text-sm text-red-600" id="logo-error" v-for="error in errors?.image">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-6">
                            <label for="permissions" class="block text-sm font-medium text-gray-700">Permissions</label>
                            <div class="grid grid-cols-4 gap-1 m-4 p-2  border-b border-1 border-b-gray-200">
                                <fieldset class="mt-4 col-span-3 lg:col-span-1" v-for="sys_perm in SystemPermissions">
                                    <legend class="sr-only">{{sys_perm.model}}</legend>
                                    <div class="text-base font-bold text-gray-900" aria-hidden="true">{{sys_perm.model}}</div>
                                    <div class="mt-4 space-y-4">
                                        <LabeledCheckBox
                                            v-for="perm in sys_perm.permissions"
                                            :label="perm.name" :system-permission="perm"
                                            :user-permissions="userForm.permissions"
                                        />
                                    </div>
                                </fieldset>
                            </div>
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
import LabeledCheckBox from "./LabeledCheckBox.vue";
import PermissionField from "./PermissionField.vue";
import {inject, onMounted} from "vue";

let props = defineProps([
    'userForm', 'errors', 'isLoading',
    'isFetching', 'imgUrl', 'btnMessage', 'formDescription', 'roles'
])

const genders = [
    {id: 1, name: "Female"},
    {id: 2, name: "Male"}
]

const emit = defineEmits(['submitUser', 'loadImage'])

const SystemPermissions = [
    {
        'model': 'User',
        'permissions': [
            {id: 'users.viewAny', name: 'ViewAll'},
            {id: 'users.view', name: 'ViewOne'},
            {id: 'users.create', name: 'Create'},
            {id: 'users.update', name: 'Update'},
            {id: 'users.delete', name: 'Delete'},
        ]
    },
    {
        'model': 'Menus',
        'permissions': [
            {id: 'menus.viewAny', name: 'ViewAll'},
            {id: 'menus.view', name: 'ViewOne'},
            {id: 'menus.create', name: 'Create'},
            {id: 'menus.update', name: 'Update'},
            {id: 'menus.delete', name: 'Delete'},
        ]
    },
    {
        'model': 'MenuItems',
        'permissions': [
            {id: 'menu_items.viewAny', name: 'ViewAll'},
            {id: 'menu_items.view', name: 'ViewOne'},
            {id: 'menu_items.create', name: 'Create'},
            {id: 'menu_items.update', name: 'Update'},
            {id: 'menu_items.delete', name: 'Delete'},
        ]
    },
    {
        'model': 'Tables',
        'permissions': [
            {id: 'tables.viewAny', name: 'ViewAll'},
            {id: 'tables.view', name: 'ViewOne'},
            {id: 'tables.create', name: 'Create'},
            {id: 'tables.update', name: 'Update'},
            {id: 'tables.delete', name: 'Delete'},
        ]
    },
    {
        'model': 'QrCode Appearance',
        'permissions': [
            {id: 'qr_codes.viewAny', name: 'ViewAll'},
            {id: 'qr_codes.view', name: 'ViewOne'},
            {id: 'qr_codes.create', name: 'Create'},
            {id: 'qr_codes.update', name: 'Update'},
            {id: 'qr_codes.delete', name: 'Delete'},
        ]
    },
    {
        'model': 'Orders',
        'permissions': [
            {id: 'orders.viewAny', name: 'ViewAll'},
            {id: 'orders.view', name: 'ViewOne'},
            {id: 'orders.create', name: 'Create'},
            {id: 'orders.update', name: 'Update'},
            {id: 'orders.delete', name: 'Delete'},
        ]
    },
    {
        'model': 'Payments',
        'permissions': [
            {id: 'payments.viewAny', name: 'ViewAll'},
            {id: 'payments.view', name: 'ViewOne'},
            {id: 'payments.create', name: 'Create'},
            {id: 'payments.update', name: 'Update'},
            {id: 'payments.delete', name: 'Delete'},
        ]
    },
    {
        'model': 'Restaurant',
        'permissions': [
            {id: 'restaurants.view', name: 'ViewOne'},
            {id: 'restaurants.update', name: 'Update'},
        ]
    },
    {
        'model': 'Plans',
        'permissions': [
            {id: 'plans.viewAny', name: 'ViewAll'},
            {id: 'plans.view', name: 'ViewOne'},
        ]
    },
    {
        'model': 'Subscriptions',
        'permissions': [
            {id: 'subscriptions.viewAny', name: 'ViewAll'},
            {id: 'subscriptions.view', name: 'ViewOne'},
        ]
    },
]


onMounted(()=>{
    console.log(props.userForm)
})
const loadFile = (event) => {
    emit('loadImage', event)
}

const submitUser = () =>{
    emit('submitUser')
}

</script>
