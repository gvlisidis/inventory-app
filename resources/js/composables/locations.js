import {ref} from "vue";
export default function useLocations() {
    const locations = ref([])
    const getLocations = async () => {
        let response = await axios.get('/locations')
        locations.value = response.data.data
    }

    return {
        locations, getLocations
    }
}
