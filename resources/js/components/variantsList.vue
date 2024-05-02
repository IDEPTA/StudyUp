<template>
    <div>
        <VariantBlock v-for="(el, index) in variants" :key="index" :variant="el" :index="index"/>
    </div>
</template>
<script>
import { useMainStore } from '../stores/main';
import VariantBlock from './variantBlock.vue';

export default {
    setup() {
        const mainStore = useMainStore();
        return {
            mainStore,
        };
    },
    data() {
        return {
            variants: '',
            message: ""
        }
    },
    async mounted() {
        await fetch("api/variants", {
            method: "GET",
            headers: {
                Accept: "application/json",
            }
        }).then(response => response.json())
            .then(data => {
                data.data.map(el =>{
                    el.answers = JSON.parse(el.answers);
                    el.created_at = el.created_at.slice(0,10);
                    return el;
                });
                console.log(data);
                this.mainStore.addVariants(data.data)
                this.variants = data.data;
                this.message = data.msg;
            });
    },
    components:{
        VariantBlock
    }
}
</script>
<style>
p {
    color: aliceblue;
}
</style>