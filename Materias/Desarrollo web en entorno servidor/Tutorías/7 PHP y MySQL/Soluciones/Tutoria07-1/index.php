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
            $link = mysqli_connect('localhost', 'super', '123456', 'tienda');

            if (!$link) {
                echo "Error: no se puede conectar con la base de datos";
                exit;
            } else {
                return $link;
            }
        }

        $link = conecta_bd();

        $consulta = "SELECT generos.gen_nombre,proveedores.pro_nombre,generos.gen_id FROM generos LEFT JOIN proveedores ON proveedores.pro_id=generos.gen_proveedor";
        $resultado = mysqli_query($link, $consulta);
                        
        echo '<table border="1">';
        echo "<tr><td>Géneros</td><td>Proveedores</td><td></td></tr>";
        while ($fila = mysqli_fetch_row($resultado)) {
            echo "<tr><td>".$fila[0]."</td><td>".$fila[1]."</td>";
            echo '<td><form action="genero.php" method="post">';
            echo '<input type="text" value="'.$fila[2].'" name="genero" hidden="hidden">';
            echo '<input type="submit" value="Seleccionar">';
            
            echo "</form></tr>";
        }
                
        echo "</table>";
        ?>
    </body>
</html>
