<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio 1</title>
    </head>
    <body>
        <form name="input" method="post">
            <select name="opcion">
                <option value="piedra">Piedra</option>
                <option value="papel">Papel</option>
                <option value="tijera">Tijera</option>
            </select>
            <input type="submit" value="Enviar"/>
        </form>
        <?php
            $num=random_int(0,2); //Generamos un número aleatorio de 0 a 2
            
            // Según el valor le asignamos piedra,papel o tijera, aunque podríamos haber utilizado directamente 0,1 y 2 en el value del formulario 
            // y saltarnos este paso aunque pienso que de esta manera está más claro sobre todo el condicional a continuación del switch
            switch ($num) { 
                case 0:
                    $resultado="piedra";
                    break;
                case 1:
                    $resultado="papel";
                    break;
                case 2:
                    $resultado="tijera";
                    break;
            }
            
            //Comprobamos que tenemos una opción enviada
            if (isset($_POST['opcion'])) {
                
                //Algoritmo para saber quién ha ganado
                if ($_POST['opcion']==$resultado) {
                    echo '<p>Los dos hemos elegido '.$resultado.' por lo que hemos empatado.</p>';
                } else {
                    if($_POST['opcion']=='piedra' && $resultado=='tijera') {
                        echo '<p>Tu piedra ha ganado a mi tijera.</p>';
                    } elseif ($_POST['opcion']=='piedra' && $resultado=='papel') {
                        echo '<p>Tu piedra ha perdido contra mi papel.</p>';
                    } elseif ($_POST['opcion']=='papel' && $resultado=='tijera') {
                        echo '<p>Tu papel ha perdido contra mi tijera.</p>';
                    } elseif ($_POST['opcion']=='papel' && $resultado=='piedra') {
                        echo '<p>Tu papel ha ganado a mi piedra.</p>';
                    } elseif ($_POST['opcion']=='tijera' && $resultado=='papel') {
                        echo '<p>Tu tijera ha ganado a mi papel.</p>';
                    } elseif ($_POST['opcion']=='tijera' && $resultado=='piedra') {
                            echo '<p>Tu tijera ha ganado a mi piedra.</p>';
                    }
                }
            }
        ?>
    </body>
</html>

