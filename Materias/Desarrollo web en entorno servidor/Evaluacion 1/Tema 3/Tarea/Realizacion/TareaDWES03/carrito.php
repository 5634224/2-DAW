<html>
    <head>
        <meta charset="UTF-8">
        <title>Carrito de la compra</title>
    </head>
    <body>
        <?php
        /*==================================================
         *           DECLARACION DE VARIABLES
         =================================================*/
        $idCliente = $_POST['cliente'];
        $tipoOperacion = $_POST['tipoOperacion'];
        $articulo = $_POST['articulo'];
        $cantidad = $_POST['cantidad'];
        $idCarrito = $_POST['carrito'];
        
        /* =======================================
         *          FUNCIONES BB.DD
          ======================================== */
        include_once 'moduloConexion.php';
        
        function getArticulosCarritoClientes() {
            global $idCliente;
            if (isset($idCliente)) {
                //settype($idCliente, "integer"); 
                /*-- Conecta con BB.DD y hace la consulta --*/
                $bd = conectar();
                $query = $bd->stmt_init();
                $query->prepare("SELECT car_id, art_nombre, SUM(FLOOR(car_cantidad)) "
                        . "FROM carritos_compra "
                        . "JOIN articulos ON (carritos_compra.car_articulo = articulos.art_id) "
                        . "WHERE car_cliente = ? "
                        . "GROUP BY car_id; ");
                $query->bind_param('i', $idCliente);
                $query->execute();
                //$query->bind_result($idArticuloCarrito, $nombreArticulo, $precioVenta, $unidades);
                $query->bind_result($idArticuloCarrito, $nombreArticulo, $unidades);

                /*-- Imprime por pantalla los resultados devueltos desde la BB.DD --*/
                while ($query->fetch()) {
                    /*-- Abre la fila --*/
                    echo '<tr style="vertical-align: middle;">';
                    /*-- Imprime el nombre del artículo --*/
                    echo "<td>";
                    echo "$nombreArticulo";
                    echo "</td>";

                    /*-- Imprime el precio del artículo --*/
//                echo "<td>";
//                echo "$precioVenta";
//                echo "</td>";

                    /*-- Imprime la cantidad de artículos que se compran --*/
                    echo "<td>";
                    echo "$unidades";
                    echo "</td>";

                    /*-- Imprime el botón para eliminar el artículo del carrito de la compra --*/
                    echo '<td style="text-align: center;">';
                    echo '<form action="" method="post">';
                    echo '<input type="text" name="tipoOperacion" value="eliminar" hidden></input>';
                    echo '<input type="text" name="cliente" value="' . $idCliente . '" hidden></input>';
                    echo '<input type="text" name="carrito" value="' . $idArticuloCarrito . '" hidden></input>';
                    echo '<input type="submit" value="X"></input>';
                    echo '</form>';
                    echo "</td>";

                    /*-- Cierra la fila --*/
                    echo "</tr>";
                }

                /*-- Cierra la conexión a la BB.DD para liberar recursos -- */
                $bd->close();
                $query->close();
            }
        }
        
        function getArticulosDesplegable() {
            global $idCliente;
            if (isset($idCliente)) {
                
                /*-- Conecta con BB.DD y hace la consulta --*/
                $bd = conectar();
                $query = $bd->stmt_init();
                $query->prepare("SELECT art_id, art_nombre "
                        . "FROM articulos "
                        . "ORDER BY art_nombre; ");
                $query->execute();
                //$query->bind_result($idArticuloCarrito, $nombreArticulo, $precioVenta, $unidades);
                $query->bind_result($idArticulo, $nombreArticulo);

                /*-- Imprime por pantalla los resultados devueltos desde la BB.DD --*/
                while ($query->fetch()) {
                    echo '<option value="' . $idArticulo . '">' . $nombreArticulo . "</input>";
                }

                /*-- Cierra la conexión a la BB.DD para liberar recursos -- */
                $bd->close();
                $query->close();
            }
        }
        
        function agregarArticuloCarrito() {
            global $idCliente;
            global $articulo;
            global $cantidad;
            if (isset($idCliente, $articulo, $cantidad)) {
                /*-- Conecta con BB.DD y hace la consulta --*/
                $bd = conectar();
                $query = $bd->stmt_init();
                
                /*-- Comprueba si el cliente ya tiene ese artículo agregado al carrito --*/
                $query->prepare("SELECT COUNT(car_articulo) FROM carritos_compra WHERE car_cliente = ? AND car_articulo = ?; ");
                $query->bind_param('ii', $idCliente, $articulo);
                $query->execute();
                $query->bind_result($cantidadArticulosCliente);
                $query->fetch();
                if ($cantidadArticulosCliente > 0) {
                    /*-- Actualiza en la BB.DD (si el usuario lo ha solicitado) el artículo en el carrito --*/
                        /*-- Hace la consulta --*/
                        $query->prepare("UPDATE carritos_compra SET car_cantidad = car_cantidad + ? WHERE car_cliente = ? AND car_articulo = ?;");
                        $query->bind_param('iii', $cantidad, $idCliente, $articulo);
                        $query->execute();
                } else {
                    /*-- Inserta en la BB.DD (si el usuario lo ha solicitado) el artículo en el carrito --*/
                        /*-- Conecta con BB.DD y hace la consulta --*/
                        $query->prepare("INSERT INTO carritos_compra (car_articulo, car_cliente, car_cantidad) VALUES (?, ?, ?); ");
                        $query->bind_param('iii', $articulo, $idCliente, $cantidad);
                        $query->execute();
                }

                /*-- Cierra la conexión a la BB.DD para liberar recursos -- */
                    $bd->close();
                    $query->close();
                    
                /*-- Borra los datos de las variables POST --*/
                /* Esto es un intento de prevenir que si el usuario actualiza la página, no
                 * se vuelvan a enviar los datos y por ende, se vuelvan a insertar
                 * en la BB.DD
                 */
//                unset($_POST["articulo"]);
//                unset($_POST["cantidad"]);
            }
        }
        
        function eliminarArticuloCarrito() {
            global $idCliente;
            global $idCarrito;
            
            if (isset($idCliente, $idCarrito)) {
                /*-- Elimina en la BB.DD (si el usuario lo ha solicitado) el artículo en el carrito --*/ {
                    /*-- Conecta con BB.DD y hace la consulta --*/
                    $bd = conectar();
                    $query = $bd->stmt_init();
                    $query->prepare("DELETE FROM carritos_compra WHERE car_id = ?; ");
                    $query->bind_param('i', $idCarrito);
                    $query->execute();

                    /*-- Cierra la conexión a la BB.DD para liberar recursos -- */
                    $bd->close();
                    $query->close();
                }
            }
        }
        
        /*==================================
         *          GUION PHP
         ===================================*/
        
        /*-- Comprueba si existe algún tipo de operación en curso --*/
        if (isset($tipoOperacion)) {
            /*-- Comprueba qué tipo de operación es para hacer una cosa u otra --*/
            switch ($tipoOperacion) {
                case "agregar":
                    agregarArticuloCarrito();
                    break;
                case "eliminar":
                    eliminarArticuloCarrito();
                    break;
            }
        }

        ?>
        
        <h2>Carrito cliente nº <?php echo "$idCliente"; ?></h2>
        <!-- Formulario para añadir articulos al carrito -->
        <form action="" method="post">
            <input type="text" name="tipoOperacion" value="agregar" hidden>
            <input name="cliente" type="text" value="<?php echo $idCliente; ?>" hidden>
            <select name="articulo" required>
                <option value="0" disabled selected>Seleccione un artículo</option>
                <?php
                    getArticulosDesplegable();
                ?>
            </select>
            <input name="cantidad" type="text" placeholder="Cantidad" required>
            <input type="submit" value="Añadir">
        </form>
        
        <!-- Tabla de articulos en carrito -->
        <table border="1">
            <thead>
                <th>Artículo</th>
                <!-- <th>Precio</th> -->
                <th>Cantidad</th>
                <th>Acciones</th> <!-- Aquí irá el botón de eliminar artículo del carrito de la compra -->
            </thead>
            <tbody>
                <?php
                    getArticulosCarritoClientes();
                ?>
            </tbody>
        </table>
        <p>
            <form action="compraRealizada.php" method="post">
                <input type="text" name="cliente" value="<?php echo "$idCliente"; ?>" hidden>
                <input type="submit" value="Comprar">
            </form>
        </p>
        <p>
            <form action="index.php" method="post">
                <input type="submit" value="Volver a la página principal">
            </form>
        </p>
    </body>
</html>