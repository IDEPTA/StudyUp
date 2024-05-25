<template>
    <div class="variantBlock">
        <router-link
            :to="{
                name: 'variantFull',
                params: { id: index },
            }"
            class="variantBlock"
        >
            <h3>{{ variant.subject }} №{{ variant.id }}</h3>
            <p>От {{ variant.created_at }}</p>
        </router-link>
        <p
            class="btn btn-danger"
            v-if="role_id == 1"
            @click="deleteVariant(variant.id)"
        >
            Удалить
        </p>
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
    props: {
        variant: {
            type: Object,
            required: true,
        },
        index: {
            type: Number,
            required: true,
        },
        role_id: {
            type: Number,
            required: true,
        },
    },
    methods: {
        async deleteVariant(id) {
            const url = "api/variants/" + id;
            await fetch(url, {
                method: "DELETE",
                headers: {
                    accept: "applications/json",
                },
            }).then((response) => {
                if (response.ok) {
                    this.mainStore.deleteVariant(id);
                }
            });
            console.log("!");
            this.mainStore.deleteVariant(id);
        },
    },
};
</script>
<style scoped>
.variantBlock {
    text-decoration: none;
    padding: 0px 15px;
    margin: 5px;
    background-color: #aac6fc;
    border-radius: 5px;
    color: rgb(0, 0, 0);
    width: 250px;
}
</style>
