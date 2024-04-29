<script setup>
import {onMounted, ref} from "vue";
import axios from "axios";

const team = ref(null);

onMounted(() => {
    getTeam();
})

const getTeam = async () => {
  await  axios.get('/api/team')
        .then(res => {
            console.log(res.data.data);
            team.value = res.data.data;
        })
        .catch(err => {
            console.log(err);
        })
}
</script>

<template>
    <div>
        <h2>Team</h2>
    </div>
</template>
