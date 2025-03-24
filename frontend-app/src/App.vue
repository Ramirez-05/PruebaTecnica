<script>
import Nav from './components/Nav.vue'
import AuthNav from './components/AuthNav.vue'
import { useAuthStore } from './store/authStore'

export default {
  name: 'App',
  components: {
    Nav,
    AuthNav
  },
  computed: {
    authStore() {
      return useAuthStore();
    },
    isAuthenticated() {
      return this.authStore.isAuthenticated;
    }
  },
  created() {
    this.authStore.initializeFromStorage();
  }
}
</script>

<template>
  <div class="min-h-screen bg-stone-200 bg-opacity-90 bg-[url('/wood-texture.jpg')] bg-blend-overlay">
    <AuthNav v-if="isAuthenticated" />
    <Nav v-else />
    <main class="relative">
      <router-view></router-view>
    </main>
  </div>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;800&family=Fauna+One&display=swap');

:root {
  --color-leaf: #2D5F2D;
  --color-wood: #8B4513;
  --color-bark: #5D4037;
  --color-moss: #708D23;
  --color-ground: #79553D;
} 
</style>
