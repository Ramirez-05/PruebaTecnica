<template>
  <div class="container mx-auto px-4 pt-24">
    <loading-spinner v-if="loading" message="Cargando datos..."/>

    <error-message 
      v-else-if="error" 
      :message="error" 
      @retry="fetchClientData"
    />
    
    <div v-else class="max-w-4xl mx-auto">
      <h1 class="text-3xl md:text-5xl font-bold text-stone-800 mb-10 font-cinzel text-center">
        Dashboard
      </h1>
      
      <session-info-card 
        :user-name="userName" 
        :user-email="userEmail"
      />
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '../store/authStore';
import LoadingSpinner from '../components/common/LoadingSpinner.vue';
import ErrorMessage from '../components/common/ErrorMessage.vue';
import SessionInfoCard from '../components/dashboard/SessionInfoCard.vue';

export default {
  name: 'Dashboard',
  components: {
    LoadingSpinner,
    ErrorMessage,
    SessionInfoCard
  },
  data() {
    return {
      loading: true,
      error: null
    };
  },
  computed: {
    authStore() {
      return useAuthStore();
    },
    userName() {
      return this.authStore.userName || 'Usuario';
    },
    userEmail() {
      return this.authStore.userEmail || '';
    }
  },
  methods: {
    async fetchClientData() {
      this.loading = true;
      this.error = null;
      
      try {
        if (!this.authStore.isAuthenticated) {
          this.$router.push('/login');
          return;
        }
        
        if (!this.authStore.userName) {
          await this.authStore.fetchUserData();
        }
      } catch (error) {
        this.error = error.message || 'Error al obtener datos del cliente';
      } finally {
        this.loading = false;
      }
    }
  },
  mounted() {
    this.fetchClientData();
  }
}
</script>

<style scoped>
.feature-card {
  @apply bg-stone-100 bg-opacity-90 p-6 rounded-lg shadow-md border-2 border-stone-500 transition-all duration-300;
  background-image: url('/paper-texture.jpg');
  background-blend-mode: overlay;
}
</style> 