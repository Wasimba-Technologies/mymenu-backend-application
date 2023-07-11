<template>
    <form class="space-y-6 mt-6" @submit.prevent="submitQRCodeFeatures">
        <div class="bg-white px-4 py-5 shadow sm:rounded-lg sm:p-6">
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">QR Code builder</h3>
                    <p class="mt-1 text-sm text-gray-500">Generate QR code features</p>
                </div>
                <div class="mt-5 md:col-span-2 md:mt-0">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-3 sm:col-span-3">
                            <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                            <input type="color" name="color" id="color"  placeholder="Hex Color" v-model="qrCodeForm.color"
                                   :class="[errors?.color === undefined ? 'h-10 valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="color-error" v-for="error in errors?.table_id">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="width" class="block text-sm font-medium text-gray-700">Width</label>
                            <input type="number" name="width" id="color"  placeholder="Width" v-model="qrCodeForm.width"
                                   :class="[errors?.width === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="width-error" v-for="error in errors?.width">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="caption-line-one" class="block text-sm font-medium text-gray-700">Caption Line 1</label>
                            <input type="text" name="caption-line-one" id="caption-line-one"  placeholder="QR Label" v-model="qrCodeForm.caption_line_one"
                                   :class="[errors?.caption_line_one === undefined ? 'valid-input' : 'invalid-input']" required/>
                            <p class="mt-2 text-sm text-red-600" id="caption-line-one-error" v-for="error in errors?.caption_line_one">{{error}}</p>
                        </div>

                        <div class="col-span-3 sm:col-span-3">
                            <label for="caption-line-two" class="block text-sm font-medium text-gray-700">Caption Line 2</label>
                            <input type="text" name="caption-line-one" id="caption-line-one"  placeholder="Caption Line 2" v-model="qrCodeForm.caption_line_two"
                                   :class="[errors?.caption_line_two === undefined ? 'valid-input' : 'invalid-input']" />
                            <p class="mt-2 text-sm text-red-600" id="caption-line-one-error" v-for="error in errors?.caption_line_two">{{error}}</p>
                        </div>

                        <div class="col-span-6 sm:col-span-6">
                            <label for="sub-caption" class="block text-sm font-medium text-gray-700">Caption Line 2</label>
                            <input type="text" name="sub_caption" id="sub_caption"  placeholder="Caption Line 2" v-model="qrCodeForm.sub_caption"
                                   :class="[errors?.sub_caption === undefined ? 'valid-input' : 'invalid-input']" />
                            <p class="mt-2 text-sm text-red-600" id="sub-caption-error" v-for="error in errors?.sub_caption">{{error}}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 text-right sm:px-6 mt-6">
                <button type="submit" class="btn-sm-submit"
                        :class="{'disabled:opacity-50' :  isLoading}"
                        :disabled="isLoading" >
                    <LoadingSpinner :is-loading="isLoading" />
                     Save
                </button>
            </div>
        </div>
    </form>
</template>

<script setup>


import LoadingSpinner from "../../components/LoadingSpinner.vue";
import useQRBuilder from "../../composables/qr_codes";
import useTables from "../../composables/tables";
import {inject, onMounted, provide, ref} from "vue";
import utils from "../../utils/utils";
import {ABILITY_TOKEN, useAbility} from "@casl/vue";
import useAuth from "../../composables/auth";

const {errors, isLoading, storeQRFeatures, qr_code, qrCodeForm} = useQRBuilder()

const {tables, getTables} = useTables();

const table = ref(null)


onMounted(()=>{
    getTables()
})

const submitQRCodeFeatures  = () =>{
    storeQRFeatures({...qrCodeForm})
}




provide('isLoading', isLoading)

// utils.has_perm('qr_codes.create')
const {can} = useAbility()
const {logout} = useAuth()
const ability = inject(ABILITY_TOKEN)
const {getAbilities} = useAuth()
//
// getAbilities()
// if(!can('qr_codes.create')){
//     logout()
// }


onMounted(async () => {
    await getAbilities()

    if (!can('qr_codes.create')) {
        await logout()
    }
})
</script>


