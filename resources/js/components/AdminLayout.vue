<template>
    <div class="min-h-screen flex flex-col bg-gray-50">
        <!-- Navbar -->
        <nav class="flex items-center justify-between bg-white shadow px-4 md:px-8 h-16 fixed w-full z-50">
            <div class="flex items-center space-x-3">
                <!-- Hamburger menu for mobile -->
                <button class="md:hidden flex items-center justify-center p-2 rounded hover:bg-orange-100 focus:outline-none" @click="toggleSidebar">
                    <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <img :src="logo" alt="Logo" class="h-10 w-10 rounded bg-orange-100 p-1" />
                <span class="font-bold text-orange-700 text-xl tracking-wide">Admin Panel</span>
            </div>
            <div class="flex items-center space-x-4 relative">
                <button @click="dropdownOpen = !dropdownOpen" class="flex items-center space-x-2 px-2 py-1 m-0 cursor-pointer">
                    <img :src="userImg" alt="User" class="h-9 w-9 rounded-full border-2 border-orange-200 shadow" />
                    <div class="text-left">
                        <div class="font-semibold text-gray-800 leading-tight">Nion Roy Test</div>
                        <div class="text-xs text-gray-500 leading-tight">Customer Support</div>
                    </div>
                    <svg class="h-4 w-4 text-gray-400 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <!-- Dropdown -->
                <div v-if="dropdownOpen" class="absolute left-0 mt-2 w-48 bg-white rounded-xl shadow-xl z-50 border border-gray-100" style="top: 100%; min-width: 12rem;">
                    <a href="#" class="flex items-center gap-2 px-4 py-2 text-gray-700 hover:bg-orange-50 transition rounded-t-xl">
                        <!-- Settings Icon -->
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.25 2.25c.414 0 .75.336.75.75v1.5a.75.75 0 01-1.5 0v-1.5c0-.414.336-.75.75-.75zm6.364 2.136a.75.75 0 011.06 1.06l-1.06 1.06a.75.75 0 11-1.06-1.06l1.06-1.06zm4.136 7.614a.75.75 0 01-.75.75h-1.5a.75.75 0 010-1.5h1.5a.75.75 0 01.75.75zm-2.136 6.364a.75.75 0 01-1.06 1.06l-1.06-1.06a.75.75 0 111.06-1.06l1.06 1.06zm-7.614 4.136a.75.75 0 01-.75-.75v-1.5a.75.75 0 011.5 0v1.5c0 .414-.336.75-.75.75zm-6.364-2.136a.75.75 0 01-1.06-1.06l1.06-1.06a.75.75 0 111.06 1.06l-1.06 1.06zm-4.136-7.614a.75.75 0 01.75-.75h1.5a.75.75 0 010 1.5h-1.5a.75.75 0 01-.75-.75zm2.136-6.364a.75.75 0 011.06-1.06l1.06 1.06a.75.75 0 11-1.06 1.06l-1.06-1.06zM12 7.5a4.5 4.5 0 100 9 4.5 4.5 0 000-9z" />
                        </svg>
                        <span>Settings</span>
                    </a>
                    <div class="my-1"></div>
                    <button @click="showLogoutConfirm = true; dropdownOpen = false" class="flex items-center gap-2 w-full text-left px-4 py-2 text-red-600 hover:bg-orange-50 transition rounded-b-xl cursor-pointer">
                        <!-- Logout Icon -->
                        <svg class="h-5 w-5 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </div>
                <!-- Logout Confirmation Modal -->
                <div v-if="showLogoutConfirm" class="fixed inset-0 z-50 flex items-center justify-center bg-black/20 backdrop-blur-sm">
                    <div class="bg-white rounded-xl shadow-xl p-6 w-80 max-w-full text-center">
                        <div class="flex flex-col items-center">
                            <svg class="h-12 w-12 text-orange-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                            </svg>
                            <h3 class="font-semibold text-lg mb-1">Confirm Logout</h3>
                            <p class="text-gray-600 mb-4">Are you sure you want to logout?</p>
                        </div>
                        <div class="flex justify-center gap-3 mt-2">
                            <button @click="confirmLogout" class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded transition cursor-pointer">Yes, Logout</button>
                            <button @click="showLogoutConfirm = false" class="bg-gray-200 hover:bg-gray-300 text-gray-700 px-4 py-2 rounded transition cursor-pointer">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="relative flex flex-1">
            <!-- Sidebar for desktop -->
            <aside class="bg-white shadow h-screen flex flex-col py-6 px-2 w-56">
                <router-link to="/dashboard" class="flex items-center mb-2 px-3 py-2 mt-14 rounded font-medium transition" active-class="bg-orange-100 text-orange-700 border-l-4 border-orange-500">
                    <!-- Box Icon -->
                   <svg class="h-5 w-5 mr-2 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7m-9 2v6m0 0h4m-4 0a2 2 0 01-2-2V7m0 0L3 12m0 0v6a2 2 0 002 2h3m10-2a2 2 0 002-2v-6m0 0l-2-2" />
                    </svg>
                    Dashboard
                </router-link>

                <router-link to="/product" class="flex items-center mb-2 px-3 py-2 rounded font-medium transition" active-class="bg-orange-100 text-orange-700 border-l-4 border-orange-500">
                    <!-- Box Icon -->
                    <svg class="h-5 w-5 mr-2 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 16V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2h14a2 2 0 002-2z" />
                    </svg>
                    Products
                </router-link>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-4 md:p-8 mt-16 md:mt-0">
                <slot />
            </main>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeUnmount, watch } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
import logo from '../assets/logo.png'
import { useToast } from 'vue-toastification'
const userImg = 'https://ui-avatars.com/api/?name=User&background=F59E42&color=fff'

const router = useRouter()
const sidebarOpen = ref(false)
const dropdownOpen = ref(false)
const showLogoutConfirm = ref(false)

const toast = useToast()

const toggleSidebar = () => {
    sidebarOpen.value = !sidebarOpen.value
}
const closeSidebar = () => {
    sidebarOpen.value = false
}

// Lock body scroll when sidebar is open on mobile
watch(sidebarOpen, (val) => {
    if (val) {
        document.body.style.overflow = 'hidden'
    } else {
        document.body.style.overflow = ''
    }
})

const logout = async () => {
    try {
        await axios.post('/logout', {}, {
            headers: {
                Authorization: `Bearer ${localStorage.getItem('token')}`
            }
        })
    } catch (e) { }
    localStorage.removeItem('token')
    toast.success('Logout successful!')
    router.push('/login')
}

const confirmLogout = () => {
    showLogoutConfirm.value = false
    logout()
}
// Close dropdown on click outside
const handleClick = (e) => {
    if (!e.target.closest('.relative')) {
        dropdownOpen.value = false
    }
}
onMounted(() => {
    window.addEventListener('click', handleClick)
})
onBeforeUnmount(() => {
    window.removeEventListener('click', handleClick)
    document.body.style.overflow = ''
})
</script>