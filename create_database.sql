CREATE DATABASE IF NOT EXISTS SEERW_LOG;

USE SEERW_LOG;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rfc_empresa VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);
