import axios from 'axios';
import { API_BASE_URL } from '../constants/apiEndpoints';
import { useAuthStore } from '../store/authStore';
import { useRouter } from 'vue-router';

const api = axios.create({
  baseURL: API_BASE_URL, 
  timeout: 10000,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  }
});

api.interceptors.request.use(
  config => {
    const token = localStorage.getItem('token');
    if (token) {
      console.log('API Interceptor: Token encontrado, añadiendo a headers');
      config.headers['Authorization'] = `Bearer ${token}`;
    } else {
      console.log('API Interceptor: No hay token disponible');
    }
    return config;
  },
  error => {
    return Promise.reject(error);
  }
);

api.interceptors.response.use(
  response => {
    if (typeof response.data === 'string' && response.data.endsWith('null')) {
      try {
        response.data = JSON.parse(response.data.replace(/null$/, ''));
      } catch (e) {
        console.error('API Response Interceptor: Error al limpiar datos:', e);
      }
    }
    
    return response;
  },
  error => {
    if (error.response?.status === 401) {
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      
      if (!window.location.pathname.includes('/login')) {
        window.location.href = '/login';
      }
    }
    return Promise.reject(error);
  }
);

export default api; 