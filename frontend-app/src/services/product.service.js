import api from './api';
import { API_ENDPOINTS } from '../constants/apiEndpoints';

class ProductService {
  async getAvailableProductsForClient(clientId) {
    try {
      console.log('ProductService: Obteniendo productos para cliente ID:', clientId);
      const response = await api.get(API_ENDPOINTS.AVAILABLE_PRODUCTS(clientId));
      console.log('ProductService: Respuesta recibida:', response.data);
      return response.data;
    } catch (error) {
      console.error('ProductService: Error al obtener productos:', error);
      let errorMessage = 'Error al obtener productos disponibles';
      
      if (error.response && error.response.data && error.response.data.error) {
        errorMessage = error.response.data.error;
      }
      
      throw new Error(errorMessage);
    }
  }
}

export default new ProductService(); 