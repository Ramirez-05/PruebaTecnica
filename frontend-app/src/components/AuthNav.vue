<template>
  <nav class="bg-stone-800 text-white p-4 fixed w-full z-10">
    <div class="container mx-auto flex justify-between items-center">
      <div class="text-2xl font-bold font-cinzel">
        <span class="text-amber-500">SR</span>
      </div>

      <div class="hidden md:flex space-x-6">
        <template v-if="!isDashboard">
          <router-link 
            v-if="!isAuthenticated" 
            to="/" 
            class="hover:text-amber-400 transition-colors font-fauna"
          >
            Inicio
          </router-link>
        </template>

        <template v-if="isAuthenticated">
          <router-link 
            to="/dashboard" 
            class="hover:text-amber-400 transition-colors font-fauna"
            :class="{'text-amber-400': isDashboard}"
          >
            Dashboard
          </router-link>
          
          <router-link 
            to="/profile" 
            class="hover:text-amber-400 transition-colors font-fauna"
            :class="{'text-amber-400': $route.path === '/profile'}"
          >
            Perfil
          </router-link>
          
          <button 
            @click="logout" 
            class="hover:text-amber-400 transition-colors font-fauna cursor-pointer"
          >
            Cerrar Sesión
          </button>
        </template>

        <template v-else>
          <router-link 
            to="/login" 
            class="hover:text-amber-400 transition-colors font-fauna"
            :class="{'text-amber-400': $route.path === '/login'}"
          >
            Login
          </router-link>
          
          <router-link 
            to="/register" 
            class="hover:text-amber-400 transition-colors font-fauna"
            :class="{'text-amber-400': $route.path === '/register'}"
          >
            Registro
          </router-link>
        </template>
      </div>

      <button @click="toggleMobileMenu" class="md:hidden text-2xl">
        <span v-if="!mobileMenuOpen">☰</span>
        <span v-else>✕</span>
      </button>
    </div>

    <div v-if="mobileMenuOpen" class="md:hidden bg-stone-800 p-4">
      <div class="flex flex-col space-y-3">
        <template v-if="!isDashboard">
          <router-link 
            v-if="!isAuthenticated" 
            to="/" 
            class="hover:text-amber-400 transition-colors font-fauna"
            @click="closeMobileMenu"
          >
            Inicio
          </router-link>
        </template>

        <template v-if="isAuthenticated">
          <router-link 
            to="/dashboard" 
            class="hover:text-amber-400 transition-colors font-fauna"
            :class="{'text-amber-400': isDashboard}"
            @click="closeMobileMenu"
          >
            Dashboard
          </router-link>
          
          <router-link 
            to="/profile" 
            class="hover:text-amber-400 transition-colors font-fauna"
            :class="{'text-amber-400': $route.path === '/profile'}"
            @click="closeMobileMenu"
          >
            Perfil
          </router-link>
          
          <button 
            @click="logoutAndCloseMobile" 
            class="hover:text-amber-400 transition-colors font-fauna text-left cursor-pointer"
          >
            Cerrar Sesión
          </button>
        </template>

        <template v-else>
          <router-link 
            to="/login" 
            class="hover:text-amber-400 transition-colors font-fauna"
            :class="{'text-amber-400': $route.path === '/login'}"
            @click="closeMobileMenu"
          >
            Login
          </router-link>
          
          <router-link 
            to="/register" 
            class="hover:text-amber-400 transition-colors font-fauna"
            :class="{'text-amber-400': $route.path === '/register'}"
            @click="closeMobileMenu"
          >
            Registro
          </router-link>
        </template>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '../store/authStore';

const router = useRouter();
const authStore = useAuthStore();
const mobileMenuOpen = ref(false);

const isAuthenticated = computed(() => authStore.isAuthenticated);
const isDashboard = computed(() => router.currentRoute.value.path === '/dashboard');

const toggleMobileMenu = () => {
  mobileMenuOpen.value = !mobileMenuOpen.value;
};

const closeMobileMenu = () => {
  mobileMenuOpen.value = false;
};

const logout = () => {
  authStore.logout();
  router.push('/');
};

const logoutAndCloseMobile = () => {
  closeMobileMenu();
  logout();
};
</script>

<style scoped>
.nav-link {
  @apply flex items-center px-3 py-2 rounded-md text-sm font-medium text-stone-300 hover:text-white hover:bg-stone-700 transition-all duration-200 font-fauna;
}
</style> 