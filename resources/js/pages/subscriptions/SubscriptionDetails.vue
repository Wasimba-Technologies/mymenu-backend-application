<template>
    <BlurredSpinner v-if="isFetching" />
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 ">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="relative p-12 overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <div :class="[statusStyles[subscription.status], 'absolute w-36 text-center h-8 top-0 right-0 rounded']">
                            {{subscription?.status }}
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <p class="text-3xl font-bold">Invoice # {{subscription.id}}</p>
                            </div>
                            <div class="text-right">
                                <div class="font-semibold text-lg">
                                    WasimbaLabs Ltd
                                </div>
                                <div class="m-2 font-normal text-sm">
                                    Dar es Salaam,
                                    Tanzania
                                </div>

                            </div>
                        </div>
                        <div class="w-72">
                            <p class="mb-4 text-2xl font-bold">Bill To</p>
                            <p class="text-gray-500 text-base italic">
                                {{subscription?.tenant?.name}},
                            </p>
                            <div class="m-2 font-normal text-sm text-gray-500">
                                {{subscription?.tenant?.address_one}},
                                {{subscription?.tenant?.address_two}},
                                {{subscription?.tenant?.country}}
                            </div>
                            <div class="m-2 font-normal text-sm text-gray-500">
                                {{subscription?.created_at}}
                            </div>
                        </div>
                        <div class="mt-6 relative overflow-x-auto sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Plan name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Qty
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        SubTotal
                                    </th>
                                    <!--                                    <th scope="col" class="px-6 py-3">-->
                                    <!--                                        <span class="sr-only">Edit</span>-->
                                    <!--                                    </th>-->
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <img class="h-10 w-10 rounded-full" :src="subscription?.image" alt="" />
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">{{ subscription?.plan?.name }}</div>
                                                <div class="text-gray-500">{{ subscription?.description }}</div>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{numFormat(subscription?.plan?.price)}}
                                    </td>
                                    <td class="px-6 py-4">
                                        1
                                    </td>
                                    <td class="px-6 py-4">
                                        {{numFormat(subscription?.plan?.price)}}
                                    </td>
                                    <!--                                    <td class="px-6 py-4 text-right">-->
                                    <!--                                        <a href="#" class="font-medium text-rose-600 hover:underline">Edit</a>-->
                                    <!--                                    </td>-->
                                </tr>
                                </tbody>
                                <tfoot class="space-y-6 border-t border-gray-200 pt-6 text-sm font-medium text-gray-500">
                                <tr>
                                    <th id="total" colSpan="3" class="text-right">
                                        Total :
                                    </th>
                                    <td class="text-left px-3 py-3.5 border-b border-gray-200 sm:px-6 font-bold">
                                        Tsh. {{numFormat(subscription?.plan?.price)}}
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="mt-4 flex justify-end gap-3">
                            <button class="btn-sm-submit"
                                    :class="{'disabled:opacity-25' : isDisabled}" :disabled="isDisabled"
                                    v-if="subscription.status === 'active' && can('subscriptions.viewAny')"
                            >
                                <LoadingSpinner :is-loading="isRejecting" />
                                Upgrade
                            </button>
                            <button class="btn-primary" @click="paySubscription(subscription)"
                                    :class="{'disabled:opacity-25' : subscription.status === 'Paid'}" :disabled="subscription.status === 'Paid'"
                                    v-if="subscription.status === 'pending' && can('subscriptions.viewAny')"
                            >
                                <LoadingSpinner :is-loading="isLoading" />
                                Pay
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import {computed, inject, onMounted, provide} from "vue";
import {useRoute} from "vue-router";
import LoadingSpinner from "../../components/LoadingSpinner.vue";
import usePayments from "../../composables/payments";
import {ABILITY_TOKEN, useAbility} from '@casl/vue'
import useAuth from "../../composables/auth";
import BlurredSpinner from "../../components/BlurredSpinner.vue";
import useSubscriptions from "../../composables/subscription";
import router from "../../router";

const {
    isLoading,
    numFormat,
    isFetching,
    isRejecting,
    subscription,
    getSubscription,
    printReceipt
} = useSubscriptions()
const {storePayment, errors} = usePayments()
const {can} = useAbility()
const {logout} = useAuth()
const ability = inject(ABILITY_TOKEN)
const {getAbilities} = useAuth()

const route = useRoute()

const swal = inject('$swal')

onMounted(async () => {
    await getAbilities()
    if (!can('orders.view')) {
        await logout()
    }
    await getSubscription(route.params.id)
})

const grandTotal = computed(() => {
    return numFormat(subscription.value.order_items?.reduce((total, item) => (item.pivot.qty*item.price) + total, 0))
});

const isDisabled = computed(() =>{
    return isLoading.value || isRejecting.value || subscription.value.status !== "Pending"
})

const active = computed(() =>{
    return  subscription.value.status === "Pending"
})

const confirmSubscription = (subscription) => {
    updateSubscriptionStatus(
        subscription.id,
        {
            'status': 'Confirmed'
        }
    )
}

const rejectSubscription= (subscription) => {
    updateSubscriptionStatus(
        subscription.id,
        {
            'status': 'Rejected'
        }
    )
}

const completeSubscription = (subscription) => {
    updateSubscriptionStatus(
        subscription.id,
        {
            'status': 'Done'
        }
    )
}

const paySubscription = (subscription) => {
    swal({
        title: "Are you sure ?",
        text: "You will record payment for this subscription!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#167B4A",
        confirmButtonText: "Yes, record!",
        cancelButtonText: "No, cancel !",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((results) => {
        if (results.isConfirmed) {
            // storePayment(
            //     {
            //         'amount': parseFloat(grandTotal.value.replace(",", "")),
            //         'order_id' : subscription.id,
            //     }
            // )
            router.push('/subscriptions/'+route.params.id+'/payment')
        } else {
            swal("Cancelled", "Payment not recorded !", "error");
        }
    });
}

const statusStyles = {
    active: 'bg-green-100 text-green-800',
    paid: 'bg-green-100 text-green-800',
    pending: 'bg-yellow-100 text-yellow-800',
    rejected: 'bg-red-100 text-red-800',
    expired: 'bg-red-100 text-red-800',
}
const printOrder= (subscription) =>{
    printReceipt(subscription.id)
}

provide('isLoading', isLoading)

//utils.has_perm('orders.update')
</script>


