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
            echo '<table border="1">';
        
            for ($i=0;$i<16;$i++) {
                echo "<tr>";
                for ($j=0;$j<16;$j++) {
                    $n=$i*16+$j;
                    echo "<td>".$n." ".chr($n)."</td>";                    
                }
                echo "</tr>";
            }
        ?>
    </body>
</html>
