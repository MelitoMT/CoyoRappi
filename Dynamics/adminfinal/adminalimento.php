<?php
$conexion= mysqli_connect("localhost","root","","Coyo_Rappi");
if( !$conexion ){
  echo mysqli_connect_error();
  echo mysql_connect_errno();
  exit();
}
else{
       $idalimento= "SELECT * FROM alimento";
       $alimento= mysqli_query($conexion, $idalimento);
       echo "<table border='1'>";
       echo "<tr>";
       echo"      <th>Nombre</th>";
       echo"      <th>Disponibilidad</th>";
       echo"      <th>Costo</th>";
       echo "</tr>";
       while($row=mysqli_fetch_array($alimento)){
         echo"<tr>";
         echo "     <td>" .$row[1]. "</td>";
         echo "     <td>" .$row[2]. "</td>";
         echo "     <td>" .$row[3]. "</td>";
         echo"</tr>";
       }
       echo "</table>";
       echo "</br>";
       echo '<a href="sesionadmin.php">Regresar </a>';
       echo "</br>";
       echo "</br>";

       echo "</br>";
           echo '
           <form action="adminalimento.php" method="POST">
               <select name="modificar" required/>
                  <option value="">Seleccione la acción que desea realizar</option>
                  <option value="changep"> Actualizar precio </option>
                  <option value="changed"> Actualizar disponibilidad</option>
                  <option value="addf"> Agregar alimento </option>
                  <option value="delf"> Eliminar alimento </option>
               </select>
               <input type="submit" value="Modificar">
           </form>
           ';
          if (isset($_POST['modificar']) && $_POST['modificar']!="")
          {
           $tipo= $_POST['modificar'];

              if ($tipo =='changep')
              {
                echo "<form action='adminalimento.php' method='POST'>";
                echo   "Seleccione el nombre del alimento del que desea cambiar el precio:";
                echo  "<select name='oldprice' required/>";
                echo  "<option value=''> Seleccione el alimento </option>";
                  $alimento4= mysqli_query($conexion, $idalimento);
                    while($row=mysqli_fetch_array($alimento4)){
                        echo "<option value='".$row[1]."'>" .$row[1].' </option>';
                        }
                 echo "</select>";
                 echo'
                  <br>
                  <br>
                  <label>Inserte el nuevo precio</label>
                  <input type="text" name="newprice">
                  <input type="submit" value="Actualizar">
                 </form>
                ';
              }
              if ($tipo =='changed')
              {
                echo "<form action='adminalimento.php' method='POST'>";
                echo   "Seleccione el nombre del alimento del que desea cambiar la disponibilidad:";
                echo  "<select name='oldstonks' required/>";
                echo  "<option value=''> Seleccione el alimento </option>";
                  $alimento4= mysqli_query($conexion, $idalimento);
                    while($row=mysqli_fetch_array($alimento4)){
                        echo "<option value='".$row[1]."'>" .$row[1].' </option>';
                      }
               echo "</select>";
                 echo'
                  <br>
                  <br>
                  <label>Cambiar disponibilidad</label>
                  <input type="text" name="stocks">
                  <input type="submit" value="Actualizar">
                 </form>
                ';
              }
              if ($tipo =='addf')
              {
                echo '
                <form action="adminalimento.php" method="POST">
                <label>Inserte el nombre del nuevo alimento:</label>
                <input type="text" name="newfood"><br><br>
                <label>Disponibilidad:</label>
                <input type="text" name="disp"><br><br>
                <label>Costo:</label>
                <input type="text" name="price"><br><br>
                <input type="submit" value="Agregar">
                ';
              }
              if ($tipo =='delf')
              {
                echo "<form action='adminalimento.php' method='POST'>";
                echo  "Seleccione el alimento a eliminar:";
                echo  "<select name='bonvoayage' required/>";
                echo  "<option value=''> Seleccione el alimento que desea eliminar </option>";
                  $alimento4= mysqli_query($conexion, $idalimento);
                    while($row=mysqli_fetch_array($alimento4)){
                        echo "<option value='".$row[1]."'>" .$row[1].' </option>';
              }
              echo "</select>";
                echo'
                 <br>
                  <br>
                 <input type="submit" value="Eliminar">
                </form>
               ';
                }
            }
             if ((isset($_POST['oldprice']) && $_POST['oldprice']!="") && (isset($_POST['newprice']) && $_POST['newprice']!=""))
            {
            $oldprice= $_POST['oldprice'];
            $newprice= $_POST['newprice'];
              echo "Ha cambiado el precio de $oldprice a $newprice";
              echo "<br>";
              echo "<a href='adminalimento.php'> Actualizar Registros </a> ";
              $sql="UPDATE alimento SET costo='$newprice' WHERE nombre='$oldprice'";
              mysqli_query($conexion,$sql);
             }
          if ((isset($_POST['oldstonks']) && $_POST['oldstonks']!="") && (isset($_POST['stocks']) && $_POST['stocks']!=""))
          {
          $oldstonks= $_POST['oldstonks'];
          $stocks= $_POST['stocks'];
           echo "Ha cambiado la disponibilidad de $oldstonks a $stocks";
           echo "<br>";
           echo "<a href='adminalimento.php'> Actualizar Registros </a> ";
           $sql="UPDATE alimento SET disponibilidad='$stocks' WHERE nombre='$oldstonks'";
           mysqli_query($conexion,$sql);
          }

          if (((isset($_POST['newfood']) && $_POST['newfood']!="")) && ((isset($_POST['disp']) && $_POST['disp']!="")) && ((isset($_POST['price']) && $_POST['price']!="")))
         {
         $newfood= $_POST['newfood'];
         $disp= $_POST['disp'];
         $price= $_POST['disp'];

           echo "Ha agregado el alimento $newfood con disponibilidad  $disp y con el precio de $price ";
           echo "<br>";
           echo "<a href='adminalimento.php'> Actualizar Registros </a> ";
           $addlugar="INSERT INTO alimento (id_alimento, nombre, disponibilidad,costo) VALUES (Null,\"$newfood\",\"$disp\", $price)";
           mysqli_query($conexion,$addlugar);
          }

          if (isset($_POST['bonvoayage']) && $_POST['bonvoayage']!="")
          {
             $bonvoayage= $_POST['bonvoayage'];
            echo "Ha eliminado $bonvoayage";
            echo "<br>";
            echo "<a href='adminalimento.php'> Actualizar Registros </a> ";
            $sql="SELECT id_alimento FROM alimento WHERE nombre='$bonvoayage'";
            $sql2=mysqli_query($conexion,$sql);
            $sql3=mysqli_fetch_array($sql2,MYSQLI_NUM);
            $elimalimentou= "DELETE FROM pedido WHERE id_alimento='$sql3[0]'";
            $answer=mysqli_query($conexion,$elimalimentou);
            $elimalimento= "DELETE FROM alimento WHERE nombre='$bonvoayage'";
            $resp=mysqli_query($conexion,$elimalimento);
          }
}
?>
