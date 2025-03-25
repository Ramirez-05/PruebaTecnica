import { computed } from 'vue';
import { useCartStore } from '../store/cartStore';

export function useCartItem(product) {
  const cartStore = useCartStore();
  
  const productId = computed(() => product.id_producto || product.id || 'N/A');
  
  const quantityInCart = computed(() => 
    cartStore.getQuantityInCart(productId.value)
  );
  
  const canAddMore = computed(() => 
    quantityInCart.value < product.stock
  );
  
  const addToCart = () => {
    cartStore.addToCart({
      ...product,
      id: productId.value
    });
  };
  
  const removeFromCart = () => {
    cartStore.removeFromCart(productId.value);
  };
  
  const decrementQuantity = () => {
    cartStore.decrementQuantity(productId.value);
  };
  
  const syncCartItemStock = (product) => {
    const cartStore = useCartStore();
    const item = cartStore.items.find(i => i.id === product.id);
    
    if (item && item.quantity > product.stock) {
      item.quantity = product.stock;
      cartStore.saveCart();
    }
  };
  
  return {
    productId,
    quantityInCart,
    canAddMore,
    addToCart,
    removeFromCart,
    decrementQuantity,
    syncCartItemStock
  };
} 