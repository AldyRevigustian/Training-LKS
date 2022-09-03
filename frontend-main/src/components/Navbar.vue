<script setup>
import { onMounted } from "vue-demi"
import { useRouter } from "vue-router"
import { useUserStore } from "../store/user"

const router  = useRouter()
const store = useUserStore()
const logout = () => {
    alert('sukses logout')
    
    store.isLoggedIn = false
    localStorage.removeItem('token')
    localStorage.removeItem('user')

    router.push('/auth/login')
}
onMounted(() => {
    if(localStorage.getItem('token'))  {
        store.isLoggedIn = true
    }
})
</script>
<template>
    <div class="navbar">
        <div class="logo">
            <h1>Selekdash</h1>
        </div> 
        <div class="menu">
            <ul>
                <li>
                    <router-link to="/">Home</router-link>
                </li>
                <li v-if="store.isLoggedIn">
                    <a href="#" @click="logout">Logout</a>
                </li>
                <li v-if="!store.isLoggedIn">
                    <router-link to="/auth/login">Login</router-link>
                </li>
                <li v-if="!store.isLoggedIn">
                    <router-link to="/auth/register">Register</router-link>
                </li>
            </ul>
        </div>
    </div>
</template>
<style lang="scss">
$navbar-bg: white;

.navbar {
    display: flex;
    justify-content: space-between;
    background: $navbar-bg;    

    .logo h1 {
        font-size: 2rem
    }

    .menu ul {
        display: flex;
        list-style: none;
        
        li {
            margin-left: 1rem;

            a {
                text-decoration: none;
                color: darkgray;
                
                &:hover {
                    color: gray;
                }
   
                &.router-link-active {
                    color: blue;
                    font-weight: bold;
                }
            }
        }
    }
}
</style>