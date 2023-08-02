
<template>
    <div class="bg-gray-50">
        <BlurredSpinner v-if="paymentLoading"/>
        <Title>Payment | {{title}}</Title>
        <div class="mt-4 mx-auto max-w-2xl px-4 pb-24 pt-16 sm:px-6 lg:max-w-7xl lg:px-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Payment Methods</h1>
            <form class="mt-12 lg:grid lg:grid-cols-12 lg:items-start lg:gap-x-12 xl:gap-x-16" @submit.prevent="initiateSubscriptionPayment">
                <section aria-labelledby="cart-heading" class="lg:col-span-7">
                    <h2 id="cart-heading" class="sr-only">Payment methods available</h2>
                    <h2 class="text-base font-semibold text-gray-900">Pay for your subscription</h2>
                    <p class="mt-1 text-sm text-gray-500">Select Payment method from below</p>
                    <div>
                        <fieldset class="mt-2">
                            <legend class="sr-only">MON</legend>
                            <div class="divide-y divide-gray-200">
                                <div v-for="(method, methodIdx) in payment_methods" :key="methodIdx" class="flex flex-col">
                                    <div class="relative flex items-center pb-2 pt-3.5">
                                        <div class="mr-6 flex h-6 items-center  leading-6">
                                            <input :id="`account-${method.id}`" :aria-describedby="`account-${method.id}-description`" name="account" type="radio" :checked="method.id === selectedMethod.id"
                                                   class="h-4 w-4 border-gray-300 text-rose-600 focus:ring-rose-600"
                                                   @change="changeSelectedMethod(method)"/>
                                        </div>
                                        <div class="min-w-0 flex items-center space-x-5 text-sm">
                                            <img :src="method.imgSrc" style="width: 80px; height: 54px;"/>
                                            <label :for="`account-${method.id}`" class="text-2xl font-extrabold text-gray-900">{{ method.name }}</label>
                                        </div>
                                    </div>
                                    <div class="ml-11" v-if="selectedMethod.id  === method.id">
                                        <div class="my-1 flex flex-col">
                                            <label for="reference-no" class="mb-1">Phone Number</label>
                                            <input
                                                type="text"
                                                id="reference_no"
                                                name="reference_no"
                                                class=" valid-input w-full rounded-md border-gray-300 shadow-sm focus:border-rose-500 focus:ring-rose-500 sm:text-sm"
                                                placeholder="Phone Number" required v-model="accountNumber"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </section>

                <!-- Order summary -->
                <section aria-labelledby="summary-heading" class="mt-16 rounded-lg bg-gray-50 px-4 py-6 sm:p-6 lg:col-span-5 lg:mt-0 lg:p-8">
                    <h2 id="summary-heading" class="text-lg font-medium text-gray-900">Order summary</h2>

                    <dl class="mt-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <dt class="text-sm text-gray-600">Subtotal</dt>
                            <dd class="text-sm font-medium text-gray-900">{{tenant.currency}} {{numFormat(subscription?.plan?.price)}}</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="flex items-center text-sm text-gray-600">
                                <span>Discount</span>
                                <a href="#" class="ml-2 flex-shrink-0 text-gray-400 hover:text-gray-500">
                                    <span class="sr-only">Learn more about how to get Discount</span>
                                    <QuestionMarkCircleIcon class="h-5 w-5" aria-hidden="true" />
                                </a>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">- {{tenant.currency}} {{0}}</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="flex text-sm text-gray-600">
                                <span>Tax</span>
                                <a href="#" class="ml-2 flex-shrink-0 text-gray-400 hover:text-gray-500">
                                  <span class="sr-only">Learn more about how tax is calculated</span>
                                  <QuestionMarkCircleIcon class="h-5 w-5" aria-hidden="true" />
                                </a>
                            </dt>
                            <dd class="text-sm font-medium text-gray-900">+ {{tenant.currency}} {{numFormat(0)}}</dd>
                        </div>
                        <div class="flex items-center justify-between border-t border-gray-200 pt-4">
                            <dt class="text-base font-medium text-gray-900">Order total</dt>
                            <dd class="text-base font-medium text-gray-900">{{tenant.currency}} {{numFormat(subscription?.plan?.price)}}</dd>
                        </div>
                    </dl>
                    <div class="mt-6">
                        <button type="submit"  class="w-full rounded-md border border-transparent bg-rose-600 px-4 py-3 text-base font-medium text-white shadow-sm hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2 focus:ring-offset-gray-50 disabled:cursor-not-allowed disabled:opacity-50">
                            Confirm Payment
                        </button>
                    </div>
                </section>
            </form>
        </div>
    </div>
</template>

<script setup>
import { QuestionMarkCircleIcon } from '@heroicons/vue/20/solid'
import {useRoute} from "vue-router";
import {inject, onMounted, ref} from "vue";
import BlurredSpinner from "../../components/BlurredSpinner.vue";
import useSubscriptions from "../../composables/subscription";
import usePaymentProcessor from "../../composables/payment_processor";
import router from "../../router";

const route = useRoute()
const swal = inject('$swal')
const {
    numFormat,
    subscription,
    getSubscription
} = useSubscriptions()
const {
    paymentLoading,
    initiateAzamPayPayment,
    checkAzamPayTransactionStatus,
} = usePaymentProcessor()

const payment_methods = [
    { id: 'Mpesa', name: 'M-Pesa',  imgSrc: "/images/gateways/m-pesa.webp"},
    { id: 'Tigo', name: 'Tigo-Pesa', imgSrc: "/images/gateways/tigo-pesa.webp" },
    { id: 'Airtel', name: 'Airtel Money',  imgSrc: "/images/gateways/airtel-money.webp" },
]

const selectedMethod = ref(payment_methods[0])

const accountNumber = ref(null)


onMounted(async () => {
    await getSubscription(route.params.id)
    await checkAzamPayTransactionStatus(
        `subscriptions.${route.params.id}`,
        '.subscription.paid'
    )
})


const changeSelectedMethod = (method) =>{
    selectedMethod.value = method
}

const initiateSubscriptionPayment = async () => {
    await initiateAzamPayPayment(
        {
            accountNumber: accountNumber.value,
            additionalProperties: {
                property1: 'subscription',
                property2: subscription.value.plan.name
            },
        amount: subscription.value.plan.price,
        currency: "TZS",
        externalId: route.params.id,
        provider: selectedMethod.value.id
    })
}

const tenant = JSON.parse(localStorage.getItem('tenant'))



</script>
