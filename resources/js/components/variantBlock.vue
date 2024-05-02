<template>
    <router-link :to="{
        name:'variantFull',
        params:{id:index}
    }">
        <h3>{{ variant.subject }} №{{ variant.id }} </h3>
        <p>От {{ variant.created_at }}</p>
    </router-link>
</template>
<script>
export default{
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
<style></style>