<template>
  <div class="space-y-3">
    <div v-if="loading" class="text-center py-2">
      <loading-spinner message="Procesando pedido..." />
    </div>
    
    <div v-if="error" class="py-2 px-3 bg-red-100 text-red-700 rounded-md text-sm">
      {{ error }}
    </div>
    
    <div v-if="success" class="py-2 px-3 bg-green-100 text-green-700 rounded-md text-sm">
      ¡Pedido realizado con éxito!
    </div>
  </div>
</template>

<script setup>
import LoadingSpinner from '../common/LoadingSpinner.vue';

defineProps({
  loading: Boolean,
  error: String,
  success: Boolean
});
</script> 