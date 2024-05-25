import { defineStore } from "pinia";

export const useMainStore = defineStore("mainStore", {
    state: () => ({
        userData: [],
        variantsData: "",
        result: "",
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
        addVariants(data) {
            this.variantsData = data;
        },
        addUserAnswers(data) {
            this.result = data;
        },
        updateUserData(data) {
            this.userData = data;
            if (localStorage.getItem("userData")) {
                console.log("localstorage");
                localStorage.setItem("userData", JSON.stringify(data));
            } else if (sessionStorage.getItem("userData")) {
                console.log("sessionStorage");
                sessionStorage.setItem("userData", JSON.stringify(data));
            }
        },
        deleteVariant(id) {
            let filteredArray = this.variantsData.filter((el) => el.id != id);
            this.variantsData = filteredArray;
        },
    },
});
