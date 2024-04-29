import { createMemoryHistory, createRouter } from "vue-router";
import loginForm from "../components/loginForm.vue";
import registerForm from "../components/registerForm.vue";
import variantAddForm from "../components/variantAddForm.vue";

const routes = [
    {
        path: "/loginForm",
        component: loginForm,
    },
    {
        path: "/registerForm",
        component: registerForm,
    },
    {
        path: "/variantAddForm",
        component: variantAddForm,
    },
];

const router = createRouter({
    history: createMemoryHistory(),
    routes,
});
export default router;
