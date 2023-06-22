<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        /*======================================
                    DEPENDENCIAS
        =======================================*/
        //require_once 'usuario.php';

        /*==================================
                VARIABLES GLOBALES
        ====================================*/
        $usuarios; // Se usara para SESSION

        /*==================================
                    FUNCIONES
        ====================================*/
        function inicializacion() {
            /*-- Inicialización de datos por primera vez --*/
            global $usuarios; // Accede a la variable global
            $usuarios = Array("Pepe", "Pepa");

            /*-- Añade la variable a la sesion --*/
            $_SESSION["usuarios"] = $usuarios;
        }

        /*[...] otras funciones que hagan falta, por ejemplo, para cargar opciones en un desplegable */

        /*===================================
                    GUION PHP
        ====================================*/
        /*-- Recupera los datos de la sesion --*/
        session_start(); // Inicia la sesion
        $usuarios = $_SESSION["usuarios"];

        /*-- Verifica si habia cargado algo en la sesion --*/
        if (isset($usuarios)) { // Existen datos en la sesion
            if (isset($_POST["reset"])) { // Si pide resetear la aplicacion
                session_destroy();
                session_start();
                inicializacion();
            } else if (isset($_POST["aceptar"])) { // Si el usuario intenta meter datos en la aplicacion
                $accion = $_POST["accion"];
                switch ($accion) {
                    case "a":
                        
                        break;
                    case "b":

                        break;
                }
            }
        } else { // No existen datos en la sesion
            inicializacion();
        }
    ?>

    <!-- Tu codigo HTML normal, que podra incluir llamadas a funciones para cargar datos, por ejemplo, para cargar datos en un desplegable -->
</body>
</html>