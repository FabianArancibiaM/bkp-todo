<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/salesPage-main.css">
	<title></title>
</head>
<body>
    <header class="header-page">
        <img class="left" src="./img/xyz.png" alt="seleccion">
        <img class="rigth" src="./img/logo-empresa.png" alt="seleccion">
    </header>
    <!-- Seccion de las tablas -->

    <?php 
        class Juego {
            private $nomb;
            private $precio;
            private $comision;

            function __construct($nomb, $precio, $comision){
                $this->nomb = $nomb;
                $this->precio = $precio;
                $this->comision = $comision;
            }

            function getNombre(){ return $this->nomb;}
            function getPrecio(){ return $this->precio;}
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

            function nombre(){
                return $this->nomb_vendedor;
            }

            function getCantVentCod(){
                return $this->cant_vent_cod;
            }

            function getCantVentMine(){
                return $this->cant_vent_min;
            }
            function getCantVentFort(){
                return $this->cant_vent_fort;
            }

            function bestSellingGame(){
                if( $this->cant_vent_cod > $this->cant_vent_min && $this->cant_vent_cod > $this->cant_vent_fort ){ return 'game_cod';}
                if( $this->cant_vent_min > $this->cant_vent_cod && $this->cant_vent_min > $this->cant_vent_fort ){ return 'game_min';}
                if( $this->cant_vent_fort > $this->cant_vent_cod && $this->cant_vent_fort > $this->cant_vent_min ){ return 'game_fort';}
            }

            function totalVentas(){
                return ($this->ventasCOD() + $this->ventasMINE() + $this->ventasFORT());
            }

            function ventasCOD(){
                return ($this->game_cod->getPrecio() * $this->cant_vent_cod);
            }

            function ventasMINE(){
                return ($this->game_min->getPrecio() * $this->cant_vent_min);
            }

            function ventasFORT(){
                return  ($this->game_fort->getPrecio() * $this->cant_vent_fort);
            }


            function totalComision(){
                return $this->comisionCOD() + $this->comisionMINE() + $this->comisionFORT();
            }

            function comisionCOD(){
                return $this->game_cod->getComision() * $this->cant_vent_cod;
            }

            function comisionMINE(){
                return ($this->game_min->getComision() * $this->cant_vent_min);
            }

            function comisionFORT(){
                return  ($this->game_fort->getComision() * $this->cant_vent_fort);
            }
        }
        function appendList($vendedor){
            if (!isset($_SESSION['list_vendedor'])){
                $_SESSION['list_vendedor']=array();
            } 
            if(!validNewSales($vendedor)){
                $list_vendedor = $_SESSION['list_vendedor'];
                array_push($list_vendedor, $vendedor);
                $_SESSION['list_vendedor'] = $list_vendedor;
                return "Guardado con exito";
            }
            return "El nombre ingresado ya existe";
        }
        function validNewSales($var)
        {
            foreach ($_SESSION['list_vendedor'] as &$valor){
                if($valor->nombre() == $var->nombre()){
                    return true;
                }
            }
            return false;
        }
        function mayorVenta(){
            $mejorVendedor = null;
            foreach ($_SESSION['list_vendedor'] as &$valor){
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
        function mayorComision(){
            $mejorVendedor = null;
            foreach ($_SESSION['list_vendedor'] as &$valor){
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
        function gameOutstanding($vendedor){
            if($vendedor->bestSellingGame() == 'game_cod'){return './img/call-of-duty-warzone.jpg';}
            if($vendedor->bestSellingGame() == 'game_min'){return './img/mine.jpg';}
            if($vendedor->bestSellingGame() == 'game_fort'){return './img/Fortnite.jpg';}
        }
        session_start();
        $vendedor = new Vendedor("Fernando", 3, 4 , 5);
        $vendedor1 = new Vendedor("jose", 8, 5 , 85);
        $vendedor2 = new Vendedor("Marcela", 80, 12 , 41);
        appendList($vendedor);
        appendList($vendedor1);
        appendList($vendedor2);
        ?>
    <form method="post" class="form-button">
        <input type="submit" name="button1" class="button" value="Agregar vendedor" />
        <input type="submit" name="button2" class="button" value="Mostrar vendedores" />
    </form>
    <?php
        $var = 0;
        $dinamicStyle=false;
        $text = "";
        $nombreMejorVendedor = "";
        $venta = false;
        $new_vendedor = null;
        if(array_key_exists('button1', $_POST)) {
            $var = 1;
        }
        else if(array_key_exists('button2', $_POST)) {
            $var = 2;
            $dinamicStyle = false;
        }
        else if(array_key_exists('button3', $_POST)) {
            $dinamicStyle = true;
            $var = 2;
            $nombreMejorVendedor = mayorVenta();
            $venta =true;
        }
        else if(array_key_exists('button4', $_POST)) {
            $venta =false;
            $dinamicStyle = true;
            $var = 2;
            $nombreMejorVendedor = mayorComision();
            
        }
        else if(array_key_exists('agregar', $_GET)) {
            $nom=$_REQUEST['nom'];
            $cod=$_REQUEST['cant_cod'];
            $mine=$_REQUEST['cant_mine'];
            $fort=$_REQUEST['cant_fort'];
            $new_vendedor = new Vendedor($nom, $cod, $mine , $fort);
            $var = 1;
            $text = appendList($new_vendedor);
        }
    ?>

    <?php if( $var == 1) { ?>
        <!-- Seccion formulario -->
        <section class="form-seller">
            <div class="box-form">
                <h1>Ingresar nuevo vendedor</h1>
                <form method="get">
                    <br>Nombre Vendedor
                    <input type="text" name="nom">
                    <br><br>Cantidad de ventas
                    <br><br>CALL OF DUTY
                    <br><input type="number" name="cant_cod">
                    <br>MINECRAFT
                    <br><input type="number" name="cant_mine">
                    <br>FORTNITE
                    <br><input type="number" name="cant_fort">
                    <br>
                    <br><input type="submit" name="agregar" value="Ingresar">
                </form>
                <?php 
                    if($text!=""){
                        echo "<h2>".$text."</h2>";
                    }
                ?>
            </div>
            <article class="box-rigth">
                <div class="box-resume">
                    <div class="box-game one">
                        <div class="image">
                            <img src="./img/call-of-duty-warzone.jpg" alt="seleccion">
                        </div>
                        <?php if($new_vendedor== null){
                            echo "Precio: $34.500";
                            echo "<br>Cantidad:";
                            echo "<br>Total: $";
                            echo "<br>Comisión: $ ";
                        } else {
                            echo "Precio: $34.500";
                            echo "<br>Cantidad: ".$new_vendedor->getCantVentCod();
                            echo "<br>Total: $".number_format($new_vendedor->ventasCOD(),0,",",".");
                            echo "<br>Comisión: $".number_format($new_vendedor->comisionCOD(),0,",",".");
                        }
                        ?>
                    </div>
                    <div class="box-game two">
                        <div class="image">
                            <img src="./img/Fortnite.jpg" alt="seleccion">
                        </div>
                    </div>
                    <div class="box-game three">
                        <div class="image">
                            <img src="./img/mine.jpg" alt="seleccion">
                        </div>
                    </div>
                </div>
            </article>
        </section>
    <?php } ?>

    <?php if( $var == 2) { ?>
        <section class="table-seller">
        <h1>Tabla de vendedores</h1>
        <article class="table1">
            <table border="2" class="table-game styled-table">
                <thead> 
                    <tr class="header-table">
                        <th>
                            Nombre Vendedor
                        </th>
                        <th style="border-left-color: black;">
                            Cantidad Ventas COD
                        </th>
                        <th>
                            Cantidad Ventas MINECRAFT
                        </th>
                        <th>
                            Cantidad Ventas FORTNITE
                        </th>
                        <th>
                            Total Ventas ($)
                        </th>
                        <th>
                            Comision Call of Duty
                        </th>
                        <th>
                            Comision Minecraft
                        </th>
                        <th>
                            Comision Fortnite
                        </th>
                        <th>
                            Comision Total
                        </th>
                        <th>
                            Juego más vendido
                        </th>
                    </tr>
                </thead>
                <?php foreach ($_SESSION['list_vendedor'] as &$valor) 
                    { ?>
                    <tbody>
                        <tr class="body-table 
                                <?php 
                                    if($dinamicStyle && $nombreMejorVendedor == $valor->nombre() )
                                    {echo 'active-row   ';} else {echo '';}
                                ?>">
                            <td>
                                <?php echo $valor->nombre(); ?> 
                            </td>
                            <td style="border-left-color: black;">
                                <?php echo number_format($valor->getCantVentCod(),0,",","."); ?> 
                            </td>
                            <td>
                                <?php echo number_format($valor->getCantVentMine(),0,",","."); ?> 
                            </td>
                            <td>
                                <?php echo number_format($valor->getCantVentFort(),0,",","."); ?> 
                            </td>
                            <td
                                class=" 
                                <?php 
                                    if($venta && $nombreMejorVendedor == $valor->nombre() )
                                    {echo 'highlight';} else {echo '';}
                                ?>"
                            >
                                <?php echo "$".number_format($valor->totalVentas(),0,",","."); ?>
                            </td>
                            <td>
                                <?php echo "$".number_format($valor->comisionCOD(),0,",","."); ?> 
                            </td>
                            <td>
                                <?php echo "$".number_format($valor->comisionMINE(),0,",","."); ?> 
                            </td>
                            <td>
                                <?php echo "$".number_format($valor->comisionFORT(),0,",","."); ?> 
                            </td>
                            <td
                            class=" 
                                <?php 
                                    if($dinamicStyle && $nombreMejorVendedor == $valor->nombre() )
                                    {echo 'highlight';} else {echo '';}
                                ?>"
                            >
                                <?php echo "$".number_format($valor->totalComision(),0,",","."); ?> 
                            </td>
                            <td>
                                <div class="img-game-outstanding">
                                    <img src="
                                    <?php 
                                        echo gameOutstanding($valor);
                                    ?>
                                    " alt="seleccion">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                <?php 
            }
            ?>
            </table>
        </article>
        <form method="post" >
        
        <?php ?>
            <input type="submit" name="button3" class="button" value="Vendedor con mayor ventas" />
            <input type="submit" name="button4" class="button" value="Vendedor con mayor comisión" />
        <?php ?> 
            
        </form>
    </section>
    <?php } ?>
</body>
</html>
<?php
	// session_destroy();
?>