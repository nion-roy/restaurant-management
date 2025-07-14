<template>
    <div>
        <Preloader v-if="isLoading" />
        <router-view />
    </div>
</template>

<script setup>
import Preloader from './components/Preloader.vue'
import { isLoading } from './loading'
</script>