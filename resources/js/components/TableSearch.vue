<template>
    <div class="pb-4 pt-4">
        <label for="table-search" class="sr-only">Search</label>
        <div class="relative mt-1">
            <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                          clip-rule="evenodd">
                    </path>
                </svg>
            </div>
            <input type="text" id="table-search"
                   class="block p-3 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:outline-none focus:ring-rose-500 focus:border-rose-500"
                   placeholder="Type to search..." @keydown="searchData"/>
        </div>
    </div>
</template>

<script setup>
const emit = defineEmits([
    'searchData'
])

const searchData = (event) =>{
    emit("searchData", event)
}
</script>
