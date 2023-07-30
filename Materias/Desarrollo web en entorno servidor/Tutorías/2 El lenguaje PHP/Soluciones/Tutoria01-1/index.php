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
            $n1=0;
            $n2=1;
            
            echo "$n1<br>$n2<br>";
            
            for ($i=0;$i<98;$i++) {
                $n3=$n1+$n2;
                echo "$n3<br>";
                
                $n1=$n2;
                $n2=$n3;
            }
            
        ?>
    </body>
</html>
