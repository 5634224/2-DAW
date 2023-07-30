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

        $link = conecta_bd();

        $consulta = "SELECT EQUIPOS.*,ZONAS.* FROM EQUIPOS JOIN ZONAS ON ZONAS.COD_ZONA=EQUIPOS.ZONA";
        $resultado = mysqli_query($link, $consulta);

        $c = array();

        while ($columnas = mysqli_fetch_field($resultado))
            $c[] = $columnas->name; // en $c creamos un array con el nombre de las columnas

        echo '<table border="1">';
        echo "<tr>";
        for ($i = 0; $i < count($c); $i++) {
            echo "<td>".$c[$i]."</td>"; // en la primera fila de la tabla HTML ponemos el nombre de las columnas
        }
        echo "</tr>";


        while ($fila = mysqli_fetch_row($resultado)) {
            echo "<tr>";
            for ($i = 0; $i < count($c); $i++) {    // recorremos campo a campo la fila actual
                echo "<td>".$fila[$i]."</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </body>
</html>
