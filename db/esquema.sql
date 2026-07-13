-- Creación de la Base de Datos con soporte internacional
CREATE DATABASE IF NOT EXISTS sistema_seguro
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE sistema_seguro;

-- Creación de la tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL UNIQUE,
    -- El password_hash se define de 255 caracteres porque PASSWORD_BCRYPT 
    -- genera cadenas de 60 caracteres, pero PHP recomienda dejar espacio para futuras actualizaciones.
    password_hash VARCHAR(255) NOT NULL,
    creado_en TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;