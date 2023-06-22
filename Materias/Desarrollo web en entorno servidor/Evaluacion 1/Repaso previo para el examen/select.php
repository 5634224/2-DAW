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
        /*-- Recibe los datos del POST o lo que sea --*/
        $miArray = array("prueba", "prueba2");
        if (isset($_POST["selection"])) {
            $opcionSeleccionadaValue = $_POST["selection"];
        }
    ?>

    <form action="" method="post">
        <select name="selection">
            <?php
                foreach ($miArray as $key => $value) { 
                    ?>
                        <option value="<?php echo $value ?>"><?php echo $key ?></option>
                    <?php
                }
            ?>
        </select>
    </form>
</body>
</html>