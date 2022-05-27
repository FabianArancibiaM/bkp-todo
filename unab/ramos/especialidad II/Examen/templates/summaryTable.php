<section class="table-seller">
    <h1>Tabla de vendedores</h1>
    <article class="table1">
        <table border="2" class="table-game styled-table">
            <thead>
                <tr class="header-table">
                    <th>
                    </th>
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
        <?php 
            if($listVendedores != null && count($listVendedores)>0){
                foreach ($listVendedores as &$valor) {
        ?>
            <tbody>
                <tr class="body-table 
                        <?php 
                            if($dinamicStyle && $bestSellerName == $valor->getNombre() )
                            {echo 'active-row   ';} else {echo '';}
                        ?>">
                    <td>
                        <form method="get">
                            <input type="hidden" name="id_vendedor" value="<?php echo $valor->getId(); ?>">
                            <input type="submit" name="edit" class="button" value="✏️ Editar" style="background-color: #000;" />
                            <input type="submit" name="delete" class="button" value="🗑️ Eliminar" style="background-color: #000;"/>
                        </form>
                    </td>
                    <td>
                        <?php echo $valor->getNombre(); ?>
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
                    <td class=" 
                            <?php 
                                if($venta && $bestSellerName == $valor->getNombre() )
                                {echo 'highlight';} else {echo '';}
                            ?>">
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
                    <td class=" 
                            <?php 
                                if($comision && $bestSellerName == $valor->getNombre() )
                                {echo 'highlight';} else {echo '';}
                            ?>">
                        <?php echo "$".number_format(($valor->totalComision()),0,",","."); ?>
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
            } else {
                echo "<h2>Sin registros</h2>";
            }
        ?>
        </table>
    </article>
    <form method="post">
        <input type="submit" name="button3" class="button" value="Vendedor con mayor ventas" />
        <input type="submit" name="button4" class="button" value="Vendedor con mayor comisión" />
    </form>
</section>