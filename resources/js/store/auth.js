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
            await this.getToken()
            await axios.get('/api/user')
                .then((response) => {
                    this.authUser = response.data.data;
                });
        },
        async login(data) {
            await this.getToken();
            await axios.post('/api/login', data)
                .then((response) => {
                    if (response.status === 200 && response.data && response.data.token) {
                        localStorage.setItem('APP_DEMO_USER_TOKEN', response.data.token)
                        this.authUser = response.data.user;
                        this.isAuthenticated = true;
                        router.push('/')
                    }
                })
                .catch((error) => {
                    router.push('/login');
                });
        }
    },
    persist: true,
});
