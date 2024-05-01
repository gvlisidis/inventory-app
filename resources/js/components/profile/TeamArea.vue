<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";
import {useAuthStore} from "../../store/auth";
import AddNewMember from "./AddNewMember.vue";
const team = ref(null);
const teamHasBeenLoaded = ref(false);
const authStore = useAuthStore();


onMounted(() => {
    getTeam();
})

const addMemberToList = () => {
    getTeam();
}

const getTeam = async () => {
  await  axios.get('/api/team')
        .then(res => {
            team.value = res.data.data;
            teamHasBeenLoaded.value = true;
        })
        .catch(err => {
            console.log(err);
        })
}

</script>

<template>
    <div class="mt-8" v-if="teamHasBeenLoaded">
        <div class="flex space-x-4">
           <div class="flex flex-col space-y-4 w-full">
               <h2>Team members</h2>
               <div class="w-full">
                   <div v-for="member in team.users" :key="member.id">
                       <p class="mt-2" v-if="member.id !== authStore.user.id">{{ member.name}}</p>
                   </div>
               </div>
           </div>
            <div class="w-full">
                <AddNewMember :team="team" @member-added="addMemberToList"></AddNewMember>
            </div>
        </div>

    </div>
</template>
