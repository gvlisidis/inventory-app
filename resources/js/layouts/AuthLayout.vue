<template>
    <div class="flex w-full h-screen justify-center items-center">
        <div class="space-y-8 w-full lg:w-5/6 2xl:w-2/3 flex justify-center items-center p-4 lg:p-10 md:mr-36">
            <form @submit.prevent="authStore.login(auth)" class="w-full flex flex-col items-center justify-center">
                <div class="" v-if="Object.keys(validationErrors).length > 0">
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <li v-for="(value, key) in validationErrors" :key="key">{{ value[0] }}</li>
                        </ul>
                    </div>
                </div>
                <div class="flex flex-col items-center justify-center space-y-8 w-full lg:w-2/3">
                    <div class="text-slate-800 flex flex-col md:flex-row justify-between items-center w-full">
                        <label for="email" class="text-white md:text-right w-full md:w-2/6 text-xs md:text-sm mb-1 md:mb-0">Email</label>
                        <input type="text" v-model="auth.email" name="email" class="w-full md:w-4/6 md:ml-6 px-4 py-2 rounded-md border-4 border-violet-600 text-xs md:text-sm">
                    </div>
                    <div class="text-slate-800 flex flex-col md:flex-row justify-between items-center w-full">
                        <label for="password" class="text-white md:text-right w-full md:w-2/6 text-xs md:text-sm mb-1 md:mb-0">Password</label>
                        <input type="password" v-model="auth.password" name="password" id="password"
                               class="w-full md:w-4/6 md:ml-6 px-4 py-2 rounded-md border-4 border-violet-600 text-xs md:text-sm">
                    </div>
                    <div class="text-slate-800 flex items-end justify-end w-full">
                        <div class="">
                            <button type="submit" class="text-xs md:text-sm rounded-md bg-violet-600 text-white px-4 py-2">Login</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</template>
<script setup>

import {reactive, ref} from "vue";
import {useAuthStore} from "../store/auth";

const authStore = useAuthStore();

const validationErrors = ref([]);
const auth = reactive({
    email: '',
    password: ''
});


</script>

<style scoped>

</style>
