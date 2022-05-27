<?php  
    include './src/instalar.php';
    include('./src/salesLogic.php');
    include './src/functionQuery.php';

    // se declaran variables globales
    $config = include './src/config.php';
    $var = 2;
    $dinamicStyle=false;
    $text = "";
    $bestSellerName = "";
    $venta = false;
    $comision = false;
    $new_seller = null;
    $isUpdate=false;
    $error=false;
    $listGame = getAllGame();
    $listVendedores = getAllSeller($listGame);   
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/salesPage-main.css">
    <title>xyz store</title>
</head>

<body>
    <!-- Seccion del header -->
    <?php include 'templates/header.php'; ?>
    <form method="post" class="form-button">
        <input type="submit" name="button1" class="button" value="Agregar vendedor" />
        <input type="submit" name="button2" class="button" value="Mostrar vendedores" />
    </form>
    <?php include('templates/buttonLogic.php'); ?>
    <?php if( $var == 0){ ?>
        <!-- Seccion texto del resultado de la atualizacion y eliminaion del vendedor y venta -->
        <section>
            <?php 
                if($text!=""){
                    echo "<div class='box-alert'>";
                    echo "<strong>".$text."</strong>";
                    echo "</div>";
                }
            ?>
        </section>
    <?php 
        }else if( $var == 1) {
            // Seccion formulario y resumen del vendedor
            include('templates/sellersForm.php');
        }else if( $var == 2) {
            // Seccion tabla con la informacion de los vendedores
            include('templates/summaryTable.php');
        }
    ?>

    <!-- footer, terminos y condiciones y desarrollador -->
    <?php include 'templates/footer.php'; ?>
</body>

</html>