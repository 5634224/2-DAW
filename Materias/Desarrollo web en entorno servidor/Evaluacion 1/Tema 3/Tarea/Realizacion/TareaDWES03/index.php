<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Compras de clientes</title>
    </head>
    <body>
        <?php
        /* =======================================
         *          FUNCIONES BB.DD
          ======================================== */
        include_once 'moduloConexion.php';

        function getComprasClientes() {
            $bd = conectar();

            if (isset($bd)) {
                $resultado = $bd->query("SELECT clicompras.cli_id, clicompras.cli_nombre, clicompras.Cantidad, clicarritos.Carrito "
                        . "FROM (SELECT cli_id, cli_nombre, IFNULL(SUM(lineas_ventas.lin_cantidad * articulos.art_precio_venta), 0) AS Cantidad "
                        . "FROM clientes "
                        . "LEFT JOIN cabeceras_ventas ON (clientes.cli_id = cabeceras_ventas.cab_cliente) "
                        . "LEFT JOIN lineas_ventas ON (cabeceras_ventas.cab_id = lineas_ventas.lin_cabecera) "
                        . "LEFT JOIN articulos ON (lineas_ventas.lin_articulo = articulos.art_id) "
                        . "GROUP BY cli_id, cli_nombre ) AS clicompras "
                        . "JOIN (SELECT cli_id, COUNT(carritos_compra.car_id) AS Carrito "
                        . "FROM clientes "
                        . "LEFT JOIN carritos_compra ON (clientes.cli_id = carritos_compra.car_cliente) "
                        . "GROUP BY cli_id) AS clicarritos "
                        . "ON (clicompras.cli_id = clicarritos.cli_id) "
                        . "ORDER BY clicompras.cli_nombre, clicompras.cli_id ASC; ",
                        MYSQLI_USE_RESULT);

                /* -- Imprime la tabla por pantalla -- */
                $fila = $resultado->fetch_row();
                while ($fila != null) {
                    //echo "" . $fila[0] . " , " . $fila[1];
                    /* -- Abre una fila -- */
                    echo "<tr>";
                    $idCliente;
                    for ($i = 0; $i < count($fila); $i++) {
                        if ($i == 0) { // Si es la primera columna, guarda el ID del cliente
                            $idCliente = $fila[$i];
                        } else {
                            echo '<td' . ($i == (count($fila) - 1) ? ' style="text-align: center;"' : '') . ">";
                            if ($i == count($fila) - 1) {
                                echo '<form action="carrito.php" method="post">';
                                echo '<input type="text" name="cliente" value="' . $idCliente . '" hidden></input>';
                                echo '<input type="submit" value="' . $fila[$i] . '"></input>';
                                echo '</form>';
                            } else {
                                echo $fila[$i];
                            }
                            echo "</td>";
                        }
                    }
                    /* -- Avanza una posición en la iteración y cierra fila -- */
                    $fila = $resultado->fetch_row();
                    echo "</tr>";
                }

                /* -- Cierra la conexión a la BB.DD para liberar recursos -- */
                $bd->close();
                $resultado->free();
            }
        }

        //getComprasClientes();
        ?>

    <h2>Clientes</h2>
    <table border="1">
        <thead>
            <th>Cliente</th>
            <th>Comprado</th>
            <th>Carrito</th>
        </thead>
        <tbody>
            <?php
                getComprasClientes();
            ?>
        </tbody>
    </table>
</body>
</html>
