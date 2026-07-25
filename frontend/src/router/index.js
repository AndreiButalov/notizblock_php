import { createRouter, createWebHistory } from 'vue-router'
import NotizblockContent from '../views/NotizblockContent.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'notizblock',
      component: NotizblockContent,
    },
  ],
})

export default router
