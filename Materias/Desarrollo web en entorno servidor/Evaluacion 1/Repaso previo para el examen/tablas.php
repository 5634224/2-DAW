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
        $miSubArray = array("prueba", "prueba2");
        $miArray = array($miSubArray);
    ?>

    <table border="1">
        <theader>
            <th>1</th>
            <th>2</th>
        </theader>
        <tbody>
            <?php
                for ($i=0; $i < count($miArray); $i++) { 
                    ?>
                        <tr>
                            <td><?php echo $miArray[$i][0] ?></td>
                            <td>
                                <form action="" method="post">
                                    <input type="submit" name="x" value="<?php echo $miArray[$i][1] ?>">
                                </form>
                            </td>
                        </tr>
                    <?php
                }
            ?>
        </tbody>
    </table>
</body>
</html>