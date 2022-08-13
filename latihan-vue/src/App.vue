<script setup>
import { ref } from 'vue';
import Card from './components/Card.vue';

const users = ref([
    {
        id:1,
        kelas:'RPL',
        name: "Fira",
        nis:12334
    },
    {
        id:2,
        kelas:'BDP',
        name: "Mega",
        nis:12334
    },
    {
        id:3,
        kelas:'AKL',
        name: "Budi",
        nis:12334
    },
])

const deleteUser = (index) =>{
    users.value.splice(index,1)
}

const addName = ref('')
const addKelas = ref('')
const addNis = ref(0)

const adduser = () => {
    users.value.push({
        id: users.value.length,
        name:addName.value,
        kelas:addKelas.value,
        nis:addNis.value
    });
}
</script>

<template>
<form class="form" @submit.prevent="adduser">
    <label for="name">Nama</label>
    <input type="text" name="name" v-model="addName">
    <label for="kelas">Kelas</label>
    <input type="text" name="kelas" v-model="addKelas">
    <label for="nis">NIS</label>
    <input type="text" name="nis" v-model="addNis">
    <button> Submit</button>
</form>

<div class="card-container">
    <Card v-for="(user, index) in users " :key="user.id" :title="user.name" >
    <ul>
        <li>Id : {{ user.id }}</li>
        <li>Nama : {{ user.name }}</li>
        <li>Kelas : {{ user.kelas }}</li>
        <li>NIS : {{ user.nis }}</li>
    </ul>

    <button>Edit</button>
    <button @click="deleteUser(index)">Delete</button>
    </Card>
</div>
</template>

<style>
.card-container{
    display: flex;
    gap: 1rem;
}

.form{
    widows: 400px;
    margin: 3rem 0;
}

.form input {
    width: 100%;
    margin-bottom: 1rem;
}
</style>
