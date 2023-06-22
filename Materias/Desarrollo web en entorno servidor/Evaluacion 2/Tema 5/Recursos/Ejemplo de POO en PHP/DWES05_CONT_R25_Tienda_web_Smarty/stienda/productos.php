<?php
require_once('include/DB.php');
require_once('include/CestaCompra.php');
require_once('Smarty.class.php');

// Recuperamos la información de la sesión
session_start();

// Y comprobamos que el usuario se haya autentificado
if (!isset($_SESSION['usuario'])) 
    die("Error - debe <a href='login.php'>identificarse</a>.<br />");

// Recuperamos la cesta de la compra
$cesta = CestaCompra::carga_cesta();

// Cargamos la librería de Smarty
$smarty = new Smarty;
$smarty->template_dir = '/web/smarty/stienda/templates/';
$smarty->compile_dir = '/web/smarty/stienda/templates_c/';
$smarty->config_dir = '/web/smarty/stienda/configs/';
$smarty->cache_dir = '/web/smarty/stienda/cache/';

// Comprobamos si se ha enviado el formulario de vaciar la cesta
if (isset($_POST['vaciar'])) {
    unset($_SESSION['cesta']);
    $cesta = new CestaCompra();
}

// Comprobamos si se quiere añadir un producto a la cesta
if (isset($_POST['enviar'])) {
    $cesta->nuevo_articulo($_POST['cod']);
    $cesta->guarda_cesta();
}

// Ponemos a disposición de la plantilla los datos necesarios
$smarty->assign('usuario', $_SESSION['usuario']);
$smarty->assign('productos', DB::obtieneProductos());
$smarty->assign('productoscesta', $cesta->get_productos());

// Mostramos la plantilla
$smarty->display('productos.tpl');     
?>