<?php
$conexion= mysqli_connect("localhost","root","","Coyo_Rappi");//Recordar que debo cambiar el nombre
if( !$conexion ){
  echo mysqli_connect_error();
  echo mysql_connect_errno();
  exit();
}
else{
           $idsupervisor= "SELECT * FROM supervisor";
           $supervisor= mysqli_query($conexion, $idsupervisor);
           echo "<table border='1'>";
           echo "<tr>";
           echo"      <th>Supervisor</th>";
           echo "</tr>";
           while($row=mysqli_fetch_array($supervisor)){
             echo"<tr>";
             echo "     <td>" .$row[0]. "</td>";
             echo"</tr>";
           }
           echo "</table>";
           echo "</table>";
           echo "</br>";
           echo '<a href="sesionadmin.php">Regresar </a>';
           echo "</br>";
           echo '
           <form action="adminsupervisor.php" method="POST">
               <select name="modificar" required/>
                 <option value="">Seleccione la accion que desea realizar</option>
                 <option value="addm"> Agregar Supervisor  </option>
                 <option value="delm"> Eliminar Supervisor </option>
                 <option value="pushm"> Actualizar Usuario de Supervisor </option>
                 <option value="chp"> Actualizar Contraseña </option>
               </select>
               <input type="submit" value="Modificar">
           </form>
           ';
          if (isset($_POST['modificar']) && $_POST['modificar']!="")
          {
           $tipo= $_POST['modificar'];

              if ($tipo =='addm')
              {
                 echo '
                      <form action="adminsupervisor.php" method="POST">
                      <label>Inserte el usuario del nuevo Supervisor:</label>
                      <input type="text" name="newmanager"><br><br>
                      <label>Ingrese la contraseña:</label>
                      <input type="password" name="newpassword" id ="password" placeholder="Mínimo 10 caracteres" minlenght="10">
                      <input type="submit" value="Enviar">
                      ';
              }
              if ($tipo =='delm')
              {
                echo "<form action='adminsupervisor.php' method='POST'>";
                echo  "Seleccione el supervisor a eliminar:";
                echo  "<select name='delmanager' required/>";
                echo  "<option value=''> Seleccione el usuario </option>";
                       $supervisor4= mysqli_query($conexion, $idsupervisor);
                          while($row=mysqli_fetch_array($supervisor4)){
                                echo "<option value='".$row[0]."'>" .$row[0].' </option>';
                                }
               echo'
                     </select>
                     <br>
                     <br>
                     <input type="submit" value="Eliminar">
                     </form>
                    ';
             }
             if ($tipo =='pushm')
             {
               echo "<form action='adminsupervisor.php' method='POST'>";
               echo  "Seleccione el usuario que desea actualizar";
               echo  "<select name='oldmanager' required/>";
               echo  "<option value=''> Seleccione el usuario </option>";
                      $supervisor4= mysqli_query($conexion, $idsupervisor);
                         while($row=mysqli_fetch_array($supervisor4)){
                               echo "<option value='".$row[0]."'>" .$row[0].' </option>';
                               }
              echo'
                    </select>
                    <br>
                    <br>
                    <label>Inserte nuevo nombre del usuario</label>
                    <input type="text" name="manager">
                    <br><br>
                    <input type="submit" value="Actualizar Usuario">
                   </form>

                   ';
            }
            if ($tipo =='chp')
            {
              echo "<form action='adminsupervisor.php' method='POST'>";
              echo  "Seleccione el usuario del que desea cambiar la contraseña";
              echo  "<select name='oldpassword' required/>";
              echo  "<option value=''> Seleccione el usuario </option>";
                     $supervisor4= mysqli_query($conexion, $idsupervisor);
                        while($row=mysqli_fetch_array($supervisor4)){
                              echo "<option value='".$row[0]."'>" .$row[0].' </option>';
                              }
             echo'
                   </select>
                   <br>
                   <br>
                   <label>Ingrese la nueva contraseña:</label>
                   <input type="password" name="newkey" id ="password" placeholder="Mínimo 10 caracteres" minlenght="10">
                   <br><br>
                   <input type="submit" value="Actualizar Contraseña">
                   </form>

                  ';
            }

              }
              if ((isset($_POST['newmanager']) && $_POST['newmanager']!="") && (isset($_POST['newpassword']) && $_POST['newpassword']!=""))
              {
                  $newmanager= $_POST['newmanager'];
                  $newpassword= $_POST['newpassword'];
                  echo "Ha agregado $newmanager";
                  echo "<br>";
                  echo "<a href='adminsupervisor.php'> Actualizar Registros </a> ";
                  $addmanager="INSERT INTO supervisor (usuario,contraseña) VALUES (\"$newmanager\",\"$newpassword\")";
                  mysqli_query($conexion,$addmanager);
              }
              if (isset($_POST['delmanager']) && $_POST['delmanager']!="")
              {
                $deletem= $_POST['delmanager'];
                echo "Ha eliminado $deletem";
                echo "<br>";
                echo "<a href='adminsupervisor.php'> Actualizar Registros </a> ";
                $elimsupreme= "DELETE FROM supervisor WHERE usuario='$deletem'";
                $resp=mysqli_query($conexion, $elimsupreme);
              }
              if ((isset($_POST['oldmanager']) && $_POST['oldmanager']!="") && (isset($_POST['manager']) && $_POST['manager']!=""))
              {
                $oldmanager= $_POST['oldmanager'];
                $manager= $_POST['manager'];
                  echo "Ha cambiado $oldmanager por $manager";
                  echo "<br>";
                  echo "<a href='adminsupervisor.php'> Actualizar Registros </a> ";
                  $sql="UPDATE supervisor SET usuario='$manager' WHERE usuario='$oldmanager'";
                  mysqli_query($conexion,$sql);
              }
              if ((isset($_POST['oldpassword']) && $_POST['oldpassword']!="") && (isset($_POST['newkey']) && $_POST['newkey']!=""))
              {
                $oldpassword= $_POST['oldpassword'];
                $newkey= $_POST['newkey'];
                  echo "Ha cambiado la contraseña del usuario $oldpassword exitosamente";
                  echo "<br>";
                  echo "<a href='adminsupervisor.php'> Actualizar Registros </a> ";
                  $sql2="UPDATE supervisor SET contraseña='$newkey' WHERE usuario='$oldpassword'";
                  mysqli_query($conexion,$sql2);




              }


              }

?>
