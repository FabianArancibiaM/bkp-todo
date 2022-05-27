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
        try{
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
        }catch(PDOException $error){
            $error =$error->getMessage();
            echo $error;
            return null;
        }
    }
    function deleteSeller($id_vendedor){
        try{
            $conexion = getConection();
            $consultaSQL = "DELETE FROM venta WHERE id_vendedor=".$id_vendedor;
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();
            $consultaSQL = "DELETE FROM vendedor WHERE id=".$id_vendedor;
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();
            return "Eliminado con exito";
        }catch(PDOException $error){
            $error =$error->getMessage();
            echo $error;
            return null;
        }
    }
    function updateSeller($vendedor){
        try {
            $date = date('Y-m-d h:m:s');
            $conexion = getConection();
            $consultaSQL = "UPDATE vendedor SET nombre='".$vendedor->getNombre()."',updated_at='".$date."' WHERE id=".$vendedor->getId();
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();
            foreach($vendedor->getListGame() as $juego){
                $consultaSQL = "UPDATE venta SET comision='".$juego->getTotalComision()."',precio='".$juego->getTotalPrecio()."',cantidad='".$juego->getCantidad()."',updated_at='".$date."' WHERE id_vendedor = ".$vendedor->getId()." and id_juego =".$juego->getId();
                $sentencia = $conexion->prepare($consultaSQL);
                $sentencia->execute();
            }
            return "Actualizado correctamente";
        } catch (PDOException $error) {
            $error = $error->getMessage();
            return $error ;
        }
    }
?>