<template>
   <main class="container blog">

      <div v-if="posts">
         <article 
            v-for="post in posts"
            :key="`post${post.id}`"
         >
            <h2><a href="">{{ truncatesTextAt(post.title, 20) }}</a></h2>
            <p v-if="post.category">{{ post.category.name }}</p>
            <div class="tags">
               <span 
                  v-for="(tag, index) in post.tags"
                  :key="index"
                  class="tag"
               >{{ tag.name }}</span>
            </div>
            <span class="date">{{ getDatePost(post.created_at) }}</span>
            <p>{{ truncatesTextAt(post.content, 50) }}</p>
         </article>

         <div class="navigation">
            <button 
               @click="getPosts(pagination.current - 1)"
               :disabled="pagination.current === 1"
               class="btn"
               :class="{ active: pagination.current !== 1 }"
            >Prev</button>
            <button 
               v-for="indexPage in pagination.last"
               :key="'page' + indexPage"
               @click="getPosts(indexPage)"
               :disabled="indexPage === pagination.current"
               class="btn"
               :class="{ active: indexPage !== pagination.current }"
            >{{ indexPage }}</button>
            <button 
               @click="getPosts(pagination.current + 1)"
               class="btn"
               :class="{ active: pagination.current !== pagination.last }"
               :disabled="pagination.current === pagination.last"
            >Next</button>
         </div>
      </div>

      <Loading v-else />
      
   </main>
</template>

<script>
import Loading from './Loading.vue'

export default {
   name: 'Posts',
   components: { Loading },
   mounted() {
      this.getPosts();
   },
   data() {
      return {
         apiUrl: 'http://127.0.0.1:8000/api/posts?page=',
         posts: [],
         pagination: {},
      }
   },
   methods: {

      getPosts(page = 1) {
         this.posts = null
         axios.get(this.apiUrl + page)
            .then(response => {
               this.posts = response.data.data;
               this.pagination = {
                  current: page,
                  last: response.data.last_page,
               }
            })
      },

      truncatesTextAt(text, numberChars) {
         if (text.length > numberChars) {
            return text.substr(0, numberChars) + ' ...';
         }
         return text;
      },

      getDatePost(dateString) {
         const date = new Date(dateString);
         let day = date.getDate();
         let month = date.getMonth() + 1;
         let year = date.getFullYear();
         
         if (day < 10) day = '0' + day;
         if (month < 10) month = '0' + month;

         return `${day}/${month}/${year}`
      },
   }
}
</script>

<style lang="scss">

</style>