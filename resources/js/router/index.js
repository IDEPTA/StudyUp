import { createMemoryHistory, createRouter } from 'vue-router'
import loginForm from "../components/loginForm.vue";
import registerForm from "../components/registerForm.vue";
const routes = [
    {
        path: '/loginForm',
        component:loginForm,
    },
    {
        path: "/registerForm",
        component:registerForm,
    }
]

const router = createRouter({
  history: createMemoryHistory(),
  routes,
})
export default router;