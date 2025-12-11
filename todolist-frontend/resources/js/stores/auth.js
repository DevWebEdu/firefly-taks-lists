import { defineStore } from "pinia";
import axios from "axios";

export const useAuthStore = defineStore("auth", {
    state: () => ({
        user: null,
        token: localStorage.getItem("token"),
    }),

    getters: {
        isAuthenticated: (state) => !!state.token,
    },

    actions: {
        async login(credentials) {
            try {
                const response = await axios.post("/login", credentials);
                this.token = response.data.token;
                this.user = response.data.user;
                localStorage.setItem("token", this.token);
                return response.data;
            } catch (error) {
                throw error;
            }
        },

        async register(userData) {
            try {
                const response = await axios.post("/register", userData);
                this.token = response.data.token;
                this.user = response.data.user;
                localStorage.setItem("token", this.token);
                
                return response.data;
            } catch (error) {
                throw error;
            }
        },

        async fetchUser() {
            try {
                const response = await axios.get("/me");
                this.user = response.data.user;
            } catch (error) {
                this.logout();
            }
        },

        logout() {
            this.user = null;
            this.token = null;
            localStorage.removeItem("token");
        },
    },
});
