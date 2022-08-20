<script setup>
import { computed } from "@vue/reactivity";
import { reactive, ref } from "vue";
import UiHeader from "./components/UiHeader.vue";

let count = ref(0);
let name = ref("Aku");
let isActive = ref(false);

let person = reactive({
  id: 1,
  nama: "aldy",
  umur: 20,
});

let doubleCount = computed(() => {
  return count.value * 2;
});

let isTransactionSuccess = ref(0);

let TransactionClass = computed(() => {
  return {
    alert: true,
    "alert-success": isTransactionSuccess.value == 1,
    "alert-danger": isTransactionSuccess.value == 0,
  };
});

let isShow = ref(false);

let transactions = ref([
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

function toggleShow() {
  isShow.value = !isShow.value;
}

let loadingPercent = ref(0);
let loadingText = computed(() => `loading: ${loadingPercent.value}`);

function submitTransaksi() {
  // isTransactionSuccess.value = isTransactionSuccess.value == 1 ? 0 : isTransactionSuccess.value += 0.5

  let addPercent = setInterval(() => {
    if (loadingPercent.value < 100) {
      loadingPercent.value++;
    }
    if (loadingPercent.value == 100) {
      // toggleShow()
      isShow.value = true;
      clearInterval(addPercent);
    }
  }, 10);
}

let addName = ref("");
let addPrice = ref(0);

function submitItem() {
  if (addName.value == "") return alert("Nama Tidak Boleh Kosong");
  if (!addPrice.value) return alert("Harga Tidak Boleh Kosong");

  transactions.value.push({ name: addName.value, price: addPrice.value });
}
</script>

<template>
  <div class="">
    <div>
      <UiHeader></UiHeader>

      <main>
        <router-view></router-view>
      </main>

      <!-- <div class="container mx-auto px-5">
        <div
          :class="TransactionClass"
          v-show="isShow"
          :style="{ color: isTransactionSuccess ? 'white' : 'black' }"
        >
          <p v-if="isTransactionSuccess == 1">Transaksi Sukses</p>
          <p v-else-if="isTransactionSuccess > 0 && isTransactionSuccess < 1">
            Transaksi Di Proses ...
          </p>
          <p v-else>Transaksi gagal</p>
        </div>

        {{ loadingText }}

        <table class="border-collapse border border-black-100 w-full my-5">
          <thead class="bg-gray-100">
            <tr>
              <th class="border border-black-100 p-2 w-[50px]">No</th>
              <th class="border border-black-100 p-2">Nama</th>
              <th class="border border-black-100 p-2">Harga</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(t, index) in transactions" :key="index">
              <td class="border border-black-100 p-2 w-[50px] text-center">
                {{ index + 1 }}
              </td>
              <td class="border border-black-100 p-2">{{ t.name }}</td>
              <td class="border border-black-100 p-2">Rp. {{ t.price }}</td>
            </tr>
          </tbody>
        </table>

        <button v-on:click="submitTransaksi">Submit Transaksi</button>
        <button v-on:click="toggleShow">Show / Hide</button>

        <hr />

        <form v-on:submit.prevent="submitItem">
          <div>
            <label for="nama">nama</label>
            <input type="text" name="nama" placeholder="Nama Makanan" v-model="addName" />
          </div>

          <div>
            <label for="harga">Harga</label>
            <input type="number" name="harga" id="harga" v-model="addPrice" />
          </div>

          <button type="submit">Submit</button>
        </form>
      </div> -->
    </div>
  </div>
</template>

<style scoped>
.alert {
  padding: 1rem;
  width: 100%;
  background-color: gray;
}

.alert-success {
  background-color: green;
}

.alert-danger {
  background-color: red;
}
</style>
