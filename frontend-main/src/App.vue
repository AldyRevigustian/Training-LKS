<script setup>
import { ref } from 'vue'
import Navbar from './components/Navbar.vue'
import Alert from "./components/Alert.vue"

let counter = ref(0)

function tambahCounter() {
  counter.value++
}
</script>

<template>
  <Navbar></Navbar>
  <router-view></router-view>
</template>

<style scoped>
</style>