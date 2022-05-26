-- El script se ejecuta al iniciar la aplicacion de vendedores
-- Se crea la base de dato si no existe
CREATE DATABASE IF NOT EXISTS tienda_xyz;
use tienda_xyz;
-- Se crea la tabla vendedor si no existe
CREATE TABLE IF NOT EXISTS vendedor (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-- Se crea la tabla juego si no existe
CREATE TABLE IF NOT EXISTS juego (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    comision INT(11) NOT NULL,
    precio INT(11) NOT NULL,
    nombre VARCHAR(30) NOT NULL
);
-- Se crea la tabla venta si no existe
CREATE TABLE IF NOT EXISTS venta (
    id_vendedor INT(11),
    id_juego INT(11),
    comision INT(11) NOT NULL,
    precio INT(11) NOT NULL,
    cantidad INT(11) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_vendedor) REFERENCES vendedor(id),
    FOREIGN KEY (id_juego) REFERENCES juego(id)
);