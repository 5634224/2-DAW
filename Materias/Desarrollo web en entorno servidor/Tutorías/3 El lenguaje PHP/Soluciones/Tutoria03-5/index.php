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
            $p=128;     // En $p calculamos el peso de cada bit, empezamos con 128, el peso del bit más significativo, el que está a la izquierda de los 8
            $t=0;       // $t es el acumulador
            for ($i=0;$i<8;$i++) {
                if ($_POST["cb".$i]) {
                    $t+=$p;
                }
                $p/=2;  // Cada vez que avanzamos en el bucle el peso del bit se divide entre 2
            }
        
            echo $t;
        ?>
        
        <form action="" method="post">
            <?php
            
                for ($i=0;$i<8;$i++)
                    echo '<input type="checkbox" name="cb'.$i.'">';     // Utilizamos PHP dentro de HTML para crear los 8 checkboxes
                
            ?>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
