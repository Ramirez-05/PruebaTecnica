<template>
  <div>
    <auth-nav />
    
    <div class="container mx-auto px-4 pt-24">
      <loading-spinner v-if="loading" message="Cargando datos..."/>

      <error-message 
        v-else-if="error" 
        :message="error" 
        @retry="fetchClientData"
      />
      
      <div v-else class="max-w-4xl mx-auto">
        <h1 class="text-3xl md:text-5xl font-bold text-stone-800 mb-10 font-cinzel text-center">
          Dashboard
        </h1>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="md:col-span-2 order-2 md:order-1">
            <products-list-card
              :products="products"
              :loading="loading"
              :error="error"
            />
          </div>
          
          <div class="order-1 md:order-2">
            <cart-summary-card @order-success="reloadProducts" />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from 'vue';
import { useAuthGuard } from '../composables/useAuthGuard';
import { useProducts } from '../composables/useProducts';
import LoadingSpinner from '../components/common/LoadingSpinner.vue';
import ErrorMessage from '../components/common/ErrorMessage.vue';
import ProductsListCard from '../components/dashboard/ProductsListCard.vue';
import CartSummaryCard from '../components/dashboard/CartSummaryCard.vue';
import AuthNav from '../components/AuthNav.vue';
import { useAuthStore } from '../store/authStore';

const { requireAuth } = useAuthGuard();
const { products, loading, error, fetchProducts, clearCache } = useProducts();
const authStore = useAuthStore();

const fetchClientData = async () => {
  const isAuthed = await requireAuth();
  if (!isAuthed) return;
  
  console.log('Obteniendo datos de cliente');
  await fetchProducts(authStore.userId);
};

const reloadProducts = () => {
  console.log('Dashboard: Recargando productos después de la compra...');
  clearCache();
  fetchProducts(authStore.userId);
};

onMounted(fetchClientData);
</script>

<style scoped>
.feature-card {
  @apply bg-stone-100 bg-opacity-90 p-6 rounded-lg shadow-md border-2 border-stone-500 transition-all duration-300;
  background-image: url('/paper-texture.jpg');
  background-blend-mode: overlay;
}
</style> 