<script setup>
defineProps({
  headings: {
    type: Array,
    required: true,
  },
});
// let headings = ['No', 'Nama', 'Harga', 'Action']
</script>

<template>
  <table class="border-collapse border border-black-100 w-full my-5">
    <thead class="bg-gray-100">
      <tr>
        <th v-for="(heading, i) in headings" :key="i" class="border border-black-100 p-2">
          {{ heading }}
        </th>
      </tr>
    </thead>
    <tbody>
      <slot />
    </tbody>
  </table>
</template>
