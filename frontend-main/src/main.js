import { createApp } from 'vue'
import './assets/scss/app.scss'
import App from './App.vue'
import router from './router'
import axios from 'axios'
import { createPinia } from 'pinia'

// Lokasi URL API
axios.defaults.baseURL = "http://localhost:8000/api" 

const app = createApp(App)
app.use(createPinia())
app.use(router)
app.mount('#app2')