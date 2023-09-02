import {ref} from "vue";
import axios from "axios";
import {request} from "../helpers";
import {useRouter} from "vue-router";

export default function useBoxes() {
    const boxes = ref([])
    const box = ref([])

    const router = useRouter()
    const getBoxes = async () => {
        let response = await axios.get('/api/boxes')
        boxes.value = response.data.data
    }

    const getBox = async (id) => {
       await axios.get(`/api/boxes/${id}`)
            .then(response => {
                box.value = response.data.data;
            })
    }

    const deleteBox =  async (id) => {
        await axios.delete(`/api/boxes/${id}`);
        router.push('/');
    }

    return {
        boxes, box, getBox, getBoxes, deleteBox
    }
}
