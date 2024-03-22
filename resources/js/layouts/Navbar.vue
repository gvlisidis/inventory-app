<template>
    <!-- Sidenav -->
    <nav
        class="overflow-hidden h-screen min-h-full sticky left-0 top-0 min-w-fit w-2/12  bg-curious-blue-300 hidden md:block">
        <div class="flex flex-col justify-between h-full">
            <div class="flex flex-col">
                <router-link to="/"
                             class="px-4 py-2 hover:bg-curious-blue-600 hover:text-white font-semibold border-curious-blue-50 hover:cursor-pointer">
                    Boxes
                </router-link>
                <router-link to="/items"
                             class="px-4 py-2 hover:bg-curious-blue-600 hover:text-white font-semibold border-t border-curious-blue-50 hover:cursor-pointer">
                    Items
                </router-link>
                <router-link to="/qrcodes"
                             class="px-4 py-2 hover:bg-curious-blue-600 hover:text-white font-semibold border-t border-b border-curious-blue-50 hover:cursor-pointer">
                    QR Codes
                </router-link>
            </div>
            <button @click="handleLogout"
                    class="px-4 py-2 hover:bg-curious-blue-600 hover:text-white font-semibold border-t border-violet-50 text-left">
                Logout
            </button>
        </div>
    </nav>

    <!--  Mobile view    -->
    <nav class=" md:hidden flex justify-end h-10 bg-curious-blue-600 text-white py-2 w-full text-xs">
        <router-link to="/" class="absolute left-0 ml-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 stroke="currentColor"
                 class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25"/>
            </svg>
        </router-link>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
             class="w-6 h-6 hover:cursor-pointer absolute right-0 mr-2"
             @click="showDropdown = !showDropdown">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
        </svg>
        <div class="dropdown-menu-wrapper absolute mt-8" v-show="showDropdown">
            <div class="dropdown-menu bg-curious-blue-600 text-white">
                <div class="py-2 hover:bg-curious-blue-300 hover:cursor-pointer" @click="showDropdown = false">
                    <router-link to="/"
                                 class="px-4 font-semibold ">Boxes
                    </router-link>
                </div>
                <div class="py-2 hover:bg-curious-blue-300 hover:cursor-pointer" @click="showDropdown = false">
                    <router-link to="/items"
                                 class="px-4 font-semibold ">
                        Items
                    </router-link>
                </div>
                <div class="py-2 hover:bg-curious-blue-300 hover:cursor-pointer" @click="showDropdown = false">
                    <router-link to="/qrcodes"
                                 class="px-4 font-semibold ">
                        QR Codes
                    </router-link>
                </div>
                <div class="border-t-2 border-curious-blue-300 py-2">
                    <button @click="handleLogout"
                            class="px-4 font-semibold ">
                        Logout
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Sidenav -->
</template>

<script setup>
import {ref} from "vue";
import {useRouter} from "vue-router";

const router = useRouter();


const showDropdown = ref(false);

const handleLogout = () => {
    axios.post('logout');
    location.reload();
}
</script>

<style scoped>

.dropdown-menu-wrapper {
    z-index: 9999999999999;
}

.dropdown-menu {
    max-height: 0;

    overflow: hidden;
    animation: dropit .3s linear;
    animation-fill-mode: forwards;
}

@keyframes dropit {
    from {
        max-height: 0
    }
    to {
        max-height: 190px;
    }
}
</style>
