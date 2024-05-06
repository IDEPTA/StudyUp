import { createMemoryHistory, createRouter } from "vue-router";
import loginForm from "../components/loginForm.vue";
import registerForm from "../components/registerForm.vue";
import variantAddForm from "../components/variantAddForm.vue";
import variantsList from "../components/variantsList.vue";
import variantBlock from "../components/variantBlock.vue";
import variantFull from "../components/variantFull.vue";
import resultScreen from "../components/resultScreen.vue";
import mainScreen from "../components/mainScreen.vue";
const routes = [
    {
        path: "/",
        component: mainScreen,
    },
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
    {
        path: "/variantsList",
        component: variantsList,
    },
    {
        path: "/variantBlock",
        component: variantBlock,
    },
    {
        path: "/variantFull/:id",
        component: variantFull,
        name:"variantFull",
        props:true,
    },
    {
        path:"/resultScreen",
        name:"resultScreen",
        component: resultScreen,
    }
];

const router = createRouter({
    history: createMemoryHistory(),
    routes,
});
export default router;
