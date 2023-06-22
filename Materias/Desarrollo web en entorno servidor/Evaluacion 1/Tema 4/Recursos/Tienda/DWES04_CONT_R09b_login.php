<?php
    // Comprobamos si ya se ha enviado el formulario
    if (isset($_POST['enviar'])) {
        $usuario = $_POST['usuario'];
        $password = $_POST['password'];
       
        if (empty($usuario) || empty($password)) 
            $error = "Debes introducir un nombre de usuario y una contraseña";
        else {
            // Comprobamos las credenciales con la base de datos
            // Conectamos a la base de datos
            try {
                $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
                $dsn = "mysql:host=localhost;dbname=dwes";
                $dwes = new PDO($dsn, "dwes", "abc123.", $opc);
            }
            catch (PDOException $e) {
                die("Error: " . $e->getMessage());
            }

             // Ejecutamos la consulta para comprobar las credenciales
            $sql = "SELECT usuario FROM usuarios " .
            "WHERE usuario='$usuario' " .
            "AND contrasena='" . md5($password) . "'";
            
            if($resultado = $dwes->query($sql)) {
                $fila = $resultado->fetch();
                if ($fila != null) {
                    session_start();
                    $_SESSION['usuario']=$usuario;
                    header("Location: productos.php");                    
                }
                else {
                    // Si las credenciales no son válidas, se vuelven a pedir
                    $error = "Usuario o contraseña no válidos!";
                }
                unset($resultado);
            }
            unset($dwes);            
        }
   }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 4 : Desarrollo de aplicaciones web con PHP -->
<!-- Ejemplo Tienda Web: login.php -->
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Ejemplo Tema 4: Login Tienda Web</title>
  <link href="tienda.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div id='login'>
    <form action='login.php' method='post'>
    <fieldset >
        <legend>Login</legend>
        <div><span class='error'><?php echo $error; ?></span></div>
        <div class='campo'>
            <label for='usuario' >Usuario:</label><br/>
            <input type='text' name='usuario' id='usuario' maxlength="50" /><br/>
        </div>
        <div class='campo'>
            <label for='password' >Contraseña:</label><br/>
            <input type='password' name='password' id='password' maxlength="50" /><br/>
        </div>

        <div class='campo'>
            <input type='submit' name='enviar' value='Enviar' />
        </div>
    </fieldset>
    </form>
    </div>
</body>
</html>
