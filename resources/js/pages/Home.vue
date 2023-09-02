<template>
    <div class="mt-4 md:mt-10 flex flex-col-reverse md:flex-row md:justify-between">
        <button @click="openCreateBoxModal"
                class="mt-2 md:mt-0 px-4 py-2 text-sm rounded-md bg-violet-200 hover:bg-violet-600 hover:text-white text-black">
            Add New Box
        </button>
        <div class="flex items-center relative">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#64748b"
                 class="mx-2 w-4 h-4 absolute">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"/>
            </svg>
            <input type="text" v-model="searchTerm"
                   name="searchTerm" placeholder="Search for item"
                   class=" rounded-md pl-8 pr-4 py-2 border-2 border-violet-600 focus:outline-0 focus:border-violet-600 focus:ring-violet-600 text-slate-800 text-xs md:text-sm w-full md:w-44 xl:w-60 2xl:w-96"
            />
        </div>
    </div>
    <div v-if="results.length !== 0 && searchTerm !== ''" class="mt-4 md:mt-10 w-full">
        <h3 class="text-lg tracking-wide text-white">Search results for item: "<span class="font-semibold">{{
                searchTerm
            }}</span>"</h3>
        <div class="items-grid mt-2 md:mt-6">
            <div v-for="result in results" :key="result.id" class="">
                <ItemCard :item="result"></ItemCard>
            </div>
        </div>
    </div>

    <div class="card-grid mx-auto mt-4 md:mt-10 w-full pb-8" v-else>
        <div v-for="box in boxes" :key="box.id" class="">
            <BoxCard :box="box"></BoxCard>
        </div>
    </div>

    <div v-if="createBoxModalOpen" class="overflow-y-auto transition-opacity text-black">
        <div class="bg-gray-300 opacity-70 fixed inset-0" @click="closeCreateBoxModal"></div>
        <div
            class="flex flex-col m-auto h-fit max-w-sm md:max-w-lg xl:max-w-xl bg-white space-y-6 fixed inset-0 bg-white  rounded-sm">
            <button @click="closeCreateBoxModal" class="absolute right-3 top-3 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                     stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <form class="px-6 pb-6 pt-2 space-y-6">
                <span v-if="errors">{{ errors }}</span>
                <div class="flex flex-col space-y-1">
                    <label for="name" class="font-semibold">Box name</label>
                    <input type="text" id="name" name="name" v-model="form.name"
                           class="h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4"/>
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="location" class="font-semibold">Location</label>
                    <select name="location" id="location" v-model="form.location"
                            class="h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4">
                        <option v-for="(location, index) in locations" :value="location" :key="index">{{ location }}
                        </option>
                    </select>
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="description" class="font-semibold">Description</label>
                    <textarea id="description" name="description" v-model="form.description" cols="10" rows="5"
                              class="w-full rounded-md border border-gray-300 focus:border-indigo-300 p-4"></textarea>
                </div>
                <div>
                    <button type="button" @click="submitForm" class="px-3 py-2 rounded-md bg-sky-300">Save</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import {onMounted, reactive, ref, watch} from "vue";
import axios from "axios";
import BoxCard from "../components/BoxCard.vue";
import {request} from '../helpers';
import ItemCard from "../components/ItemCard.vue";
import useBoxes from "../composables/boxes";
import useLocations from "../composables/locations";
import useGroups from "../composables/groups";

const createBoxModalOpen = ref(false);
const searchTerm = ref('');
const results = ref([]);
const errors = ref('');
const form = reactive({
    name: '',
    location: '',
    description: ''
});

onMounted(() => {
    getBoxes();
    getLocations();
});

const {boxes, getBoxes} = useBoxes()
const {locations, getLocations} = useLocations()

watch(searchTerm, (newValue, oldValue) => {
    if (newValue === '') {
        results.value = [];
    }
    search();
});

const openCreateBoxModal = () => {
    createBoxModalOpen.value = true;
}
const closeCreateBoxModal = () => {
    createBoxModalOpen.value = false;
}
const submitForm = async () => {
    await request('post', '/api/boxes', form)
        .then((response) => {
            createBoxModalOpen.value = false;
            boxes.value.push(response.data.data);
            form.name = '';
            form.location = '';
            form.description = '';
        })
        .catch((error) => {
            errors.value = 'Some data is missing';
        })
}
const search = async () => {
    try {
        const response = await axios.get('/api/search', {
            params: {
                searchTerm: searchTerm.value
            }
        });

        results.value = response.data.data;
    } catch (error) {
        console.error(error);
    }
};

</script>

<style scoped>
.card-grid {
    display: grid;
    gap: 1rem;
    grid-template-columns: repeat(auto-fill, minmax(14rem, 1fr));
}

.items-grid {
    display: grid;
    gap: 1.5rem;
    grid-template-columns: repeat(auto-fill, minmax(15rem, 1fr));
}
</style>
