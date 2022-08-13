<script setup>
import { onMounted, ref } from 'vue';

const props = defineProps({
    id:Number,
    title:String,
    user:String
})

const comments = ref([])

const isCommentsOpen = ref(false)

const toggle = () =>{
    isCommentsOpen.value = !isCommentsOpen.value
}

onMounted(()=>{
fetch('https://jsonplaceholder.typicode.com/posts/'+ props.id +'/comments').then(res => res.json()).then(data => {
    comments.value = data,
    console.log(data)
})
})
</script>


<template>
    <div class="post">
        <h3>{{ title }}</h3>
        <slot></slot>
        <small>Posted By : {{ user }}</small>

        <div>
            <button @click="toggle">Open Comment</button>
        </div>
        
        
        <div class="comments" v-show="isCommentsOpen">
            <div class="comment" v-for="comment in comments" :key="comment.id">
                <h5>{{ comment.name }}</h5>
                <p>{{ comment.body }}</p>
            </div>
        </div>
    </div>
</template>

<style>
.comments{
    padding-left: 3rem;
}

.comments h5{
    margin: 0;
}

</style>