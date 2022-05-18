<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/salesPage-main.css">
	<title></title>
</head>
<body>
    <header class="header-page">
        <section class="menu">
            <nav>
                <a href="index.php">Home</a>
            </nav>
        </section>
        <img class="left" src="./img/xyz.png" alt="seleccion">
        <img class="rigth" src="./img/logo-empresa.png" alt="seleccion">
    </header>

    <?php 
        include('./src/salesLogic.php');
        // Se inicia la session de php
        session_start();
        // Se agregan vendedores por default
        $vendedor = new Vendedor("Fernando", 3, 8 , 5);
        $vendedor1 = new Vendedor("Jose", 8, 5 , 9);
        $vendedor2 = new Vendedor("Marcela", 3, 2 , 1);
        $vendedor3 = new Vendedor("Vanessa", 3, 3 , 3);
        appendList($vendedor);
        appendList($vendedor1);
        appendList($vendedor2);
        appendList($vendedor3);
    ?>
    <form method="post" class="form-button">
        <input type="submit" name="button1" class="button" value="Agregar vendedor" />
        <input type="submit" name="button2" class="button" value="Mostrar vendedores" />
    </form>
    <?php
        // se declaran variables globales
        $var = 2;
        $dinamicStyle=false;
        $text = "";
        $bestSellerName = "";
        $venta = false;
        $comision = false;
        $new_seller = null;

        if(array_key_exists('button1', $_POST)) {
            // Muestra el formulario
            $var = 1;
        }
        else if(array_key_exists('button2', $_POST)) {
            // Muestra la tabla de vendedores
            $var = 2;
            $dinamicStyle = false;
        }
        else if(array_key_exists('button3', $_POST)) {
            // Resalta la fila del vendedor con mas ventas
            $dinamicStyle = true;
            $var = 2;
            $bestSellerName = biggestSale();
            $venta =true;
            $comision = false;
        }
        else if(array_key_exists('button4', $_POST)) {
            // Resalta la fila del vendedor con mas comision
            $venta =false;
            $comision = true;
            $dinamicStyle = true;
            $var = 2;
            $bestSellerName = higherCommission();
            
        }
        else if(array_key_exists('agregar', $_GET)) {
            // Crea y agrega un nuevo vendedor
            $nom=$_REQUEST['nom'];
            $cod=$_REQUEST['cant_cod'];
            $mine=$_REQUEST['cant_mine'];
            $fort=$_REQUEST['cant_fort'];
            $new_seller = new Vendedor($nom, $cod, $mine , $fort);
            $var = 1;
            $text = appendList($new_seller);
        }
    ?>

    <script>
        // La funcion valida que solo se ingresen letras
        function SoloLetras(letra) {
            tecla = (document.all) ? letra.keyCode : letra.which;
            //Tecla de retroceso para borrar, y espacio siempre la permite
            if (tecla == 8 || tecla == 32) {
                return true;
            }
            patron = /[A-Za-z]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }
    </script>

<?php if( $var == 1) { ?>
        <!-- Seccion formulario y resumen del vendedor-->
        <section class="form-seller">
            <!--  Formulario del vendedor -->
            <div class="box-form">
                <h1>Ingresar nuevo vendedor</h1>
                <form method="get">
                    <br>
                    <input id="txtSoloLetras" type="text" name="nom" placeholder="Nombre" onkeypress="return SoloLetras(event)" required>
                    <br><br><strong>Ingresar cantidad de productos vendidos</strong>
                    <br><br><br>
                    <br><input type="text" name="cant_cod" placeholder="CALL OF DUTY" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required>
                    <br>
                    <br><input type="text" name="cant_fort" placeholder="FORTNITE" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required>
                    <br>
                    <br><input type="text" name="cant_mine" placeholder="MINECRAFT" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required>
                    <br>
                    <br>
                    <input type="submit" class="button" name="agregar" value="Ingresar">
                </form>
            </div>
            <!-- Resumen de la venta realizada por en nuevo vendedor -->
            <article class="box-resume">
                
                <?php 
                    if($text!=""){
                        echo "<div class='box-alert'>";
                        echo "<strong>".$text."</strong>";
                        echo "</div>";
                    }
                ?>
                
                <h2>Resumen de venta</h2>
                <div class="box-images">
                    <div class="box-game one">
                        <div class="image">
                            <img src="./img/call-of-duty-warzone.jpg" alt="seleccion">
                        </div>
                        <?php if($new_seller== null){
                            echo "Precio: $34.500";
                            echo "<br>Cantidad:0";
                            echo "<br>Total: $0";
                            echo "<br>Comisión: $0 ";
                        } else {
                            echo "Precio: $34.500";
                            echo "<br>Cantidad: ".$new_seller->getCantVentCod();
                            echo "<br>Total: $".number_format($new_seller->ventasCOD(),0,",",".");
                            echo "<br>Comisión: $".number_format($new_seller->comisionCOD(),0,",",".");
                        }
                        ?>
                    </div>
                    <div class="box-game two">
                        <div class="image">
                            <img src="./img/Fortnite.jpg" alt="seleccion">
                        </div>
                        <?php if($new_seller== null){
                            echo "Precio: $58.200";
                            echo "<br>Cantidad: 0";
                            echo "<br>Total: $0";
                            echo "<br>Comisión: $0";
                        } else {
                            echo "Precio: $58.200";
                            echo "<br>Cantidad: ".$new_seller->getCantVentFort();
                            echo "<br>Total: $".number_format($new_seller->ventasFORT(),0,",",".");
                            echo "<br>Comisión: $".number_format($new_seller->comisionFORT(),0,",",".");
                        }
                        ?>
                    </div>
                    <div class="box-game three">
                        <div class="image">
                            <img src="./img/mine.jpg" alt="seleccion">
                        </div>
                        <?php if($new_seller== null){
                            echo "Precio: $8.800";
                            echo "<br>Cantidad: 0";
                            echo "<br>Total: $0";
                            echo "<br>Comisión: $0 ";
                        } else {
                            echo "Precio: $8.800";
                            echo "<br>Cantidad: ".$new_seller->getCantVentMine();
                            echo "<br>Total: $".number_format($new_seller->ventasMINE(),0,",",".");
                            echo "<br>Comisión: $".number_format($new_seller->comisionMINE(),0,",",".");
                        }
                        ?>
                    </div>
                </div>
            </article>
        </section>
    <?php } ?>

    <?php if( $var == 2) { ?>
        <!-- Seccion tabla con la informacion de los vendedores -->
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
                <?php foreach ($_SESSION['list_seller'] as &$valor) 
                    { ?>
                    <tbody>
                        <tr class="body-table 
                                <?php 
                                    if($dinamicStyle && $bestSellerName == $valor->nombre() )
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
                                    if($venta && $bestSellerName == $valor->nombre() )
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
                                    if($comision && $bestSellerName == $valor->nombre() )
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
    
    <!-- footer, terminos y condiciones y desarrollador -->
    <footer>
        <div class="social-media">
            <img src="./img/facebook.png" alt="seleccion" >
            <img src="./img/instagram.png" alt="seleccion" >
            <img src="./img/whatsapp.png" alt="seleccion" >
            <img src="./img/gorjeo.png" alt="seleccion" >
        </div>
        <p>TÉRMINOS Y CONDICIONES | POLÍTICA DE PRIVACIDAD</p>
        <h3>©Autor Fabian Arancibia</h3>
    </footer>
</body>
</html>