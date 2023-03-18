<template>
    <PlanFormComponent
        :plan-form="planForm"
        :is-loading="isLoading"
        @submitPlan="savePlan"
        form-description="Register plan  by filling the form below"
        btn-message="Register"
        :errors="errors"
    />
</template>

<script setup>
import {provide} from "vue";
import PlanFormComponent from "./components/PlanFormComponent.vue";
import usePlans from "../../composables/plans";

const {errors, planForm, isLoading, storePlan} = usePlans()


const savePlan = async () => {
    await storePlan({...planForm});
}


provide('isLoading', isLoading)

</script>
