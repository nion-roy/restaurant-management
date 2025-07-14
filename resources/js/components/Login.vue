<template>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-50 to-yellow-100">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow space-y-6">
            <div class="flex flex-col items-center mb-6">
                <img :src="logo" alt="Restaurant Logo" class="w-16 h-16 mb-2" />
                <h1 class="text-2xl font-bold text-orange-700 mb-1">Welcome to Restaurant Manager</h1>
                <p class="text-gray-500 text-sm">Sign in to continue</p>
            </div>
            <form @submit.prevent="handleLogin" class="space-y-5">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Username or Email</label>
                    <input v-model="email" id="email" type="email" required class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none bg-yellow-50" placeholder="Enter username or email" />
                </div>
                <div class="relative">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input v-model="password" :type="showPassword ? 'text' : 'password'" id="password" required class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none bg-yellow-50" placeholder="••••••••" />
                    <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-9 text-gray-500 hover:text-orange-600 focus:outline-none" tabindex="-1" aria-label="Toggle password visibility">
                        <svg v-if="!showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.956 9.956 0 012.293-3.95M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 12.414m0 0L6.343 5.343m7.071 7.071l6.364 6.364" />
                        </svg>
                    </button>
                </div>
                <div class="flex items-center">
                    <input id="remember_me" name="remember_me" type="checkbox" v-model="remember" class="h-4 w-4 text-orange-600 border-gray-300 rounded focus:ring-orange-500" />
                    <label for="remember_me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                    <router-link to="/forgot-password" class="ml-auto text-sm text-orange-600 hover:underline">Forgot password?</router-link>
                </div>
                <button type="submit" :disabled="loading" class="w-full py-2 px-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold rounded-lg shadow focus:outline-none transition-all duration-150 cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                    <span v-if="loading">Logging in...</span>
                    <span v-else>Login</span>
                </button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import axios from 'axios'
import logo from '../assets/logo.png'
import { useToast } from 'vue-toastification'
import { useRouter } from 'vue-router'

const toast = useToast()
const router = useRouter()

const email = ref('')
const password = ref('')
const showPassword = ref(false)
const remember = ref(false)
const loading = ref(false)
const error = ref('')

const handleLogin = async () => {
    error.value = ''
    loading.value = true
    try {
        const response = await axios.post('/api/login', {
            email: email.value,
            password: password.value,
            remember: remember.value
        })
        // Save token to localStorage or cookies
        localStorage.setItem('token', response.data.data.token)
        // Show success toast
        toast.success('Login successful!')
        // Redirect to dashboard without reload
        router.push('/dashboard')
    } catch (err) {
        const msg = err.response?.data?.message || 'Login failed. Please try again.'
        error.value = msg
        toast.error(msg)
    } finally {
        loading.value = false
    }
}
</script>

<style scoped>
/* You can add custom styles here if needed */
</style>