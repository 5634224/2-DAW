<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Fibonacci</title>
    </head>
    <body>
        <?php
            if (isset($_POST['numero'])) {
                $numero = $_POST['numero'];
                $actual = 0;
                $siguiente = 1;
                while ($actual < $numero) {
                    /*-- Avanza en la iteración hasta coincidir en la condición del bucle --*/
                    $anterior = $actual;
                    $actual = $siguiente;
                    $siguiente = $anterior + $siguiente;
                }
                
                echo "El número " . $numero . ($actual == $numero ? " S&Iacute " : " NO ") . "est&aacute en la sucesi&oacuten de Fibonacci.\n<p>";
            }
        ?>
        <form action='<?php echo $_SERVER['PHP_SELF']; ?>' method="post">
            <input type="text" name="numero" autofocus="autofocus"/>
            <input type="submit" value="Comprobar" />
        </form>
    </body>
</html>
