  
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php
            define('DB','Coyo_Rappi') ;   
            define('PASSWORD','root') ;
            define('USER','root') ;
            define('A','localhost') ;
            $conexion = mysqli_connect("localhost",USER,"", DB);
            if( !$conexion ){
                echo mysqli_connect_error();
                echo mysqli_connect_errno();
                exit();
            }
            $comida="SELECT nombre FROM alimento WHERE disponibilidad >0";
            $menu2=mysqli_query($conexion,$comida);
            $menu3=[];
            while($menu=mysqli_fetch_array($menu2,MYSQLI_NUM)){
                $menu3[]=$menu[0];
            }
            echo"<br>";
            echo"<br>";
            $food=[];
            $cant=[];
            $n=0;
            $f=0;
            if (isset($_POST["food"])&&isset($_POST["cant"])){
                $food = $_POST["food"];
                $cant= $_POST["cant"];
            }
            if (isset($_POST["Pedir"])) {
                print_r($food);
                echo"<br>";
                print_r($cant);
                echo"<br>";    
            }
            echo"<form action='Pedidos.php' method='POST'>";
            /* Segundo */
            for($i=0;$i<count($food);$i++){
                echo"<select name='food[]'>";
                $n=0;
                print_r($menu3);   
                echo"<option>".$_POST["food"]."</option>";
               /*   while($n < count($menu3)){
                    echo"<option value='".$menu3[$n]."'";
                    if($menu3[$n]==$food[$i])
                        echo "selected";
                    echo ">".$menu3[$n]." </option>";
                    $n++;
                }*/
                echo"</select>";
                echo"<input value=".$cant[$i]." type='number' name='cant[]'>";
                echo"<br>";           
            }
            /* Primero */
                echo"<select name='food[]'>";
                while($f < count($menu3)){
                echo"<option value=".$menu3[$f].">".$menu3[$f]." </option>";
                echo $menu3[$f];
                $f++;
                }
                echo"</select>";
        ?>    
            <input type="number" name="cant[]" required>  
            <br>
            <input type='submit' name='Pedir' value='Pedir'>
            <input type='submit' name='Agregar' value='Agregar'>
        </form>
    </body>
</html>