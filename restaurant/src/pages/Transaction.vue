<script setup>
import { ref } from "vue";
import Card from "../components/Card.vue";
import Table from "../components/Table.vue";
import TableData from "../components/TableData.vue";
import Button from "../components/Button.vue";
import { useStore } from "../store/foods";

let isFormAddShow = ref(false);
let addName = ref("");
let addPrice = ref(0);

let store = useStore();
let transactions = store.transactions;

function submitItem() {
  if (addName.value == "") return alert("Nama Tidak Boleh Kosong");
  if (!addPrice.value) return alert("Harga Tidak Boleh Kosong");
  store.addFood(addName.value, addPrice.value);
  isFormAddShow.value = false;
}
</script>

<template>
  <div class="container mx-auto">
    <h1 class="font-bold text-2xl mb-3">Transaction</h1>
    <Card>
      <template #card-header> Daftar transaksi </template>
      <template #card-body>
        <Button class="bg-blue-500" @click="isFormAddShow = !isFormAddShow"
          >Add Product</Button
        >
        <form v-on:submit.prevent="submitItem" v-show="isFormAddShow" class="mt-5">
          <div>
            <label for="nama">Nama</label>
            <input
              class="w-full border border-grey-300 rounded-sm mb-3 p-2"
              type="text"
              name="nama"
              placeholder="Nama Makanan"
              v-model="addName"
            />
          </div>

          <div>
            <label for="harga">Harga</label>
            <input
              class="w-full border border-grey-300 rounded-sm mb-3 p-2"
              type="number"
              name="harga"
              id="harga"
              v-model="addPrice"
            />
          </div>
          <Button class="bg-blue-500">Submit</Button>
        </form>
        <Table :headings="['Id', 'Customer', 'Produk', 'Quantity', 'Action']">
          <tr v-for="(t, index) in transactions" :key="index">
            <TableData class="text-center">{{ index + 1 }}</TableData>
            <TableData>{{ t.name }}</TableData>
            <TableData>{{ t.food }}</TableData>
            <TableData>{{ t.quantity }}</TableData>
            <!-- <TableData>{{ t.price }}</TableData> -->
            <!-- <TableData>Rp. {{ t.price }}</TableData> -->
            <TableData class="text-center w-[200px]">
              <Button class="bg-green-500 mx-2"> Edit </Button>
              <Button class="bg-red-500"> Delete </Button>
            </TableData>
          </tr>
        </Table>
      </template>
    </Card>
  </div>
</template>
