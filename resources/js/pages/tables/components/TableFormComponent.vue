<template>
    <form class="space-y-6 mt-6" @submit.prevent="submitTable">
        <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Table information</h3>
                    <p class="mt-1 text-sm text-gray-500">{{formDescription}}</p>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6">
                            <label for="name" class="block text-sm font-medium text-gray-700">Table Name</label>
                            <input type="text" name="name" id="name"  placeholder="Table name" v-model="tableForm.name"
                                   :class="[errors?.name === undefined ? 'valid-input' : 'invalid-input']"  required/>
                            <p class="mt-2 text-sm text-red-600" id="name-error" v-for="error in errors?.name">{{error}}</p>
                        </div>

                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 mt-6">
                <button type="submit" class="btn-sm-submit" :class="{'disabled:opacity-25' : isLoading}" :disabled="isLoading">
                    <LoadingSpinner :is-loading="isLoading" />
                    {{btnMessage}}
                </button>
            </div>
        </div>
    </form>
</template>

<script setup>

import LoadingSpinner from "../../../components/LoadingSpinner.vue";

let props = defineProps([
    'tableForm', 'errors', 'isLoading',
    'isFetching',  'btnMessage', 'formDescription'
])

const emit = defineEmits(['submitTable'])


const submitTable = () =>{
    emit('submitTable')
}

</script>

