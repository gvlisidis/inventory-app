<script setup>

import axios from "axios";
import {reactive, ref} from "vue";
const successMessage = ref('');
const form = reactive({
    name: '',
    email: '',
    password: '',
    password_confirmation: ''
})

const props = defineProps(['team']);
const emit = defineEmits(['memberAdded']);

const errors = ref([]);
const addMember = async () => {
    await axios.post(`/api/users/${props.team.id}/add-member`, form)
        .then(() => {
            emit('memberAdded');
            successMessage.value = 'Team member added successfully';
            reset();
        })
        .catch((err) => {
            errors.value = err.response.data.errors;
            setTimeout(() => {
                errors.value = [];
            },3000)
        });
}

const reset = () => {
    form.name = '';
    form.email = '';
    form.password = '';
    form.password_confirmation = '';

    setTimeout(() => {
        successMessage.value = '';
    },2000)
}
</script>

<template>
    <form class="px-2 md:px-6 space-y-5  relative">
        <div v-if="successMessage" class="absolute -top-10">
            <p class="text-sm text-curious-blue-200">{{ successMessage }}</p>
        </div>
        <div class="flex flex-col space-y-1">
            <label for="name" class="font-semibold text-xs md:text-sm">Name</label>
            <input type="text" id="name" name="name" v-model="form.name" required
                   class="text-gray-700 text-xs md:text-sm h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4"/>
            <div class="py-0.5 text-xxs tracking-wide text-curious-blue-200" v-if="errors.name">{{ errors.name[0]}}</div>
        </div>
        <div class="flex flex-col space-y-1">
            <label for="email" class="font-semibold text-xs md:text-sm">Email</label>
            <input type="email" id="email" name="email" v-model="form.email" required
                   class="text-gray-700 text-xs md:text-sm h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4"/>
            <div class="py-0.5 text-xxs tracking-wide text-curious-blue-200" v-if="errors.email">{{ errors.email[0]}}</div>
        </div>
        <div class="flex flex-col space-y-1">
            <label for="password" class="font-semibold text-xs md:text-sm">Password</label>
            <input type="password" id="password" name="password" v-model="form.password" required
                   class="text-gray-700 text-xs md:text-sm h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4"/>
            <div class="py-0.5 text-xxs tracking-wide text-curious-blue-200" v-if="errors.password">{{ errors.password[0]}}</div>
        </div>
        <div class="flex flex-col space-y-1 w-full">
            <label for="password_confirmation" class="font-semibold text-xs md:text-sm">Confirm Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" v-model="form.password_confirmation" required
                   class="text-gray-700 text-xs md:text-sm h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4"/>
        </div>
        <div class="flex space-x-4 w-full">
            <button @click.prevent="addMember" class="rounded-md px-4 py-2 bg-curious-blue-400 hover:bg-curious-blue-500">Add member</button>
            <button @click.prevent="reset" class="rounded-md px-4 py-2 bg-curious-blue-900 hover:bg-black">Clear</button>
        </div>
    </form>
</template>

<style scoped>

</style>
