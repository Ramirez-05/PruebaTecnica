<template>
  <div class="min-h-screen pt-24 px-4 flex items-center justify-center">
    <div class="w-full max-w-md bg-stone-100 bg-opacity-90 p-8 rounded-lg shadow-lg border-2 border-stone-500 login-card">
      <h2 class="text-3xl font-bold text-stone-800 mb-6 font-cinzel text-center">Iniciar Sesión</h2>
      
      <div v-if="message" class="mb-4 p-3 rounded" :class="{'bg-red-100 text-red-700': isError, 'bg-green-100 text-green-700': !isError}">
        {{ message }}
      </div>
      
      <form @submit.prevent="handleLogin">
        <div class="mb-5">
          <label class="block text-stone-700 mb-2 font-fauna" for="email">Email</label>
          <input 
            type="email" 
            id="email"
            v-model="user.email"
            class="w-full px-4 py-2 border-2 border-stone-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-stone-500 bg-stone-100 bg-opacity-80 text-stone-800 font-fauna"
            placeholder="tu@email.com"
            required
          >
        </div>
        
        <div class="mb-6">
          <label class="block text-stone-700 mb-2 font-fauna" for="password">Contraseña</label>
          <input 
            type="password" 
            id="password"
            v-model="user.password"
            class="w-full px-4 py-2 border-2 border-stone-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-stone-500 bg-stone-100 bg-opacity-80 text-stone-800 font-fauna"
            placeholder="••••••••"
            required
          >
        </div>
        
        <button 
          type="submit"
          class="w-full bg-stone-700 text-stone-100 py-3 px-4 rounded-lg hover:bg-stone-800 transition-colors font-medium font-cinzel tracking-wider shadow-md"
          :disabled="loading"
        >
          <span v-if="loading">Iniciando sesión...</span>
          <span v-else>Iniciar Sesión</span>
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { useAuthStore } from '../store/authStore';

export default {
  name: 'Login',
  data() {
    return {
      user: {
        email: '',
        password: ''
      },
      message: '',
      isError: false
    };
  },
  computed: {
    authStore() {
      return useAuthStore();
    },
    loading() {
      return this.authStore.loading;
    }
  },
  methods: {
    async handleLogin() {
      if (!this.user.email || !this.user.password) {
        this.message = 'Por favor, complete todos los campos';
        this.isError = true;
        return;
      }
      
      this.message = '';
      this.isError = false;
      
      try {
        await this.authStore.login(this.user.email, this.user.password);
        
        this.message = 'Inicio de sesión exitoso';
        setTimeout(() => {
          this.$router.push('/dashboard');
        }, 500);
        
      } catch (error) {
        this.isError = true;
        this.message = error.message;
        this.user.password = '';
      }
    }
  }
}
</script>

<style scoped>
.login-card {
  background-image: url('/paper-texture.jpg');
  background-blend-mode: overlay;
  box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
</style> 