<template>
    <div class="qrcode-grid mx-auto mt-6 w-full">
        <div v-for="box in boxes" :key="box.id"
             class="flex flex-col items-center  p-1 pt-3 bg-white text-black rounded">
            <qrcode-vue :value="box.uri" :size="120" level="H"/>
            <div class="w-full mt-3 border-t-2 border-black text-center">
                <p class="mt-2  text-xl font-semibold ">#{{ box.id }}</p>
                <p class="mt-1  text-lg font-semibold ">{{ box.name }}</p>
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
    axios.get('/boxes')
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
    grid-template-columns: repeat(auto-fill, minmax(10rem, 1fr));
}
</style>
