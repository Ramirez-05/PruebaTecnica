import api from './api';
import { API_ENDPOINTS } from '../constants/apiEndpoints';

class ClientService {
  async getClientById(id) {
    try {
      const response = await api.get(API_ENDPOINTS.CLIENT_BY_ID(id));
      return response.data;
    } catch (error) {
      let errorMessage = 'Error al obtener datos del cliente';
      if (error.response) {
        if (error.response.data && error.response.data.error) {
          errorMessage = error.response.data.error;
        }
      }
      
      throw new Error(errorMessage);
    }
  }

  async updateClient(id, data) {
    try {
      const response = await api.put(API_ENDPOINTS.CLIENT_BY_ID(id), data);
      return response.data;
    } catch (error) {
      let errorMessage = 'Error al actualizar el perfil';
      
      if (error.response) {
        if (error.response.data && error.response.data.error) {
          errorMessage = error.response.data.error;
        } else if (error.response.status === 400) {
          errorMessage = 'Datos inválidos o el correo electrónico ya está en uso';
        }
      }
      
      throw new Error(errorMessage);
    }
  }

  async deleteClient(id) {
    try {
      const response = await api.delete(API_ENDPOINTS.CLIENT_BY_ID(id));
      return response.data;
    } catch (error) {
      
      let errorMessage = 'Error al eliminar la cuenta';
      
      if (error.response) {
        if (error.response.data && error.response.data.error) {
          errorMessage = error.response.data.error;
        }
      }
      
      throw new Error(errorMessage);
    }
  }
}

export default new ClientService(); 