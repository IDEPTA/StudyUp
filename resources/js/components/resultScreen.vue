<template>
    <div class="resultBlock">
        <h1>Ваши результаты</h1>
        <div class="answersBlock">
            <div
                v-for="(element, index) in result"
                :key="index"
                :class="[
                    compareAnswers(element, variantAnswers[index])
                        ? 'right'
                        : 'error',
                ]"
            >
                <span>Задание №{{ index + 1 }}</span>
                <br />Ваш ответ: {{ element }} <br />Верный ответ:
                {{ variantAnswers[index] }}
            </div>
        </div>
        <router-link to="/" class="backButton">На главную</router-link>
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
        return {};
    },
    computed: {
        result() {
            return this.mainStore.result.userAnswers;
        },
        variantAnswers() {
            const variantId = this.mainStore.result.variantId;
            const variantA = this.mainStore.variantsData.filter(
                (el) => el.id == variantId
            )[0].answers;
            return variantA;
        },
    },
    methods: {
        compareAnswers(userAnswer, correctAnswer) {
            return userAnswer === correctAnswer;
        },
    },
};
</script>

<style scoped>
h1 {
    color: rgb(255, 255, 255);
}
.backButton {
    margin: 10px;
    text-decoration: none;
    padding: 5px;
    text-align: center;
    border-radius: 5px;
    color: white;
    background-color: #e0719e;
    width: 200px;
}
.resultBlock {
    background-color: #aac6fc;
    padding-top: 40px;
    margin: 50px auto;
    width: 50%;
    padding: 10px;
    border-radius: 5px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.answersBlock {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.answersBlock div {
    margin: 10px;
    color: rgb(255, 255, 255);
    padding: 5px;
    border-radius: 5px;
    font-size: 16px;
    width: 160px;
    font-weight: 400;
}

.right {
    background-color: #7fd6c2;
}

.error {
    background-color: #e0719e;
}
</style>
