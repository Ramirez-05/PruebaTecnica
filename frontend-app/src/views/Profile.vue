<template>
  <div class="container mx-auto px-4 pt-24">
    <loading-spinner v-if="loading" message="Cargando datos..."/>
    
    <error-message 
      v-else-if="error" 
      :message="error" 
      @retry="loadProfile"
    />
    
    <div v-else class="max-w-2xl mx-auto">
      <h1 class="text-3xl font-bold text-stone-800 mb-6 font-cinzel text-center">
        Perfil de Usuario
      </h1>
      
      <div class="space-y-6">
        <user-info-card 
          :user-name="authStore.userName"
          :user-email="authStore.userEmail"
          :user-id="authStore.userId"
          :user-data="displayableUserData"
          :format-key="formatKey"
        />
        
        <account-options-card 
          @edit="showEditForm = true"
          @delete="confirmDelete"
        />
      </div>
      
      <delete-confirmation-modal 
        v-if="showDeleteModal"
        :deleting="deleting"
        @cancel="showDeleteModal = false"
        @confirm="deleteAccount"
      />
      
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
import DeleteConfirmationModal from '../components/profile/DeleteConfirmationModal.vue';
import EditProfileModal from '../components/profile/EditProfileModal.vue';

export default {
  name: 'Profile',
  components: {
    LoadingSpinner,
    ErrorMessage,
    UserInfoCard,
    AccountOptionsCard,
    DeleteConfirmationModal,
    EditProfileModal
  },
  data() {
    return {
      loading: true,
      userData: null,
      error: null,
      showDeleteModal: false,
      showEditForm: false,
      deleting: false
    };
  },
  computed: {
    authStore() {
      return useAuthStore();
    },
    displayableUserData() {
      if (!this.userData) return {};
      
      const { id, email, password, ...rest } = this.userData;
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
        
        this.userData = await this.authStore.fetchUserData();
      } catch (error) {
        this.error = error.message || 'Error al obtener datos del perfil';
      } finally {
        this.loading = false;
      }
    },
    confirmDelete() {
      this.showDeleteModal = true;
    },
    async deleteAccount() {
      this.deleting = true;
      try {
        await this.authStore.deleteAccount();
        this.$router.push('/login');
      } catch (error) {
        this.error = error.message || 'Error al eliminar la cuenta. Por favor, intente nuevamente.';
        this.showDeleteModal = false;
      } finally {
        this.deleting = false;
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