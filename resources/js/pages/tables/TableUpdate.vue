<template>
    <TableFormComponent
        :table-form="table"
        :is-loading="isLoading"
        @submitTable="changeTable"
        form-description="Update your table by filling the form below"
        btn-message="Update"
        :errors="errors"
    />
</template>

<script setup>
import {onMounted, provide} from "vue";
import useTables from "../../composables/tables";
import TableFormComponent from "./components/TableFormComponent.vue";
import {useRoute} from "vue-router";

const {errors, getTable, updateTable, isLoading, table} = useTables()

const router = useRoute()


const changeTable = async () => {
    await updateTable(router.params.id);
}


onMounted(() => {
        if(router.params.id){
            getTable(router.params.id)
        }
    }
)


provide('isLoading', isLoading)

</script>

