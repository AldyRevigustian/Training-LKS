import { defineStore } from "pinia";
import { ref } from "vue";

export const useStore = defineStore("food", () => {
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
  ])

  const addFood = (name,price) =>{
    foods.value.push({
      name, price
    })
  }

  let transactions = ref([
    {
      name: 'Ahmad',
      food: 'Nasi Uduk',
      price: 15000,
      quantity: 2
    },
    {
      name: 'Adi',
      food: 'Nasi Kuning',
      price: 20000,
      quantity: 1
    }
  ])

  function createTransaction(name,food,price,quantity){
    transactions.push({name,food,price,quantity})
  }

  return {
    foods,
    addFood,
    transactions,
    createTransaction
  }
});
