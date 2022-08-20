<script setup>
import { computed } from '@vue/reactivity';
import { reactive, ref } from 'vue';

let count = ref(0);
let name = ref("Aku");
let isActive = ref(false)

let person = reactive({
  id : 1,
  nama : 'aldy',
  umur : 20
})

let doubleCount = computed(()=>{
  return count.value * 2
})


let isTransactionSuccess = ref(0)

let TransactionClass = computed(()=>{
  return {'alert': true, 'alert-success':isTransactionSuccess.value == 1,'alert-danger': isTransactionSuccess.value==0 }
})

let isShow = ref(false)




</script>

<template>
  <div class="lorem">
    <!-- <p>Count : {{ count }}</p>
    
    <button v-on:click="count++">click me</button> -->

    <div > 
      <div :class="TransactionClass"  v-show="isShow" :style="{color : isTransactionSuccess ? 'white' : 'black'}" >
        <!-- {{ isTransactionSuccess ? 'Transaksi Sukses' : 'Transaksi Gagal' }} -->
        <p v-if="isTransactionSuccess">
        Transaksi Sukses
        </p>

        <p v-else> Transaksi gagal</p>
      </div>

      <button v-on:click="isTransactionSuccess = !isTransactionSuccess">Submit Transaksi</button>
      <button v-on:click="isShow = !isShow">Show / Hide</button>
    </div>
  </div>
</template>

<style scoped>
  .alert{
    padding: 1rem;
    width: 100%;
    background-color: gray;
  }

  .alert-success{
    background-color: green;
  }

  .alert-danger{
    background-color: red;
  }
</style>
