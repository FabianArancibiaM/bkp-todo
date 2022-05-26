<?php 
   function getConection(){
        $config = include './src/config.php';
        $dsn = 'mysql:host='.$config['db']['host'].';dbname='.$config['db']['name'];
        return new PDO($dsn,$config['db']['user'],$config['db']['pass'],$config['db']['option']);
   }
   function getAllGame(){
        try {
            $conexion = getConection();
            $consultaSQL = "SELECT * FROM juego";
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();
            $juegos = $sentencia->fetchAll();
            $list = array();
            foreach($juegos as $fila){
                $newGame = new Juego($fila["id"],$fila["nombre"],$fila["precio"],$fila["comision"]);
                array_push($list, $newGame);
            }
            return $list;
        } catch(PDOException $error){
            $error =$error->getMessage();
        }
   }
   function saveSeller($seller){
        try {
            $date = date('Y-m-d h:m:s');
            $conexion = getConection();
            $consultaSQL = "INSERT INTO `vendedor` (`id`, `nombre`, `created_at`, `updated_at`) VALUES (NULL, '".$seller->getNombre()."', '".$date."', '".$date."')";
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();
            $indexBD = $conexion->lastInsertId();
            $consultaSQL = "INSERT INTO `venta` (`id_vendedor`, `id_juego`, `comision`, `precio`, `cantidad`, `created_at`, `updated_at`) VALUES";
            $contador = 1;
            foreach($seller->getListGame() as $fila){
                $consultaSQL = $consultaSQL." ('".$indexBD."', '".$fila->getId()."', '".$fila->getTotalComision()."', '".$fila->getTotalPrecio()."', '".$fila->getCantidad()."', '".$date."', '".$date."')";
                if($contador<count($seller->getListGame())){
                    $consultaSQL = $consultaSQL.",";
                    $contador = $contador +1;
                }
            }
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();
            return "Guardado con exito";
        } catch(PDOException $error){
            $error =$error->getMessage();
            echo $error;
            return "Se produjo un error";
        }
   }

    function getAllSeller(){
        try {
            $conexion = getConection();
            $consultaSQL = "SELECT * FROM vendedor";
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();
            $sellers = $sentencia->fetchAll();
            $listSellers = array();
            foreach($sellers as $fila){
                $vendedor = new Vendedor($fila['1']);
                $vendedor->setId($fila['0']);
                getVentas($vendedor);
                array_push($listSellers, $vendedor);
            }
            return $listSellers;
        } catch(PDOException $error){
            $error =$error->getMessage();
            echo $error;
            return null;
        }
    }
    function getVentas($vendedor){
        $conexion = getConection();
        $consultaSQL = "SELECT venta.id_vendedor,venta.comision, venta.precio, venta.cantidad, juego.comision, juego.precio, juego.nombre, juego.id FROM venta INNER JOIN juego ON juego.id =venta.id_juego WHERE venta.id_vendedor = ".$vendedor->getId().";";
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();
        $sellers = $sentencia->fetchAll();
        foreach($sellers as $fila){
            $newGame = new Juego($fila["id"],$fila["nombre"],$fila["precio"],$fila["comision"]);
            $newGame->setCantidad($fila["3"]);
            $vendedor->addGame($newGame);
        }
    }
    
?>