<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-4 flex flex-col">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-300">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Plan</th>
                                <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6">Start</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">End</th>
                                <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">
                                    Action
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 bg-white">
                            <tr v-if="isFetching">
                                <td colSpan="5">
                                    <SkeletonPlaceHolder />
                                </td>
                            </tr>
                            <tr v-for="subscription in subscriptions" :key="subscription.id">
                                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm sm:pl-6">
                                    {{subscription.plan.name }}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{subscription.start_date}}
                                </td>
                                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">
                                    {{subscription.end_date}}
                                </td>
                                <td>
                                    <a href="#" class="px-3 py-4 text-rose-600 hover:text-rose-900" @click="showPayments">payments</a>
                                </td>
                            </tr>
                            <tr v-if="subscriptions?.length === 0 && ! isFetching">
                                <td colSpan="5">
                                    <NoDataSVG
                                        class="flex flex-col justify-center items-center mt-10"
                                        message="Oops! There are no restaurants Yet."
                                    />
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex justify-end mt-2">
                        <Pagination v-if="subscriptions?.length !== 0"
                                    @on-prev-clicked="onPrevClicked"
                                    @on-next-clicked="onNextClicked"
                                    :is-next="paginationLinks?.next"
                                    :is-prev="paginationLinks?.prev"
                                    :meta="paginationMetaData"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>

import {onMounted, ref} from "vue";
import Pagination from "../../components/Pagination.vue";
import SkeletonPlaceHolder from "../../components/SkeletonPlaceHolder.vue";
import NoDataSVG from "../../components/NoDataSVG.vue";
import useSubscriptions from "../../composables/subscription";

const searchName = ref('')
const {
    subscriptions,
    getSubscriptions,
    paginationLinks,
    paginationMetaData,
    changeSubscriptionsUrl,
    isFetching
} = useSubscriptions()



const onNextClicked = () => {
    changeSubscriptionsUrl(paginationLinks.value.next)
}

const onPrevClicked =() =>{
    changeSubscriptionsUrl(paginationLinks.value.prev)
}

onMounted(()=>{
    //if URL changes perform side effects
    getSubscriptions()
})

const showPayments = () =>{

}


</script>
