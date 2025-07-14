import { createApp } from 'vue'
import App from './App.vue'
import Login from './components/Login.vue'
import Dashboard from './components/Dashboard.vue'
import Unauthorized from './components/Unauthorized.vue'
import NotFound from './components/NotFound.vue'
import { createRouter, createWebHistory } from 'vue-router'
import { isLoading } from './loading'
import Toast from 'vue-toastification'
import 'vue-toastification/dist/index.css'

const routes = [
  { path: '/login', component: Login },
  { path: '/dashboard', component: Dashboard, meta: { requiresAuth: true } },
  { path: '/401', component: Unauthorized },
  { path: '/:pathMatch(.*)*', component: NotFound },
  { path: '/', redirect: '/login' }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  isLoading.value = true
  const token = localStorage.getItem('token')

  // If already logged in, redirect from /login to /dashboard
  if (to.path === '/login' && token) {
    isLoading.value = false
    return next('/dashboard')
  }

  // If route requires auth and not logged in, redirect to /401
  if (to.meta.requiresAuth && !token) {
    isLoading.value = false
    return next('/401')
  }

  next()
})

router.afterEach(() => {
  setTimeout(() => {
    isLoading.value = false
  }, 500)
})

const app = createApp(App)
app.use(router)
app.use(Toast, {
  position: 'bottom-center'
})
app.mount('#app')
