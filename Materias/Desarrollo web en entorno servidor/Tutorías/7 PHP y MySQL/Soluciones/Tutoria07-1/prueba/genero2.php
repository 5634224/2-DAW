<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once '../conexion.php';

$link = conecta_bd();

$consulta = "SELECT art_id,art_nombre,gen_nombre FROM generos ".
        "LEFT JOIN articulos ON art_genero=gen_id WHERE gen_id=".$_POST["genero"];
//echo $consulta;
$resultado = mysqli_query($link, $consulta);

echo '<form action = "../index.php" method="post">';

for ($cont=0;$fila = mysqli_fetch_row($resultado);$cont++) {
    if ($cont==0) {
        echo "<h3>".$fila[2]."</h3>";
        
        echo '<select name="listaarticulo">';        
    }

    echo '<option value="'.$fila[0].'">'.$fila[1]."</option>";
}

echo '</select><input type="submit" value="enviar"></form>';
