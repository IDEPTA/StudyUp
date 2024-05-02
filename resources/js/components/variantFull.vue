<template>
    <div>
        <h2>{{ variant.subject }}</h2>
        <h3>{{ variant.id }}</h3>
        <embed :src="variant.file">
        <form @submit.prevent="submit">
            <div>
                <input type="text" v-for="(el, index) in variant.answers" v-model="answersData[index]"
                    :placeholder="'Задание ' + (index + 1)" required :key="index">
            </div>
            <input type="submit" value="Отправить">
        </form>
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
        const variant = this.mainStore.variantsData[this.id]
        return {
            variant: variant,
            answersData: []
        }
    },
    props: {
        id: {
            type: Number
        },

    },
    methods: {
        async submit() {
            /*await fetch("api/examination", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                },
                body: JSON.stringify(
                    {
                        "answersData": this.answersData,
                        "variantId": this.variant.id,
                        "userId": this.mainStore.userData['id'],
                    }
                )
            })
                .then(response => {
                    response.json()
                })
                
            this.$router.push({
                name: "resultScreen",
            })*/
            let resultData = {
                "userAnswers": this.answersData,
                "variantId": this.variant.id
            }
            this.mainStore.addUserAnswers(resultData)
            console.log(this.mainStore.result);

        }
    }
}
</script>
<style scoped></style>