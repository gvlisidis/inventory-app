<template>
    <div class="max-h-32 h-full ">
        <router-link :to="`/box/${box.id}/contents`" class="h-full text-xs md:text-sm flex flex-col justify-between  mb-1 md:mb-4 p-4 rounded  bg-curious-blue-300 hover:bg-curious-blue-400 hover:text-white">
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
