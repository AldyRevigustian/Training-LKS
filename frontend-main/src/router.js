import { createRouter, createWebHistory } from 'vue-router'
import Home from './pages/Home.vue'
import Login from './pages/auth/Login.vue'
import Register from './pages/auth/Register.vue'
import Admin from './pages/Admin.vue'
import auth from './middleware/auth'


const routes = [
    {
        path: '/',
        component: Home
    },
    {
        path: '/auth/login',
        component: Login
    },
    {
        path: '/auth/register',
        component: Register
    },
    {
        path: '/admin',
        component: Admin,
        meta: {
            middleware: auth
        }
    }
]

const router = createRouter({
    routes: routes,
    history: createWebHistory()
})
router.beforeEach((to) => {
    const middleware = to.meta.middleware
    if(middleware) {
        console.log('sudah login');
        return middleware()
    }
})

export default router