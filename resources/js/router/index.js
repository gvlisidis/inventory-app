import {createRouter, createWebHistory} from "vue-router";
import Home from "../pages/Home.vue";
import Items from "../pages/items/ItemsIndex.vue";
import BoxIndex from "../pages/boxes/BoxShow.vue";
import QRCodesList from "../pages/qrcodes/QRCodesIndex.vue";
import Dashboard from "../pages/Dashboard.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home,
            meta: {requiresAuth: true}
        },
        {
            path: '/dashboard',
            name: 'dashboard',
            component: Dashboard,
            meta: {requiresAuth: true}
        },
        {
            path: '/items',
            name: 'items',
            component: Items,
            meta: {requiresAuth: true}
        },
        {
            path: '/box/:id/contents',
            name: 'box',
            component: BoxIndex,
            props: true,
            meta: {requiresAuth: true}
        },
        {
            path: '/qrcodes',
            name: 'qrcodes',
            component: QRCodesList,
            meta: {requiresAuth: true}
        },
    ],
});

export default router;
