-- Seleccionamos la base de datos
USE dwes;

-- Creamos la tabla
CREATE TABLE usuarios (
	usuario VARCHAR(20) NOT NULL PRIMARY KEY,
	contrasena VARCHAR(32) NOT NULL
) ENGINE = INNODB;

-- Creamos el usuario dwes
INSERT INTO usuarios (usuario, contrasena) VALUES
('dwes', 'e8dc8ccd5e5f9e3a54f07350ce8a2d3d');
