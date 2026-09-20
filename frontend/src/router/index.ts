import { createRouter, createWebHistory } from 'vue-router'
import Login from '../views/LoginView.vue'
import Feedback from '../views/FeedbackView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect: '/login' // Automatically go to login when opening the app
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/feedback',
      name: 'feedback',
      component: Feedback
    }
  ]
})

export default router