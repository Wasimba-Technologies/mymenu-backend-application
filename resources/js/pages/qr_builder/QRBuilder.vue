<template>
    <form class="space-y-6 mt-6" @submit.prevent="generateQRCode">
        <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">QR Code builder</h3>
                    <p class="mt-1 text-sm text-gray-500">Generate QR code for each table</p>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-6">
                            <label for="menu" class="block text-sm font-medium text-gray-700">Menu</label>
                            <select id="menu" name="menu" v-model="qrCodeForm.table_id"
                                    :class="[errors?.table_id === undefined ? 'valid-select' : 'invalid-select']">
                                <option value="" selected>--Select Table--</option>
                                <option  v-for="table in tables" :value="table.id" v-if="table?.qr_code !== null">{{table.name}}</option>
                            </select>
                            <p class="mt-2 text-sm text-red-600" id="menu-error" v-for="error in errors?.table_id">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">Color</label>
                            <input type="color" name="color" id="color"  placeholder="Hex Color" v-model="qrCodeForm.color"
                                   :class="[errors?.color === undefined ? 'h-10 valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="color-error" v-for="error in errors?.color">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="label" class="block text-sm font-medium text-gray-700">Label</label>
                            <input type="text" name="label" id="label"  placeholder="QR Label" v-model="qrCodeForm.label"
                                   :class="[errors?.label === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="label-error" v-for="error in errors?.label">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <img id="img_qr"  :src="qr_code?.url" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 mt-6">
                <button type="submit" class="btn-sm-submit"
                        :class="{'disabled:opacity-50' : qr_code.url !== undefined || isLoading}"
                        :disabled="isLoading || qr_code.url !== undefined" >
                    <LoadingSpinner :is-loading="isLoading" />
                     Generate
                </button>
            </div>
        </div>
    </form>
</template>

<script setup>


import LoadingSpinner from "../../components/LoadingSpinner.vue";
import useQRCodes from "../../composables/qr_codes";
import useTables from "../../composables/tables";
import {onMounted, provide, ref} from "vue";

const {errors, isLoading, generateQR, qr_code, qrCodeForm} = useQRCodes()

const {tables, getTables} = useTables();

const table = ref(null)


onMounted(()=>{
    getTables()
})

const generateQRCode  = () =>{
    generateQR({...qrCodeForm})
}




provide('isLoading', isLoading)

</script>


