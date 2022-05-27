-- El script se ejecuta al iniciar la aplicacion de vendedores
-- Se crea la base de dato si no existe
CREATE DATABASE IF NOT EXISTS juegos;
use juegos;
-- Se crea la tabla vendedor si no existe
CREATE TABLE IF NOT EXISTS vendedor (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL,
    comision_cod INT(11) NOT NULL,
    precio_cod INT(11) NOT NULL,
    cantidad_cod INT(11) NOT NULL,
    comision_min INT(11) NOT NULL,
    precio_min INT(11) NOT NULL,
    cantidad_min INT(11) NOT NULL,
    comision_for INT(11) NOT NULL,
    precio_for INT(11) NOT NULL,
    cantidad_for INT(11) NOT NULL,
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