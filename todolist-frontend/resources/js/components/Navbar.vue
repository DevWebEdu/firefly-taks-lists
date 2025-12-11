<template>
    <!-- Navbar -->
    <nav class="shadow-lg bg-neutral-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center gap-5">
                      <span class="text-gray-700 block" :title="user?.name" ><CaUserAvatarFilled class="w-10 h-10 text-cyan-950"/></span>
                    <h1 class="text-xl font-bold text-cyan-950">
                        Sistema de Tareas
                    </h1>
                </div>
                <div class="flex items-center space-x-4">

                    <button
                        @click="handleLogout"
                        class="bg-red-500 text-white px-2 py-2 rounded-lg hover:bg-red-600 transition"
                    >
                       <MdLogout class="w-6 h-6"/>
                    </button>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { MdLogout,CaUserAvatarFilled } from '@kalimahapps/vue-icons';
import { onMounted, ref } from "vue";
import { useAuthStore } from "../stores/auth";

import { router } from '@inertiajs/vue3';

const authStore = useAuthStore();
const user = ref(null);
onMounted(async () => {
   await fetchUser()
});
const fetchUser = async () => {
    try {
        await authStore.fetchUser();
        user.value = authStore.user;
    } catch (error) {
        console.error("Error fetching user:", error);
    }
};

const handleLogout = async () => {
    try {
        await axios.post("/logout");
    } catch (error) {
        console.error("Error logging out:", error);
    } finally {
        authStore.logout();
        router.visit("/login");
    }
};
</script>
