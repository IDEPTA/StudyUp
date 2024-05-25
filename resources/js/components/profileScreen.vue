<template>
    <div class="profileCard">
        <div class="solvedsVariant" v-if="responseData != null">
            <h2 class="title">Ваши решенные варианты</h2>
            <div v-for="element in responseData" class="solvedVariantBlock">
                <p>
                    {{ element.variant.subject }}
                    №{{ element.variant.id }} от
                    {{ element.variant.created_at.slice(0, 10) }}
                    <br />
                    Правильных ответов:
                    {{ counter(element.result) }}/{{
                        element.result.split(",").length
                    }}
                    <br />
                    Дата прохождения:
                    {{ element.created_at.slice(11, 19) }}
                    {{ element.created_at.slice(0, 10) }}
                </p>
            </div>
        </div>
        <form @submit.prevent="editProfile">
            <h2>Профиль</h2>
            <div class="profileLine">
                <div>
                    <label for="name">Имя</label>
                    <br /><input
                        type="text"
                        id="name"
                        placeholder="Имя"
                        v-model="name"
                        required
                    />
                </div>
                <div>
                    <label for="lastname">Фамилия</label>
                    <br /><input
                        type="text"
                        id="lastname"
                        placeholder="Фамилия"
                        v-model="lastname"
                        required
                    />
                </div>
            </div>
            <div class="profileLine">
                <div>
                    <label for="email">Email</label>
                    <br /><input
                        type="email"
                        id="email"
                        placeholder="Email"
                        v-model="email"
                        required
                    />
                </div>
                <div>
                    <label for="phone">Телефон</label>
                    <br /><input
                        type="text"
                        id="phone"
                        placeholder="Телефон"
                        v-model="phone"
                        required
                    />
                </div>
            </div>
            <div class="profileLine">
                <p>Для изменения данных введите текущий пароль</p>
            </div>
            <div class="profileLine">
                <div>
                    <label for="password">Пароль</label>
                    <br /><input
                        type="password"
                        id="password"
                        v-model="password"
                        required
                    />
                </div>
                <div>
                    <label for="password_confirmation"
                        >Подтвердите пароль</label
                    >
                    <br /><input
                        type="password"
                        id="password_confirmation"
                        v-model="password_confirmation"
                        required
                    />
                </div>
            </div>
            <P>{{ msg }}</P>
            <div class="profileLine">
                <div>
                    <span>Дата создания:</span>
                    <p>
                        {{ mainStore.userData.created_at.slice(11, 19) }}
                        {{ mainStore.userData.created_at.slice(0, 10) }}
                    </p>
                </div>
                <div>
                    <span>Последнее обновление данных:</span>
                    <p>
                        {{ mainStore.userData.updated_at.slice(11, 19) }}
                        {{ mainStore.userData.updated_at.slice(0, 10) }}
                    </p>
                </div>
            </div>
            <input type="submit" class="btn btn-success" value="Сохранить" />
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
            name: this.mainStore.userData.name,
            lastname: this.mainStore.userData.lastname,
            email: this.mainStore.userData.email,
            phone: this.mainStore.userData.phone,
            password: "",
            errors: [],
            password_confirmation: "",
            msg: "",
            responseData: null,
        };
    },
    mounted() {
        if (this.mainStore.userData.role_id === 2) {
            this.fetchData();
        }
    },
    methods: {
        async editProfile() {
            let data = {
                name: this.name,
                lastname: this.lastname,
                email: this.email,
                phone: this.phone,
                password: this.password,
                password_confirmation: this.password_confirmation,
            };

            const url = "api/edit/" + this.mainStore.userData.id;
            await fetch(url, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                // здесь изменено data на body
                body: JSON.stringify(data),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.errors) {
                        this.errors = data.errors;
                    } else {
                        this.msg = "Данные успешно обновлены";
                        this.mainStore.updateUserData(data.user);
                    }
                });
            this.password = "";
            this.password_confirmation = "";
        },
        async fetchData() {
            try {
                const url = "api/solved/" + this.mainStore.userData.id;
                const response = await fetch(url); // Замените "api/data" на ваш эндпоинт
                const data = await response.json();
                this.responseData = data.data; // Присваиваем данные переменной, чтобы они отобразились в шаблоне
                console.log(this.responseData);
            } catch (error) {
                console.error("Ошибка при загрузке данных:", error);
            }
        },
        counter(data) {
            let array = data.split(",");
            let count = 0;
            array.forEach((element) => {
                if (element == 1) {
                    count++;
                }
            });
            return count;
        },
    },
};
</script>
<style scoped>
h2 {
    color: white;
}
.solvedVariantBlock {
    background-color: aliceblue;
    padding: 10px;
    border-radius: 10px;
    margin: 10px;
}
.solvedsVariant {
    overflow-y: auto;
    background-color: #aac6fc;
    font-size: 20px;
    margin: 0px 10px;
    padding: 10px;
    border-radius: 10px;
    height: 100vh;
}
.profileCard {
    display: flex;
    align-items: center;
    align-content: center;
    justify-content: center;
}
form {
    border-radius: 10px;
    padding: 10px 0px;
    margin: 50px 0px;
    background-color: #aac6fc;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
label {
    margin: 10px 0px;
}
.profileLine {
    display: flex;
}
.profileLine div {
    background-color: #fcfcfc;
    padding: 10px;
    border-radius: 5px;
    margin: 20px;
}
input {
    padding: 10px;
    outline: none;
    border: none;
    border-bottom: 2px solid #aac6fc;
}
</style>
