<template>

    <div class="min-h-screen flex items-center justify-center bg-cyan-950">
        <div class="max-w-md w-full bg-white rounded-lg shadow-2xl p-8">
            <slot></slot>
        </div>
    </div>
</template>

<script setup>

import { onMounted, ref } from "vue";
import { useAuthStore } from "../stores/auth";

import { router } from '@inertiajs/vue3';
const user = ref(null);
const authStore = useAuthStore();
onMounted(async () => {
    const token = localStorage.getItem('token')
    if(token) {
         router.visit('/dashboard')
    }
});

const fetchUser = async () => {
    try {
        await authStore.fetchUser();
        user.value = authStore.user;
    } catch (error) {
        console.error("Error fetching user:", error);
    }
};
</script>
