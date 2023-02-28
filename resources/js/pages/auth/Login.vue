<template>
    <div class="min-h-full flex ">
        <title>MyMenu |  Login</title>
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h1 class="text-rose-600 font-bold text-4xl text-center">MyMenu</h1>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Or
                        {{ ' ' }}
                        <router-link to="/register" class="font-medium text-rose-600 hover:text-rose-500"> start your 14-day free trial </router-link>
                    </p>
                </div>

                <div class="mt-8">
                    <div>
                        <div class="mt-6 relative">
                            <div class="absolute inset-0 flex items-center" aria-hidden="true">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <form class="space-y-6" @submit.prevent="submitLogin">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700"> Email address </label>
                                <div class="mt-1">
                                    <input id="email" name="email" type="email" autocomplete="email" required v-model="loginForm.email"
                                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm" />
                                    <p class="mt-2 text-sm font-extrabold text-red-600" id="name-error" v-for="error in errors?.email">{{error}}</p>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label for="password" class="block text-sm font-medium text-gray-700"> Password </label>
                                <div class="mt-1">
                                    <input id="password" name="password" type="password" autocomplete="current-password" required  v-model="loginForm.password"
                                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm" />
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-rose-600 focus:ring-rose-500 border-gray-300 rounded" />
                                    <label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
                                </div>

                                <div class="text-sm">
                                    <a href="#" class="font-medium text-rose-600 hover:text-rose-500"> Forgot your password? </a>
                                </div>
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full btn-sm-submit" :class="{ 'opacity-70': isLoading }" :disabled="isLoading">
                                    <LoadingSpinner />
                                    Sign in
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden lg:block relative w-0 flex-1">
            <img class="absolute inset-0 h-full w-full object-cover blur-sm" src="https://menusavvy.com/channel/menusavvy/img/photos/cocktail.jpg" alt="" />
        </div>
    </div>
</template>


<script setup>

import useAuth from "../../composables/auth";
import LoadingSpinner from "../../components/LoadingSpinner.vue";
import {provide} from "vue";

const {isLoading, submitLogin, errors, loginForm} = useAuth()

provide('isLoading', isLoading)

</script>
