<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 3</title>
    </head>
    <body>
        <form name="input" method="post">
            <input type="text" name="numero"/>
            <input type="submit" value="Enviar"/>
        </form>
        <br>
        <?php
            if (isset($_POST['numero']) && $_POST['numero']!="") {
                $inicio=0;
                $siguiente=1;
                while ($inicio<$_POST['numero']) {
                    $aux=$inicio+$siguiente;
                    $inicio=$siguiente;                    
                    $siguiente=$aux;
                }
                
                if ($_POST['numero']==$inicio) {
                    echo "El número ".$_POST['numero']." se encuentra en la serie Fibonacci.";
                } else {
                    echo "El número ".$_POST['numero']." no se encuentra en la serie Fibonacci.";
                }
                
            }
        ?>
    </body>
</html>
