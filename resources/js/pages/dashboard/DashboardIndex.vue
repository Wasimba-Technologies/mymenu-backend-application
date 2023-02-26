<template>
    <div>
        <title>MyMenu | Home</title>
        <div class="mx-auto px-4 sm:px-6 md:px-8">
            <div class="flex items-center">
                <img class="hidden h-16 w-16 rounded-full sm:block" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                <div>
                    <div class="flex items-center">
                        <img class="h-16 w-16 rounded-full sm:hidden" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
                        <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate">Good morning, Jovenali Bantulaki</h1>
                    </div>
                    <dl class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
                        <dt class="sr-only">Company</dt>
                        <dd class="flex items-center text-sm text-gray-500 font-medium capitalize sm:mr-6">
                            <BuildingOfficeIcon class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" aria-hidden="true" />
                            Makarwe Restaurant
                        </dd>
                    </dl>
                </div>
            </div>
        </div>
        <Overview />
        <RecentActivity />
    </div>
</template>



<script setup>
    import {BuildingOfficeIcon} from '@heroicons/vue/24/outline'
    import RecentActivity from "./components/RecentActivity.vue";
    import Overview from "./components/Overview.vue";
</script>
