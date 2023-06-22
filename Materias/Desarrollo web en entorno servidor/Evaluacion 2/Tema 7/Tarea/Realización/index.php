<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>

    <script src="validacion.js"></script>
    <link rel="stylesheet" href="custom.css">
</head>
<body>
    <?php

    ?>

    <div id="wrapper">
        <h1>Gestión de usuarios</h1>
        <form action="" method="post">
            <div>
                <label>DNI</label>
                <input type="text" placeholder="DNI" name="dni" maxlength="9">
            </div>
            
            <div>
                <label>Usuario</label>
                <input type="text" placeholder="Nombre" name="nombre">
            </div>
            
            <div>
                <label>Ciudad</label>
                <input type="text" placeholder="Ciudad" name="ciudad">
            </div>
            
            <div>
                <input type="submit" value="Crear">
            </div>
        </form>
    </div>
</body>
</html>