export interface Product {
  id?: number;
  id_producto?: number;
  name: string;
  description?: string;
  stock: number;
}

export interface CartItem {
  id: number | string;
  name: string;
  stock: number;
  quantity: number;
}

export interface OrderResponse {
  status: 'success' | 'error';
  data?: any;
  message?: string;
} 