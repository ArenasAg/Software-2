DROP DATABASE IF EXISTS facturaya;

CREATE DATABASE facturaya;
USE facturaya;

CREATE TABLE categorias (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL
);

INSERT INTO categorias (nombre) VALUES ('Electrónica'), ('Ropa'), ('Alimentos');

CREATE TABLE clientes (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    numero_documento VARCHAR(10) NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telefono VARCHAR(10) NOT NULL,
    ciudad VARCHAR(255) NOT NULL
);

INSERT INTO clientes (numero_documento, nombre, direccion, email, telefono, ciudad) VALUES
('1234567890', 'Juan Perez', 'Calle Falsa 123', 'juan@example.com', '5551234', 'Ciudad A'),
('0987654321', 'Maria Lopez', 'Avenida Siempre Viva 456', 'maria@example.com', '5555678', 'Ciudad B');

CREATE TABLE impuestos (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    porcentaje DECIMAL(5, 2) NOT NULL
);

INSERT INTO impuestos (nombre, porcentaje) VALUES ('IVA', 16.00), ('ISR', 10.00);

CREATE TABLE productos (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(255) UNIQUE NOT NULL,
    nombre VARCHAR(255) NOT NULL,
    imagen VARCHAR(255),
    precio DECIMAL(10, 2) NOT NULL,
    medida DECIMAL(5, 2) NOT NULL,
    stock INT NOT NULL,
    categoria_id BIGINT NOT NULL,
    impuesto_id BIGINT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES categorias(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (impuesto_id) REFERENCES impuestos(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT INTO productos (codigo, nombre, imagen, precio, medida, stock, categoria_id, impuesto_id) VALUES
('P001', 'Laptop', 'laptop.jpg', 1500.00, 1.00, 10, 1, 1),
('P002', 'Camiseta', 'camiseta.jpg', 20.00, 1.00, 50, 2, 1),
('P003', 'Manzana', 'manzana.jpg', 1.00, 1.00, 100, 3, 2);

CREATE TABLE metodo_pagos (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    identificador VARCHAR(255)
);

INSERT INTO metodo_pagos (nombre, identificador) VALUES
('Tarjeta de Crédito', 'TC001'),
('Efectivo', 'EF001');

CREATE TABLE facturas (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    codigo VARCHAR(255) NOT NULL,
    fecha TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    subtotal DECIMAL(10, 2) NOT NULL,
    total_impuestos DECIMAL(10, 2) NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    estado BOOLEAN NOT NULL,
    cliente_id BIGINT NOT NULL,
    metodo_pago_id BIGINT NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (metodo_pago_id) REFERENCES metodo_pagos(id) ON UPDATE CASCADE ON DELETE RESTRICT
);

INSERT INTO facturas (codigo, fecha, subtotal, total_impuestos, total, estado, cliente_id, metodo_pago_id) VALUES
('F001', '2024-11-11 10:00:00', 100.00, 16.00, 116.00, TRUE, 1, 1),
('F002', '2024-11-12 11:00:00', 50.00, 8.00, 58.00, TRUE, 2, 2);

CREATE TABLE detalle_facturas (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(8, 2) NOT NULL,
    valor_total DECIMAL(8, 2) NOT NULL,
    descuento DECIMAL(5, 2) NOT NULL,
    producto_id BIGINT NOT NULL,
    factura_id BIGINT NOT NULL,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (factura_id) REFERENCES facturas(id) ON UPDATE CASCADE ON DELETE CASCADE
);

INSERT INTO detalle_facturas (cantidad, precio_unitario, valor_total, descuento, producto_id, factura_id) VALUES
(2, 50.00, 100.00, 0.00, 1, 1),
(1, 20.00, 20.00, 0.00, 2, 2);

CREATE TABLE informes (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    tipo_informe CHAR(1) NOT NULL,
    datos_json TEXT NOT NULL
);

INSERT INTO informes (fecha, tipo_informe, datos_json) VALUES
('2024-11-11', 'A', '{"ventas": 1000, "compras": 500}'),
('2024-11-12', 'B', '{"ventas": 1500, "compras": 700}');

CREATE TABLE inventarios (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    fecha DATE NOT NULL,
    tipo_movimiento VARCHAR(255) NOT NULL
);

INSERT INTO inventarios (fecha, tipo_movimiento) VALUES
('2024-11-11', 'Entrada'),
('2024-11-12', 'Salida');

CREATE TABLE inventario_detalles (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    inventario_id BIGINT NOT NULL,
    producto_id BIGINT NOT NULL,
    cantidad INT NOT NULL,
    FOREIGN KEY (inventario_id) REFERENCES inventarios(id) ON DELETE CASCADE,
    FOREIGN KEY (producto_id) REFERENCES productos(id) ON DELETE CASCADE
);

INSERT INTO inventario_detalles (inventario_id, producto_id, cantidad) VALUES
(1, 1, 10),
(2, 2, 5);