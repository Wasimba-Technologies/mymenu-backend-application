<template>
    <BlurredSpinner v-if="isFetching" />
    <PlanFormComponent
        :menu-form="plan"
        :is-loading="isLoading"
        @submitPlan="changePlan"
        form-description="Update your plan by filling the form below"
        btn-message="Update"
        :errors="errors"
    />
</template>

<script setup>
import {onMounted, provide} from "vue";
import {useRoute} from "vue-router";
import usePlans from "../../composables/plans";
import PlanFormComponent from "./components/PlanFormComponent.vue";
import utils from "../../utils/utils";
import {useAbility} from "@casl/vue";
import useAuth from "../../composables/auth";

const {errors, plan, isLoading, isFetching, updatePlan, getPlan} = usePlans()
const route = useRoute()

const changePlan = async () => {
    await updatePlan(route.params.id);
}

onMounted(()=>{
    getPlan(route.params.id)
})

const {can} = useAbility()
const {logout} = useAuth()

if(!can('plans.update')){
    logout()
}
provide('isLoading', isLoading)
// utils.has_perm('plans.update')
</script>

