<template>
    <div class="container mx-auto mt-1 md:mt-6">
        <div class="flex flex-col">
            <div class="flex flex-col space-y-1 md:space-y-4 text-white tracking-wider">
                <h3 class="text-sm md:text-base xl:text-lg font-bold">Box Name: <span class="ml-2">{{ box.name }}</span></h3>
                <h3 class="text-sm md:text-base xl:text-lg font-bold">Number:  <span class="ml-2">{{ box.id }}</span></h3>
                <h3 class="text-sm md:text-base xl:text-lg font-bold">Location:  <span class="ml-2">{{ box.location }}</span></h3>
            </div>
            <div class="sm:right-0 sm:top-0 p-1 ">
                <div class="mt-6 flex space-x-3 md:space-x-8">
                    <button @click.prevent="openCreateItemModal" type="button" class="text-xxs  md:ext-sm xl:text-base px-2 md:px-4 py-2 rounded-md text-white bg-blue-color hover:bg-violet-200 hover:text-black">Add item</button>
                    <button @click.prevent="openEditBoxModal" type="button" class="text-xxs  md:text-sm xl:text-base px-2 md:px-4 py-2 rounded-md bg-green-600 hover:bg-green-300 hover:text-black text-white">Edit Box</button>
                    <button @click.prevent="deleteConfirm = true" type="button" class="text-xxs  md:text-sm xl:text-base px-2 md:px-4 py-2 rounded-md bg-red-600 hover:bg-red-300 hover:text-black text-white">Delete Box</button>
                </div>
            </div>
        </div>


        <div class="items-grid mt-8 pb-8">
            <div v-for="item in box.items" :key="item.id" class="">
                <div class="text-xs md:text-sm block mb-1 md:mb-4 p-4  rounded shadow bg-green-color  hover:bg-blue-color hover:text-white">
                    <h2 class="font-semibold tracking-wide">{{ item.name }}</h2>
                </div>
            </div>
        </div>


        <div v-if="createItemModalOpen" class="overflow-y-auto transition-opacity text-black">
            <div class="bg-gray-300 opacity-70 fixed inset-0" @click="closeCreateItemModal"></div>
            <div class="flex flex-col m-auto h-fit max-w-[300px] md:max-w-sm lg:max-w-lg xl:max-w-xl bg-white space-y-2 md:space-y-6 fixed inset-0  rounded-sm" >
                <button @click="closeCreateItemModal" class="absolute right-3 top-3 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <form class="px-2 md:px-6 pb-6 pt-2 space-y-6">
                    <span v-if="errors">{{ errors }}</span>
                    <div class="flex flex-col space-y-1">
                        <label for="name" class="font-semibold text-xs md:text-sm">Item name</label>
                        <input type="text" id="name" name="name" v-model="form.name"  class="text-xs md:text-sm h-8 md:h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4" />
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="group" class="font-semibold text-xs md:text-sm">Group</label>
                        <select name="group" id="group"  v-model="form.group" class="text-xs md:text-sm h-8 md:h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4" >
                            <option value="">--Select Group--</option>
                            <option v-for="(group, index) in groups" :value="group" :key="index">{{group}}</option>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="location" class="font-semibold text-xs md:text-sm">Location</label>
                        <select name="location" id="location" v-model="form.location"
                                class="text-xs md:text-sm h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4">
                            <option value="">Location (optional)</option>
                            <option v-for="(location, index) in locations" :value="location" :key="index">{{ location }}
                            </option>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="description" class="font-semibold text-xs md:text-sm">Description</label>
                        <textarea id="description" name="description" v-model="form.description" cols="10" rows="2" class="text-xs md:text-sm w-full rounded-md border border-gray-300 focus:border-indigo-300 p-4"></textarea>
                    </div>
                    <div>
                        <button type="button" @click.prevent="submitForm" class="text-xs md:text-sm px-3 py-2 rounded-md bg-sky-300">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <div v-if="editBoxModalOpen" class="overflow-y-auto transition-opacity text-black">
            <div class="bg-gray-300 opacity-70 fixed inset-0" @click="closeEditBoxModalOpen"></div>
            <div class="flex flex-col m-auto h-fit max-w-[300px] md:max-w-sm lg:max-w-lg xl:max-w-xl space-y-2 md:space-y-6 fixed inset-0 bg-white  rounded-sm">
                <button @click="closeEditBoxModalOpen" class="absolute right-3 top-3 cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <form class="px-2 md:px-6 pb-6 pt-2 space-y-6">
                    <span v-if="errors">{{ errors }}</span>
                    <div class="flex flex-col space-y-1">
                        <label for="name" class="font-semibold text-xs md:text-sm">Box name</label>
                        <input type="text" id="name" name="name" v-model="box.name"
                               class="text-xs md:text-sm h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4"/>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="location" class="font-semibold text-xs md:text-sm">Location</label>
                        <select name="location" id="location" v-model="box.location"
                                class="text-xs md:text-sm h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4">
                            <option v-for="(location, index) in locations" :value="location" :key="index">{{ location }}
                            </option>
                        </select>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="description" class="font-semibold text-xs md:text-sm">Description</label>
                        <textarea id="description" name="description" v-model="box.description" cols="10" rows="2"
                                  class="text-xs md:text-sm w-full rounded-md border border-gray-300 focus:border-indigo-300 p-2 md:p-4"></textarea>
                    </div>
                    <div>
                        <button type="button" @click.prevent="submitEditForm" class="text-xs md:text-sm px-3 py-2 rounded-md bg-sky-300">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <div v-if="deleteConfirm" class="overflow-y-auto transition-opacity text-black">
            <div class="bg-gray-300 opacity-70 fixed inset-0" @click="deleteConfirm = false"></div>
            <div
                class="flex flex-col m-auto h-fit max-w-[360px] bg-white space-y-2 md:space-y-6 fixed inset-0  rounded-md">
                    <div class=" w-full flex flex-col space-y-3 justify-center items-center p-5">
                        <h3 class="text-sm md:text-base lg:text-xl font-bold">Are you sure?</h3>
                        <p class="text-xs md:text-sm">This action won't delete any items.</p>
                    </div>
                    <div class="flex w-full justify-center items-center space-x-10 pb-4">
                        <button @click.prevent="deleteBox" class="text-xs md:text-sm xl:text-base px-4 py-2 rounded-md bg-red-600 hover:bg-red-500 text-white">Delete</button>
                        <button @click.prevent="deleteConfirm= false" class="text-xs md:text-sm xl:text-base px-4 py-2 rounded-md bg-black text-white">Cancel</button>
                    </div>
            </div>
        </div>

    </div>
