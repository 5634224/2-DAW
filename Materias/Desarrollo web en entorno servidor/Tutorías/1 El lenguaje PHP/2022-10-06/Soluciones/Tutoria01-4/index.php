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
            $a=1;
            $b=-7;
            $c=12;
            
            
            $r=$b*$b-4*$a*$c;
            
            if ($r<0) {
                echo "No tiene solución en los números reales";
            } else if ($r==0) {
                $s = -$b/(2*$a);
                echo "Una solución: $s";
            } else {
                $s1=(-$b+ sqrt($r))/(2*$a);
                $s2=(-$b- sqrt($r))/(2*$a);
                
                echo "Dos soluciones: $s1 y $s2";
            }
        ?>
    </body>
</html>
