<template>
    <BlurredSpinner v-if="isFetching" />
         <div class="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
             <title>MyMenu |  Verify Email</title>
             <div class="sm:mx-auto sm:w-full sm:max-w-sm">
                <h1 class="text-rose-600 font-bold text-4xl text-center">MyMenu</h1>
                <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Verify your email</h2>
            </div>

            <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                <form class="space-y-6" @submit.prevent="verifyOTP">
                    <div>
                        <div class="flex items-center justify-between">
                            <label for="otp" class="block text-sm font-medium leading-6 text-gray-900">One Time Password(OTP)</label>
                            <div class="text-sm">
                                <a role="button" class="font-medium text-rose-600 hover:text-rose-500" @click="resendOTP">Resend OTP?</a>
                            </div>
                        </div>
                        <div class="mt-2">
                            <input id="otp" name="otp" type="number" required class="valid-input" v-model="otpForm.otp"/>
                            <p class="mt-2 text-sm font-extrabold text-red-600" id="otp-error" v-for="error in errors?.otp">{{error}}</p>
                        </div>
                    </div>

                    <div>
                    <button type="submit"
                        class="w-full btn-sm-submit" :class="{ 'opacity-70': isLoading }" :disabled="isLoading">
                        <LoadingSpinner />
                        Verify
                    </button>
                    </div>
                </form>
            </div>
        </div>

</template>


<script setup>

    import useAuth from "../../composables/auth";
    import LoadingSpinner from "../../components/LoadingSpinner.vue";
    import {inject, onMounted, provide} from "vue";
    import BlurredSpinner from "../../components/BlurredSpinner.vue";
    import {ABILITY_TOKEN, useAbility} from "@casl/vue";
    import router from "../../router";

    const {
        errors,
        otpForm,
        resendOTP,
        verifyOTP,
        isLoading,
        isFetching,
    } = useAuth()

    const {logout} = useAuth()

    onMounted(async () => {
        if (!localStorage.getItem('access_token')){
            window.location.pathname = '/login'
        }
    })


    provide('isLoading', isLoading)

</script>
