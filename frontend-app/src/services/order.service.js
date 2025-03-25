import api from './api';
import { API_ENDPOINTS } from '../constants/apiEndpoints';

class OrderService {
  /**
   * Crea una nueva orden con los productos del carrito
   * @param {number} clientId 
   * @param {Array} items 
   * @returns {Promise}
   */
  async createOrder(clientId, items) {
    try {
      const orderData = {
        client_id: clientId,
        items: items.map(item => ({
          product_id: parseInt(item.id),
          quantity: item.quantity
        }))
      };

      console.log('Enviando orden:', orderData);
      
      const response = await api.post(API_ENDPOINTS.ORDERS, orderData);
      return response.data;
    } catch (error) {
      console.error('Error al crear la orden:', error);
      const errorMessage = error.response?.data?.message || 
                          'Error al procesar la orden. Por favor, intente nuevamente.';
      throw new Error(errorMessage);
    }
  }

  /**
   * Obtiene las órdenes de un cliente específico
   * @param {number} clientId
   * @returns {Promise} 
   */
  async getOrdersByClient(clientId) {
    try {
      const response = await api.get(`${API_ENDPOINTS.ORDERS}/client/${clientId}`);
      return response.data;
    } catch (error) {
      console.error('Error al obtener órdenes del cliente:', error);
      throw new Error('No se pudieron cargar las órdenes');
    }
  }
}

export default new OrderService(); 