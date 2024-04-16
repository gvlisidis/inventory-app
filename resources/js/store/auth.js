import {defineStore} from "pinia";
import axios from "axios";
import router from "../router";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        authUser: null,
        isAuthenticated: false,

    }),
    getters: {
        user: (state) => state.authUser,
        isLoggedIn: (state) => state.isAuthenticated,
    },
    actions: {
        async getToken() {
            await axios.get('/sanctum/csrf-cookie');
        },
        async getUser() {
            await axios.get('/api/user')
                .then((response) => {
                    console.log(response.data.data)
                    this.authUser = response.data.data;
                });
        },
        async login(data) {
            console.log(998)
            await this.getToken();
            await axios.post('/login', data)
                .then((response) => {
                    console.log(566, response)
                    if (response.status === 200 && response.data && response.data.token) {
                        console.log(555)
                        localStorage.setItem('APP_DEMO_USER_TOKEN', response.data.token)
                        this.authUser = response.data.user;
                        this.isAuthenticated = true;
                        console.log(22, this.authUser, this.isAuthenticated)
                        this.router.push('/')
                    }
                })
                .catch((error) => {
                    this.router.push('/login');
                });
        }
    }
});
