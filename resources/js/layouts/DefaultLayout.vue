<template>
    <div class="flex flex-col md:flex-row">
        <Navbar/>
        <div class="px-2 md:px-6 flex-1 bg-gray-800 text-white">
            <router-view></router-view>
        </div>
    </div>
</template>

<script setup>
import Navbar from "../layouts/Navbar.vue";
</script>
