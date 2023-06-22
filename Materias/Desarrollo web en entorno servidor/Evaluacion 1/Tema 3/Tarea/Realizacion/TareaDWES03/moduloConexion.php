<?php

    /* =======================================
     *          FUNCIONES BB.DD
      ======================================== */
    const hostname = "localhost";
    const database = "tienda";
    const username = "super";
    const password = "123456";
    
    /**
     * Funcion que realiza la conexion con la BBDD y devuelve un objeto para
     * poder realizar consultas y manipular sus registros.
     * @return \mysqli
     */
    function conectar() {
        $conexion = new mysqli(hostname, username, password, database);
        return $conexion;
    }

?>