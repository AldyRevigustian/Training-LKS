<script setup>
import { ref } from "vue";
import Card from "../components/Card.vue";
import Table from "../components/Table.vue";
import TableData from "../components/TableData.vue";

let foods = ref([
  {
    name: "Nasi Goreng",
    price: 10000,
  },
  {
    name: "Nasi Uduk",
    price: 15000,
  },
  {
    name: "Nasi Kuning",
    price: 20000,
  },
]);
</script>

<template>
  <div class="container mx-auto">
    <h1 class="font-bold text-2xl mb-3">Products</h1>
    <Card>
      <template #card-header> Daftar produk </template>
      <template #card-body>
        <form v-on:submit.prevent="submitItem">
          <div>
            <label for="nama">nama</label>
            <input class="w-full border border-grey-300 rounded-sm mb-2 p-2 " type="text" name="nama" placeholder="Nama Makanan" v-model="addName" />
          </div>

          <div>
            <label for="harga">Harga</label>
            <input class="w-full border border-grey-300 rounded-sm mb-2 p-2 " type="number" name="harga" id="harga" v-model="addPrice" />
          </div>

          <button class="bg-gradient-to-r from-blue-500 to-sky-500 px-3 py-2 text-white rounded-md" type="submit">Submit</button>
        </form>
        <Table>
          <tr v-for="(t, index) in foods" :key="index">
            <TableData class="text-center">{{ index + 1 }}</TableData>
            <TableData>{{ t.name }}</TableData>
            <TableData>Rp. {{ t.price }}</TableData>
            <TableData>Edit Delete</TableData>
          </tr>
        </Table>
      </template>
    </Card>
  </div>
</template>
