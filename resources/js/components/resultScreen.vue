<template>
    <div class="resultBlock">
        <h1>Ваши результаты</h1>
        <div class="answersBlock">
            <div v-for="(element, index) in result" :key="index" :class="[compareAnswers(element, variantAnswers[index]) ? 'right' : 'error']">
                <span>Задание №{{ index + 1 }}</span>
                <br>Ваш ответ: {{ element }}
                <br>Верный ответ: {{ variantAnswers[index] }}
            </div>
        </div>
    </div>
</template>

<script>
import { useMainStore } from '../stores/main';

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
            return this.mainStore.variantsData[variantId].answers;
        }
    },
    methods: {
        compareAnswers(userAnswer, correctAnswer) {
            return userAnswer === correctAnswer;
        }
    }
}
</script>

<style scoped>
h1 {
    color: rgb(255, 255, 255);
}

.resultBlock {
    padding-top: 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.answersBlock {
    background-color: white;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    width: 600px;
    padding: 10px;
    border-radius: 5px;
}

.answersBlock div {
    margin: 10px;
    color: black;
    padding: 5px;
    border-radius: 5px;
    font-size: 16px;
    width: 160px;
}

.right {
    background-color: darkcyan;
}

.error {
    background-color: red;
}
</style>
