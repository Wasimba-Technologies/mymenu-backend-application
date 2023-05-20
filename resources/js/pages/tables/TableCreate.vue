<template>
    <TableFormComponent
        :table-form="tableForm"
        :is-loading="isLoading"
        @submitTable="saveTable"
        form-description="Register your table by filling the form below"
        btn-message="Register"
        :errors="errors"
    />
</template>

<script setup>
import {inject, onMounted, provide} from "vue";
import useTables from "../../composables/tables";
import TableFormComponent from "./components/TableFormComponent.vue";
import {useAbility} from "@casl/vue";
import useAuth from "../../composables/auth";
import useQRBuilder from "../../composables/qr_codes";
import router from "../../router";

const swal = inject('$swal')
const {errors, tableForm, isLoading, storeTable} = useTables()
const {qr_code, getQRCodeFeatures} = useQRBuilder()

const saveTable = async () => {
    await storeTable({...tableForm});
}

onMounted( async () => {
    //getQrCode appearance
    await getQRCodeFeatures()
    console.log(qr_code.value)
    if (qr_code.value === {} || qr_code.value === null) {
        swal({
            icon: 'warning',
            title: "First Create Qr code appearance",
        })
        await router.push({name: 'qr-builder'})
    }
})


provide('isLoading', isLoading)

//utils.has_perm('tables.create')
const {can} = useAbility()
const {logout} = useAuth()

if(!can('tables.create')){
    logout()
}
</script>
