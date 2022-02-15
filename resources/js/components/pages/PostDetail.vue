<template>
   <main class="container">
      <div class="post" v-if="post">
         <h1>{{ post.title }}</h1>
         <h4 class="category" v-if="post.category">
            <span>{{ post.category.name }}</span>
         </h4>
         <div v-if="post.tags" class="tags">
            <span 
               v-for="(tag, index) in post.tags"
               :key="index"
               class="tag"
            >{{ tag.name }}</span>
         </div>
         <div class="img-box">
            <img :src="post.cover" :alt="post.title">
         </div>
         <p>{{ post.content }}</p>
      </div>
      <Loading v-else />
   </main>
</template>

<script>
import Loading from '../Loading.vue'
export default {
   name: 'PostDetail',
   components: { Loading },
   data() {
      return {
         apiUrl: 'http://127.0.0.1:8000/api/posts/',
         post: null,
      }
   },
   mounted() {
      this.getPost();
   },
   methods: {
      getPost() {
         axios.get(this.apiUrl + this.$route.params.slug)
            .then(response => {
               this.post = response.data;
            });
      }
   }
}
</script>

<style>

</style>