</template>

<script setup>
import axios from "axios";
import {onMounted, reactive, ref} from "vue";
import {request} from "../../helpers";
import router from "../../router";

const props = defineProps(['id'])
const box = ref([]);
const groups = ref([]);
const createItemModalOpen = ref(false);
const deleteConfirm = ref(false);
const locations = ref([]);
const editBoxModalOpen = ref(false);
const form = reactive({
    name:'',
    group: '',
    location: '',
    description: '',
})

const errors = ref('');

onMounted(() => {
    getBox();
    getLocations();
    getGroups();
})

const getBox = () => {
    axios.get(`/api/boxes/${props.id}`)
        .then(response => {
            box.value = response.data.data;
        })
        .catch(error => {
            console.log(error);
        });
}

const getGroups = () => {
    axios.get('/api/groups')
        .then((response) => {
            groups.value = response.data.data;
        })
}

const openCreateItemModal = () => {
    createItemModalOpen.value = true;
}
const closeCreateItemModal = () => {
    createItemModalOpen.value = false;
}

const getLocations = async () => {
    const req = await request('get', '/api/locations')
    locations.value = req.data.data;
}
const openEditBoxModal = () => {
    editBoxModalOpen.value = true;
}
const closeEditBoxModalOpen = () => {
    editBoxModalOpen.value = false;
}

const submitForm = () => {
    form.box_id = box.value.id;
    axios.post('/api/items', form)
        .then((response) => {
            box.value.items.push(response.data.data);
            createItemModalOpen.value = false;
            form.name = '';
            form.group = '';
            form.location = '';
            form.description = '';
        })
        .catch((error) => {
            errors.value = 'Some data is missing';
        })
}

const submitEditForm = async  () => {
    await axios.put(`/api/boxes/${props.id}`, {
        name: box.value.name,
        location: box.value.location,
        description: box.value.description,
    })
        .then((response) => {
            editBoxModalOpen.value = false;
        })
        .catch((error) => {
            errors.value = 'Some data is missing';
        })
}
const deleteBox =  () => {
     request('delete', `/api/boxes/${props.id}`);
     router.push('/');
}
</script>

<style scoped>
.items-grid {
    display: grid;
    gap: 1rem;
    grid-template-columns: repeat(auto-fill, minmax(15rem, 1fr));
}
</style>
