<?php
    // Recuperamos la información de la sesión
    session_start();
    unset($_SESSION['cesta']);
    
    die("Gracias por su compra.<br />Quiere <a href='productos.php'>comenzar de nuevo</a>?");
?>
