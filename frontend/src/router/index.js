import { createRouter, createWebHistory } from 'vue-router'
import NotizblockContent from '../views/NotizblockContent.vue'
import Imprint from '../views/Imprint.vue'
import PrivacyPolicy from '../views/PrivacyPolicy.vue'
import Notizen from '../views/Notizen.vue'


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'notizen',
      component: Notizen,
    },
    {
      path: '/addNotizen',
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
    {
      path: '/editNotizen/:id',
      name: 'editNotizen',
      component: () => import('@/views/EditNote.vue'),
    },
  ],
})

export default router
