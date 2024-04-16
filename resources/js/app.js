import './bootstrap';
import  {createApp, markRaw} from 'vue';
import router from "./router";
import App from "./App.vue";
import {createPinia} from "pinia";
import piniaPluginPersistedstate from 'pinia-plugin-persistedstate'

const pinia = createPinia();

pinia.use(({ store }) => {
    store.router = markRaw(router);
});


const app = createApp(App);
pinia.use(piniaPluginPersistedstate)

app.use(router);
app.use(pinia);

app.mount('#app');
