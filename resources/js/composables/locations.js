import {ref} from "vue";
export default function useLocations() {
    const locations = ref([])
    const getLocations = async () => {
        let response = await axios.get('/api/locations')
        locations.value = response.data.data
    }

    return {
        locations, getLocations
    }
}
