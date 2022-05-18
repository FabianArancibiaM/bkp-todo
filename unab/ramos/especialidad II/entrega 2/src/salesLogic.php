// Se declaran las clases a utilizar 
<?php 
// Juego -> Datos de los juegos
// Vendedor -> Datos de los vendedores a registrar

    class Juego {
        private $nomb;
        private $precio;
        private $comision;

        function __construct($nomb, $precio, $comision){
            $this->nomb = $nomb;
            $this->precio = $precio;
            $this->comision = $comision;
        }
        // Retorna el nombre del juego
        function getNombre(){ return $this->nomb;}
        // Retorna el precio del juego
        function getPrecio(){ return $this->precio;}
        // Retorna la comisión del juego
        function getComision(){ return ($this->comision * $this->precio)/100;}
    }

    class Vendedor {
        private $nomb_vendedor;
        private $cant_vent_cod;
        private $cant_vent_min;
        private $cant_vent_fort;
        private $game_cod;
        private $game_min;
        private $game_fort;

        function __construct($nomb_vendedor, $cant_vent_cod, $cant_vent_min, $cant_vent_fort)
        {
            $this->nomb_vendedor = $nomb_vendedor;
            $this->cant_vent_cod = $cant_vent_cod;
            $this->cant_vent_min = $cant_vent_min;
            $this->cant_vent_fort = $cant_vent_fort;
            $this->game_cod = new Juego("CALL OF DUTY", 34500, 6);
            $this->game_min = new Juego("MINECRAFT", 8800, 4);
            $this->game_fort = new Juego("FORTNITE", 58200, 9);
        }
        // Retorna el nombre del vendedor
        function nombre(){
            return $this->nomb_vendedor;
        }
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
    function validNewSales($var)
    {
        foreach ($_SESSION['list_seller'] as &$valor){
            if($valor->nombre() == $var->nombre()){
                return true;
            }
        }
        return false;
    }
    // La funcion busca al vendedor que tiene el valor de ventas mayor
    function biggestSale(){
        $mejorVendedor = null;
        foreach ($_SESSION['list_seller'] as &$valor){
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
    function higherCommission(){
        $mejorVendedor = null;
        foreach ($_SESSION['list_seller'] as &$valor){
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