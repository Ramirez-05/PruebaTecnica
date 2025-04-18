export const API_BASE_URL = 'http://localhost:8000';

export const API_ENDPOINTS = {
    LOGIN: '/login',
    CLIENTS: '/clients',
    CLIENT_BY_ID: (id) => `/clients/${id}`,
    PRODUCTS: '/products',
    AVAILABLE_PRODUCTS: (clientId) => `/products/available/client/${clientId}`,
    ORDERS: '/orders'
};
