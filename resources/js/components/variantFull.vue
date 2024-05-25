<template>
    <div>
        <h2>{{ variant.subject }} №{{ variant.id }}</h2>
        <div class="testBlock">
            <div class="leftSide">
                <embed :src="variant.file" />
            </div>
            <form @submit.prevent="submit">
                <div>
                    <input
                        v-if="mainStore.userData.role_id != 1"
                        type="text"
                        v-for="(el, index) in variant.answers"
                        v-model="answersData[index]"
                        :placeholder="'Задание ' + (index + 1)"
                        required
                        :key="index"
                    />
                    <input
                        v-if="mainStore.userData.role_id == 1"
                        type="text"
                        v-for="(el, index) in variant.answers"
                        :value="el"
                        :placeholder="'Задание ' + (index + 1)"
                        readonly
                        :key="index"
                    />
                </div>
                <div v-if="mainStore.userData.role_id != 1" class="timer">
                    {{ formattedTime }}
                </div>
                <!-- Вывод таймера -->
                <input
                    type="submit"
                    v-if="mainStore.userData.role_id != 1"
                    value="Отправить"
                    class="button"
                />
            </form>
        </div>
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
        const variant = this.mainStore.variantsData[this.id];
        const answersData = new Array(variant.answers.length).fill("");
        return {
            variant: variant,
            answersData: answersData,
            timerSeconds: 3500,
        };
    },
    props: {
        id: {
            type: Number,
        },
    },
    mounted() {
        this.startTimer();
    },
    methods: {
        async submit() {
            // Проверяем, есть ли пустые поля
            const filledAnswers = this.answersData.map((answer) =>
                answer.trim() !== "" ? answer : "Не ответил"
            );

            await fetch("api/examination", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify({
                    answersData: filledAnswers,
                    variantId: this.variant.id,
                    userId: this.mainStore.userData["id"],
                }),
            }).then((response) => {
                response.json();
            });

            this.$router.push({
                name: "resultScreen",
            });

            let resultData = {
                userAnswers: filledAnswers,
                variantId: this.variant.id,
            };
            this.mainStore.addUserAnswers(resultData);
            console.log(this.mainStore.result);
        },
        startTimer() {
            let timerInterval = setInterval(() => {
                this.timerSeconds--;
                if (this.timerSeconds <= 0) {
                    clearInterval(timerInterval);
                    this.submit(); // автоматическая отправка формы после завершения таймера
                }
            }, 1000);
        },
    },
    computed: {
        formattedTime() {
            const minutes = Math.floor(this.timerSeconds / 60);
            const seconds = this.timerSeconds % 60;
            return `${minutes}:${seconds < 10 ? "0" : ""}${seconds}`;
        },
    },
};
</script>

<style scoped>
h2 {
    margin: 30px 0px;
    text-align: center;
    color: rgb(0, 0, 0);
}
.testBlock {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    width: 80%;
    margin: auto;
}
.leftSide {
    width: 50%;
    color: white;
}
.leftSide embed {
    width: 100%;
    height: 80vh;
}
form {
    padding-top: 50px;
    text-align: center;
    width: 50%;
    height: 80vh;
}
form input {
    margin: 10px;
    padding: 5px;
    outline: none;
    border: none;
    border-bottom: 2px solid #aac6fc;
}

.timer {
    text-align: center;
    font-size: 20px;
    color: white;
    padding: 10px;
    border-radius: 5px;
    background-color: #aac6fc;
    width: 200px;
    margin: 20px auto;
}
.button {
    background-color: rgb(5, 158, 107);
    border: none;
    padding: 10px;
    color: white;
    border-radius: 10px;
}
</style>
