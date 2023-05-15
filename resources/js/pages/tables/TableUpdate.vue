<template>
    <BlurredSpinner v-if="isFetching" />
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
import BlurredSpinner from "../../components/BlurredSpinner.vue";
import utils from "../../utils/utils";
import {useAbility} from "@casl/vue";
import useAuth from "../../composables/auth";

const {errors, getTable, updateTable, isLoading, isFetching, table} = useTables()

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

const {can} = useAbility()
const {logout} = useAuth()

if(!can('tables.update')){
    logout()
}

provide('isLoading', isLoading)

</script>

