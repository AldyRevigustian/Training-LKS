<script setup>
const props = defineProps({
    title: String,
    content: String
})
</script>

<template>
    <div class="card">
        <div class="card-header">
            <h3>{{ title }}</h3>
        </div>
        <div class="card-body">
            <slot></slot>
        </div>
    </div>
</template>

<style>
.card{
    width: 100%;
}
    .card-header{
        padding:.2rem .5rem ;
        background-color: #aaa;

    }
    .card-body{
        padding: 1rem;
        background-color: #ccc;
    }
</style>