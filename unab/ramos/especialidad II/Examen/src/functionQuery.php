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
            $consultaSQL = "INSERT INTO vendedor    (nombre, comision_cod, precio_cod, cantidad_cod, comision_min, precio_min, cantidad_min, comision_for, precio_for, cantidad_for, created_at, updated_at) VALUES ('".$seller->getNombre()."','".$seller->comisionCOD()."','".$seller->ventasCOD()."','".$seller->getCantVentCod()."','".$seller->comisionMINE()."','".$seller->ventasMINE()."','".$seller->getCantVentMine()."','".$seller->comisionFORT()."','".$seller->ventasFORT()."','".$seller->getCantVentFort()."','".$date."','".$date."')";
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();            
            return "Guardado con exito";
        } catch(PDOException $error){
            $error =$error->getMessage();
            echo $error;
            return "Se produjo un error";
        }
   }

    function getAllSeller($listGame){
        try {
            $conexion = getConection();
            $consultaSQL = "SELECT * FROM vendedor";
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();
            $sellers = $sentencia->fetchAll();
            $listSellers = array();
            foreach($sellers as $fila){
                $vendedor = new Vendedor($fila['nombre'],$fila['cantidad_cod'],$fila['cantidad_min'],$fila['cantidad_for'],$listGame[0],$listGame[1],$listGame[2]);
                $vendedor->setId($fila['id']);
                array_push($listSellers, $vendedor);
            }
            return $listSellers;
        } catch(PDOException $error){
            $error =$error->getMessage();
            echo $error;
            return null;
        }
    }
    function deleteSeller($id_vendedor){
        try{
            $conexion = getConection();
            $consultaSQL = "DELETE FROM vendedor WHERE id=".$id_vendedor;
            echo $consultaSQL;
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();
            return "Eliminado con exito";
        }catch(PDOException $error){
            $error =$error->getMessage();
            echo $error;
            return null;
        }
    }
    function updateSeller($seller){
        try {
            $date = date('Y-m-d h:m:s');
            $conexion = getConection();
            $consultaSQL = "UPDATE vendedor SET nombre='".$seller->getNombre()."',comision_cod='".$seller->comisionCOD()."',precio_cod='".$seller->ventasCOD()."',cantidad_cod='".$seller->getCantVentCod()."',comision_min='".$seller->comisionMINE()."',precio_min='".$seller->ventasMINE()."',cantidad_min='".$seller->getCantVentMine()."',comision_for='".$seller->comisionFORT()."',precio_for='".$seller->ventasFORT()."',cantidad_for='".$seller->getCantVentFort()."',updated_at='".$date."' WHERE id=".$seller->getId();
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();
            return "Actualizado correctamente";
        } catch (PDOException $error) {
            $error = $error->getMessage();
            return $error ;
        }
    }
?>