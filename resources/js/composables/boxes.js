import {ref} from "vue";
import axios from "axios";
import {request} from "../helpers";
import {useRouter} from "vue-router";

export default function useBoxes() {
    const boxes = ref([])
    const box = ref([])
    const errors = ref('')

    const router = useRouter()
    const getBoxes = async () => {
        let response = await axios.get('/api/boxes')
        boxes.value = response.data.data
    }

    const getBox = async (id) => {
        try{
            await axios.get(`/api/boxes/${id}`)
                .then(response => {
                    box.value = response.data.data;
                });
        } catch (error) {
            console.log(error)
        }

    }

    const updateBox = async (id) => {
        try {
            await axios.put(`/api/boxes/${id}`, box.value)
        } catch (e) {
            console.log(e)
        }
    }

    const destroyBox =  async (id) => {
        await axios.delete(`/api/boxes/${id}`);
        router.push('/');
    }

    return {
        errors, boxes, box, getBox, getBoxes, destroyBox, updateBox
    }
}
