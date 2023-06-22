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
            function es_palindromo($s) {
                $l=strlen($s);
                for ($i=0,$j=$l-1;$i<$j;$i++,$j--) {
                    if (substr($s,$i,1)<>substr($s,$j,1)) {
                        return 0;
                    }
                }
                
                return 1;
            }
            
            echo es_palindromo("dabalxarrozalazorraelabad");
        ?>
    </body>
</html>
