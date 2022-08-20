<script setup>
// let headings = ['No', 'Nama', 'Harga', 'Action']
</script>


<template>
  <table class="border-collapse border border-black-100 w-full my-5">
    <thead class="bg-gray-100">
      <tr>
        <th class="border border-black-100 p-2 w-[50px]">No</th>
        <th class="border border-black-100 p-2">Nama</th>
        <th class="border border-black-100 p-2">Harga</th>
        <th class="border border-black-100 p-2">Action</th>
      </tr>
    </thead>
    <tbody>
      <slot/>
    </tbody>
  </table>
</template>
