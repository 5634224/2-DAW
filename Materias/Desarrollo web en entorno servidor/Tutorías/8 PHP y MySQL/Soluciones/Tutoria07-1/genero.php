<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'conexion.php';


//echo $_POST["genero"];

$link = conecta_bd();

$consulta = "SELECT art_nombre,art_precio_compra,art_precio_venta,gen_nombre FROM generos ".
        "LEFT JOIN articulos ON art_genero=gen_id WHERE gen_id=".$_POST["genero"];
//echo $consulta;
$resultado = mysqli_query($link, $consulta);



for ($cont=0;$fila = mysqli_fetch_row($resultado);$cont++) {
    if ($cont==0) {
        echo "<h3>".$fila[3]."</h3>";
        
        echo '<table border="1">';
        echo "<tr><td>Nombre</td><td>Precio compra</td><td>Precio Venta</td></tr>";
    }
        
    echo "<tr><td>" . $fila[0] . "</td><td>" . $fila[1] ."</td><td>" . $fila[2] . "</td></tr>";
}

echo "</table>";
