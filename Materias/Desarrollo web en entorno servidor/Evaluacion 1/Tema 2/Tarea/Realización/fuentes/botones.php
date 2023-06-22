<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 2</title>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
        </style>
    </head>
    <body>
        <table>
            <?php 
                for ($i = 0; $i <= 10; $i++) {
                echo '<tr>';
                
                //Este condicional es para que se genere la tabla con un formato más claro
                if ($i == 0) {
                    echo '<td></td>';
                    for ($j = 1; $j <= 10; $j++) {
                        echo '<td>Columna ' . $j . '</td>';
                    }
                } else {
                    for ($j = 0; $j <= 10; $j++) {
                        if ($j == 0) {
                            echo '<td>Fila ' . $i . '</td>';
                        } else {
                            echo '<td>';
                            echo '<form method="post">';
                            //Los valores del botón pulsado se guardan en dos campos ocultos llamados fila y columna
                            echo '<input type=text name="fila" hidden=hidden value="' . $i . '"/>';
                            echo '<input type=text name="columna" hidden=hidden value="' . $j . '"/>';
                            echo '<input type="submit" value="Pulsar"/>';
                            echo '</form>';
                            echo '</td>';
                        }
                    }
                }
                echo '</tr>';
            }
            ?>
        </table>
        <?php
            //Si se ha pulsado un botón significa que $_POST['fila'] y $_POST['columna'] contienen la posición del botón presionado
            if (isset($_POST['fila']) && isset($_POST['columna'])) {
                echo '<p>El botón presionado se encuentra en la fila '.$_POST['fila'].' y en la columna '.$_POST['columna'].'</p>';
            }
        ?>
    </body>
</html>
