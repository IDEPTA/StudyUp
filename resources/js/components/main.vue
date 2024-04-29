<template>
    <div>
        <header>
            <nav
                class="navbar navbar-expand-lg bg-body-tertiary"
                v-if="showHeader"
            >
                <div class="container-fluid">
                    <router-link class="navbar-brand" to="/loginForm"
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
                                    class="nav-link active"
                                    to="/variantAddForm"
                                    >Добавить вариант</router-link
                                >
                            </li>
                            <li
                                class="nav-item"
                                v-if="mainStore.userData.role_id == 1"
                            >
                                <router-link class="nav-link active" to="/"
                                    >Статистика</router-link
                                >
                            </li>
                            <li
                                class="nav-item"
                                v-if="mainStore.userData.role_id == 1"
                            >
                                <router-link class="nav-link active" to="/"
                                    >Пользователи</router-link
                                >
                            </li>
                        </ul>
                        <router-link
                            v-if="mainStore.userData.length == 0"
                            class="nav-link active"
                            to="/loginForm"
                            >Войти</router-link
                        >
                        <div v-else class="d-flex">
                            <p class="m-2">{{ mainStore.userData.name }}</p>
                            <a
                                class="m-2 nav-link active logout"
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
                        return response.json();
                    }
                })
                .then((data) => alert(data.message));
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
.logout {
    cursor: pointer;
}
</style>
