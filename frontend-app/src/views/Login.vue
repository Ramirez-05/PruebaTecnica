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
        
        <div class="mt-6 text-center text-stone-700 font-fauna">
          <p>¿No tienes una cuenta? <router-link to="/register" class="text-stone-600 hover:text-stone-800 font-medium">Regístrate</router-link></p>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import AuthService from '../services/auth.service';

export default {
  name: 'Login',
  data() {
    return {
      user: {
        email: '',
        password: ''
      },
      loading: false,
      message: '',
      isError: false
    };
  },
  methods: {
    async handleLogin() {
      if (!this.user.email || !this.user.password) {
        this.message = 'Por favor, complete todos los campos';
        this.isError = true;
        console.warn('Login Component: Campos incompletos');
        return;
      }
      
      this.loading = true;
      this.message = '';
      
      console.log('Login Component: Intentando iniciar sesión con:', { 
        email: this.user.email,
        password: '*'.repeat(this.user.password.length)
      });
      
      try {
        const response = await AuthService.login(this.user.email, this.user.password);
        console.log('Login Component: Inicio de sesión exitoso, datos recibidos:', response);
        console.log('Login Component: Redirigiendo a la página principal');
        
        this.$router.push('/');
        this.message = 'Inicio de sesión exitoso';
        this.isError = false;
      } catch (error) {
        this.isError = true;
        console.error('Login Component: Error durante el inicio de sesión:', error);
        
        if (error.response) {
          this.message = error.response.data.message || 'Error al iniciar sesión';
          console.error('Login Component: Mensaje de error del servidor:', error.response.data);
        } else {
          this.message = 'Error de conexión con el servidor';
          console.error('Login Component: Error:', error);
        }
      } finally {
        this.loading = false;
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