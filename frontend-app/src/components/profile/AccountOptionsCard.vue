<template>
  <div class="feature-card">
    <h2 class="text-xl font-semibold mb-4 text-stone-800 font-cinzel">Opciones de Cuenta</h2>
    <div class="flex flex-col md:flex-row gap-4">
      <button 
        @click="$emit('edit')" 
        class="flex-1 py-3 px-4 bg-stone-700 text-white rounded-md font-fauna hover:bg-stone-800 transition flex items-center justify-center"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>
        Editar Correo
      </button>
      <button 
        @click="$emit('delete')" 
        class="flex-1 py-3 px-4 bg-red-600 text-white rounded-md font-fauna hover:bg-red-700 transition flex items-center justify-center"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
        Eliminar Cuenta
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AccountOptionsCard',
  emits: ['edit', 'delete']
}
</script>

<style scoped>
.feature-card {
  @apply bg-stone-100 bg-opacity-90 p-6 rounded-lg shadow-md border-2 border-stone-500 transition-all duration-300;
  background-image: url('/paper-texture.jpg');
  background-blend-mode: overlay;
}
</style> 