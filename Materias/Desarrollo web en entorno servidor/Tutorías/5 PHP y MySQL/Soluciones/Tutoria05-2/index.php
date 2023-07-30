<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php

        function conecta_bd() {
            $link = mysqli_connect('localhost', 'super', '123456', 'baloncesto');

            if (!$link) {
                echo "Error: no se puede conectar con la base de datos";
                exit;
            } else {
                return $link;
            }
        }

              
        if (isset($_POST["codigo"])) {
            $link = conecta_bd();

            $consulta = "SELECT NOMBRE_JUGADOR FROM JUGADORES WHERE COD_JUGADOR=".$_POST["codigo"];
            $resultado = mysqli_query($link, $consulta);
            
            
            if ($fila= mysqli_fetch_row($resultado)) {
                echo "El nombre del jugador ".$_POST["codigo"]." es ".$fila[0]."<br>";
            } else {
                echo "No existe ningún jugador con el código ".$_POST["codigo"]."<br>";
            }
        }        
        ?>

        <form action="" method="post">
            <input type="text" name="codigo"><!-- comment -->
            <input type="submit" value ="Enviar"><!-- comment -->
        </form>
    </body>
</html>
