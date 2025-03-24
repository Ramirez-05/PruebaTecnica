import api from './api';
import { API_ENDPOINTS } from '../constants/apiEndpoints';

class AuthService {
  async login(email, password) {
    try {
      console.log('Login: Enviando solicitud con datos:', { email, password });
      
      const response = await api.post(API_ENDPOINTS.LOGIN, { email, password });
      
      console.log('Login: Respuesta completa del servidor:', response);
      console.log('Login: Datos recibidos:', response.data);
      
      if (response.data.token) {
        console.log('Login: Token recibido, guardando en localStorage');
        localStorage.setItem('token', response.data.token);
      } else {
        console.warn('Login: No se recibió token en la respuesta');
      }
      
      return response.data;
    } catch (error) {
      console.error('Login: Error en la petición:', error);
      
      if (error.response) {
        console.error('Login: Respuesta de error del servidor:', error.response.data);
        console.error('Login: Estado HTTP:', error.response.status);
      } else if (error.request) {
        console.error('Login: No se recibió respuesta del servidor');
      } else {
        console.error('Login: Error al configurar la petición:', error.message);
      }
      
      throw error;
    }
  }

  async register(email, password) {
    try {
      console.log('Register: Enviando solicitud con datos:', { email, password });
      
      const response = await api.post('/register', { email, password });
      
      console.log('Register: Respuesta completa del servidor:', response);
      console.log('Register: Datos recibidos:', response.data);
      
      return response.data;
    } catch (error) {
      console.error('Register: Error en la petición:', error);
      
      if (error.response) {
        console.error('Register: Respuesta de error del servidor:', error.response.data);
        console.error('Register: Estado HTTP:', error.response.status);
      } else if (error.request) {
        console.error('Register: No se recibió respuesta del servidor');
      } else {
        console.error('Register: Error al configurar la petición:', error.message);
      }
      
      throw error;
    }
  }

  logout() {
    console.log('Logout: Eliminando token del localStorage');
    localStorage.removeItem('token');
  }

  getCurrentUser() {
    const user = localStorage.getItem('user');
    console.log('GetCurrentUser: Usuario recuperado del localStorage:', user);
    return user ? JSON.parse(user) : null;
  }
}

export default new AuthService(); 