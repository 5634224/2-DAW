<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>                        
        <?php
            if (isset($_POST['jugada'])) {
                echo $_POST['jugada'];
            }
        ?>
        
        
        <form action="" method="post">
            <input type="text" name="jugada" value="Piedra" hidden="hidden"><!-- comment -->
            <input type="submit" value="Piedra"><!-- comment -->
        </form>
        
        <form action="" method="post">
            <input type="text" name="jugada" value="Papel" hidden="hidden"><!-- comment -->
            <input type="submit" value="Papel"><!-- comment -->
        </form>
        
        <form action="" method="post">
            <input type="text" name="jugada" value="Tijeras" hidden="hidden"><!-- comment -->
            <input type="submit" value="Tijeras"><!-- comment -->
        </form>        
        
        
    </body>
</html>
