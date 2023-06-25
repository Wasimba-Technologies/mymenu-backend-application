<template>
    <div class="flex items-start">
        <div class="flex h-5 items-center">
            <input type="checkbox" class="h-4 w-4rounded border-gray-300 text-rose-600 focus:ring-rose-500"
                   :checked="userPermissions?.
                   findIndex(
                       user_perm => user_perm.name === systemPermission.id
                   ) !== -1"
                   :value="systemPermission.id"
            />
        </div>
        <div class="ml-3 text-sm">
            <label for="permissions" class="font-medium text-gray-700">{{label}}</label>
        </div>
    </div>
</template>

<script setup>

import {inject, onMounted} from "vue";

const props = defineProps([
    'systemPermission','label','userPermissions'
])

const emit = defineEmits([
    'on-change'
])



</script>

