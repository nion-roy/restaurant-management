import { createApp } from 'vue'
import App from './App.vue'
import Login from './components/Login.vue'
// Import Dashboard component (create a placeholder if not exists)
import Dashboard from './components/Dashboard.vue'
import { createRouter, createWebHistory } from 'vue-router'
import { isLoading } from './loading'

const routes = [
  { path: '/login', component: Login },
  { path: '/dashboard', component: Dashboard },
  { path: '/', redirect: '/login' }
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

router.beforeEach((to, from, next) => {
  isLoading.value = true
  next()
})

router.afterEach(() => {
  setTimeout(() => {
    isLoading.value = false
  }, 500)
})

const app = createApp(App)
app.use(router)
app.mount('#app')
