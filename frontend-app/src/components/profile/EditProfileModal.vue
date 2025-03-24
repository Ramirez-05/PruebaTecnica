<template>
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full mx-4">
      <h3 class="text-xl font-semibold mb-4 text-stone-800 font-cinzel">Editar Perfil</h3>
      
      <div v-if="message" class="mb-4 p-3 rounded" :class="{'bg-red-100 text-red-700': isError, 'bg-green-100 text-green-700': !isError}">
        {{ message }}
      </div>
      
      <form @submit.prevent="updateProfile">
        <div class="mb-5">
          <label class="block text-stone-700 mb-2 font-fauna" for="name">Nombre</label>
          <input 
            type="text" 
            id="name"
            v-model="name"
            class="w-full px-4 py-2 border-2 border-stone-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-stone-500 bg-stone-100 bg-opacity-80 text-stone-800 font-fauna"
            placeholder="Tu nombre"
            required
          >
        </div>
        
        <div class="mb-5">
          <label class="block text-stone-700 mb-2 font-fauna" for="email">Email</label>
          <input 
            type="email" 
            id="email"
            v-model="email"
            class="w-full px-4 py-2 border-2 border-stone-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-stone-500 bg-stone-100 bg-opacity-80 text-stone-800 font-fauna"
            placeholder="tu@email.com"
            required
          >
        </div>
        
        <div class="flex justify-end space-x-4 mt-6">
          <button 
            type="button" 
            @click="$emit('close')" 
            class="px-4 py-2 bg-stone-300 text-stone-800 rounded-md font-fauna hover:bg-stone-400"
          >
            Cancelar
          </button>
          <button 
            type="submit"
            class="px-4 py-2 bg-stone-700 text-white rounded-md font-fauna hover:bg-stone-800"
            :disabled="updating"
          >
            {{ updating ? 'Actualizando...' : 'Guardar Cambios' }}
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '../../store/authStore';

export default {
  name: 'EditProfileModal',
  props: {
    currentName: {
      type: String,
      required: true
    },
    currentEmail: {
      type: String,
      required: true
    }
  },
  emits: ['close', 'updated'],
  data() {
    return {
      name: '',
      email: '',
      updating: false,
      message: '',
      isError: false
    };
  },
  computed: {
    authStore() {
      return useAuthStore();
    }
  },
  methods: {
    async updateProfile() {
      if (!this.name) {
        this.message = 'Por favor, ingrese su nombre';
        this.isError = true;
        return;
      }

      if (!this.email) {
        this.message = 'Por favor, ingrese un correo electrónico';
        this.isError = true;
        return;
      }
      
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(this.email)) {
        this.message = 'Por favor, ingrese un email válido';
        this.isError = true;
        return;
      }
      
      const noChanges = this.name === this.currentName && this.email === this.currentEmail;
      
      if (noChanges) {
        this.message = 'No se realizaron cambios';
        this.isError = false;
        return;
      }
      
      this.updating = true;
      this.message = '';
      this.isError = false;
      
      try {
        const result = await this.authStore.updateUserProfile(this.name, this.email);
        
        this.message = 'Perfil actualizado con éxito';
        this.isError = false;
        this.$emit('updated');
        
        setTimeout(() => {
          this.$emit('close');
        }, 1500);
      } catch (error) {
        this.isError = true;
        this.message = error.message || 'Error al actualizar el perfil';
      } finally {
        this.updating = false;
      }
    }
  },
  created() {
    this.name = this.currentName;
    this.email = this.currentEmail;
  }
}
</script> 