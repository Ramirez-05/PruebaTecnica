import { ref } from 'vue';
import orderService from '../services/order.service';

export function useOrders() {
  const orderLoading = ref(false);
  const orderError = ref(null);
  const orderSuccess = ref(false);

  const validateStock = (items) => {
    const invalidItems = items.filter(item => item.quantity > item.stock);
    if (invalidItems.length > 0) {
      throw new Error('Algunos productos no tienen stock suficiente');
    }
  };

  const createOrder = async (clientId, items) => {
    if (items.length === 0) {
      orderError.value = 'No hay productos en el carrito';
      return null;
    }

    try {
      validateStock(items);
      
      orderLoading.value = true;
      orderError.value = null;
      orderSuccess.value = false;
      
      console.log('Enviando orden para cliente:', clientId, 'con items:', items);
      const order = await orderService.createOrder(clientId, items);
      console.log('Respuesta de orden exitosa:', order);
      
      orderSuccess.value = true;
      
      return order;
    } catch (error) {
      console.error('Error al crear la orden:', error);
      orderError.value = error.message;
      orderSuccess.value = false;
      return null;
    } finally {
      orderLoading.value = false;
    }
  };

  return {
    orderLoading,
    orderError,
    orderSuccess,
    createOrder
  };
} 