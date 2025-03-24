import api from './api';
import { API_ENDPOINTS } from '../constants/apiEndpoints';

class AuthService {
  async login(email, password) {
    try {
      const response = await api.post(API_ENDPOINTS.LOGIN, { email, password });
      if (response.data.token) {
        localStorage.setItem('token', response.data.token);

        if (response.data.user_id) {
          localStorage.setItem('user_id', response.data.user_id);
        }
      } else {
        console.warn('Login: No se recibió token en la respuesta');
      }
      
      return response.data;
    } catch (error) {
      let errorMessage = 'Error en la conexión con el servidor';
      if (error.response) {
        if (error.response.data && error.response.data.error) {
          errorMessage = error.response.data.error;
        } else if (typeof error.response.data === 'string' && error.response.data.includes('error')) {
          try {
            const jsonMatch = error.response.data.match(/\{.*\}/);
            if (jsonMatch) {
              const jsonData = JSON.parse(jsonMatch[0]);
              if (jsonData.error) {
                errorMessage = jsonData.error;
              }
            }
          } catch (e) {
            console.error('Error al procesar la respuesta HTML:', e);
          }
        }
      } else if (error.request) {
        errorMessage = 'No se recibió respuesta del servidor';
      } else {
        errorMessage = error.message;
      }
      const enhancedError = new Error(errorMessage);
      enhancedError.originalError = error;
      throw enhancedError;
    }
  }

  async register(email, password) {
    try {

      const response = await api.post('/register', { email, password });
      return response.data;
    } catch (error) {
      throw error;
    }
  }

  logout() {
    localStorage.removeItem('token');
  }

  getCurrentUser() {
    const user = localStorage.getItem('user');
    return user ? JSON.parse(user) : null;
  }
}

export default new AuthService(); 