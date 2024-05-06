<template>
    <div>
        <form @submit.prevent="login(email, password, remember_token)" method="post">
            <p>Логин</p>
            <input class="input" v-model="email" type="text" name="email" placeholder="Логин" />
            <p v-if="errors.email">{{ errors.email[0] }}</p>
            <p>Пароль</p>
            <input class="input" type="password" name="password" v-model="password" placeholder="Пароль" />
            <p v-if="errors.password">{{ errors.password[0] }}</p>
            <p>
                <input class="form-check-input" type="checkbox" id="flexCheckDefault" name="remember_token" v-model="remember_token" />
                Запомнить меня
            </p>
            <p v-if="message">{{ message }}</p>
            <input class="submit" type="submit" value="Авторизоваться" />
            <router-link to="/registerForm" class="back">Зарегистрироваться</router-link>
            <router-link to="/" class="back">Назад</router-link>
        </form>
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
            email: "",
            password: "",
            errors: [],
            message: "",
            remember_token: "",
        };
    },
    methods: {
        login(email, password, remember_token) {
            this.errors = [];
            this.message = "";
            if (remember_token != "") {
                remember_token = "active";
            }
            let data = {
                email: email,
                password: password,
                remember_token: remember_token,
            };
            fetch("api/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify(data),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.errors) {
                        this.errors = data.errors;
                    } else if (data.user) {
                        this.message = data.message;
                        this.mainStore.login(data.user, data.data.remember_token);
                        // Перенаправляем на главный экран после успешной авторизации
                        this.$router.push({ path: '/' });
                    } else {
                        this.message = data.message;
                    }
                });
        },
    },
};
</script>

<style scoped>
form {
    display: flex;
    flex-direction: column;
    margin: 100px auto;
    padding: 30px;
    width: 300px;
    background-color: rgb(237, 119, 72);
    border-radius: 5px;
}

form p {
    color: rgb(15, 32, 42);
    font-size: 20px;
}

.input {
    margin: 10px 0px;
    padding: 10px;
    font-size: 18px;
    border: none;
    outline: none;
    border-radius: 5px;
}

.submit {
    background-color: #28a745;
    border: none;
    margin: 10px 0px;
    border-radius: 5px;
    color: aliceblue;
    font-size: 15px;
    padding: 5px;
    cursor: pointer;
}

.back {
    text-decoration: none;
    color: rgb(15, 32, 42);
}

#flexCheckDefault {
    cursor: pointer;
}
</style>
