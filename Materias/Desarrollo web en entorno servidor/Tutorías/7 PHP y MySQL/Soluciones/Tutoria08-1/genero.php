<!DOCTYPE html>


<?php
/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'conexion.php';

//echo $_POST["genero"];

$link = conecta_bd();

if (isset($_POST["eliminar"])) {    // En primer lugar, miramos si tenemos que eliminar algún artículo de la tabla
    $consulta = "DELETE FROM articulos WHERE art_id=" . $_POST["eliminar"];
    mysqli_query($link, $consulta);
}




if (isset($_POST["precioventa"])) {     // Recibir este dato por $_POST es sinónimo de que hemos recibido una petición de inserción
    $consulta = $link->stmt_init(); 

    $consulta->prepare("INSERT INTO articulos VALUES (NULL,?,?,?,?)");    // El primer valor es nulo porque la columno es autoincremental y tomará el valor automáticamente
    $nom = $_POST["nombre"];  
    $pv = $_POST["precioventa"];
    $gen = $_POST["genero"];
    $pc = $_POST["preciocompra"];
    $consulta->bind_param("siii", $nom, $pv, $gen, $pc);
    $consulta->execute(); 
    $consulta->free_result();
}



$consulta = "SELECT art_nombre,art_precio_compra,art_precio_venta,gen_nombre,art_id FROM generos " .
        "LEFT JOIN articulos ON art_genero=gen_id WHERE gen_id=" . $_POST["genero"];
//echo $consulta;
$resultado = mysqli_query($link, $consulta);

for ($cont = 0; $fila = mysqli_fetch_row($resultado); $cont++) {
    if ($cont == 0) {
        echo "<h3>" . $fila[3] . "</h3>";

        echo '<table border="1">';
        echo "<tr><td>Nombre</td><td>Precio compra</td><td>Precio Venta</td><td></td></tr>";
        $genero = $fila[3];
    }

    echo "<tr><td>" . $fila[0] . "</td><td>" . $fila[1] . "</td><td>" . $fila[2] . "</td><td>";

    echo '<form action="" method="post">';  // Tras eliminar volveremos a esta misma página
    echo '<input type="text" hidden="hidden" name="genero" value="' . $_POST["genero"] . '">';  // Necesitamos enviar el género para mantener este dato
    echo '<input type="text" hidden="hidden" name="eliminar" value="' . $fila[4] . '">';    // Aquí irá el ID del artículo a eliminar
    echo '<input type="submit" value="Eliminar"></form>';

    echo "</td></tr>";
}

echo "</table><br><br>";

echo '<form action="insertar.php" method="post">';
echo '<input type="text" hidden="hidden" name="genero" value="' . $_POST["genero"] . '">';  // Para la nueva página enviamos ya el género seleccionado
echo '<input type="text" hidden="hidden" name="nombregenero" value="' . $genero . '">';    // También enviamos el nombre de este
echo '<input type="submit" value="Insertar"></form>';
