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
        require_once 'conexion.php';

        if (isset($_POST["listaarticulo"])) {
            echo $_POST["listaarticulo"];
        }

        
        $link = conecta_bd();

        $consulta = "SELECT generos.gen_nombre,proveedores.pro_nombre,generos.gen_id FROM generos LEFT JOIN proveedores ON proveedores.pro_id=generos.gen_proveedor";
        $resultado = mysqli_query($link, $consulta);
        ?>                
        <form action="genero.php" method="post">
        
        <table border="1">
        <tr><td>Géneros</td><td>Proveedores</td><td>Seleccionar</td></tr>        
        
        <?php
        while ($fila = mysqli_fetch_row($resultado)) {
            echo "<tr><td>".$fila[0]."</td><td>".$fila[1]."</td>";
            echo '<td>';
            //echo '<input type="text" value="'.$fila[2].'" name="genero" hidden="hidden">';
            echo '<input type="submit" name="genero" value="'.$fila[2].'">';
            
            echo "</tr>";
        }
        echo "</form>";
                
        //echo "</table>";
        ?>
        
    </table>
        
    </body>
    

    
    
</html>
