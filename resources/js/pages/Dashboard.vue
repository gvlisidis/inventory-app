<script setup>
import {onMounted, reactive, ref} from "vue";
import {useAuthStore} from "../store/auth";
import TeamArea from "../components/profile/TeamArea.vue";
const successMessage = ref('');
const authStore = useAuthStore();
const errors = ref([]);
let updateProfileMode = ref(false);
const form = reactive({
    name: authStore.user.name,
    email: authStore.user.email,
    password: '',
    password_confirmation: ''
})

onMounted(() => {
})

const updateUser = async () => {
     await axios.put(`/api/users/${authStore.user.id}`, {
        name: form.name,
        email: form.email,
        password: form.password,
        password_confirmation: form.password_confirmation,
    })
        .then((response) => {
            authStore.authUser = response.data.data;
            successMessage.value = 'Team member added successfully';
            updateProfileMode.value = false;
            setTimeout(() => {
                successMessage.value = '';
            },2000)
        })
        .catch((error) => {
            errors.value = error.response.data.errors;
        })
}

</script>

<template>
    <div class="mt-4 md:mt-10 flex flex-col text-white">
        <div>
            <h2 class="text-lg">Profile</h2>
            <div v-if="successMessage" class="absolute w-full text-center top-3">
                <p class="text-sm text-curious-blue-200">{{ successMessage }}</p>
            </div>
            <div class="flex flex-col space-y-4 mt-4" v-if="!updateProfileMode">
                <div class="flex space-x-2">
                    <p>Name</p>
                    <p>{{ authStore.user.name }}</p>
                </div>
                <div class="flex space-x-2">
                    <p>Email</p>
                    <p>{{ authStore.user.email }}</p>
                </div>
                <div>
                    <button @click="updateProfileMode = true" class="px-3 py-2 rounded-md bg-sky-300">Update profile</button>
                </div>
            </div>

            <div v-else>
                <form class="px-2 md:px-6 pb-6 pt-2 space-y-6">
                    <div v-if="errors">
                        <div v-for="(error, index) in errors" :key="index">
                            <p>{{ error[0] }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="name" class="font-semibold text-xs md:text-sm">Name</label>
                        <input type="text" id="name" name="name" v-model="form.name"
                               class="text-gray-700 text-xs md:text-sm h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4"/>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="email" class="font-semibold text-xs md:text-sm">Email</label>
                        <input type="email" id="email" name="email" v-model="form.email"
                               class="text-gray-700 text-xs md:text-sm h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4"/>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="password" class="font-semibold text-xs md:text-sm">Password</label>
                        <input type="password" id="password" name="password" v-model="form.password"
                               class="text-gray-700 text-xs md:text-sm h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4"/>
                    </div>
                    <div class="flex flex-col space-y-1">
                        <label for="password_confirmation" class="font-semibold text-xs md:text-sm">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" v-model="form.password_confirmation"
                               class="text-gray-700 text-xs md:text-sm h-10 w-full rounded-md border border-gray-300 focus:border-indigo-300 px-4"/>
                    </div>
                    <div class="flex space-x-4">
                        <button @click.prevent="updateUser" class="rounded-md px-4 py-2 bg-curious-blue-400 hover:bg-curious-blue-500">Save</button>
                        <button @click.prevent="updateProfileMode = false" class="rounded-md px-4 py-2 bg-curious-blue-900 hover:bg-black">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-4" v-if="authStore.user.is_team_owner">
            <div class="border-t border-gray-300"></div>
            <TeamArea></TeamArea>
        </div>
    </div>
</template>
