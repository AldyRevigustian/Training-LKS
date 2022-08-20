import { createRouter, createWebHistory } from 'vue-router'
import Home from './pages/Home.vue'
import Product from './pages/Product.vue'
import Transaction from './pages/Transaction.vue'

export default createRouter({
    history : createWebHistory(),
    routes: [
        {
            path: '/',
            component: Home
        },
        {
            path: '/products',
            component: Product
        },
        {
            path: '/transaction',
            component: Transaction
        },
    ]
})