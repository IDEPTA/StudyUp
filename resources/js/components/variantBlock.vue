<template>
    <div class="variantBlock">
        <router-link :to="{
            name: 'variantFull',
            params: { id: index }
        }" class="variantBlock">
            <h3>{{ variant.subject }} №{{ variant.id }} </h3>
            <p>От {{ variant.created_at }}</p>
        </router-link>
    </div>
</template>
<script>
export default {
    props: {
        variant: {
            type: Object,
            required: true
        },
        index: {
            type: Number,
            required: true
        }
    }
}
</script>
<style scoped>
.variantBlock {
    text-decoration: none;
    padding: 0px 15px;
    margin: 5px;
    background-color: white;
    color: rgb(0, 0, 0);
    width: 250px;
}
</style>