<template>
    <div class="relative flex flex-col justify-between">
        <div class="sticky pt-10 pb-10 h-20 z-[111111111] bg-curious-blue-800 top-0 bottom-0 left-0 right-0 w-full flex flex-col-reverse md:flex-row items-start md:items-center md:justify-between">
            <div class="mt-2 md:mt-0">
                <button @click="editMode = !editMode"
                        class="rounded-md bg-red-600 text-white px-3 py-2 text-xs md:text-sm font-semibold tracking-wider">
                    Edit: <span v-if="editMode">On</span><span v-else>Off</span>
                </button>
            </div>
            <div class="flex items-center relative w-full md:w-auto">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="#64748b" class="mx-2 w-4 h-4 absolute">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
                <input type="text" v-model="searchTerm"
                       name="searchTerm" placeholder="Search for item"
                       class=" rounded-md pl-8 pr-4 py-2 border-2 border-curious-blue-600 focus:outline-0 text-slate-800 text-xs w-full sm:w-72 md:w-96 md:text-sm"
                />
            </div>
        </div>
        <div class="items-grid mx-auto mt-4 md:mt-10 w-full relative">
            <div v-for="item in items" :key="item.id" class="">
                <ItemCard :item="item" :editMode="editMode" :groups="groups" :locations="locations"></ItemCard>
            </div>
        </div>
    </div>
</template>

<script setup>
import {onMounted, ref, watch} from "vue";
import ItemCard from "../../components/ItemCard.vue";
import axios from "axios";
import useLocations from "../../composables/locations";
import useGroups from "../../composables/groups";

const items = ref([]);
const searchTerm = ref('');
const editMode = ref(false);

onMounted(() => {
    search();
    getGroups();
    getLocations();
});

const { locations, getLocations } = useLocations()
const { groups, getGroups } = useGroups()

watch(searchTerm, (currentValue) => {
    search();
})

const search = async () => {
    try {
        const response = await axios.get('/api/search', {
            params: {
                searchTerm: searchTerm.value
            }
        });

        items.value = response.data.data;
    } catch (error) {
        console.error(error);
    }
};

</script>

<style scoped>
.items-grid {
    display: grid;
    gap: 1.2rem;
}

@media (min-width: 480px) {
    .items-grid {
        grid-template-columns: repeat(auto-fill, minmax(10rem, 1fr));
    }
}

@media (min-width: 760px) {
    .items-grid {
        grid-template-columns: repeat(auto-fill, minmax(15rem, 1fr));
    }
}
</style>
