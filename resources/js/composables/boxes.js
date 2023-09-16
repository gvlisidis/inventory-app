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
       await axios.get(`/api/boxes/${id}`)
            .then(response => {
                box.value = response.data.data;
            })
    }

    const updateBox = async (id) => {
        try {
            await axios.put(`/api/boxes/${id}`, box.value)
        } catch (e) {
            // if (e.response.status === 422) {
            //     for (const key in e.response.data.errors) {
            //         errors.value = e.response.data.errors
            //     }
            // }
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
