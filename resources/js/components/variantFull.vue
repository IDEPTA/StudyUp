<template>
    <h2>{{ variant.subject }} №{{ variant.id }}</h2>
    <div class="testBlock">
        <div class="leftSide">
            <embed :src="variant.file">
        </div>
        <form @submit.prevent="submit">
            <div>
                <input type="text" v-for="(el, index) in variant.answers" v-model="answersData[index]"
                    :placeholder="'Задание ' + (index + 1)" required :key="index">
            </div>
            <input type="submit" value="Отправить" class="button">
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
            await fetch("api/examination", {
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
            })
            this.$router.push({
                name: "resultScreen",
            })
            let resultData = {
                "userAnswers": this.answersData,
                "variantId": this.variant.id-1
            }
            this.mainStore.addUserAnswers(resultData)
            console.log(this.mainStore.result);

        }
    }
}
</script>
<style scoped>
h2{
    margin: 30px 0px;
    text-align: center;
    color: white;
}
.testBlock {
    display: flex;
    justify-content: center;

    flex-wrap: wrap;
    width: 80%;
    margin: auto;
}
.leftSide{
    width: 50%;
    color: white;
}
.leftSide embed{
    width: 100%;
    height: 80vh;
}

form{
    padding-top: 50px;
    text-align: center;
    width: 48%;
    height: 80vh;
}
form input{
    margin: 10px;
    padding: 5px;
    outline: none;
    border: none;
    border-radius: 5px;

}
.button{
    background-color: rgb(5, 158, 107);
    border: none;
    padding: 10px;
    color: white;
    border-radius: 10px;
}
</style>