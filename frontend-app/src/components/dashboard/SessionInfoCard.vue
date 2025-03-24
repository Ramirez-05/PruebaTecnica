<template>
  <div class="feature-card">
    <div class="text-center mb-6">
      <h2 class="text-2xl font-bold text-stone-800 font-cinzel">
        Bienvenido, {{ userName }}
      </h2>
      <p class="text-stone-600 font-fauna mt-2">
        Nos alegra verte de nuevo
      </p>
    </div>
    
    <div class="mt-6 text-center">
      <p class="text-sm text-stone-500 font-fauna">
        Tu sesión está activa
      </p>
    </div>
  </div>
</template>

<script>
export default {
  name: 'SessionInfoCard',
  props: {
    userName: {
      type: String,
      default: 'Usuario'
    },
    userEmail: {
      type: String,
      default: ''
    }
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