<template>
   <main class="container">
      <div v-if="post">
         <h1>Titolo</h1>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam, quasi!</p>
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
      
   },
   methods: {
      getPost()
   }
}
</script>

<style>

</style>