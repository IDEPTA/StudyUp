<template>
    <div>
        <header>
            <nav class="navbar navbar-expand-lg bg-body-tertiary" v-if="showHeader">
                <div class="container-fluid">
                    <router-link  class="navbar-brand" to="/loginForm">StudyUp!</router-link>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <router-link class="nav-link active" to="/">Страница 1</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link  class="nav-link active" to="/loginForm">Страница 2</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link  class="nav-link active" to="/loginForm">Страница 3</router-link>
                            </li>
                        </ul>
                        <router-link  class="nav-link active" to="/loginForm">Войти</router-link>
                    </div>
                </div>
            </nav>
        </header>
        <RouterView />
    </div>
</template>
<script>
export default {
    data() {
        return {
            showHeader: true
        }
    },
    watch: {
        '$route'(to) {
            if (to.fullPath === '/loginForm' ||to.fullPath === '/registerForm'  ) {
                this.showHeader = false;
            } else {
                this.showHeader = true;
            }
        }
    }
}
</script>
<style></style>