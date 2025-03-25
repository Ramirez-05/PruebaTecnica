CREATE DATABASE pruebatecnica;
USE tienda;

CREATE TABLE clients (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255)
);

CREATE TABLE products (
    id_producto INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    stock INT
);

CREATE TABLE client_product (
    id_client_product INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT,
    id_producto INT,
    FOREIGN KEY (id_cliente) REFERENCES clients(id_cliente),
    FOREIGN KEY (id_producto) REFERENCES products(id_producto)
);

CREATE TABLE orders (
    id_pedido INT PRIMARY KEY AUTO_INCREMENT,
    id_cliente INT,
    created_at DATETIME,
    FOREIGN KEY (id_cliente) REFERENCES clients(id_cliente)
);

CREATE TABLE order_details (
    id_order_detail INT PRIMARY KEY AUTO_INCREMENT,
    id_pedido INT,
    id_producto INT,
    quantity INT,
    FOREIGN KEY (id_pedido) REFERENCES orders(id_pedido),
    FOREIGN KEY (id_producto) REFERENCES products(id_producto)
);
