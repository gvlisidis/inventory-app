<template>
    <div class="flex flex-col md:flex-row relative">
        <Navbar/>
        <div class="px-2 md:px-6 flex-1 bg-blue-dark-color relative">
            <router-view></router-view>
        </div>
    </div>
</template>

<script setup>
import Navbar from "../layouts/Navbar.vue";
</script>
