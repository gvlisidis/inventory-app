<template>
    <div>
        <router-link :to="`/box/${box.id}/contents`" class="text-xs md:text-sm block mb-1 md:mb-4 p-4 rounded  bg-green-color hover:bg-blue-color hover:text-white">
            <h2 class="font-semibold tracking-wide">Box Name: {{ box.name }}</h2>
            <div class="mt-4 space-y-2">
                <p class="tracking-wide">Location: {{ box.location }}</p>
            </div>
        </router-link>
    </div>
</template>

<script setup>
const props = defineProps(['box'])
const box = props.box;
</script>
