<!--
NOTE: Make sure you have 'vue' and 'axios' installed in your project.
Run: npm install vue axios
-->
<template>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-orange-50 to-yellow-100">
        <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-lg">
            <div class="flex flex-col items-center mb-6">
                <img :src="logo" alt="Restaurant Logo" class="w-16 h-16 mb-2" />
                <h1 class="text-2xl font-bold text-orange-700 mb-1">Welcome to Restaurant Manager</h1>
                <p class="text-gray-500 text-sm">Sign in to continue</p>
            </div>
            <form @submit.prevent="handleLogin" class="space-y-5">
                <div>
                    <label class="block text-gray-700 mb-1" for="email">Email</label>
                    <div class="relative">
                        <input v-model="email" id="email" type="email" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-0 focus:border-gray-200 bg-yellow-50" placeholder="you@example.com" />
                        <span class="absolute right-3 top-2.5 text-gray-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </span>
                    </div>
                </div>
                <div>
                    <label class="block text-gray-700 mb-1 font-medium" for="password">Password</label>
                    <div class="relative">
                        <input v-model="password" :type="showPassword ? 'text' : 'password'" id="password" required class="w-full px-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-0 focus:border-gray-200 bg-yellow-50" placeholder="••••••••" />
                        <button type="button" @click="showPassword = !showPassword" class="absolute right-2 top-1/2 -translate-y-1/2 p-2 text-gray-400 hover:text-orange-500 focus:outline-none" tabindex="-1" aria-label="Toggle password visibility">
                            <svg v-if="showPassword" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-.274.832-.67 1.613-1.17 2.318M15.54 15.54A8.963 8.963 0 0112 17c-4.477 0-8.268-2.943-9.542-7a9.014 9.014 0 012.042-3.338" />
                            </svg>
                            <svg v-else xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.014 9.014 0 012.042-3.338m1.414-1.414A8.963 8.963 0 0112 7c4.477 0 8.268 2.943 9.542 7-.274.832-.67 1.613-1.17 2.318M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input type="checkbox" v-model="remember" class="form-checkbox text-orange-600" />
                        <span class="ml-2 text-gray-600 text-sm">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-orange-600 hover:underline">Forgot password?</a>
                </div>
                <button type="submit" class="w-full py-2 px-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold rounded-lg shadow focus:outline-none focus:ring-2 focus:ring-orange-400 transition-all duration-150">
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

const toast = useToast()

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
        localStorage.setItem('token', response.data.token)
        // Redirect or update app state as needed
        // ...
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