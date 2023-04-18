import {createRouter, createWebHistory} from "vue-router";
import Home from "../pages/Home.vue";
import Items from "../pages/Items.vue";
import BoxIndex from "../pages/boxes/BoxIndex.vue";
import QRCodesList from "../pages/QRCodesList.vue";
import Login from "../pages/Login.vue";

const router = createRouter({
    history: createWebHistory(),
    routes: [
        // {
        //     path: '/login',
        //     name: 'login',
        //     component: Login,
        //     meta: {requiresAuth: false}
        // },
        {
            path: '/',
            name: 'home',
            component: Home,
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

// router.beforeEach((to, from, next) => {
//
//     if(to.matched.some(record => record.meta.requiresAuth)) {
//         if (isAuthenticated()) {
//             next()
//             return
//         }
//         next({name: 'login'})
//     } else {
//         next()
//     }
// });
function isAuthenticated() {
    return Boolean(localStorage.getItem('APP_DEMO_USER_TOKEN'))
}

export default router;
