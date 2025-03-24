<template>
  <nav class="fixed w-full bg-stone-900 bg-opacity-90 shadow-xl z-50 border-b-4 border-stone-700">
    <div class="container mx-auto px-4">
      <div class="flex justify-between items-center h-16">
        <router-link to="/dashboard" class="flex items-center space-x-2">
          <span class="text-2xl font-bold text-stone-300 font-cinzel tracking-wider">SR</span>
        </router-link>
        
        <div class="hidden md:flex items-center space-x-6">
          <router-link 
            to="/profile" 
            class="nav-link"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
            Perfil
          </router-link>
          
          <button 
            @click="handleLogout" 
            class="nav-link"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            Cerrar Sesión
          </button>
        </div>
        
        <div class="md:hidden">
          <button @click="toggleMobileMenu" class="text-stone-300 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path v-if="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>
    </div>
    
    <div v-if="mobileMenuOpen" class="md:hidden bg-stone-900 bg-opacity-95 border-t border-stone-700">
      <div class="px-4 py-3 space-y-3">
        <router-link 
          to="/profile" 
          class="block text-stone-300 hover:text-white py-2 flex items-center"
          @click="mobileMenuOpen = false"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
          </svg>
          Perfil
        </router-link>
        
        <button 
          @click="handleLogout" 
          class="block text-stone-300 hover:text-white py-2 w-full text-left flex items-center"
        >
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg>
          Cerrar Sesión
        </button>
      </div>
    </div>
  </nav>
</template>

<script>
import { useAuthStore } from '../store/authStore';

export default {
  name: 'AuthNav',
  data() {
    return {
      mobileMenuOpen: false
    };
  },
  computed: {
    authStore() {
      return useAuthStore();
    }
  },
  methods: {
    toggleMobileMenu() {
      this.mobileMenuOpen = !this.mobileMenuOpen;
    },
    handleLogout() {
      this.authStore.logout();
      this.mobileMenuOpen = false;
    }
  }
}
</script>

<style scoped>
.nav-link {
  @apply flex items-center px-3 py-2 rounded-md text-sm font-medium text-stone-300 hover:text-white hover:bg-stone-700 transition-all duration-200 font-fauna;
}
</style> 