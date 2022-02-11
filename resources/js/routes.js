import Vue from 'vue';
import VueRouter from 'vue-router';
import Home from './components/pages/Home';
import Posts from './components/Posts';
import About from './components/pages/About';
import Contacts from './components/pages/Contacts';
import PostDetail from './components/pages/PostDetail';

Vue.use(VueRouter);

const router = new VueRouter({
   mode: 'history',
   linkExactActiveClass: 'active',
   
   routes: [
      {
         path: '/',
         name: 'home',
         component: Home,
      },
      {
         path: '/blog',
         name: 'blog',
         component: Posts,
      },
      {
         path: '/chi-siamo',
         name: 'about',
         component: About,
      },
      {
         path: '/contatti',
         name: 'contacts',
         component: Contacts,
      },
      {
         path: '/detail/:slug',
         name: 'detail',
         component: PostDetail,
      },
   ],
});

export default router;