import { defineStore } from "pinia";

export const useMainStore = defineStore("mainStore", {
    state: () => ({
        userData: [],
    }),
    getters: {},
    actions: {
        login(data, remember) {
            this.userData = data;
            if (remember === "active") {
                localStorage.setItem("userData", JSON.stringify(data));
            } else {
                sessionStorage.setItem("userData", JSON.stringify(data));
            }
        },
        logout() {
            this.userData = [];
            localStorage.removeItem("userData");
        },
    },
});
