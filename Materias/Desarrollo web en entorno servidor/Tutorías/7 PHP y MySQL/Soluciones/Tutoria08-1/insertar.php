<!DOCTYPE html>

<html>
    <body>
        <h3>Insertar nuevo artículo</h3><!-- comment -->
        
        <form action="genero.php" method="post">
            <input type="text" readonly="readonly" value="Nombre"><input type="text" name="nombre"><br>
            <input type="text" readonly="readonly" value="Precio de compra"><input type="text" name="preciocompra"><br>
            <input type="text" readonly="readonly" value="Precio de venta"><input type="text" name="precioventa"><br>
            <input type="text" readonly="readonly" value="Género"><input type="text" name="genero" readonly="readonly" value="<?php echo $_POST["genero"]?>">
            <input type="text" readonly="readonly" value="<?php echo $_POST["nombregenero"]?>"><br>            
            <input type="submit" value="Aceptar">
        </form>

        <form action="genero.php" method="post">
            <input type="text" name="genero" hidden="hidden" value="<?php $_POST["genero"]?>">          
            <input type="submit" value="Cancelar"><!-- comment -->
        </form>        
        
    </body>            
</html>



