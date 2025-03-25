import { defineStore } from 'pinia';
import { useAuthStore } from './authStore';
import orderService from '../services/order.service';

export const useCartStore = defineStore('cart', {
  state: () => ({
    items: [],
    orderLoading: false,
    orderError: null,
    orderSuccess: false,
    triggerProductsReload: false
  }),
  
  getters: {
    totalItems: (state) => {
      return state.items.reduce((total, item) => total + item.quantity, 0);
    },
    
    getQuantityInCart: (state) => (productId) => {
      const item = state.items.find(item => item.id === productId);
      return item ? item.quantity : 0;
    }
  },
  
  actions: {
    addToCart(product) {
      const existingItem = this.items.find(item => item.id === product.id);
      
      if (existingItem) {
        if (existingItem.quantity < product.stock) {
          existingItem.quantity++;
        }
      } else {
        this.items.push({
          id: product.id,
          name: product.name,
          stock: product.stock,
          quantity: 1
        });
      }
    },
    
    removeFromCart(productId) {
      const index = this.items.findIndex(item => item.id === productId);
      if (index !== -1) {
        this.items.splice(index, 1);
      }
    },
    
    decrementQuantity(productId) {
      const item = this.items.find(item => item.id === productId);
      if (item) {
        if (item.quantity > 1) {
          item.quantity--;
        } else {
          this.removeFromCart(productId);
        }
      }
    },
    
    clearCart() {
      console.log('Vaciando carrito de compras');
      this.items = [];
      localStorage.setItem('cart', JSON.stringify([]));
    },
  }
}); 