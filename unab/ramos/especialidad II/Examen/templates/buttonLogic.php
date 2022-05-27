<?php 
    if(array_key_exists('button1', $_POST)) {
        // Muestra el formulario
        $var = 1;
    }else if(array_key_exists('button2', $_POST)) {
        // Muestra la tabla de vendedores
        $var = 2;
        $dinamicStyle = false;
        $isUpdate=false;
    }else if(array_key_exists('button3', $_POST)) {
        // Resalta la fila del vendedor con mas ventas
        $dinamicStyle = true;
        $var = 2;
        $bestSellerName = biggestSale($listVendedores);
        $venta =true;
        $comision = false;
    }else if(array_key_exists('button4', $_POST)) {
        // Resalta la fila del vendedor con mas comision
        $venta =false;
        $comision = true;
        $dinamicStyle = true;
        $var = 2;
        $bestSellerName = higherCommission($listVendedores);   
    }else if(array_key_exists('agregar', $_GET)) {
        // Crea y agrega un nuevo vendedor
        $nom=$_REQUEST['nom'];
        $cod=$_REQUEST['cant_cod'];
        $mine=$_REQUEST['cant_mine'];
        $fort=$_REQUEST['cant_fort'];
        $vendedor = new Vendedor($nom, $cod, $mine, $fort, $listGame[0], $listGame[1], $listGame[2]);
        $text = saveSeller($vendedor);
        $new_seller = $vendedor;
        $var = 1;
        $isUpdate=false;
    }else if(array_key_exists('edit', $_GET)) {
        // Envia a pantalla editar y busca los datos del vendedor
        $id_vendedor=$_REQUEST['id_vendedor'];
        foreach ($listVendedores as $valor) {
            if($valor->getId()==$id_vendedor){
                $new_seller = $valor;
            }
        }
        $var = 1;
        $isUpdate=true;
    }else if(array_key_exists('delete', $_GET)) {
        // Elimina al vendedor y su venta
        $id_vendedor=$_REQUEST['id_vendedor'];
        $text = deleteSeller($id_vendedor);
        $listVendedores = getAllSeller($listGame);
        $var = 0;
    }else if(array_key_exists('update', $_GET)) {
        // Actualiza los datos del vendedor seleccionado
        $id_vendedor=$_REQUEST['id_vendedor'];
        $nom=$_REQUEST['nom'];
        $cod=$_REQUEST['cant_cod'];
        $mine=$_REQUEST['cant_mine'];
        $fort=$_REQUEST['cant_fort'];
        $vendedor = new Vendedor($nom, $cod, $mine, $fort, $listGame[0], $listGame[1], $listGame[2]);
        $vendedor->setId($id_vendedor);
        $text = updateSeller($vendedor);
        $var = 0;
    }
?>