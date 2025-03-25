<template>
  <div class="flex justify-end space-x-2">
    <button 
      @click="$emit('clear')" 
      class="btn-secondary"
      :disabled="loading">
      Vaciar carrito
    </button>
    <button 
      @click="$emit('checkout')"
      :disabled="loading"
      class="btn-primary">
      Finalizar compra
    </button>
  </div>
</template>

<script setup>
defineProps({
  loading: Boolean
});

defineEmits(['clear', 'checkout']);
</script>

<style scoped>
.btn-primary {
  @apply bg-stone-700 hover:bg-stone-800 text-white py-2 px-4 rounded-md font-fauna text-sm disabled:opacity-50;
}

.btn-secondary {
  @apply bg-stone-200 hover:bg-stone-300 text-stone-800 py-2 px-4 rounded-md font-fauna text-sm disabled:opacity-50;
}
</style> 