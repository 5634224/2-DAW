<html>
    <head>
        <meta charset="UTF-8">
        <title>Carrito de la compra</title>
    </head>
    <body>
        <?php
        $idCliente = $_POST['cliente'];
        /* =======================================
         *          FUNCIONES BB.DD
          ======================================== */
        include_once 'moduloConexion.php';
        
        function getArticulosCarritoClientes() {
            /*-- Conecta con BB.DD y hace la consulta --*/
            $bd = conectar();
            $query = $bd->stmt_init();
            $query->prepare("SELECT car_id, art_nombre, art_precio_venta, SUM(FLOOR(car_cantidad)) "
                    . "FROM carritos_compra "
                    . "JOIN articulos ON (carritos_compra.car_articulo = articulos.art_id) "
                    . "WHERE car_cliente = ? "
                    . "GROUP BY car_id; ");
            $query->bind_param('i', $idCliente);
            $query->execute();
            $query->bind_result($idArticuloCarrito, $nombreArticulo, $precioVenta, $unidades);

            /*-- Imprime por pantalla los resultados devueltos desde la BB.DD --*/
            while ($query->fetch()) {
                /*-- Abre la fila --*/
                echo "<tr>";
                /*-- Imprime el nombre del artículo --*/
                echo "<td>";
                echo "$nombreArticulo";
                echo "</td>";

                /*-- Imprime el precio del artículo --*/
                echo "<td>";
                echo "$precioVenta";
                echo "</td>";

                /*-- Imprime la cantidad de artículos que se compran --*/
                echo "<td>";
                echo "$unidades";
                echo "</td>";

                /*-- Imprime el botón para eliminar el artículo del carrito de la compra --*/
                echo "<td>";
                echo '<form action="" method="post">';
                echo '<input type="text" name="cliente" value="' . $idArticuloCarrito . '" hidden></input>';
                echo '<input type="submit" value="X"></input>';
                echo '</form>';
                echo "</td>";

                /*-- Cierra la fila --*/
                echo "</tr>";
            }

            /*-- Cierra la conexión a la BB.DD para liberar recursos -- */
            $bd->close();
            $resultado->free();
        }
        
        /*==================================
         *          GUION PHP
         ===================================*/

            if (isset($idCliente)) {
               settype($idCliente, "integer"); 
            
        ?>
        
        <h2>Carrito cliente nº <?php echo "$idCliente"; ?></h2>
        <table border="1">
            <thead>
                <th>Artículo</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Acciones</th> <!-- Aquí irá el botón de eliminar artículo del carrito de la compra -->
            </thead>
            <tbody>
                <?php
                    getArticulosCarritoClientes();
                ?>
            </tbody>
        </table>
        <?php
            }
        ?>
    </body>
</html>