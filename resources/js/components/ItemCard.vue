<template>
    <div class="max-h-32 h-full flex flex-col justify-between text-xs md:text-sm  mb-1 md:mb-4 p-2 md:p-4 rounded bg-curious-blue-300 hover:bg-curious-blue-400 hover:text-white relative">
        <svg v-show="editMode" @click.prevent="openEditItemModal" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-4 h-4 absolute top-1 right-1 hover:cursor-pointer">
            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
        </svg>

        <h2 class="font-semibold tracking-wide">{{ item.name }}</h2>
        <div class="mt-2 md:mt-4 space-y-2">
            <p class="tracking-wide">Box: {{ item.box_id }}</p>
            <p class="tracking-wide">Location: {{ item.location }}</p>
        </div>
    </div>

    <div v-if="editItemModalOpen" class="overflow-y-auto transition-opacity text-black ">
        <div class="bg-gray-300 opacity-70 fixed inset-0" @click.prevent="closeEditItemModal"></div>
        <div class="z-50 flex flex-col m-auto h-fit max-w-[300px] md:max-w-sm lg:max-w-lg xl:max-w-xl bg-white space-y-2 md:space-y-6 fixed inset-0  rounded-sm" >
            <button @click.prevent="closeEditItemModal" class="absolute right-3 top-3 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <form class="px-2 md:px-6 pb-6 pt-2 space-y-6">
                <div class="flex flex-col space-y-1">
                    <label for="name" class="font-semibold text-xs md:text-sm">Item name</label>
                    <input type="text" id="name" name="name" v-model="item.name"  class="text-xs md:text-sm h-8 md:h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4" />
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="group" class="font-semibold text-xs md:text-sm">Group</label>
                    <select name="group" id="group"  v-model="item.group" class="text-xs md:text-sm h-8 md:h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-1 md:px-4" >
                        <option value="">--Select Group--</option>
                        <option v-for="(group, index) in props.groups" :value="group" :key="index">{{group}}</option>
                    </select>
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="box_id" class="font-semibold text-xs md:text-sm">Box</label>
                    <select name="box_id" id="box_id" v-model="item.box_id"
                            class="text-xs md:text-sm h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-1 md:px-4">
                        <option value="">--Select Box--</option>
                        <option v-for="(box, index) in boxes" :value="box.id" :key="index">{{ box.name }}
                        </option>
                    </select>
                </div>
                <div class="flex flex-col space-y-1" v-if="needsLocation || item.box_id === null">
                    <label for="location" class="font-semibold text-xs md:text-sm">Location</label>
                    <select name="location" id="location" v-model="item.location"
                            class="text-xs md:text-sm h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-1 md:px-4">
                        <option value="">Location (optional)</option>
                        <option v-for="(location, index) in props.locations" :value="location" :key="index">{{ location }}
                        </option>
                    </select>
                </div>
                <div class="flex flex-col space-y-1">
                    <label for="description" class="font-semibold text-xs md:text-sm">Description</label>
                    <textarea id="description" name="description" v-model="item.description" cols="10" rows="2" class="text-xs md:text-sm w-full rounded-md border border-gray-300 focus:border-indigo-300 p-4"></textarea>
                </div>
                <div>
                    <button type="submit" @click.prevent="submitEditItemForm" class="text-xs md:text-sm px-3 py-2 rounded-md bg-sky-300">Update</button>
                </div>
            </form>
        </div>
    </div>

</template>

<script setup>
import {onMounted, ref, toRaw, watch} from "vue";
import axios from "axios";
import {request} from "../helpers";

const props = defineProps(['item', 'editMode', 'groups', 'locations'])
const item = props.item;
const boxes = ref([]);
const needsLocation = ref(false);
const editItemModalOpen = ref(false);

watch(item, (currentValue, oldValue) => {
    const current = toRaw(currentValue)
    needsLocation.value = current.box_id === '';
},{
    deep: true,
});


const openEditItemModal = () => {
    editItemModalOpen.value = true;
    getBoxes();
}
const closeEditItemModal = () => {
    editItemModalOpen.value = false;
}

const getBoxes = async () => {
    const req = await request('get', '/boxes')
    boxes.value = req.data.data;
}

const submitEditItemForm = async  () => {
    await axios.put(`/items/${item.id}`, {
        name: item.name,
        group: item.group,
        box_id: item.box_id,
        location: item.location,
        description: item.description,
    })
        .then((response) => {
            console.log(response.data, 666)
            item.value = response.data.data;
            editItemModalOpen.value = false;
        })
        .catch((error) => {
           //
        })
}
</script>
