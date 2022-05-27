<?php 
// Se declaran las clases a utilizar 
// Juego -> Datos de los juegos
// Vendedor -> Datos de los vendedores a registrar

    class Juego {
        private $id;
        private $nomb;
        private $precio;
        private $comision;
        private $cantidad;

        function __construct($id,$nomb, $precio, $comision){
            $this->nomb = $nomb;
            $this->precio = $precio;
            $this->comision = $comision;
            $this->id = $id;
        }
        function toString(){
            return "id: ".$this->id."nombre: ".$this->nomb."// precio: ".$this->precio."// comision: ".$this->comision." // Total precio:".$this->getTotalPrecio()." // Total comision:".$this->getTotalComision()  ;
        }
        // Se asigna la cantidad de juegos vendidos
        function setCantidad($cantidad){ $this->cantidad = $cantidad;}
        // Se asigna el id del juego
        function setId($id){ $this->id = $id;}
        // Retorna el id del juego
        function getId(){ return $this->id;}
        // Retorna el nombre del juego
        function getNombre(){ return $this->nomb;}
        // Retorna el precio del juego
        function getPrecio(){ return $this->precio;}
        // Retorna la cantidad de juegos vendidos
        function getCantidad(){ return $this->cantidad;}
        // Retorna la comisión del juego
        function getComision(){ return ($this->comision * $this->precio)/100;}
        // Retorna el valor total del juego
        function getTotalPrecio(){ return ($this->cantidad * $this->precio);}
        // Retorna la comisión total del juego
        function getTotalComision(){ return ($this->cantidad * $this->getComision());}
    }

    class Vendedor {
        private $id;
        private $nomb_vendedor;
        private $juegos;

        function __construct($nomb_vendedor)
        {
            $this->nomb_vendedor = $nomb_vendedor;
        }
        function toString(){
            return "id: ".$this->id."nombre: ".$this->nomb_vendedor."=>".$this->juegos[0]->toString()."=>".$this->juegos[1]->toString()."=>".$this->juegos[2]->toString();
        }
        // Retorna el nombre del vendedor
        function getNombre(){ return $this->nomb_vendedor;}
        // Se asigna el id del vendedor
        function setId($id){
            $this->id = $id;
        }
        // Se obtiene el id del vendedor
        function getId(){
            return $this->id;
        }
        // Se asigna el id del vendedor
        function addGame($game){
            $newList;
            if (!isset($this->juegos)){
                $newList=array();
            } else {
                $newList = $this->juegos;
            }
            array_push($newList, $game);
            $this->juegos = $newList;
        }
        // Se obtiene el id del vendedor
        function getListGame(){
            return $this->juegos;
        }
        
        // Retorna el nombre del juego que mas se vendio
        function bestSellingGame(){
            $cant_vent_cod = $this->juegos[0]->getCantidad();
            $cant_vent_min = $this->juegos[1]->getCantidad();
            $cant_vent_fort = $this->juegos[2]->getCantidad();
            if( $cant_vent_cod > $cant_vent_min && $cant_vent_cod > $cant_vent_fort ){ return 'game_cod';}
            if( $cant_vent_min > $cant_vent_cod && $cant_vent_min > $cant_vent_fort ){ return 'game_min';}
            if( $cant_vent_fort > $cant_vent_cod && $cant_vent_fort > $cant_vent_min ){ return 'game_fort';}
        }

        function biggestSale(){
            $bigger
            foreach ($this->juegos as $value) {
                
            }
        }
    }
?>

<?php
    // La funcion inicializa y agrega a la lista de vendedores, y la guarda en la sesion
    function appendList($seller){
        if (!isset($_SESSION['list_seller'])){
            $_SESSION['list_seller']=array();
        } 
        if(!validNewSales($seller)){
            $list_seller = $_SESSION['list_seller'];
            array_push($list_seller, $seller);
            $_SESSION['list_seller'] = $list_seller;
            return "Guardado con exito";
        }
        return "El vendedor ingresado ya existe";
    }
    // La funcion valida que los nombres de los vendedores no se repita
    function validNewSales($var){
        foreach ($_SESSION['list_seller'] as &$valor){
            if($valor->nombre() == $var->nombre()){
                return true;
            }
        }
        return false;
    }
    // La funcion busca al vendedor que tiene el valor de ventas mayor
    function biggestSale($listVendedores){
        $mejorVendedor = null;
        foreach ($listVendedores as &$valor){
            if($mejorVendedor == null) {
                $mejorVendedor = $valor;
            } else {
                if($mejorVendedor -> totalVentas() <= $valor -> totalVentas()){
                    $mejorVendedor = $valor;
                }
            }
        }
        return $mejorVendedor-> nombre();     
    }
    // La funcion busca al vendedor que tiene el valor de comision mayor
    function higherCommission($listVendedores){
        $mejorVendedor = null;
        foreach ($listGame as &$valor){
            if($mejorVendedor == null) {
                $mejorVendedor = $valor;
            } else {
                if($mejorVendedor -> totalComision() <= $valor -> totalComision()){
                    $mejorVendedor = $valor;
                }
            }
        }
        return $mejorVendedor-> nombre();     
    }
    // La funcion retorna la ruta de la imagen del juego que mas se vendio, si no hay un juego ganador, se muestra una imagen por default
    function gameOutstanding($vendedor){
        if($vendedor->bestSellingGame() == 'game_cod'){return './img/call-of-duty-warzone.jpg';}
        if($vendedor->bestSellingGame() == 'game_min'){return './img/mine.jpg';}
        if($vendedor->bestSellingGame() == 'game_fort'){return './img/Fortnite.jpg';}
        return './img/logo-empresa.png';
    }

?>