<template>
    <div>
        <form @submit.prevent="
            register(
                name,
                lastname,
                role_id,
                school,
                email,
                phone,
                password,
                password_confirmation
            )
            " method="post">
            <p>Имя</p>
            <input class="input" v-model="name" type="text" name="name" placeholder="Имя" />
            <p v-if="errors.name">{{ errors.name[0] }}</p>
            <p>Фамилия</p>
            <input class="input" type="text" name="lastname" placeholder="Фамилия" v-model="lastname" />
            <p v-if="errors.lastname">{{ errors.lastname[0] }}</p>
            <p>Кто вы?</p>
            <select name="role_id" class="form-select form-select-lg mb-3" aria-label="Large select example"
                v-model="role_id" required>
                <option value=3>Учитель</option>
                <option value=2 selected>Ученик</option>
            </select>
            <p v-if="errors.person">{{ errors.person[0] }}</p>
            <p>Выберите вышу школу</p>
            <select name="school" class="form-select form-select-lg mb-3" aria-label="Large select example"
                v-model="school" required>
                <option v-for="el in schoolList" :value="el.id">{{ el.name }} <br>{{ el.city }}</option>
            </select>
            <p v-if="errors.school">{{ errors.school[0] }}</p>
            <p>Email</p>
            <input class="input" type="email" name="email" placeholder="Email" v-model="email" />
            <p v-if="errors.email">{{ errors.email[0] }}</p>
            <p>Телефон</p>
            <input class="input" type="phone" name="phone" placeholder="Телефон" v-model="phone" />
            <p v-if="errors.phone">{{ errors.phone[0] }}</p>
            <p>Пароль</p>
            <input class="input" type="password" name="password" placeholder="Пароль" v-model="password" />
            <input class="input" type="password" name="password_confirmation" placeholder="Подтвердите пароль"
                v-model="password_confirmation" />
            <p v-if="errors.password">{{ errors.password[0] }}</p>
            <p v-if="message">{{ message }}</p>
            <input class="submit" type="submit" value="Зарегистрироваться" />
            <router-link to="/loginForm" class="back">Назад</router-link>
        </form>
    </div>
</template>
<script>
export default {
    data() {
        return {
            name: "",
            lastname: "",
            email: "",
            role_id: "",
            school: "",
            phone: "",
            password: "",
            password_confirmation: "",
            errors: [],
            message: "",
            schoolList: [],
        };
    },
    async mounted() {
        await this.getSchoolList()
    },
    methods: {
        async getSchoolList() {
            await fetch("api/schools", {
                method: "GET",
                headers: {
                    Accept: "application/json",
                },
            }).then((response) => response.json())
                .then((data) => this.schoolList = data.data);
            console.log(this.schoolList);
        },
        async register(
            name,
            lastname,
            role_id,
            school,
            email,
            phone,
            password,
            password_confirmation,
        ) {
            this.errors = [];
            this.message = "";
            let data = {
                name: name,
                lastname: lastname,
                email: email,
                phone: phone,
                role_id: role_id,
                school: school,
                password: password,
                password_confirmation: password_confirmation,
            };
            await fetch("api/register", {
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
                    } else {
                        this.name = "";
                        this.lastname = "";
                        this.email = "";
                        this.phone = "";
                        this.password = "";
                        this.role_id = "";
                        this.school = "";
                        this.password_confirmation = "";
                        this.message = data.message;
                        console.log(data);
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
    margin: 10px auto;
    padding: 30px;
    width: 40%;
    border: 2px solid #aac6fc;
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
    border-bottom: 2px solid #aac6fc;
    outline: none;
}

.submit {
    margin: 10px;
    text-decoration: none;
    border: 2px solid #c76991;
    padding: 5px;
    text-align: center;
    border-radius: 5px;
    color: #c76991;
    background-color: white;
}

.back {
    text-decoration: none;
    color: rgb(15, 32, 42);
}

#flexCheckDefault {
    cursor: pointer;
}
</style>
