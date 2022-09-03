<script setup>
defineProps({
    color: String 
})
</script>
<template>
    <div :class="`alert alert-${color}`">
        <slot></slot>
    </div>
</template>
<style> 
    .alert {
        padding: .5rem;
        border-radius: .3rem;
    }
    .alert-blue {
        border: 1px solid #084298;
        background: #cfe2ff;
    }
    .alert-red {
        border: 1px solid red;
        background:  rgb(254, 170, 170);
    }
</style>