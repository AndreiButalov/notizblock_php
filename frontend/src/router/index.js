import { createRouter, createWebHistory } from 'vue-router'
import NotizblockContent from '../views/NotizblockContent.vue'
import Imprint from '../views/Imprint.vue'
import PrivacyPolicy from '../views/PrivacyPolicy.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'notizblock',
      component: NotizblockContent,
    },
    {
      path: '/imprint',
      name: 'imprint',
      component: Imprint,
    },
    {
      path: '/privacy_policy',
      name: 'privacy_policy',
      component: PrivacyPolicy,
    },
  ],
})

export default router
