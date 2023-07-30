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
            function es_primo($n) {
                for ($i=2;$i<=sqrt($n);$i++) {
                    if ($n%$i==0) {
                        return 0;
                    }
                }
                
                return 1;
            }            
                        
            echo '<table border="1">';
            for ($i=0;$i<10;$i++) {
                echo '<tr>';
                for ($j=0;$j<10;$j++) {
                    $n=$i*10+$j;
                    if (es_primo($n)) {
                        echo '<td>'.$n.'</td>';
                    } else {
                        echo '<td>-</td>';
                    }
                }
                echo '</tr>';
            }
        ?>

    </body>
</html>
