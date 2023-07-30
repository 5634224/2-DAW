<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

        function conecta_bd() {
            $link = mysqli_connect('localhost', 'super', '123456', 'tienda');

            if (!$link) {
                echo "Error: no se puede conectar con la base de datos";
                exit;
            } else {
                return $link;
            }
        }