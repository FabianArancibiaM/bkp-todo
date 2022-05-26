<?php 
// Se obtienen los datos de configuración de la BBDD
$config= include 'config.php';

try {
	// Se realiza la conexion a la BBDD
	$conexion = new PDO('mysql:host='.$config['db']['host'],$config['db']['user'],$config['db']['pass'],$config['db']['option']);
	// Se ejecuta el script para crear la BBDD
	$sql=file_get_contents('sql/create.sql');
	$conexion->exec($sql);

	// Se ejecuta query para saber si la tabla "juego" tiene datos 
	$consultaSQL = "SELECT * FROM juego";
	$sentencia = $conexion->prepare($consultaSQL);
	$sentencia->execute();
	$juegos = $sentencia->fetchAll();
	if (count($juegos)==0) {
		// Inserta los juegos de la tienda en caso de no tener datos las BBDD
		$sql=file_get_contents('sql/insert.sql');
		$conexion->exec($sql);
	}
} catch(PDOException $error){
	echo $error->getMessage();
}
?>