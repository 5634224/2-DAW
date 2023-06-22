<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Botones</title>
    </head>
    <body>
        <table border="1">
            <!-- Imprime la primera fila (encabezado) de la tabla -->
            <tr>
                <td>  </td>
                <?php
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<td>" . $i . "</td>";
                    }
                ?>
            </tr>
            <!-- Empieza a imprimir filas -->
            <?php
                $mensaje = $_POST['mensaje']; // Almacena lo captado del formulario
                for ($i = 1; $i <= 10; $i++) { // Por cada fila
                    /*-- Abre la etiqueta de fila --*/
                    echo "<tr>";
                    
                    /*-- Escribe la primera celda (indica el nº de fila) --*/
                    echo "<td>" . $i . "</td>\n";
                    
                    /*-- Escribe celdas --*/
                    if (isset($mensaje)) { // Si hay algo en el post, marca con una X el boton que corresponda
                        for ($j = 1; $j <= 10; $j++) {
                            echo "<td>";
                            /*-- Crea el formulario --*/
                            echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
                            echo '<input type="text" name="mensaje" value="' . $i . ',' . $j . '" hidden="hidden" />'; // Campo oculto que transmite la posición del submit en la tabla a la siguiente ejecución del guión PHP
                            echo "\n";
                            echo '<input type="submit" value="' . ($mensaje == "" . $i . "," . $j ? "X" : "  ") . '" />';
                            echo "\n</form>\n";
                            echo "</td>\n";
                        }
                    } else {
                        for ($j = 1; $j <= 10; $j++) {
                            echo "<td>";
                            echo '<form action="' . $_SERVER["PHP_SELF"] . '" method="post">';
                            echo '<input type="text" name="mensaje" value="' . $i . ',' . $j . '" hidden="hidden" />'; // Campo oculto que transmite la posición del submit en la tabla a la siguiente ejecución del guión PHP
                            echo "\n";
                            echo '<input type="submit" value="  " />';
                            echo "\n</form>\n";
                            echo "</td>\n";
                        }
                    }
                    
                    /*-- Cierra la etiqueta <tr> ---*/
                    echo "\n</tr>";
                }
            ?>
            
        </table>
        
        <p>
        <?php
            if (isset($mensaje)) {
                echo "Botón seleccionado (fila,columna): " . $mensaje;
            }
        ?>
    </body>
</html>
