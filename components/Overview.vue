<template>
     <div class="mt-8">
          <div class="mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-lg leading-6 font-medium text-gray-900">Overview</h2>
            <div class="mt-2 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
              <!-- Card -->
              <div v-for="card in cards" :key="card.name" class="bg-white overflow-hidden shadow rounded-lg">
                <div class="p-5">
                  <div class="flex items-center">
                    <div class="flex-shrink-0">
                      <component :is="card.icon" class="h-6 w-6 text-gray-400" aria-hidden="true" />
                    </div>
                    <div class="ml-5 w-0 flex-1">
                      <dl>
                        <dt class="text-sm font-medium text-gray-500 truncate">
                          {{ card.name }}
                        </dt>
                        <dd>
                          <div class="text-lg font-medium text-gray-900">
                            {{ card.amount }}
                          </div>
                        </dd>
                      </dl>
                    </div>
                  </div>
                </div>
                <div class="bg-gray-50 px-5 py-3">
                  <div class="text-sm">
                    <a :href="card.href" class="font-medium text-rose-700 hover:text-rose-900"> View all </a>
                  </div>
                </div>
              </div>
            </div>
          </div></div>
</template>

<script setup>
import {
  FolderIcon,
 TrendingUpIcon,
 ShoppingCartIcon
} from '@heroicons/vue/outline'
const cards = [
  { name: 'Sales Volume (30 Days)', href: '#', icon: TrendingUpIcon, amount: 'TZS 3,654,000' },
  { name: 'Orders (30 Days)', href: '#', icon: ShoppingCartIcon, amount: '213' },
  { name: 'Number of Items', href: '#', icon: FolderIcon, amount: '26 Items' },
  // More items...
]
</script>