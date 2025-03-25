<template>
  <div class="bg-stone-50 p-4 rounded-md shadow-sm border border-stone-300 hover:shadow-md transition-all">
    <h3 class="text-lg font-semibold text-stone-800 font-cinzel">{{ product.name }}</h3>
    
    <div class="mt-2 space-y-1">
      <p v-if="product.description" class="text-stone-600 font-fauna">
        {{ product.description }}
      </p>
      <p v-if="product.stock !== undefined" class="text-stone-600 font-fauna">
        Stock: {{ product.stock }}
      </p>
      
      <div class="mt-4 flex items-center">
        <div v-if="quantityInCart > 0">
          <cart-item-controls
            :quantity="quantityInCart"
            :max-quantity="product.stock"
            @increment="addToCart"
            @decrement="decrementQuantity"
          />
        </div>
        
        <button 
          v-else
          @click="addToCart" 
          class="bg-stone-700 hover:bg-stone-800 text-white py-2 px-4 rounded-md font-fauna text-sm w-full">
          Agregar al carrito
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import CartItemControls from '../cart/CartItemControls.vue';
import { useCartItem } from '../../composables/useCartItem';

const props = defineProps({
  product: {
    type: Object,
    required: true
  }
});

const {
  quantityInCart,
  addToCart,
  decrementQuantity
} = useCartItem(props.product);
</script> 