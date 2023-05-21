<template>
    <BlurredSpinner v-if="isFetching" />
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 ">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="p-12 overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <RibbonConfirmed v-if='order?.status==="Confirmed" || order?.status==="Paid"' :status="order?.status"/>
                        <RibbonPending v-if='order?.status==="Pending"' :status="order?.status"/>
                        <RibbonRejected v-if='order?.status==="Rejected"' :status="order?.status"/>
                        <div class="flex justify-between">
                            <div>
                                <p class="text-3xl font-bold">Invoice # {{order.id}}</p>
                            </div>
                            <div class="text-right">
                                <div class="font-semibold text-lg">
                                    {{order?.restaurant?.name}}
                                </div>
                                <div class="m-2 font-normal text-sm">
                                    {{order?.restaurant?.address_one}},
                                    {{order?.restaurant?.address_two}},
                                    {{order?.restaurant?.country}}
                                </div>
                                <div class="m-2 font-normal text-sm text-gray-500">
                                    {{order?.created_at}}
                                </div>
                            </div>
                        </div>
                        <div class="w-72">
                            <p class="mb-4 text-2xl font-bold">Bill To</p>
                            <p class="text-gray-500 text-base italic">
                                {{order?.table?.name}}
                            </p>
                        </div>
                        <div class="mt-6 relative overflow-x-auto sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Product name
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
                                <tr class="" v-for="item in order?.order_items" :key="item.id">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 flex-shrink-0">
                                                <img class="h-10 w-10 rounded-full" :src="item?.image" alt="" />
                                            </div>
                                            <div class="ml-4">
                                                <div class="font-medium text-gray-900">{{ item.name }}</div>
                                                <div class="text-gray-500">{{ item.description }}</div>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="px-6 py-4">
                                        {{numFormat(item.price)}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{item.pivot.qty}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{numFormat(item.price * item.pivot.qty)}}
                                    </td>
<!--                                    <td class="px-6 py-4 text-right">-->
<!--                                        <a href="#" class="font-medium text-rose-600 hover:underline">Edit</a>-->
<!--                                    </td>-->
                                </tr>
                                </tbody>
                                <tfoot class="space-y-6 border-t border-gray-200 pt-6 text-sm font-medium text-gray-500">
                                    <tr>
                                        <th id="total" colSpan="3" class="text-right">
                                            Total Paid:
                                        </th>
                                        <td class="text-left px-3 py-3.5 border-b border-gray-200 sm:px-6 font-bold">
                                            {{grandTotal}}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="mt-4 flex justify-end gap-3">
                            <button class="btn-secondary"
                                    @click="printOrder(order)"
                                    :class="{'disabled:opacity-25' : isLoading}" :disabled="isLoading"
                            >Print
                            </button>
                            <button class="btn-sm-submit" @click="rejectOrder(order)"
                                    :class="{'disabled:opacity-25' : isDisabled}" :disabled="isDisabled"
                                    v-if="active"
                            >
                                <LoadingSpinner :is-loading="isRejecting" />
                                Reject
                            </button>
                            <button class="btn-primary" @click="confirmOrder(order)"
                                :class="{'disabled:opacity-25' : isDisabled}" :disabled="isDisabled"
                                v-if="active"
                            >
                                <LoadingSpinner :is-loading="isLoading" />
                                Confirm
                            </button>
                            <button class="btn-primary" @click="payOrder(order)"
                                    :class="{'disabled:opacity-25' : order.status === 'Paid'}" :disabled="order.status === 'Paid'"
                                    v-if="order.status === 'Confirmed'"
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

import useOrders from "../../composables/orders";
import {computed, inject, onMounted, provide, ref, toRaw} from "vue";
import {useRoute} from "vue-router";
import LoadingSpinner from "../../components/LoadingSpinner.vue";
import usePayments from "../../composables/payments";
import { useAbility } from '@casl/vue'
import RibbonConfirmed from "../../components/RibbonConfirmed.vue";
import RibbonPending from "../../components/RibbonPending.vue";
import RibbonRejected from "../../components/RibbonRejected.vue";
import utils from "../../utils/utils";
import useAuth from "../../composables/auth";
import BlurredSpinner from "../../components/BlurredSpinner.vue";
const { can } = useAbility()


const {
    order,
    isLoading,
    isRejecting,
    isFetching,
    numFormat,
    getOrder,
    updateOrderStatus,
    printReceipt
} = useOrders()
const {storePayment, errors} = usePayments()

const router = useRoute()

const swal = inject('$swal')

onMounted(()=>{
    getOrder(router.params.id)
})

const grandTotal = computed(() => {
    return numFormat(order.value.order_items?.reduce((total, item) => (item.pivot.qty*item.price) + total, 0))
});

const isDisabled = computed(() =>{
    return isLoading.value || isRejecting.value || order.value.status !== "Pending"
})

const active = computed(() =>{
    return  order.value.status === "Pending"
})

const confirmOrder = (order) => {
    updateOrderStatus(
        order.id,
        {
            'status': 'Confirmed'
        }
    )
}

const rejectOrder = (order) => {
    updateOrderStatus(
        order.id,
        {
            'status': 'Rejected'
        }
    )
}

const payOrder = (order) => {
    swal({
        title: "Are you sure ?",
        text: "You will record payment for this order!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#167B4A",
        confirmButtonText: "Yes, record!",
        cancelButtonText: "No, cancel !",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then((confirmed) => {
        if (confirmed) {
            storePayment(
                {
                    'amount': parseFloat(grandTotal.value.replace(",", "")),
                    'order_id' : order.id,
                }
            )
        } else {
            swal("Cancelled", "Payment not recorded !", "error");
        }
    });
}

const printOrder= (order) =>{
    printReceipt(order.id)
}


const {logout} = useAuth()

if(!can('orders.update')){
    logout()
}
provide('isLoading', isLoading)

//utils.has_perm('orders.update')
</script>

