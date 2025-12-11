<template>
    <Head title="Signup - Registrate" />
    <AuthLayout>
        <h2 class="text-3xl font-bold text-center mb-8 text-gray-800">
            Registro
        </h2>

        <form @submit.prevent="handleRegister" autocomplete="off" noValidate>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Nombre
                </label>
                <input
                    v-model="form.name"
                    type="text"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    required
                />
                <p v-if="errors.name" class="text-red-500 text-xs mt-1">
                    {{ errors.name[0] }}
                </p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Email
                </label>
                <input
                    v-model="form.email"
                    type="email"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    required
                />
                <p v-if="errors.email" class="text-red-500 text-xs mt-1">
                    {{ errors.email[0] }}
                </p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Contraseña
                </label>
                <input
                    v-model="form.password"
                    type="password"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    required
                />
                <p v-if="errors.password" class="text-red-500 text-xs mt-1">
                    {{ errors.password[0] }}
                </p>
            </div>

            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">
                    Confirmar Contraseña
                </label>
                <input
                    v-model="form.password_confirmation"
                    type="password"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                    required
                />
            </div>

            <div
                v-if="generalError"
                class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded"
            >
                {{ generalError }}
            </div>

            <button
                type="submit"
                :disabled="loading"
                class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition disabled:opacity-50"
            >
                {{ loading ? "Cargando..." : "Registrarse" }}
            </button>
        </form>

        <p class="text-center mt-4 text-gray-600">
            ¿Ya tienes cuenta?
            <Link href="/login" class="text-blue-500 hover:underline"
                >Inicia sesión</Link
            >
        </p>
    </AuthLayout>
</template>

<script setup>
import { Head } from "@inertiajs/vue3";
import AuthLayout from "../../layout/AuthLayout.vue";
import { ref } from "vue";
import { router, Link } from "@inertiajs/vue3";
import { useAuthStore } from "../../stores/auth";

const authStore = useAuthStore();

const form = ref({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const errors = ref({});
const generalError = ref("");
const loading = ref(false);

const handleRegister = async () => {
    loading.value = true;
    errors.value = {};
    generalError.value = "";

    try {
        await authStore.register(form.value);
        router.visit("/dashboard");
    } catch (error) {
        if (error.response?.data?.errors) {
            errors.value = error.response.data.errors;
        } else {
            generalError.value =
                error.response?.data?.message || "Error al registrarse";
        }
    } finally {
        loading.value = false;
    }
};
</script>
