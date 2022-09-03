import { defineStore } from 'pinia'
import { ref } from 'vue'
import axios from 'axios'
import router from '../router'

export const useUserStore = defineStore('user', () => {
    const user = ref({})
    const isLoggedIn = ref(false)
    const token = ref('')
    const submitLogin = (username, password) => {
        // Proses submit login
        let dataYangDikirim = {
            username: username,
            password: password,
        }
        
        axios.post("/auth/login", dataYangDikirim)
            .then(res => {
                // sukses login
                let dataUser = res.data.data.user;
                let userName = dataUser.name;
                localStorage.setItem('user', JSON.stringify(dataUser))
                localStorage.setItem('token', res.data.data.access_token)
                isLoggedIn.value = true
                alert(`Selamat datang ${userName}`);
    
                router.push('/')
            })
            .catch(err => {
                // gagal login
                console.log(err);
                alert('Username atau password salah')
            });
    }
    return {
        user,
        isLoggedIn,
        token,
        submitLogin
    }
})