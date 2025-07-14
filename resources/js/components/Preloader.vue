<template>
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-white/40 backdrop-blur-sm">
        <div class="relative w-16 h-16 flex items-center justify-center">
            <!-- Dual ring spinner -->
            <span class="block w-12 h-12 border-4 border-orange-400 border-t-transparent border-b-transparent rounded-full animate-spin"></span>
            <!-- Center dot for accent -->
            <span class="absolute w-4 h-4 bg-orange-500 rounded-full shadow-lg"></span>
        </div>
    </div>
</template>

<style scoped>
/* Optional: Enhance the spinner with a gradient or shadow if desired */
</style>