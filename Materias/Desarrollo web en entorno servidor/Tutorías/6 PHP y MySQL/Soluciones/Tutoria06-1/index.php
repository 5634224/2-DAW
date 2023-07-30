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
            
            $consulta=$link->stmt_init();   // Paso 1 - Iniciar la consulta
            
            $consulta->prepare("SELECT COUNT(*) FROM JUGADORES WHERE EQUIPO=?");    // Paso 2 - Crear la Query
            $equipo=$_POST["codigo"];
            $consulta->bind_param("i", $equipo);    // Paso 3 - Vincular los parámetros, uniendo cada parámetro con una variable de entrada
            $consulta->execute();       // Paso 4 - Ejecutar la consulta
            
            $consulta->bind_result($resultado); // Paso 5 - Vincular el resultado (debe haber una variable por cada columna que devuelva la consulta)
            
            
            if ($consulta->fetch()) {   // Paso 6 - Extraer las filas de la consulta, los resultados aparecerán en la/s variable/s vinculada/s
               echo "El equipo ".$_POST["codigo"]." tiene $resultado jugadores:<br>"; 
            }
            
            $consulta->close();
            
            $consulta=$link->stmt_init();   // Paso 1
            
            $consulta->prepare("SELECT COD_JUGADOR,NOMBRE_JUGADOR FROM JUGADORES WHERE EQUIPO=?");    // Paso 2
            $equipo=$_POST["codigo"];
            $consulta->bind_param("i", $equipo);    // Paso 3
            $consulta->execute();       // Paso 4
            
            $consulta->bind_result($resultado,$resultado2); // Paso 5
                        
            while ($consulta->fetch()) {    // Paso 6
                echo $resultado." ".$resultado2."<br>";
            }            

        }
        ?>

        <form action="" method="post">
            <input type="text" name="codigo"><!-- comment -->
            <input type="submit" value ="Enviar"><!-- comment -->
        </form>
    </body>
</html>
