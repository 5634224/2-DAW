<?php
    // Recuperamos la información de la sesión
    session_start();
    
    // Y la eliminamos
    session_unset();
    header("Location: login.php");
?>
