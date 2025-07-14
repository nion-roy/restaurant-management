<template>
    <div class="min-h-screen flex flex-col items-center justify-center bg-orange-50">
        <h1 class="text-6xl font-bold text-orange-600 mb-4">401</h1>
        <h2 class="text-2xl font-semibold text-gray-700 mb-2">Unauthorized</h2>
        <p class="text-gray-500 mb-6">You are not authorized to view this page.</p>
        <router-link to="/login" class="px-6 py-2 bg-orange-600 text-white rounded hover:bg-orange-700 transition">Go to Login</router-link>
    </div>
</template>