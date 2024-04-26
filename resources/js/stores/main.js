import { defineStore } from "pinia";

export const useMainStore = defineStore("mainStore", {
    state: () => ({
        userData: [],
    }),
    getters: {},
    actions: {
        login($data){
            this.userData = $data
        },
        logout(){
            this.userData = []
        }
    },
});
