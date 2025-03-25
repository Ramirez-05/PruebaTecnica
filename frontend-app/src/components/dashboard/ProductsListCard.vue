<template>
  <div class="feature-card mt-6">
    <h2 class="text-xl font-semibold mb-4 text-stone-800 font-cinzel">Productos Disponibles</h2>
    
    <loading-spinner v-if="loading" />
    
    <error-message v-else-if="error" :message="error" />
    
    <div v-else-if="products.length === 0" class="py-4 text-center text-stone-600 font-fauna">
      No hay productos disponibles en este momento.
    </div>
    
    <div v-else class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <product-card
        v-for="product in products"
        :key="getProductId(product)"
        :product="product"
      />
    </div>
  </div>
</template>

<script setup>
import LoadingSpinner from '../common/LoadingSpinner.vue';
import ErrorMessage from '../common/ErrorMessage.vue';
import ProductCard from './ProductCard.vue';

const props = defineProps({
  products: {
    type: Array,
    default: () => []
  },
  loading: Boolean,
  error: String
});

const getProductId = (product) => {
  return product.id_producto || product.id || 'N/A';
};
</script>

<style scoped>
.feature-card {
  @apply bg-stone-100 bg-opacity-90 p-6 rounded-lg shadow-md border-2 border-stone-500 transition-all duration-300;
  background-image: url('/paper-texture.jpg');
  background-blend-mode: overlay;
}
</style> 