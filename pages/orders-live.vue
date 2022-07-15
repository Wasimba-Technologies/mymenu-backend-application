<template>
    <div class="w-full">
        <h2 class="text-xl text-gray-700 font-bold md:text-2xl lg:text-3xl">Live Orders</h2>

        <!-- Boards go here -->
        <div class="flex flex-wrap  divide-y divide-gray-200 mt-8 gap-4 w-full justify-between ">
            <div class="flex flex-col divide-y divide-gray-200 bg-white rounded drop-shadow-md grow ">
                <!-- New orders -->
                <h3 class="text-lg font-bold text-gray-700 px-8 py-4">New Orders</h3>
                <ul role="list" class="divide-y divide-gray-200 p-8 ">
                    <li v-for="order in newOrders" :key="order.id" class="py-4 flex flex-col">
                        <p class="text-gray-600 text-sm">{{ order.createdAt }}</p>
                        <p class="text-gray-900 font-bold flex justify-between"> <span
                                class="animate-ping absolute left-2 h-3 w-3 rounded-full bg-blue-400 opacity-75"></span><span>{{ order.id }}</span>
                            <button type="button"
                                class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium ml-10 rounded shadow-sm text-white bg-rose-400 hover:bg-rose-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">Details</button>
                        </p>
                        <p class="text-gray-600 text-sm">{{ order.table }}</p>
                        <p class="text-gray-600 text-sm">TZS {{ order.cost }}</p>
                    </li>
                </ul>

            </div>

            <!-- Accepted orders -->
            <div class="flex flex-col divide-y divide-gray-200 bg-white rounded drop-shadow-md grow  ">
                <h3 class="text-lg font-bold text-gray-700 px-8 py-4">Accepted Orders</h3>
                <ul role="list" class="divide-y divide-gray-200 p-8 ">
                    <li v-for="order in newOrders" :key="order.id" class="py-4 flex flex-col">
                        <p class="text-gray-600 text-sm">{{ order.createdAt }}</p>
                        <p class="text-gray-900 font-bold flex justify-between"> <span
                                class="animate-ping absolute left-2 h-3 w-3 rounded-full bg-amber-400 opacity-75"></span><span>{{ order.id }}</span>
                            <button type="button"
                                class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium ml-10 rounded shadow-sm text-white bg-rose-400 hover:bg-rose-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">Details</button>
                        </p>
                        <p class="text-gray-600 text-sm">{{ order.table }}</p>
                        <p class="text-gray-600 text-sm">TZS {{ order.cost }}</p>
                    </li>
                </ul>

            </div>

            <!-- Done orders -->
            <div class="flex flex-col divide-y divide-gray-200 bg-white rounded drop-shadow-md grow ">
                <h3 class="text-lg font-bold text-gray-700 px-8 py-4">Done</h3>
                <ul role="list" class="divide-y divide-gray-200 p-8 ">
                    <li v-for="order in newOrders" :key="order.id" class="py-4 flex flex-col">
                        <p class="text-gray-600 text-sm">{{ order.createdAt }}</p>
                        <p class="text-gray-900 font-bold flex justify-between"> <span
                                class="animate-ping absolute left-2 h-3 w-3 rounded-full bg-green-400 opacity-75"></span><span>{{ order.id }}</span>
                            <button type="button"
                                class="inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium ml-10 rounded shadow-sm text-white bg-rose-400 hover:bg-rose-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500">Details</button>
                        </p>
                        <p class="text-gray-600 text-sm">{{ order.table }}</p>
                        <p class="text-gray-600 text-sm">TZS {{ order.cost }}</p>
                    </li>
                </ul>

            </div>

        </div>
    </div>
</template>


<script setup>
definePageMeta({
    layout: "dashboard",
});

const newOrders = [
    {
        id: "#100 Pizza",
        table: "Inside - Table 3",
        cost: "10000",
        createdAt: "Friday, July 15, 2022 6:34 AM"
    },
    {
        id: "#101 Cocktail",
        table: "Inside - Table 1",
        cost: "5000",
        createdAt: "Friday, July 15, 2022 6:37 AM"
    },
    {
        id: "#102 Massedonia",
        table: "Outside - Table 24",
        cost: "3000",
        createdAt: "Friday, July 15, 2022 6:42 AM"
    },
]
</script>


