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
            
            $consulta->prepare("INSERT INTO EQUIPOS VALUES (?,?,?,?,?,?)");    // Paso 2
            $codigo=$_POST["codigo"];
            $nombre=$_POST["nombre"];
            $presupuesto=$_POST["presupuesto"];
            $fecha=$_POST["fecha"];
            $zona=$_POST["zona"];
            $titulos=$_POST["titulos"];
            $consulta->bind_param("isisii", $codigo,$nombre,$presupuesto,$fecha,$zona,$titulos);    // Paso 3
            $consulta->execute();       // Paso 4         
        }
        ?>

        <form action="" method="post">
            Código<input type="text" name="codigo"><br>
            Nombre<input type="text" name="nombre"><br>
            Presupuesto<input type="text" name="presupuesto"><br>
            Fecha de fundación<input type="text" name="fecha"><br>
            Zona<input type="text" name="zona"><br>
            Títulos<input type="text" name="titulos"><br>
            <input type="submit" value ="Enviar"><!-- comment -->
        </form>
    </body>
</html>
