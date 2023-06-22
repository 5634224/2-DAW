<?php
    /*===========================
        *     Funciones BB.DD
        ============================*/
    
        const hostname = "localhost";
        const database = "tienda";
        const username = "super";
        const password = "123456";
        
        /**
     * Funcion que realiza la conexion con la BBDD y devuelve un objeto para
     * poder realizar consultas y manipular sus registros.
     * @return \mysqli
     */
    function conectar() {
        $conexion = new mysqli(hostname, username, password, database);
        return $conexion;
    }
    
    function consultaNormal() {
        $bd = conectar();
        $resultado = $bd->query("SELECT * FROM tabla; ",
                    MYSQLI_USE_RESULT);
        /*-- Imprime la tabla por pantalla -- */
        $fila = $resultado->fetch_row();
        while ($fila != null) {
            /*-- Codigo --*/
            echo "<td>";
            
            echo "</td>";
            /*-- Avanza una posición en la iteración y cierra fila -- */
            $fila = $resultado->fetch_row();
        }
    }
    
    function consultaPreparada() {
            $bd = conectar();
            $query = $bd->stmt_init(); // Inicia un Statement
        
            // Demostración: inserción de fila
            $query->prepare("INSERT INTO cabeceras_ventas (cab_cliente, cab_fecha) VALUES "
                    . "(?, (SELECT CURRENT_TIMESTAMP FROM DUAL)); ");
            $query->bind_param('i', $idCliente);
            $query->execute();
            
            // Demostración: se pueden hacer varias consultas con un mismo Statement
            
            $query->prepare("SELECT lin_cabecera, COUNT(lin_articulo) "
                . "FROM lineas_ventas "
                . "WHERE lin_cabecera = ? "
                . "GROUP BY lin_cabecera; ");
            $query->bind_param('i', $idCabeceraVenta);
            $query->execute();
            $query->bind_result($idCabeceraVenta, $numeroLineas);
            
            /*-- Imprime por pantalla los resultados devueltos desde la BB.DD --*/
            while ($query->fetch()) {
                /*-- Codigo --*/
                echo "<td>";
                echo "$idCabeceraVenta";
                echo "</td>";
            }
            
            /*-- Cerramos la consulta y la conexión a la BB.DD --*/
                $query->close();
                $bd->close();
    }
?>