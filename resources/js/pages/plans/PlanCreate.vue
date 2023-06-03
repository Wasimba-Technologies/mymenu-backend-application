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
import {inject, onMounted, provide} from "vue";
import PlanFormComponent from "./components/PlanFormComponent.vue";
import usePlans from "../../composables/plans";
import utils from "../../utils/utils";
import {ABILITY_TOKEN, useAbility} from "@casl/vue";
import useAuth from "../../composables/auth";

const {errors, planForm, isLoading, storePlan} = usePlans()


const savePlan = async () => {
    await storePlan({...planForm});
}
const {can} = useAbility()
const {logout} = useAuth()
const ability = inject(ABILITY_TOKEN)
const {getAbilities} = useAuth()

onMounted(async () => {
    await getAbilities()

    if (!can('menus.create')) {
        await logout()
    }
})

// const {can} = useAbility()
// const {logout} = useAuth()
// const ability = inject(ABILITY_TOKEN)
// const {getAbilities} = useAuth()
//
// getAbilities()
// if(!can('plans.create')){
//     logout()
// }
provide('isLoading', isLoading)
//utils.has_perm('plans.create')
</script>
