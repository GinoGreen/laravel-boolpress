<template>
   <main class="container">
      <div v-if="post">
         <h1>{{ post.title }}</h1>
         <h4 v-if="post.category">{{ post.category.name }}</h4>
         <div class="tags">
            <span 
               v-for="(tag, index) in post.tags"
               :key="index"
               class="tag"
            >{{ tag.name }}</span>
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