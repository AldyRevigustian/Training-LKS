<script setup>
import { onMounted, ref } from "vue";
import Post from "./components/Post.vue";
let posts = ref([])

onMounted(() => {
    fetch('https://jsonplaceholder.typicode.com/posts').then(res => res.json()).then(data => {
    posts.value = data,
    console.log(data)
})
})

</script>

<template>
<div class="post-container">
    <Post  class="post" :title="post.title" :user="post.userId" :id="post.id" v-for="post in posts" :key="post.id">
    {{ post.body }}
   
    </Post>
</div>
</template>

<style>
/* .post-container{
    display: flex;
} */

.post{
    padding: .3rem;
    width: 100%;
}
</style>