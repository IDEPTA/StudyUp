<template>
    <div>
        <form @submit.prevent="login" method="post">
            <p>Логин</p>
            <input
                class="input"
                v-model="email"
                type="text"
                name="email"
                placeholder="Логин"
            />
            <p>Пароль</p>
            <input
                class="input"
                type="password"
                name="password"
                v-model="password"
                placeholder="Пароль"
            />
            <p>
                <input
                    class="form-check-input"
                    type="checkbox"
                    id="flexCheckDefault"
                    name="rememberMe"
                />
                Запомнить меня
            </p>
            <input class="submit" type="submit" value="Авторизоваться" />
            <router-link to="/registerForm" class="back"
                >Зарегистрироваться</router-link
            >
            <router-link to="/" class="back">Назад</router-link>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            email: "",
            password: "",
        };
    },
    methods: {
        login() {
            fetch("api/login", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify({
                    email: this.email,
                    password: this.password,
                }),
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error("Invalid credentials");
                    }
                    return response.json();
                })
                .then((data) => {
                    console.log(data); // Вывод данных пользователя
                    console.log(data.message); // Вывод сообщения об успешной авторизации
                    // Далее вы можете использовать данные пользователя в вашем приложении Vue.js
                })
                .catch((error) => {
                    console.error(error);
                    this.errorMessage = "Invalid credentials";
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
