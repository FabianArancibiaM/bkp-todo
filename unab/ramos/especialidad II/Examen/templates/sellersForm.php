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
<section class="form-seller">
    <!--  Formulario del vendedor -->
    <div class="box-form">
        <h1>Ingresar nuevo vendedor</h1>
        <form method="get">
            <br>
            <input id="txtSoloLetras" type="text" name="nom" placeholder="Nombre"
                value="<?php if($isUpdate){ echo $new_seller->getNombre();} ?>"
                onkeypress="return SoloLetras(event)" required>
            <br><br><strong>Ingresar cantidad de productos vendidos</strong>
            <br><br><br>CALL OF DUTY
            <br><input type="text" name="cant_cod" placeholder="0"
                value="<?php if($isUpdate){ echo $new_seller->getCantVentCod();} ?>"
                onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required>
            <br>FORTNITE
            <br><input type="text" name="cant_fort" placeholder="0"
                value="<?php if($isUpdate){ echo $new_seller->getCantVentFort();} ?>"
                onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required>
            <br>MINECRAFT
            <br><input type="text" name="cant_mine" placeholder="0"
                value="<?php if($isUpdate){ echo $new_seller->getCantVentMine();} ?>"
                onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required>
            <br>
            <br>
            <?php 
                    if(!$isUpdate){
                        echo "<input type='submit' class='button' name='agregar' value='Ingresar'>";
                    }else{
                        echo "<input type='hidden' name='id_vendedor' value='".$new_seller->getId()."' >";
                        echo "<input type='submit' class='button' name='update' value='Actualizar'>";
                    }
                ?>

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
                        echo "Precio: $".number_format($listGame[0]->getPrecio(),0,",",".");
                        echo "<br>Cantidad:0";
                        echo "<br>Total: $0";
                        echo "<br>Comisión: $0 ";
                    } else {
                        echo "Precio: $".number_format($listGame[0]->getPrecio(),0,",",".");
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
                        echo "Precio: $".number_format($listGame[2]->getPrecio(),0,",",".");
                        echo "<br>Cantidad: 0";
                        echo "<br>Total: $0";
                        echo "<br>Comisión: $0";
                    } else {
                        echo "Precio: $".number_format($listGame[2]->getPrecio(),0,",",".");
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
                        echo "Precio: $".number_format($listGame[1]->getPrecio(),0,",",".");
                        echo "<br>Cantidad: 0";
                        echo "<br>Total: $0";
                        echo "<br>Comisión: $0 ";
                    } else {
                        echo "Precio: $".number_format($listGame[1]->getPrecio(),0,",",".");
                        echo "<br>Cantidad: ".$new_seller->getCantVentMine();
                        echo "<br>Total: $".number_format($new_seller->ventasMINE(),0,",",".");
                        echo "<br>Comisión: $".number_format($new_seller->comisionMINE(),0,",",".");
                    }
                    ?>
            </div>
        </div>
    </article>
</section>