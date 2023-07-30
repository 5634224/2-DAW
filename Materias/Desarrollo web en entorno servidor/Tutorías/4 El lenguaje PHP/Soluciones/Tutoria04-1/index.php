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
        
            if (isset($_POST["buscado"]) && $_POST["buscado"]!="") {
                $num=$_POST["buscado"];
            } else {
                $num=1+rand()%100;
            }
            
            
            if(isset($_POST["numero"])) {
                $n=$_POST["numero"];
                
                if ($num>$n) {
                    echo "El número buscado es mayor";
                } else if ($num<$n) {
                    echo "El número buscado es menor";
                } else {
                    echo "Has acertado el número $num. Empieza una nueva partida";
                    
                    $num=1+rand()%100;
                }
            }
            
        ?>
        
        <form action="" method="post">
            <input type="text" name="numero"><!-- comment -->
            <input type="text" name="buscado" hidden="hidden" value="<?php echo $num?>">
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
