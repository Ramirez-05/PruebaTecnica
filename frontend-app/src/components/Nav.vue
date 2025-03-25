<template>
  <nav class="fixed w-full bg-stone-900 bg-opacity-90 shadow-xl z-50 border-b-4 border-stone-700">
    <div class="container mx-auto px-4">
      <div class="flex justify-between items-center h-16">
        <router-link to="/" class="flex items-center space-x-2">
          <span class="text-2xl font-bold text-stone-300 font-cinzel tracking-wider">SR</span>
        </router-link>
        <div class="hidden md:flex items-center space-x-6">
          <router-link 
            to="/" 
            class="nav-link"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Inicio
          </router-link>
          
          <router-link 
            to="/login" 
            class="nav-link"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
            </svg>
            Iniciar Sesión
          </router-link>
          
          <a 
            href="https://github.com/Ramirez-05/PruebaTecnica" 
            target="_blank"
            class="nav-link"
          >
            <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 24 24">
              <path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/>
            </svg>
            GitHub
          </a>
          
          <a 
            href="https://linkedin.com/in/TU-USERNAME" 
            target="_blank"
            class="nav-link"
          >
            <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 24 24">
              <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
            </svg>
            LinkedIn
          </a>
        </div>

        <button 
          @click="isMenuOpen = !isMenuOpen" 
          class="md:hidden p-2 rounded-md text-stone-400 hover:text-stone-200 hover:bg-stone-800 transition-all duration-200"
        >
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path 
              v-if="!isMenuOpen" 
              stroke-linecap="round" 
              stroke-linejoin="round" 
              stroke-width="2" 
              d="M4 6h16M4 12h16M4 18h16"
            />
            <path 
              v-else 
              stroke-linecap="round" 
              stroke-linejoin="round" 
              stroke-width="2" 
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </button>
      </div>

      <div 
        v-show="isMenuOpen" 
        class="md:hidden border-t border-stone-700"
      >
        <div class="px-2 pt-2 pb-3 space-y-1">
          <router-link 
            to="/" 
            class="mobile-nav-link"
            @click="isMenuOpen = false"
          >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            Inicio
          </router-link>
          
          <router-link 
            to="/login" 
            class="mobile-nav-link"
            @click="isMenuOpen = false"
          >
            Iniciar Sesión
          </router-link>
          
          <a 
            href="https://github.com/Ramirez-05/PruebaTecnica" 
            target="_blank"
            class="mobile-nav-link"
            @click="isMenuOpen = false"
          >
            GitHub
          </a>
          
          <a 
            href="https://linkedin.com/in/TU-USERNAME" 
            target="_blank"
            class="mobile-nav-link"
            @click="isMenuOpen = false"
          >
            LinkedIn
          </a>
        </div>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  name: 'Nav',
  data() {
    return {
      isMenuOpen: false
    }
  }
}
</script>

<style scoped>
.nav-link {
  @apply flex items-center px-3 py-2 rounded-md text-sm font-medium text-stone-300 hover:text-white hover:bg-stone-700 transition-all duration-200 font-fauna;
}

.mobile-nav-link {
  @apply flex items-center w-full px-3 py-2 text-base font-medium text-stone-300 hover:text-white hover:bg-stone-700 transition-all duration-200 rounded-md font-fauna;
}
</style> 