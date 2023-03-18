<template>
    <BlurredSpinner v-if="isFetching" />
    <RestaurantFormComponent
        :tenant-form="tenant"
        :is-loading="isLoading"
        :is-fetching="isFetching"
        :img-url="imgUrl"
        form-description="Update your company by filling the form below"
        btn-message="Update"
        @submit-tenant="changeTenant"
        @load-image ="loadImage"
        :errors="errors"
    />
</template>

<script setup>
import useTenants from "../../composables/restaurant";
import {useRoute} from "vue-router";
import {onMounted, provide, ref} from "vue";
import RestaurantFormComponent from "./components/RestaurantFormComponent.vue";
import BlurredSpinner from "../../components/BlurredSpinner.vue";

const {tenant, getTenant, updateTenant, errors, isFetching, isLoading} = useTenants();
const router = useRoute()

const imgUrl = ref(null)

const changeTenant = async () => {
    await updateTenant(router.params.id);
}


onMounted(() => {
        if(router.params.id){
            getTenant(router.params.id)
        }
    }
)

const loadImage = (event) => {
    tenant.value.logo = event.target.files[0]

    //Preview Image
    imgUrl.value = window.URL.createObjectURL(event.target.files[0])
    URL.revokeObjectURL(event.target.files[0])
}

provide('isLoading', isLoading)

</script>
