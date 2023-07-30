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

            $consulta = "SELECT COUNT(*) FROM JUGADORES WHERE EQUIPO=".$_POST["codigo"];
            $resultado = mysqli_query($link, $consulta);
            $fila= mysqli_fetch_row($resultado);
            $n=$fila[0];
            echo "El equipo ".$_POST["codigo"]." tiene $n jugadores:<br>";
            
            $consulta = "SELECT NOMBRE_JUGADOR FROM JUGADORES WHERE EQUIPO=".$_POST["codigo"];
            $resultado = mysqli_query($link, $consulta);
            
            while ($fila= mysqli_fetch_row($resultado)) {
                echo $fila[0]."<br>";
            }
        }
        ?>

        <form action="" method="post">
            <input type="text" name="codigo"><!-- comment -->
            <input type="submit" value ="Enviar"><!-- comment -->
        </form>
    </body>
</html>
