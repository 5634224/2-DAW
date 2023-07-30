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
        $a = 2022;
        $m = 10;

        /*
          if ($m==4 || $m==6 || $m==9 || $m==11) {
          echo "30 días";
          } else if ($m==2) {
          if ($a%4==0)
          echo "29 días";
          else
          echo "28 días";
          } else {
          echo "31 días";
          } */

        switch ($m) {
            case 4:
            case 6:
            case 9:
            case 11:
                echo "30 días";
                break;
            case 2:
                if ($a % 4 == 0)
                    echo "29 días";
                else
                    echo "28 días";
                break;

            default :
                echo "31 días";
        }
        ?>
    </body>
</html>
