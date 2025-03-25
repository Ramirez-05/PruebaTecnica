export interface CartItem {
  id: number;
  name: string;
  stock: number;
  quantity: number;
}

export interface OrderItem {
  product_id: number;
  quantity: number;
}

export interface Order {
  client_id: number;
  items: OrderItem[];
} 