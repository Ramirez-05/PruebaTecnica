import { defineStore } from 'pinia'
import api from '../services/api'
import { API_ENDPOINTS } from '../constants/apiEndpoints'
import router from '../router'
import clientService from '../services/client.service'

export const useAuthStore = defineStore('auth', {
  state: () => ({
    _token: localStorage.getItem('token') || null,
    _user: JSON.parse(localStorage.getItem('user') || 'null'),
    _loading: false,
    _error: null
  }),
  
  getters: {
    isAuthenticated: (state) => !!state._token,
    token: (state) => state._token,
    userId: (state) => state._user?.id || null,
    userEmail: (state) => state._user?.email || null,
    userName: (state) => state._user?.name || null,
    user: (state) => state._user,
    loading: (state) => state._loading,
    error: (state) => state._error
  },
  
  actions: {
    initializeFromStorage() {
      this._token = localStorage.getItem('token') || null;
      try {
        const userData = localStorage.getItem('user');
        this._user = userData ? JSON.parse(userData) : null;
      } catch (e) {
        this._user = null;
      }
    },
    
    async login(email, password) {
      this._loading = true;
      this._error = null;
      
      try {
        console.log('Intentando login con:', email);
        const response = await api.post(API_ENDPOINTS.LOGIN, { email, password });
        
        console.log('Respuesta completa del servidor:', response);
        console.log('Datos de respuesta:', response.data);
        console.log('Tipo de datos:', typeof response.data);
        
        const responseData = response.data.data || response.data;
        
        if (responseData.token) {
          this._token = responseData.token;
          localStorage.setItem('token', responseData.token);
          
          if (responseData.user_id) {
            this._user = { id: responseData.user_id };
            localStorage.setItem('user', JSON.stringify(this._user));
            
            try {
              await this.fetchUserData();
            } catch (fetchError) {
              console.warn('No se pudieron cargar datos completos del usuario:', fetchError);
            }
          }
          
          return responseData;
        } else {
          throw new Error('No se recibió token en la respuesta');
        }
      } catch (error) {
        console.error('Error completo:', error);
        
        if (error.response) {
          console.error('Respuesta de error:', error.response);
          console.error('Datos de error:', error.response.data);
        }
        
        let errorMessage = 'Error de conexión';
        
        if (error.response) {
          if (error.response.data && error.response.data.error) {
            errorMessage = error.response.data.error;
          } else if (error.response.data && error.response.data.message) {
            errorMessage = error.response.data.message;
          }
        }
        
        this._error = errorMessage;
        throw new Error(errorMessage);
      } finally {
        this._loading = false;
      }
    },
    
    async register(email, password) {
      this._loading = true;
      this._error = null;
      
      try {
        const response = await api.post('/register', { email, password });
        return response.data;
      } catch (error) {
        let errorMessage = 'Error de conexión';
        
        if (error.response) {
          if (error.response.data && error.response.data.error) {
            errorMessage = error.response.data.error;
          } else if (error.response.data && error.response.data.message) {
            errorMessage = error.response.data.message;
          }
        }
        
        this._error = errorMessage;
        throw new Error(errorMessage);
      } finally {
        this._loading = false;
      }
    },
    
    logout() {
      console.log('AuthStore: Cerrando sesión');
      this._token = null;
      this._user = null;
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      
      router.push('/');
    },
    
    clearError() {
      this._error = null;
    },
    
    async fetchUserData() {
      if (!this._user || !this._user.id) {
        console.error('No hay usuario autenticado o no tiene ID');
        throw new Error('No hay usuario autenticado');
      }
      
      this._loading = true;
      
      try {
        const userId = this._user.id;
        console.log('Obteniendo datos para el usuario ID:', userId);
        const clientData = await clientService.getClientById(userId);
        console.log('Datos obtenidos del cliente:', clientData);
        
        if (clientData) {
          const userData = clientData.data || clientData;
          
          this._user = {
            ...this._user,
            ...userData,
            name: userData.name || userData.nombre || this._user.name || 'No disponible',
            email: userData.email || userData.correo || this._user.email || 'No disponible',
            id: this._user.id
          };
          
          console.log('Usuario actualizado:', this._user);
          localStorage.setItem('user', JSON.stringify(this._user));
          return this._user;
        } else {
          throw new Error('No se pudieron obtener los datos del cliente');
        }
      } catch (error) {
        console.error('Error al obtener datos del usuario:', error);
        this._error = error.message;
        throw error;
      } finally {
        this._loading = false;
      }
    },
    
    async updateUserEmail(newEmail) {
      if (!this._user || !this._user.id) {
        throw new Error('No hay usuario autenticado');
      }
      
      if (newEmail === this._user.email) {
        return this._user;
      }
      
      this._loading = true;
      
      try {
        const userId = this._user.id;
        try {
          const checkResponse = await api.get(API_ENDPOINTS.CLIENTS);
          const clients = checkResponse.data;
          
          const emailExists = clients.some(client => 
            client.email === newEmail && client.id !== parseInt(userId)
          );
          
          if (emailExists) {
            throw new Error('El correo electrónico ya está registrado por otro usuario');
          }
        } catch (checkError) {
          if (checkError.message.includes('ya está registrado')) {
            throw checkError;
          }
        }

        const updateData = {
          email: newEmail
        };
        
        const updatedUser = await clientService.updateClient(userId, updateData);
        
        if (updatedUser) {
          this._user = {
            ...this._user,
            email: newEmail
          };
          
          localStorage.setItem('user', JSON.stringify(this._user));
          
          return this._user;
        } else {
          throw new Error('No se pudo actualizar el email');
        }
      } catch (error) {
        this._error = error.message;
        throw error;
      } finally {
        this._loading = false;
      }
    },
    
    async updateUserProfile(newName, newEmail) {
      if (!this._user || !this._user.id) {
        throw new Error('No hay usuario autenticado');
      }
      
      if (newName === this._user.name && newEmail === this._user.email) {
        return this._user;
      }
      
      this._loading = true;
      
      try {
        const userId = this._user.id;
        if (newEmail !== this._user.email) {
          try {
            const checkResponse = await api.get(API_ENDPOINTS.CLIENTS);
            const clients = checkResponse.data;
            
            const emailExists = clients.some(client => 
              client.email === newEmail && client.id !== parseInt(userId)
            );
            
            if (emailExists) {
              throw new Error('El correo electrónico ya está registrado por otro usuario');
            }
          } catch (checkError) {
            if (checkError.message.includes('ya está registrado')) {
              throw checkError;
            }
          }
        }
        
        const updateData = {
          name: newName
        };
        
        if (newEmail !== this._user.email) {
          updateData.email = newEmail;
        }
        
        const updatedUser = await clientService.updateClient(userId, updateData);
        
        if (updatedUser) {
          this._user = {
            ...this._user,
            name: newName,
            ...(newEmail !== this._user.email ? { email: newEmail } : {})
          };
          
          localStorage.setItem('user', JSON.stringify(this._user));
          
          return this._user;
        } else {
          throw new Error('No se pudo actualizar el perfil');
        }
      } catch (error) {
        this._error = error.message;
        throw error;
      } finally {
        this._loading = false;
      }
    },
    
    clearSession() {
      this._token = null;
      this._user = null;
      this._error = null;
      localStorage.removeItem('token');
      localStorage.removeItem('user');
      localStorage.removeItem('user_id');
    }
  }
});
