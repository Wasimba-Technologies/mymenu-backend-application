
<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 ">
            <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                    <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                        <main class="flex-1">
                            <div class="relative mx-auto max-w-4xl">
                                <div class="pt-4 pb-16">
                                    <div class="px-4 sm:px-6 lg:px-0">
                                        <div class="py-6">
                                            <!-- Tabs -->
                                            <div class="lg:hidden">
                                                <label for="selected-tab" class="sr-only">Select a tab</label>
                                                <select id="selected-tab" name="selected-tab" class="mt-1 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-inset focus:ring-rose-500 sm:text-sm sm:leading-6">
                                                    <option v-for="tab in tabs" :key="tab.name" :selected="tab.current">{{ tab.name }}</option>
                                                </select>
                                            </div>
                                            <div class="hidden lg:block">
                                                <div class="border-b border-gray-200">
                                                    <nav class="-mb-px flex space-x-8">
                                                        <a v-for="tab in tabs" :key="tab.name" :href="tab.href" :class="[tab.current ? 'border-rose-500 text-rose-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'whitespace-nowrap border-b-2 py-4 px-1 text-sm font-medium']">{{ tab.name }}</a>
                                                    </nav>
                                                </div>
                                            </div>

                                            <!--Tab here -->
                                            <div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </main>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'

const tabs = [
    { name: 'General', href: '#', current: true },
    { name: 'Business Info', href: '#', current: false },
]

</script>
