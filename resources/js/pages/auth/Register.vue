<template>
    <div class="min-h-full flex ">
        <title>MyMenu |  Register Restaurant</title>
        <div class="flex-1 flex flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <div>
                    <h1 class="text-rose-600 font-bold text-4xl text-center">MyMenu</h1>
                    <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Register your account</h2>
                    <p class="mt-2 text-sm text-gray-600">
                        Or
                        {{ ' ' }}
                        <router-link to="/login" class="font-medium text-rose-600 hover:text-rose-500">Login to your account</router-link>
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
                        <form class="space-y-6" @submit.prevent="registerOwner">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Names</label>
                                <div class="mt-1">
                                    <input id="name" name="name" type="text" autocomplete="name" required v-model="ownerForm.name"
                                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm" />
                                    <p class="mt-2 text-sm font-extrabold text-red-600" id="name-error" v-for="error in errors?.name">{{error}}</p>
                                </div>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                <div class="mt-1">
                                    <input id="email" name="email" type="email" autocomplete="email" required v-model="ownerForm.email"
                                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm" />
                                    <p class="mt-2 text-sm font-extrabold text-red-600" id="name-error" v-for="error in errors?.email">{{error}}</p>
                                </div>
                            </div>
                            <div>
                                <label for="tel" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <div class="mt-1">
                                    <input id="phone_number" name="phone_number" type="tel" autocomplete="tel" required v-model="ownerForm.phone_number"
                                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm" />
                                    <p class="mt-2 text-sm font-extrabold text-red-600" id="name-error" v-for="error in errors?.phone_number">{{error}}</p>
                                </div>
                            </div>
                            <div class="space-y-1">
                                <label for="password" class="block text-sm font-medium text-gray-700"> Password </label>
                                <div class="mt-1">
                                    <input id="password" name="password" type="password" autocomplete="current-password" required  v-model="ownerForm.password"
                                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md
                                           shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm" />
                                    <p class="mt-2 text-sm font-extrabold text-red-600" id="name-error" v-for="error in errors?.password">{{error}}</p>
                                </div>
                            </div>

                            <div class="space-y-1">
                                <label for="password" class="block text-sm font-medium text-gray-700"> Confirm Password </label>
                                <div class="mt-1">
                                    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="current-password" required  v-model="ownerForm.password_confirmation"
                                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-rose-500 focus:border-rose-500 sm:text-sm" />
                                    <p class="mt-2 text-sm font-extrabold text-red-600" id="name-error" v-for="error in errors?.password_confirmation">{{error}}</p>
                                </div>
                            </div>


                            <div>
                                <button type="submit"
                                        class="w-full btn-sm-submit" :class="{ 'opacity-70': isLoading }" :disabled="isLoading">
                                    <LoadingSpinner />
                                    Register
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

    const {isLoading, registerOwner, errors, ownerForm} = useAuth()

    provide('isLoading', isLoading)

</script>
