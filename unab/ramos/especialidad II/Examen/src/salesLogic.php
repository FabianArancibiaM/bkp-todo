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
        // Se asigna el id del juego
        function setId($id){ $this->id = $id;}
        // Retorna el id del juego
        function getId(){ return $this->id;}
        // Retorna el nombre del juego
        function getNombre(){ return $this->nomb;}
        // Retorna el precio del juego
        function getPrecio(){ return $this->precio;}
        // Retorna la comisio del juego
        function getComision(){ return ($this->comision * $this->precio)/100;}
    }

    class Vendedor {
        private $id;
        private $nomb_vendedor;
        private $cant_vent_cod;
        private $cant_vent_min;
        private $cant_vent_fort;
        private $game_cod;
        private $game_min;
        private $game_fort;

        function __construct($nomb_vendedor, $cant_vent_cod, $cant_vent_min, $cant_vent_fort, $game_cod, $game_min, $game_fort)
        {
            $this->nomb_vendedor = $nomb_vendedor;
            $this->cant_vent_cod = $cant_vent_cod;
            $this->cant_vent_min = $cant_vent_min;
            $this->cant_vent_fort = $cant_vent_fort;
            $this->game_cod = $game_cod;
            $this->game_min = $game_min;
            $this->game_fort = $game_fort;
        }
        // Retorna el id del vendedor
        function getId(){ return $this->id;}
        // Asigna el id del vendedor
        function setId($id){ $this->id = $id;}
        // Retorna el nombre del vendedor
        function getNombre(){ return $this->nomb_vendedor;}
        // Retorna la cantidad de ventas que tiene CALL OF DUTY
        function getCantVentCod(){
            return $this->cant_vent_cod;
        }
        // Retorna la cantidad de ventas que tiene MINECRAFT
        function getCantVentMine(){
            return $this->cant_vent_min;
        }
        // Retorna la cantidad de ventas que tiene FORTNITE
        function getCantVentFort(){
            return $this->cant_vent_fort;
        }
        // Retorna el nombre del juego que mas se vendio
        function bestSellingGame(){
            if( $this->cant_vent_cod > $this->cant_vent_min && $this->cant_vent_cod > $this->cant_vent_fort ){ return 'game_cod';}
            if( $this->cant_vent_min > $this->cant_vent_cod && $this->cant_vent_min > $this->cant_vent_fort ){ return 'game_min';}
            if( $this->cant_vent_fort > $this->cant_vent_cod && $this->cant_vent_fort > $this->cant_vent_min ){ return 'game_fort';}
        }
        // Retorna el valor total de ventas de los 3 juegos
        function totalVentas(){
            return ($this->ventasCOD() + $this->ventasMINE() + $this->ventasFORT());
        }
        // Retorna el valor de ventas total que tiene CALL OF DUTY
        function ventasCOD(){
            return ($this->game_cod->getPrecio() * $this->cant_vent_cod);
        }
        // Retorna el valor de ventas total que tiene MINECRAFT
        function ventasMINE(){
            return ($this->game_min->getPrecio() * $this->cant_vent_min);
        }
        // Retorna el valor de ventas total que tiene FORTNITE
        function ventasFORT(){
            return  ($this->game_fort->getPrecio() * $this->cant_vent_fort);
        }
        // Retorna el valor total de las comisiones de los 3 juegos
        function totalComision(){
            return $this->comisionCOD() + $this->comisionMINE() + $this->comisionFORT();
        }
        // Retorna el valor total de las comisiones que tiene CALL OF DUTY
        function comisionCOD(){
            return $this->game_cod->getComision() * $this->cant_vent_cod;
        }
        // Retorna el valor total de las comisiones que tiene MINECRAFT
        function comisionMINE(){
            return ($this->game_min->getComision() * $this->cant_vent_min);
        }
        // Retorna el valor total de las comisiones que tiene FORTNITE
        function comisionFORT(){
            return  ($this->game_fort->getComision() * $this->cant_vent_fort);
        }
    }
?>

<?php
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
        return $mejorVendedor-> getNombre();     
    }
    // La funcion busca al vendedor que tiene el valor de comision mayor
    function higherCommission($listVendedores){
        $mejorVendedor = null;
        foreach ($listVendedores as &$valor){
            if($mejorVendedor == null) {
                $mejorVendedor = $valor;
            } else {
                if($mejorVendedor -> totalComision() <= $valor -> totalComision()){
                    $mejorVendedor = $valor;
                }
            }
        }
        return $mejorVendedor-> getNombre();     
    }
    // La funcion retorna la ruta de la imagen del juego que mas se vendio, si no hay un juego ganador, se muestra una imagen por default
    function gameOutstanding($vendedor){
        if($vendedor->bestSellingGame() == 'game_cod'){return './img/call-of-duty-warzone.jpg';}
        if($vendedor->bestSellingGame() == 'game_min'){return './img/mine.jpg';}
        if($vendedor->bestSellingGame() == 'game_fort'){return './img/Fortnite.jpg';}
        return './img/logo-empresa.png';
    }

?>