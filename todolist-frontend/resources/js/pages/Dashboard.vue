<template>
    <Head title="Dashboard" />
    <div class="min-h-screen relative bg-cyan-950">
        <Navbar />

        <button
            @click="openCreateModal"
            class="text-white px-4 py-2 rounded-lg transition absolute -bottom-0 right-6 m-10"
        >
            <FlFilledAddStarburst
                class="text-green-500 w-14 h-14 hover:text-green-800"
            />
        </button>
        <!-- Main Content -->
        <div
            class="max-w-7xl mx-auto sm:px-6 lg:px-8 h-full flex justify-center flex-col items-center"
        >
            <!-- Header -->
            <div class="flex justify-center items-center mb-6">
                <h2 class="text-3xl font-bold text-center mt-20 text-white">
                    Mis Tareas
                </h2>
                <!--  -->
            </div>

            <!-- Tasks List -->
            <div v-if="loading" class="flex flex-col gap-2 w-full mx-auto m-10">
                <div class="space-y-3">
                    <div class="animate-pulse bg-white p-6 rounded-lg shadow">
                        <div class="h-4 w-1/3 bg-gray-200 rounded mb-3"></div>
                        <div class="h-3 w-2/3 bg-gray-200 rounded"></div>
                    </div>

                    <div class="animate-pulse bg-white p-6 rounded-lg shadow">
                        <div class="h-4 w-1/4 bg-gray-200 rounded mb-3"></div>
                        <div class="h-3 w-1/2 bg-gray-200 rounded"></div>
                    </div>

                    <div class="animate-pulse bg-white p-6 rounded-lg shadow">
                        <div class="h-4 w-1/4 bg-gray-200 rounded mb-3"></div>
                        <div class="h-3 w-1/2 bg-gray-200 rounded"></div>
                    </div>
                </div>
            </div>

            <div
                v-else-if="tasks.length === 0"
                class="bg-white rounded-lg shadow p-8 text-center"
            >
                <p class="text-gray-600">
                    No tienes tareas aún. ¡Crea tu primera tarea!
                </p>
            </div>
            <!-- crear un componente -->
            <div v-else class="flex flex-col gap-2 w-full m-10">
                <div
                    v-for="task in tasks"
                    :key="task.id"
                    class="rounded-lg shadow p-6 hover:shadow-lg transition bg-neutral-200"
                >
                    <div>
                        <div class="flex justify-between items-center">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3">
                                    <h3
                                        :class="
                                            task.status === 'completed'
                                                ? 'line-through text-gray-500'
                                                : ''
                                        "
                                        class="text-xl font-semibold text-gray-800 capitalize"
                                    >
                                        {{ task.title }}
                                    </h3>
                                    <span
                                        :class="
                                            task.status === 'completed'
                                                ? 'bg-green-100 text-green-800'
                                                : 'bg-yellow-100 text-yellow-800'
                                        "
                                        class="px-2 py-1 rounded-full text-xs font-medium"
                                    >
                                        {{
                                            task.status === "completed"
                                                ? "Completada"
                                                : "Pendiente"
                                        }}
                                    </span>
                                </div>

                                <!-- <p
                                v-if="task.description"
                                class="text-gray-600 mt-2"
                            >
                                {{ task.description }}
                            </p> -->
                            </div>
                            <div
                                class="flex space-x-2 ml-4 items-center justify-center h-full"
                            >
                                <button
                                    @click="toggleStatus(task)"
                                    class="p-2 text-blue-600 hover:bg-blue-50 rounded"
                                    title="Cambiar estado"
                                >
                                    <AnOutlinedFileDone
                                        v-if="task.status === 'pending'"
                                        class="w-6 h-6"
                                    />
                                    <MdSharpPendingActions
                                        v-else
                                        class="w-6 h-6"
                                    />
                                </button>
                                <button
                                    @click="openEditModal(task)"
                                    class="p-2 text-yellow-600 hover:bg-yellow-50 rounded"
                                    title="Editar"
                                >
                                    <FeEdit2 class="w-6 h-6" />
                                </button>
                                <button
                                    @click="deleteTask(task.id)"
                                    class="p-2 text-red-600 hover:bg-red-50 rounded"
                                    title="Eliminar"
                                >
                                    <AnOutlinedDelete class="w-6 h-6" />
                                </button>
                            </div>
                        </div>
                        <div class="flex justify-center flex-col">
                            <!-- Botón para abrir/cerrar descripción -->
                            <button
                                @click="toggleDescription(task.id)"
                                class="text-gray-600 hover:text-gray-900 ml-4 mt-2 flex items-center justify-center"
                                title="Mostrar descripción"
                            >
                                <span v-if="openTaskId === task.id"
                                    ><AkChevronUp class="w-3 h-3"
                                /></span>
                                <span v-else
                                    ><AkChevronDown
                                        class="w-3 h-3 animate-bounce"
                                /></span>
                            </button>
                            <!-- DESCRIPCIÓN DROPDOWN -->
                            <div
                                v-if="
                                    task.description && openTaskId === task.id
                                "
                                class="mt-3 p-3 bg-gray-50 border-gray-200 rounded-lg text-gray-700 text-sm transition-all duration-300"
                            >
                                <h5 class="text-base font-medium">
                                    Descripción
                                </h5>
                                <p class="text-sm text-justify px-2 mt-5">
                                    {{ task.description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  crear un componente para el modal -->
        <!-- Modal -->
        <div
            v-if="showModal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
            @click.self="closeModal"
        >
            <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4">
                <h3 class="text-2xl font-bold mb-4">
                    {{ editingTask ? "Editar Tarea" : "Nueva Tarea" }}
                </h3>
                <form @submit.prevent="saveTask" autocomplete="off" noValidate>
                    <div class="mb-4">
                        <label
                            class="block text-gray-700 text-sm font-bold mb-2"
                        >
                            Título
                        </label>
                        <input
                            v-model="taskForm.title"
                            type="text"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                            required
                        />
                        <p
                            v-if="taskErrors.title"
                            class="text-red-500 text-xs mt-1"
                        >
                            {{ taskErrors.title[0] }}
                        </p>
                    </div>

                    <div class="mb-4">
                        <label
                            class="block text-gray-700 text-sm font-bold mb-2"
                        >
                            Descripción
                        </label>
                        <textarea
                            v-model="taskForm.description"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                            rows="4"
                        ></textarea>
                        <p
                            v-if="taskErrors.description"
                            class="text-red-500 text-xs mt-1"
                        >
                            {{ taskErrors.description[0] }}
                        </p>
                    </div>

                    <div class="mb-6">
                        <label
                            class="block text-gray-700 text-sm font-bold mb-2"
                        >
                            Estado
                        </label>
                        <select
                            v-model="taskForm.status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500"
                        >
                            <option value="pending">Pendiente</option>
                            <option value="completed">Completada</option>
                        </select>
                    </div>

                    <div class="flex space-x-3">
                        <button
                            type="submit"
                            class="flex-1 bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition"
                        >
                            Guardar
                        </button>
                        <button
                            type="button"
                            @click="closeModal"
                            class="flex-1 bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 transition"
                        >
                            Cancelar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<script setup>
import Navbar from "../components/Navbar.vue";
import {
    AkChevronDown,
    AkChevronUp,
    MdSharpPendingActions,
    AnOutlinedFileDone,
    FlFilledAddStarburst,
    FeEdit2,
    AnOutlinedDelete,
} from "@kalimahapps/vue-icons";
import { ref, onMounted } from "vue";
import { router, Head } from "@inertiajs/vue3";
import { useAuthStore } from "../stores/auth";
import axios from "axios";
import Swal from "sweetalert2";
const openTaskId = ref(null);
const authStore = useAuthStore();
const user = ref(null);
const tasks = ref([]);
const loading = ref(true);
const showModal = ref(false);
const editingTask = ref(null);
const taskForm = ref({
    title: "",
    description: "",
    status: "pending",
});
const taskErrors = ref({});

onMounted(async () => {
    await fetchUser();
    await fetchTasks();
});

const toggleDescription = (id) => {
    openTaskId.value = openTaskId.value === id ? null : id;
};

const fetchUser = async () => {
    try {
        await authStore.fetchUser();
        user.value = authStore.user;
    } catch (error) {
        console.error("Error fetching user:", error);
    }
};

const fetchTasks = async () => {
    try {
        const response = await axios.get("/tasks");

        tasks.value = response.data;
    } catch (error) {
        console.error("Error fetching tasks:", error);
    } finally {
        loading.value = false;
    }
};

const openCreateModal = () => {
    editingTask.value = null;
    taskForm.value = {
        title: "",
        description: "",
        status: "pending",
    };
    taskErrors.value = {};
    showModal.value = true;
};

const openEditModal = (task) => {
    editingTask.value = task;
    taskForm.value = {
        title: task.title,
        description: task.description || "",
        status: task.status,
    };
    taskErrors.value = {};
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    editingTask.value = null;
    taskForm.value = {
        title: "",
        description: "",
        status: "pending",
    };
    taskErrors.value = {};
};

const saveTask = async () => {
    taskErrors.value = {};

    try {
        if (editingTask.value) {
            await axios.put(`/tasks/${editingTask.value.id}`, taskForm.value);
        } else {
            await axios.post("/tasks", taskForm.value);
        }

        await fetchTasks();
        closeModal();
    } catch (error) {
        if (error.response?.data?.errors) {
            taskErrors.value = error.response.data.errors;
        }
    }
};

const toggleStatus = async (task) => {
    try {
        const newStatus = task.status === "pending" ? "complete" : "pending";
        await axios.post(`/tasks/${task.id}/toggle`, { status: newStatus });
        await fetchTasks();
    } catch (error) {
        console.error("Error toggling status:", error);
    }
};

const deleteTask = async (id) => {
    //if (!confirm("¿Estás seguro de eliminar esta tarea?")) return;
    Swal.fire({
        title: "¿Estas seguro?",
        text: "Al borrar un tarea, no hay vuelta atras!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#083344",
        cancelButtonColor: "#d33",
        confirmButtonText: "Eliminar",
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                await axios.delete(`/tasks/${id}`);
                await fetchTasks();
                Swal.fire({
                    title: "Tarea Eliminada!",
                    text: "La tarea fue eliminada correctamente.",
                    icon: "success",
                });
            } catch (error) {
                console.error("Error deleting task:", error);
            }
        }
    });
    // try {
    //     await axios.delete(`/tasks/${id}`);
    //     await fetchTasks();
    // } catch (error) {
    //     console.error("Error deleting task:", error);
    // }
};
</script>
