<?php
    // Recuperamos la información de la sesión
    session_start();
    
    // Y comprobamos que el usuario se haya autentificado
    if (!isset($_SESSION['usuario'])) {
        die("Error - debe <a href='login.php'>identificarse</a>.<br />");
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<!-- Desarrollo Web en Entorno Servidor -->
<!-- Tema 4 : Desarrollo de aplicaciones web con PHP -->
<!-- Ejemplo Tienda Web: productos.php -->
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Ejemplo Tema 4: Listado de Productos</title>
  <link href="tienda.css" rel="stylesheet" type="text/css">
</head>

<body class="pagproductos">

<div id="contenedor">
  <div id="encabezado">
    <h1>Listado de productos</h1>
  </div>
  <div id="cesta">
    <h3><img src="cesta.png" alt="Cesta" width="24" height="21"> Cesta</h3>
    <hr />
<?php
    // Comprobamos si se ha enviado el formulario de vaciar la cesta
    if (isset($_POST['vaciar'])) {
        unset($_SESSION['cesta']);
    }

    // Comprobamos si se ha enviado el formulario de añadir
    if (isset($_POST['enviar'])) {
        // Creamos un array con los datos del nuevo producto
        $producto['nombre'] = $_POST['nombre'];
        $producto['precio'] = $_POST['precio'];
        //  y lo añadimos
        $_SESSION['cesta'][$_POST['producto']] = $producto;
   }
   
   // Si la cesta está vacía, mostramos un mensaje
   $cesta_vacia = true;
   if (count($_SESSION['cesta'])==0) {
       print "<p>Cesta vacía</p>";
   }
   
   // Si no está vacía, mostrar su contenido
   else {      
       foreach ($_SESSION['cesta'] as $codigo => $producto)
            print "<p>$codigo</p>";
       $cesta_vacia = false;
   }
?>
    <form id='vaciar' action='productos.php' method='post'>
        <input type='submit' name='vaciar' value='Vaciar Cesta' 
            <?php if ($cesta_vacia) print "disabled='true'"; ?>
        />
    </form>
    <form id='comprar' action='cesta.php' method='post'>
        <input type='submit' name='comprar' value='Comprar' 
            <?php if ($cesta_vacia) print "disabled='true'"; ?>
        />
    </form>
  </div>
  <div id="productos">
<?php
    try {
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $dsn = "mysql:host=localhost;dbname=dwes";
        $dwes = new PDO($dsn, "dwes", "abc123.", $opc);
    }
    catch (PDOException $e) {
        $error = $e->getCode();
        $mensaje = $e->getMessage();
    }

    if (!isset($error)) {
	$sql = <<<SQL
SELECT cod, nombre_corto, PVP
FROM producto
SQL;
	$resultado = $dwes->query($sql);
	if($resultado) {
            // Creamos un formulario por cada producto obtenido
            $row = $resultado->fetch();
            while ($row != null) {
                echo "<p><form id='${row['cod']}' action='productos.php' method='post'>";
                // Metemos ocultos los datos de los productos
                echo "<input type='hidden' name='producto' value='".$row['cod']."'/>";
                echo "<input type='hidden' name='nombre' value='".$row['nombre_corto']."'/>";
                echo "<input type='hidden' name='precio' value='".$row['PVP']."'/>";
                echo "<input type='submit' name='enviar' value='Añadir'/>";
                echo " ${row['nombre_corto']}: ";
                echo $row['PVP']." euros.";
                echo "</form>";
                echo "</p>";
                $row = $resultado->fetch();
            }
	}
    }
?>

  </div>
  <br class="divisor" />
  <div id="pie">
    <form action='logoff.php' method='post'>
        <input type='submit' name='desconectar' value='Desconectar usuario <?php echo $_SESSION['usuario']; ?>'/>
    </form>        
<?php
    if (isset($error)) {
        print "<p class='error'>Error $error: $mensaje</p>";
    }
?>
  </div>
</div>
</body>
</html>
