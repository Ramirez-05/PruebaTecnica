<template>
  <div class="container mx-auto px-4 pt-24">
    <loading-spinner v-if="loading" message="Cargando datos del perfil..."/>
    
    <error-message 
      v-else-if="error" 
      :message="error" 
      @retry="loadProfile"
    />
    
    <div v-else class="max-w-4xl mx-auto">
      <h1 class="text-3xl md:text-5xl font-bold text-stone-800 mb-10 font-cinzel text-center">
        Perfil de Usuario
      </h1>
      
      <div class="grid grid-cols-1 gap-8">
        <user-info-card 
          :user-name="authStore.userName" 
          :user-email="authStore.userEmail"
          :user-id="authStore.userId"
          :format-key="formatKey"
        />
        
        <account-options-card 
          @edit="showEditForm = true"
        />
      </div>
      
      <edit-profile-modal
        v-if="showEditForm"
        :current-name="authStore.userName"
        :current-email="authStore.userEmail"
        @close="closeEditModal"
        @updated="handleProfileUpdated"
      />
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '../store/authStore';
import LoadingSpinner from '../components/common/LoadingSpinner.vue';
import ErrorMessage from '../components/common/ErrorMessage.vue';
import UserInfoCard from '../components/profile/UserInfoCard.vue';
import AccountOptionsCard from '../components/profile/AccountOptionsCard.vue';
import EditProfileModal from '../components/profile/EditProfileModal.vue';

export default {
  name: 'Profile',
  components: {
    LoadingSpinner,
    ErrorMessage,
    UserInfoCard,
    AccountOptionsCard,
    EditProfileModal
  },
  data() {
    return {
      loading: true,
      userData: null,
      error: null,
      showEditForm: false
    };
  },
  computed: {
    authStore() {
      return useAuthStore();
    },
    displayableUserData() {
      if (!this.userData) return {};
      
      const { id, email, password, _password, status, data, ...rest } = this.userData;
      return rest;
    }
  },
  methods: {
    formatKey(key) {
      return key
        .replace(/_/g, ' ')
        .replace(/([A-Z])/g, ' $1')
        .split(' ')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');
    },
    async loadProfile() {
      this.loading = true;
      this.error = null;
      
      try {
        if (!this.authStore.isAuthenticated) {
          this.$router.push('/login');
          return;
        }
        
        console.log('Cargando datos del usuario...');
        this.userData = await this.authStore.fetchUserData();
        console.log('Datos del usuario cargados:', this.userData);
        console.log('Nombre del usuario:', this.authStore.userName);
        console.log('Email del usuario:', this.authStore.userEmail);
      } catch (error) {
        console.error('Error al cargar el perfil:', error);
        this.error = error.message || 'Error al obtener datos del perfil';
      } finally {
        this.loading = false;
      }
    },
    handleProfileUpdated() {
      this.loadProfile();
    },
    closeEditModal() {
      this.showEditForm = false;
    }
  },
  mounted() {
    this.loadProfile();
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