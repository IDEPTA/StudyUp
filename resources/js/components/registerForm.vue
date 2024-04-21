<template>
    <div>
        <form action="api/register" method="post">
            <p>Имя</p>
            <input class="input" type="text" name="name" placeholder="Имя" />
            <p>Фамилия</p>
            <input
                class="input"
                type="text"
                name="lastname"
                placeholder="Фамилия"
            />
            <p>Email</p>
            <input
                class="input"
                type="email"
                name="email"
                placeholder="Email"
            />
            <p>Телефон</p>
            <input
                class="input"
                type="phone"
                name="phone"
                placeholder="Телефон"
            />
            <p>Пароль</p>
            <input
                class="input"
                type="password"
                name="password"
                placeholder="Пароль"
            />
            <input
                class="input"
                type="password"
                name="password_confirmation"
                placeholder="Подтвердите пароль"
            />
            <input class="submit" type="submit" value="Зарегистрироваться" />
            <router-link to="/loginForm" class="back">Назад</router-link>
        </form>
    </div>
</template>
<script></script>
<style scoped>
form {
    display: flex;
    flex-direction: column;
    margin: 10px auto;
    padding: 30px;
    width: 500px;
    background-color: rgb(237, 119, 72);
    border-radius: 5px;
}
form p {
    color: rgb(15, 32, 42);
    font-size: 20px;
}
.input {
    margin: 5px 0px;
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
