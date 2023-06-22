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
            
            
            if (isset($_POST['numero'])) {
                $m=$_POST['numero'];
                if (es_primo($m)) {
                    echo "El número ".$m." es primo.";
                } else {
                    echo "El número ".$m." no es primo.";
                }
                
            }
        ?>
        
        
        <form action="" method="post">
            <input type="text" name="numero"><br>
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
