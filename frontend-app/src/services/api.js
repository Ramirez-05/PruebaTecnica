import axios from 'axios';
import { API_BASE_URL } from '../constants/apiEndpoints';

const api = axios.create({
  baseURL: API_BASE_URL, 
  timeout: 10000,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  }
});

console.log('API: Configurando axios con URL base:', API_BASE_URL);

// Interceptor para manejar tokens de autenticación
api.interceptors.request.use(
  config => {
    const token = localStorage.getItem('token');
    console.log('API Interceptor: Preparando petición a:', config.url);
    
    if (token) {
      console.log('API Interceptor: Token encontrado, añadiendo a headers');
      config.headers['Authorization'] = `Bearer ${token}`;
    } else {
      console.log('API Interceptor: No hay token disponible');
    }
    
    console.log('API Interceptor: Configuración final de la petición:', config);
    return config;
  },
  error => {
    console.error('API Interceptor: Error en la configuración de la petición:', error);
    return Promise.reject(error);
  }
);

// Interceptor para manejar errores comunes
api.interceptors.response.use(
  response => {
    console.log('API Response Interceptor: Respuesta exitosa de:', response.config.url);
    return response;
  },
  error => {
    console.error('API Response Interceptor: Error en la respuesta:', error);
    
    if (error.response) {
      console.error('API Response Interceptor: Estado HTTP:', error.response.status);
      
      if (error.response.status === 401) {
        console.warn('API Response Interceptor: Error 401 Unauthorized - Redirigiendo a login');
        localStorage.removeItem('token');
        window.location.href = '/login';
      }
    }
    
    return Promise.reject(error);
  }
);

export default api; 