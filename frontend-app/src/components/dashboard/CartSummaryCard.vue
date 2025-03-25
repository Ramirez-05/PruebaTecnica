<template>
  <div class="feature-card mt-6">
    <h2 class="text-xl font-semibold mb-4 text-stone-800 font-cinzel">Carrito de Compras</h2>
    
    <cart-empty-state v-if="cartStore.items.length === 0" />
    
    <div v-else>
      <cart-items-list 
        :items="cartStore.items"
        @remove-item="removeItem"
      />
      
      <cart-total-items :total="cartStore.totalItems" />
      
      <cart-status-messages
        :loading="orderLoading"
        :error="orderError"
        :success="orderSuccess"
      />
      
      <cart-actions
        :loading="orderLoading"
        @clear="cartStore.clearCart"
        @checkout="finalizarCompra"
      />
    </div>
  </div>
</template>

<script setup>
import { useCartStore } from '../../store/cartStore';
import { useAuthStore } from '../../store/authStore';
import { useOrders } from '../../composables/useOrders';
import { useRouter } from 'vue-router';
import CartEmptyState from '../cart/CartEmptyState.vue';
import CartItemsList from '../cart/CartItemsList.vue';
import CartTotalItems from '../cart/CartTotalItems.vue';
import CartStatusMessages from '../cart/CartStatusMessages.vue';
import CartActions from '../cart/CartActions.vue';

const emit = defineEmits(['order-success']);
const router = useRouter();
const cartStore = useCartStore();
const authStore = useAuthStore();
const { orderLoading, orderError, orderSuccess, createOrder } = useOrders();

const removeItem = (productId) => cartStore.removeFromCart(productId);

const finalizarCompra = async () => {
  if (!authStore.isAuthenticated) {
    router.push({
      path: '/login',
      query: { redirect: '/dashboard' }
    });
    return;
  }
  
  try {
    console.log('Iniciando proceso de compra');
    const result = await createOrder(authStore.userId, cartStore.items);
    if (result) {
      console.log('Compra exitosa, limpiando carrito y emitiendo evento order-success');
      cartStore.clearCart();
      emit('order-success');
    }
  } catch (error) {
    console.error('Error al finalizar compra:', error);
    orderError.value = error.message || 'Error al procesar la orden';
  }
};
</script> 