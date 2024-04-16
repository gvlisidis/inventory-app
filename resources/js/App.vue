<template>
    <DefaultLayout v-if="authStore.isLoggedIn"/>
    <AuthLayout v-else/>
</template>

<script setup>
import DefaultLayout from "./layouts/DefaultLayout.vue";
import AuthLayout from "./layouts/AuthLayout.vue";
import {useAuthStore} from "./store/auth";

const authStore = useAuthStore();
</script>

<style scoped>

</style>
