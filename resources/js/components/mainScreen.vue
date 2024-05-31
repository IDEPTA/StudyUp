<template>
    <div class="mainScreen">
        <div class="banner">
            <div class="mainTextBlock">
                <h1>Добро пожаловать в <br />StudyUP!</h1>
                <p>
                    StudyUP - образовательная площадка, на которой вы можете
                    <br />
                    проверить качество своей подготовки к ЕГЭ
                </p>
                <div class="bannerButtonBlock">
                    <router-link class="bannerButton" to="/loginForm">
                        Авторизоваться
                    </router-link>
                    <router-link class="bannerButton" to="/registerForm">
                        Зарегистрироваться
                    </router-link>
                </div>
            </div>
            <img src="/storage/app/public/img/main.png" alt="mainPage" />
        </div>
        <div class="descriptionnBlock">
            <h3>Доступны онлайн тестирования по следующим предметам!</h3>
            <div class="cardsList">
                <div class="cardItem">
                    <img src="/storage/app/public/img/1.png" alt="" />
                    <p>Русский язык</p>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing
                        elit. Ex tenetur debitis illo molestiae ducimus ut
                        assumenda ea
                    </p>
                    <router-link class="btn btn-succes" to="/loginForm">
                        Пройти тестирование
                    </router-link>
                </div>
                <div class="cardItem">
                    <img src="/storage/app/public/img/main.png" alt="" />
                    <p>Математика (профиль)</p>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing
                        elit. Ex tenetur debitis illo molestiae ducimus ut
                        assumenda ea
                    </p>
                    <router-link class="btn btn-succes" to="/loginForm">
                        Пройти тестирование
                    </router-link>
                </div>
                <div class="cardItem">
                    <img src="/storage/app/public/img/2.png" alt="" />
                    <p>Математика (база)</p>
                    <p>
                        Lorem ipsum dolor, sit amet consectetur adipisicing
                        elit. Ex tenetur debitis illo molestiae ducimus ut
                        assumenda ea
                    </p>
                    <router-link class="btn btn-succes" to="/loginForm">
                        Пройти тестирование
                    </router-link>
                </div>
            </div>
        </div>
        <footer>
            <div>
                <p>Контакты</p>
                <p>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-envelope"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1zm13 2.383-4.708 2.825L15 11.105zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741M1 11.105l4.708-2.897L1 5.383z"
                        /></svg
                    >Procopchuk14092002@yandex.ru
                </p>
                <p>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-phone"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"
                        />
                        <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2" /></svg
                    >8(900) 125-73-39
                </p>
                <p>
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-geo-alt"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M12.166 8.94c-.524 1.062-1.234 2.12-1.96 3.07A32 32 0 0 1 8 14.58a32 32 0 0 1-2.206-2.57c-.726-.95-1.436-2.008-1.96-3.07C3.304 7.867 3 6.862 3 6a5 5 0 0 1 10 0c0 .862-.305 1.867-.834 2.94M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10"
                        />
                        <path
                            d="M8 8a2 2 0 1 1 0-4 2 2 0 0 1 0 4m0 1a3 3 0 1 0 0-6 3 3 0 0 0 0 6"
                        /></svg
                    >Ростовн-на-Дону, Россия
                </p>
            </div>
            <div>
                <p>Разработчик: Прокопчук Сергей</p>
                <a href=""
                    ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-github"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"
                        /></svg
                    >Мой Github</a
                >
            </div>
            <div>
                <p>Следите за нами</p>
                <a href=""
                    ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-facebook"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"
                        /></svg
                    >Вконтакте</a
                >
                <br /><a href=""
                    ><svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="16"
                        height="16"
                        fill="currentColor"
                        class="bi bi-telegram"
                        viewBox="0 0 16 16"
                    >
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.287 5.906q-1.168.486-4.666 2.01-.567.225-.595.442c-.03.243.275.339.69.47l.175.055c.408.133.958.288 1.243.294q.39.01.868-.32 3.269-2.206 3.374-2.23c.05-.012.12-.026.166.016s.042.12.037.141c-.03.129-1.227 1.241-1.846 1.817-.193.18-.33.307-.358.336a8 8 0 0 1-.188.186c-.38.366-.664.64.015 1.088.327.216.589.393.85.571.284.194.568.387.936.629q.14.092.27.187c.331.236.63.448.997.414.214-.02.435-.22.547-.82.265-1.417.786-4.486.906-5.751a1.4 1.4 0 0 0-.013-.315.34.34 0 0 0-.114-.217.53.53 0 0 0-.31-.093c-.3.005-.763.166-2.984 1.09"
                        /></svg
                    >Телеграмм</a
                >
            </div>
        </footer>
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
};
</script>
<style scoped>
.mainScreen {
    width: 100%;
    height: 100vh;
    background-color: aliceblue;
}
.mainTextBlock {
    padding-top: 50px;
    text-align: center;
    margin-right: 100px;
}
.banner img {
    border-radius: 5px;
}
.banner {
    padding-top: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
}
.bannerButtonBlock {
    margin: 40px 0px;
}
.bannerButton:first-child {
    margin: 10px;
    text-decoration: none;
    background-color: #aac6fc;
    padding: 15px;
    border-radius: 5px;
    color: white;
}
.bannerButton:last-child {
    margin: 10px;
    text-decoration: none;
    border: 2px solid #c76991;
    padding: 15px;
    border-radius: 5px;
    color: #c76991;
}
.descriptionnBlock {
    margin-top: 100px;
    padding: 40px 0px 100px;
    background-color: #fcfcfc;
}
.descriptionnBlock h3 {
    text-align: center;
    color: white;
}
.cardsList {
    display: flex;
    justify-content: center;
}
.cardItem {
    width: 300px;
    background-color: #aac6fc;
    border-radius: 5px;
    margin: 10px;
}
.cardItem p {
    margin: 10px;
}
.CardButton {
    text-decoration: none;
    border: 1px solid red;
}
.cardItem img {
    border-radius: 5px 5px 0px 0px;
    width: 300px;
}
footer {
    display: flex;
    justify-content: center;
    padding: 40px;
    color: white;
    background-color: rgb(26, 26, 26);
}
footer div {
    margin: 0px 20px;
}
a {
    margin: 10px 0px;
    text-decoration: none;
    color: white;
}
svg {
    margin: 0px 10px 5px 0px;
}
</style>
