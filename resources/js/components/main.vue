<template>
    <div>
        <header>
            <nav class="navbar navbar-expand-lg" v-if="showHeader">
                <div class="container-fluid">
                    <router-link class="navbar-brand" to="/"
                        >StudyUp!</router-link
                    >
                    <button
                        class="navbar-toggler"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent"
                        aria-expanded="false"
                        aria-label="Toggle navigation"
                    >
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div
                        class="collapse navbar-collapse"
                        id="navbarSupportedContent"
                    >
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li
                                class="nav-item"
                                v-if="mainStore.userData.role_id == 1"
                            >
                                <router-link
                                    class="nav-link active text-light"
                                    to="/variantAddForm"
                                    >Добавить вариант</router-link
                                >
                            </li>
                            <li
                                class="nav-item"
                                v-if="
                                    mainStore.userData.role_id == 2 ||
                                    mainStore.userData.role_id == 1
                                "
                            >
                                <router-link
                                    class="nav-link active text-light"
                                    to="/variantsList"
                                    >Варианты</router-link
                                >
                            </li>
                            <li
                                class="nav-item"
                                v-if="mainStore.userData.length != 0"
                            >
                                <router-link
                                    class="nav-link active text-light"
                                    to="/profileScreen"
                                    >Личный кабинет</router-link
                                >
                            </li>
                            <li
                                class="nav-item"
                                v-if="mainStore.userData.length != 0"
                            >
                                <span class="nav-link active text-light"
                                    >Здравствуйте,
                                    {{ mainStore.userData.name }}</span
                                >
                            </li>
                        </ul>
                        <router-link
                            v-if="mainStore.userData.length == 0"
                            class="nav-link active text-light"
                            to="/loginForm"
                            >Войти</router-link
                        >
                        <div v-else class="d-flex">
                            <a
                                class="m-2 nav-link active logout text-light"
                                @click="logout"
                                >Выйти</a
                            >
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <RouterView />
    </div>
</template>
<script>
import { useMainStore } from "../stores/main";

export default {
    setup() {
        const mainStore = useMainStore();
        return {
            mainStore,
        };
    },
    data() {
        return {
            showHeader: true,
        };
    },
    mounted() {
        const userDataSession = JSON.parse(sessionStorage.getItem("userData"));
        const userDataLocal = JSON.parse(localStorage.getItem("userData"));
        if (userDataSession) {
            console.log("Сессия");
            this.mainStore.login(userDataSession, "nonactive");
        }
        if (userDataLocal) {
            this.mainStore.login(userDataLocal, "active");
        }
    },
    methods: {
        async logout() {
            await fetch("api/logout", {
                method: "GET",
                headers: {
                    accept: "application/json",
                },
            })
                .then((response) => {
                    if (response.ok) {
                        this.mainStore.logout();
                        localStorage.clear();
                        sessionStorage.clear();
                        return response.json();
                    }
                })
                .then((data) => {
                    alert("Вы разлогинились");
                    this.$router.push({
                        path: "/",
                    });
                });
        },
    },
    watch: {
        $route(to) {
            if (
                to.fullPath === "/loginForm" ||
                to.fullPath === "/registerForm"
            ) {
                this.showHeader = false;
            } else {
                this.showHeader = true;
            }
        },
    },
};
</script>
<style>
.navbar-brand {
    font-size: 20px;
    font-weight: 600;
    color: white;
}
.navbar {
    background-color: #c76991;
}
.logout {
    cursor: pointer;
}
</style>
