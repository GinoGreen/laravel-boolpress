<template>
   <header>
      <ul>
         <li><router-link :to="{ name: 'home' }">Home</router-link></li>
         <li><a class="active" href="">Blog</a></li>
         <li><router-link :to="{ name: 'about' }">Chi Siamo</router-link></li>
         <li><router-link :to="{ name: 'contacts' }">Contatti</router-link></li>
      </ul>
   </header>
</template>

<script>
export default {
   name: 'Header'
}
</script>

<style lang="scss">

</style>