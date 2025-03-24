<template>
  <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full mx-4">
      <h3 class="text-xl font-semibold mb-4 text-stone-800 font-cinzel">Confirmar Eliminación</h3>
      <p class="text-stone-700 font-fauna mb-6">¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer y perderás todos tus datos.</p>
      <div class="flex justify-end space-x-4">
        <button 
          @click="$emit('cancel')" 
          class="px-4 py-2 bg-stone-300 text-stone-800 rounded-md font-fauna hover:bg-stone-400"
        >
          Cancelar
        </button>
        <button 
          @click="$emit('confirm')" 
          class="px-4 py-2 bg-red-600 text-white rounded-md font-fauna hover:bg-red-700"
          :disabled="deleting"
        >
          {{ deleting ? 'Eliminando...' : 'Eliminar Cuenta' }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'DeleteConfirmationModal',
  props: {
    deleting: {
      type: Boolean,
      default: false
    }
  },
  emits: ['cancel', 'confirm']
}
</script> 