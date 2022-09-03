<script setup>
import Card from "./../../components/Card.vue";
import { ref } from "vue";
import { useRouter } from 'vue-router'
import axios from "axios";
import { useUserStore } from './../../store/user'

const username = ref("");
const password = ref("");
const { submitLogin } = useUserStore()
let router = useRouter()

const submit = () => submitLogin(username.value, password.value)
</script>

<template>
    <div class="auth">
        <Card>
            <h3>Login</h3>
            <form @submit.prevent="submit">
                <div>
                    <label>Username</label>
                    <input type="text" v-model="username" />
                    <!-- <p>Anda mengetik: {{ username }}</p> -->
                </div>
                <div>
                    <label>Password</label>
                    <input type="password" v-model="password" />
                    <!-- <p>Anda mengetik: {{ password }}</p> -->
                </div>
                <button type="submit">Submit</button>
            </form>
        </Card>
    </div>
</template>
