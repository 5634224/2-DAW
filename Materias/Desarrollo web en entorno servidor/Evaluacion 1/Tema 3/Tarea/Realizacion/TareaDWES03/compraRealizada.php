<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Compra realizada</title>
    </head>
    <body>
        <?php
        /*==================================================
         *           DECLARACION DE VARIABLES
         =================================================*/
        $idCliente = $_POST['cliente'];
        
        /* =======================================
         *          FUNCIONES BB.DD
          ======================================== */
        include_once 'moduloConexion.php';
        
        
        function comprar() {
            global $idCliente;
            /*-- Conecta con la BB.DD e inicializa las consultas --*/
            $bd = conectar();
            $query = $bd->stmt_init();
            $idCabeceraVenta;
            
            /*-- Comprueba primero si hay artículos en el carrito de ese cliente para comprar --*/
            $query->prepare("SELECT COUNT(car_cliente) FROM carritos_compra WHERE car_cliente = ?; ");
            $query->bind_param('i', $idCliente);
            $query->execute();
            $query->bind_result($cantidadArticulosCliente);
            $query->fetch();
                if ($cantidadArticulosCliente > 0) {
                    /*-- Añade un nuevo registro a la tabla cabeceras_ventas y guarda su ID --*/ {
                        $query->prepare("INSERT INTO cabeceras_ventas (cab_cliente, cab_fecha) VALUES "
                                . "(?, (SELECT CURRENT_TIMESTAMP FROM DUAL)); ");
                        $query->bind_param('i', $idCliente);
                        $query->execute();

                        /*-- Guarda el ID de la cabecera_venta que se acaba de crear --*/
                        //https://dev.mysql.com/doc/refman/8.0/en/information-functions.html#function_last-insert-id
                        $query->prepare("SELECT LAST_INSERT_ID() FROM DUAL;");
                        $query->execute();
                        $query->bind_result($idCabeceraVenta);
                        $query->fetch();
                    }

                    /*-- Añade los artículos del carrito a la tabla lineas_ventas, asociándose con su cabecera --*/ {
                        $query->prepare("INSERT INTO lineas_ventas "
                                . "SELECT NULL, " . $idCabeceraVenta . ", car_articulo, car_cantidad "
                                . "FROM carritos_compra "
                                . "WHERE car_cliente = ?");
                        $query->bind_param('i', $idCliente);
                        $query->execute();
                    }

                    /*-- Elimina los artículos del carrito (ya que ya han sido comprados) --*/ {
                        $query->prepare("DELETE FROM carritos_compra WHERE car_cliente = ?; ");
                        $query->bind_param('i', $idCliente);
                        $query->execute();
                    }
                }
            
            /*-- Cierra la consulta --*/
            $query->close();
            $bd->close();
            
            /*-- Devuelve el id del registro en la tabla cabecera_ventas --*/ {
                return $idCabeceraVenta;
            }
        }
        
        function mostrarArticulosComprados() {
            global $idCliente;
            if (isset($idCliente)) {
                /*-- Realiza la compra de los artículos y obtiene el ID de la cabecera de las venta --*/
                $idCabeceraVenta = comprar();
                
                if (isset($idCabeceraVenta)) {
                    /*-- Conecta con la BB.DD e inicializa las consultas --*/
                    $bd = conectar();
                    $query = $bd->stmt_init();

                    /*-- Prepara la consulta y la ejecuta --*/
                    $query->prepare("SELECT lin_cabecera, COUNT(lin_articulo) "
                            . "FROM lineas_ventas "
                            . "WHERE lin_cabecera = ? "
                            . "GROUP BY lin_cabecera; ");
                    $query->bind_param('i', $idCabeceraVenta);
                    $query->execute();
                    $query->bind_result($idCabeceraVenta, $numeroLineas);

                    /*-- Mostramos las líneas insertadas en la tabla HTML --*/
                    while ($query->fetch()) {
                        /*-- Abrimos fila --*/
                        echo "<tr>";

                        /*-- Escribimos el id de la cabecera de venta --*/
                        echo "<td>";
                        echo $idCabeceraVenta;
                        echo "</td>";

                        /*-- Escribimos el numero de líneas de ventas insertadas en la BB.DD --*/
                        echo "<td>";
                        echo $numeroLineas;
                        echo "</td>";

                        /*-- Cerramos fila --*/
                        echo "</tr>";
                    }

                    /*-- Cerramos la consulta y la conexión a la BB.DD --*/
                    $query->close();
                    $bd->close();
                }
            }
        }
        
        ?>
        
        <p>Compra realizada:</p>
        <table border="1">
            <theader>
                <th>ID Cabecera</th>
                <th>Lineas insertadas (lineas_ventas)</th>
                <tbody>
                    <?php
                    mostrarArticulosComprados();
                    ?>
                </tbody>
            </theader>
        </table>
        <p>
            <form action="index.php" method="post">
                <input type="submit" value="Volver a la página principal">
            </form>
        </p>
    </body>
</html>
