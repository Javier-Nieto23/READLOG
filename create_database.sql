
CREATE DATABASE IF NOT EXISTS SEERW_LOG;

USE SEERW_LOG;

-- Tabla de usuarios (sin seguridad de hash para contraseñas)
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rfc_empresa VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);

-- Tabla de clientes
CREATE TABLE IF NOT EXISTS clientes (
    idcliente INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    numTel VARCHAR(20) NOT NULL
);

-- Tabla de productos
CREATE TABLE IF NOT EXISTS productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    idcliente INT,
    nombre VARCHAR(255) NOT NULL,
    descripcion TEXT NOT NULL,
    costo_importe DECIMAL(10, 2) NOT NULL,
    costo_iva DECIMAL(10, 2) NOT NULL,
    costo_total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (idcliente) REFERENCES clientes(idcliente)
);

-- Tabla de logs
CREATE TABLE IF NOT EXISTS logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    usuario VARCHAR(255) NOT NULL,
    accion VARCHAR(255) NOT NULL
);
