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
import {provide} from "vue";
import useTables from "../../composables/tables";
import TableFormComponent from "./components/TableFormComponent.vue";

const {errors, tableForm, isLoading, storeTable} = useTables()


const saveTable = async () => {
    await storeTable({...tableForm});
}


provide('isLoading', isLoading)

</script>
