<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tarea 5</title>
        
        <style>
            body {
                margin-top: 0;
            }
            
            header {
                background-color: white;
                position: -webkit-sticky; /* Safari */
                position: sticky;
                top: 0;
                padding-top: 0.5em;
                padding-bottom: 0.5em;
                text-align: center;
            }
            
            .mensajeError {
                color: red;
            }
            
            .mensajeExito {
                color: green;
            }
            
            main div {
                display: inline-block;
                width: 50%;
                vertical-align: top;
            }
        </style>
    </head>
    <body>
        <div id="container">
            <header>
                <?php
                    require_once 'usuario.php';

                    /*-- Variables --*/
                    $usuarios;

                    /*-- Funciones --*/            
                    function inicializacion() {
                        /*-- Inicialización de datos por primera vez --*/
                        global $usuarios;
                        $usuarios = Array(new Usuario("Pepe"), new Usuario("Pepa"));

                        /*-- Pepe --*/
                        $usuarios[0]->addArticulo(new Consola("PlayStation 5", "PS5", 549, "Arquitectura AMD RDNA 2"));
                        $usuarios[0]->addArticulo(new Videojuego("Forza Horizon 5", "PS5 & Xbox Series", 50, "Carreras", 5));
                        $usuarios[0]->addArticulo(new Videojuego("Ratchet And Clank: Rift Apart", "PS5", 70, "Plataformas, aventura, disparos en tercera persona", 7));
                        $usuarios[0]->addArticulo(new Videojuego("Spiderman: Miles Morales", "PS5 & Xbox Series", 30, "Acción y aventura, lucha, plataformas", 3));
//                        $usuarios[0]->addArticulo(new Videojuego("Doom Eternal", "PS5 & Xbox Series", 20, "Shooter en primera persona", 2));
//                        $usuarios[0]->addArticulo(new Videojuego("FIFA 2023", "PS5 & Xbox Series", 55, "Deportes", 6));
                        $usuarios[0]->anadirTarjeta(450);

                        /*-- Pepa --*/
                        $usuarios[1]->addArticulo(new Consola("Xbox Series X", "Xbox Series", 499, "Arquitectura AMD RDNA 2"));
                        $usuarios[1]->addArticulo(new Videojuego("Need For Speed Unbound", "PS5 & Xbox Series", 60, "Carreras", 6));
                        $usuarios[1]->addArticulo(new Videojuego("Spiderman: Miles Morales", "PS5 & Xbox Series", 30, "Acción y aventura, lucha, plataformas", 3));
                        $usuarios[1]->addArticulo(new Videojuego("Howgarts Legacy", "PS5 & Xbox Series", 75, "Videojuego de rol, mundo abierto", 8));
//                        $usuarios[1]->addArticulo(new Videojuego("The Last Of Us", "PS5 & Xbox Series", 70, "Terror, acción y aventura, disparos en tercera persona", 7));
                        $usuarios[1]->anadirTarjeta(700);
                        
                        /*-- Añade el array de usuarios a la sesion --*/
                        $_SESSION["usuarios"] = $usuarios;
                    }

                    function cargarDesplegableUsuarios() {
        //                echo '<option value="Pepe">Pepe</option>';
        //                echo '<option value="Pepa">Pepa</option>';
                        global $usuarios;
                        for ($i = 0; $i < count($usuarios); $i++) {
                            echo '<option value="' . $i . '">' . $usuarios[$i]->getNombre() .'</option>';
                        }
                    }

                    /*=================================
                     *          GUION PHP
                     =================================*/
                    session_start(); // Inicia la sesion
                    $usuarios = $_SESSION["usuarios"];
                    /*-- Verifica si hay algo cargado ya en la sesion --*/
                    if (isset($usuarios)) { // Existen datos en la sesion
                        if (isset($_POST["reset"])) { // Si pide resetear la aplicacion
                            session_destroy();
                            session_start();
                            inicializacion();
                        } else if (isset($_POST["aceptar"])) { // Si intenta meter datos en la aplicacion
                            $accion = $_POST["accion"];
                            $idUser = intval($_POST["user"]);
                            $user = $usuarios[$idUser];
                            switch ($accion) {
                                case "buy":
                                    $resultado = $user->compraArticulo($_POST["articulo"], $usuarios[($idUser + 1) % 2]);
                                    switch ($resultado) {
                                        case 0:
                                            echo '<div class="mensajeExito">La transacción se ha completado. Tu compra se ha realizado correctamente.</div>';
                                            break;
                                        case 1:
                                            echo '<div class="mensajeError">' . 
                                                'La transacción no se ha completado. El artículo especificado no está en la lista de ' .
                                                $usuarios[($idUser + 1) % 2]->getNombre() . '</div>';
                                            break;
                                        case 2:
                                            echo '<div class="mensajeError">' . 
                                                'La transacción no se ha completado. No tienes crédito suficiente.</div>';
                                            break;
                                    }
                                    break;
                                case "rent":
                                    $resultado = $user->alquilaVideojuego($_POST["articulo"], $usuarios[($idUser + 1) % 2]);
                                    switch ($resultado) {
                                        case 0:
                                            echo '<div class="mensajeExito">La transacción se ha completado. Tu alquiler se ha realizado correctamente.</div>';
                                            break;
                                        case 1:
                                            echo '<div class="mensajeError">' . 
                                                'La transacción no se ha completado. El videojuego especificado no está en la lista de ' .
                                                $usuarios[($idUser + 1) % 2]->getNombre() . '</div>';
                                            break;
                                        case 2:
                                            echo '<div class="mensajeError">' . 
                                                'La transacción no se ha completado. No tienes crédito suficiente.</div>';
                                            break;
                                    }
                                    break;
                            }
                        }
                    } else { // No existen datos en la sesion
                        inicializacion();
                    }
                ?>
                <form method="post">
                    <label>Elige el usuario</label>
                    <select name="user">
                        <?php
                            cargarDesplegableUsuarios();
                        ?>
                        
                    </select>
                    <span>   </span>
                    
                    <label>Elige una acción:</label>
                    <select name="accion">
                        <option value="buy">Comprar</option>    
                        <option value="rent">Alquilar</option>
                    </select>
                    <span>   </span>
                    
                    <label>Artículo</label>
                    <input type="text" name="articulo">
                    <input type="submit" name="aceptar" value="Aceptar">
                    <input type="submit" name="reset" value="Reiniciar">
                </form>
            </header>
            <main>
                <?php
                    for ($i = 0; $i < count($usuarios); $i++) {
                        echo "<div>";
                        /*-- Datos personales --*/
                        echo "<h1>" . $usuarios[$i]->getNombre() . "</h1>";
                        echo "<p>" . 
                                '<span style="font-weight: bold;">Nombre: </span>' . $usuarios[$i]->getNombre() . 
                                '   <span style="font-weight: bold;">Credito: </span>' . $usuarios[$i]->getCredito() . 
                                "</p>";
                        /*-- Seccion de articulos --*/
                        $articulos = $usuarios[$i]->getArticulos();
                        echo "<h2>" . "Articulos" . "</h2>";
                        echo "<ul>";
                        foreach ($articulos as $articulo) {
                            for ($j = 0; $j < count($articulo); $j++) {
                                echo "<li>";
                                echo $articulo[$j]->getTipoArticulo() . " - ";
                                echo $articulo[$j]->getNombre(). " - ";
                                echo $articulo[$j]->getPrecioVenta() . " &euro;";
                                echo "</li>";
                            }                            
                        }
                        echo "</ul>";
//                        var_dump($articulos);
                        
                        /*-- Seccion de prestamos --*/
                        $alquileres = $usuarios[$i]->getPrestamos();
                        echo "<h2>" . "Alquileres" . "</h2>";
                        echo "<ul>";
                        foreach ($alquileres as $alquiler) {
                            echo "<li>" . $alquiler . "</li>";                     
                        }
                        echo "</ul>";

                        
                        /*-- Finaliza la impresión de datos del usuario --*/
                        echo "</div>";
                    }
                ?>
            </main>
        </div>
    </body>
</html>
