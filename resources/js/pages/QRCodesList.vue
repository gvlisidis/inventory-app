<template>
    <div class="qrcode-grid mx-auto mt-6 w-full">
        <div v-for="box in boxes" :key="box.id"
             class="flex flex-col items-center justify-center p-1 bg-white text-black">
            <qrcode-vue :value="box.uri" :size="200" level="H"/>
            <div class="w-full mt-3 border-t-2 border-black text-center">
                <p class="mt-4 tracking-widest text-3xl font-semibold ">#{{ box.id }} | {{ box.name }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";
import QrcodeVue from 'qrcode.vue'


const boxes = ref([]);
const getBoxes = () => {
    axios.get('/api/boxes')
        .then((response) => {
            boxes.value = response.data.data;
        })
}

onMounted(() => {
    getBoxes();
});
</script>

<style scoped>
.qrcode-grid {
    display: grid;
    gap: 1.5rem;
    grid-template-columns: repeat(auto-fit, minmax(13rem, 1fr));
}
</style>
