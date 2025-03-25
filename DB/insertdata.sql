INSERT INTO clients (name, email, password) VALUES
('Juan Pérez', 'juan.perez@email.com', '$2a$12$NW/GvaUUGTCxU/5fA8ChPO2bMNYBNPT4j653jYzTajKkqfKWS8cUe'),
('María Gómez', 'maria.gomez@email.com', '$2a$12$NW/GvaUUGTCxU/5fA8ChPO2bMNYBNPT4j653jYzTajKkqfKWS8cUe'),
('Carlos Ramírez', 'carlos.ramirez@email.com', '$2a$12$NW/GvaUUGTCxU/5fA8ChPO2bMNYBNPT4j653jYzTajKkqfKWS8cUe');

INSERT INTO products (name, stock) VALUES
('Laptop', 50),
('Teléfono', 50),
('Tablet', 50),
('Monitor', 50);

INSERT INTO client_product (id_cliente, id_producto) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4),
(2, 1);

INSERT INTO orders (id_cliente, created_at) VALUES
(1, '2024-03-24 10:00:00'),
(2, '2024-03-23 15:30:00'),
(3, '2024-03-22 09:45:00');

INSERT INTO order_details (id_pedido, id_producto, quantity) VALUES
(1, 1, 1),  -- Pedido 1: 1 Laptop
(1, 2, 2),  -- Pedido 1: 2 Teléfonos
(2, 3, 1),  -- Pedido 2: 1 Tablet
(3, 4, 1),  -- Pedido 3: 1 Monitor
(3, 1, 1);  -- Pedido 3: 1 Laptop
