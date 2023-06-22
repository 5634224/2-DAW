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
            
            $consulta=$link->stmt_init();   // Paso 1
            
            $consulta->prepare("DELETE FROM JUGADORES WHERE COD_JUGADOR=?");    // Paso 2
            $codigo=$_POST["codigo"];
            $consulta->bind_param("i", $codigo);    // Paso 3
            $consulta->execute();       // Paso 4  
            
            if ($consulta->affected_rows==0) { // Aunque no lo pide el enunciado, verifico si la supresión se ha hecho correctamente
                echo "Error eliminando el jugador ".$codigo."<br>";
            } else {
                echo "Eliminado correctamente el jugador ".$codigo."<br>";
            }
        }
        ?>

        <form action="" method="post">
            Código<input type="text" name="codigo"><br>

            <input type="submit" value ="Enviar"><!-- comment -->
        </form>
    </body>
</html>
