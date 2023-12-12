CREATE DATABASE IF NOT EXISTS ServicioCorreo;

USE ServicioCorreo;

CREATE TABLE IF NOT EXISTS emails (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    tipo_cesta TEXT NOT NULL,
);

INSERT INTO emails (nombre, email, tipo_cesta) VALUES ('Juan', 'juan@example.com','con');
INSERT INTO emails (nombre, email, tipo_cesta) VALUES ('María', 'maria@example.com','sin');
INSERT INTO emails (nombre, email, tipo_cesta) VALUES ('Carlos', 'carlos@example.com','con');
INSERT INTO emails (nombre, email, tipo_cesta) VALUES ('Marcos', 'navidadleonmarcos@gmail.com','con');


