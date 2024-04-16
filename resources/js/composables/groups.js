import {ref} from "vue";
export default function useGroups() {
    const groups = ref([])
    const getGroups = async () => {
        let response = await axios.get('/api/groups')
        groups.value = response.data.data
    }

    return {
        groups, getGroups
    }
}
