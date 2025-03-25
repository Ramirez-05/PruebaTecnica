import { ref, computed } from 'vue';
import productService from '../services/product.service';
import { useAuthStore } from '../store/authStore';

const productCache = {
  cache: new Map(),
  ttl: 5 * 60 * 1000,
  
  set(key, value) {
    this.cache.set(key, {
      value,
      timestamp: Date.now()
    });
  },
  
  get(key) {
    const item = this.cache.get(key);
    if (!item) return null;

    if (Date.now() - item.timestamp > this.ttl) {
      this.cache.delete(key);
      return null;
    }

    return item.value;
  },

  clear() {
    this.cache.clear();
  }
};

export function useProducts() {
  const products = ref([]);
  const loading = ref(false);
  const error = ref(null);

  const hasProducts = computed(() => products.value.length > 0);
  const availableProducts = computed(() => 
    products.value.filter(p => p.stock > 0)
  );

  const fetchProducts = async (clientId) => {
    if (!clientId) {
      const authStore = useAuthStore();
      clientId = authStore.userId;
      
      if (!clientId) {
        console.error('No se puede obtener el ID del usuario');
        error.value = 'ID de usuario no válido';
        return;
      }
    }
    
    console.log('Obteniendo productos para el cliente ID:', clientId);
    
    loading.value = true;
    error.value = null;
    
    try {
      const cachedProducts = productCache.get(`products-${clientId}`);
      if (cachedProducts) {
        products.value = cachedProducts;
        return;
      }

      const response = await productService.getAvailableProductsForClient(clientId);
      handleProductsResponse(response);
      
      productCache.set(`products-${clientId}`, products.value);
    } catch (err) {
      handleError(err);
    } finally {
      loading.value = false;
    }
  };

  const handleProductsResponse = (response) => {
    if (response?.status === 'success' && Array.isArray(response.data)) {
      products.value = response.data;
    } else if (Array.isArray(response)) {
      products.value = response;
    } else {
      throw new Error('Formato de respuesta inválido');
    }
  };

  const handleError = (err) => {
    console.error('Error al obtener productos:', err);
    error.value = err.message || 'Error al cargar productos';
    products.value = [];
  };

  const updateProductStock = (productId, newStock) => {
    const product = products.value.find(p => p.id === productId);
    if (product) {
      product.stock = newStock;
    }
  };

  const clearCache = () => {
    productCache.clear();
  };
  
  return {
    products,
    loading,
    error,
    hasProducts,
    availableProducts,
    fetchProducts,
    updateProductStock,
    clearCache
  };
} 