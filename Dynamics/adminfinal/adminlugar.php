<?php
  echo '<link rel="stylesheet" href="../../Style/rappi.css">';
  echo '
<ul>
    <li><a id="adm" href="adminlugar.php">Consultar Lugares de Entrega</a></li>
    <li><a id="adm" href="adminalimento.php">Consultar Alimentos</a></li>
    <li><a id="adm" href="totaladmin.php">Consultar Usuarios</a></li>
    <li><a id="adm" href="adminsupervisor.php">Consultar Supervisores</a></li>
    <br><br><br>
    <a href="cerraradmin.php">Cerrar la sesion</a>
</ul>
';

  $conexion= mysqli_connect("localhost","root","","Coyo_Rappi");//Recordar que debo cambiar el nombre
if( !$conexion ){
  echo mysqli_connect_error();
  echo mysqli_connect_errno();
  exit();
}
else{
           $idlugar= "SELECT * FROM lugardeentrega";
           $lugar= mysqli_query($conexion, $idlugar);
           echo "<table class='table2'>";
           echo "<tr>";
           echo"      <th>Nombre</th>";
           echo "</tr>";
           while($row=mysqli_fetch_array($lugar)){
             echo"<tr>";
             echo "     <td>" .$row[1]. "</td>";
             echo"</tr>";
           }
          echo "</table>";
          echo "</br>";
          echo '<a href="sesionadmin.php">Regresar </a>';
          echo "</br>";
          echo "</br>";
           echo '
           <form action="adminlugar.php" method="POST">
               <select name="modificar" required/>
                 <option value="">Seleccione la accion que desea realizar</option>
                 <option value="cambl"> Cambiar lugar de entrega </option>
                 <option value="nuevol"> Agregar lugar de entrega </option>
                 <option value="eliml"> Eliminar lugar de entrega </option>
               </select>
               <input type="submit" value="Modificar">
           </form>
           ';
          if (isset($_POST['modificar']) && $_POST['modificar']!="")
          {
           $tipo= $_POST['modificar'];

              if ($tipo =='nuevol')
              {
                 echo '
                 <form action="adminlugar.php" method="POST">
                 <label>Inserte el nuevo lugar:</label>
                 <input type="text" name="nouveau">
                 <input type="submit" value="Agregar">
                 ';
              }
              if ($tipo =='eliml')
              {
                echo "<form action='adminlugar.php' method='POST'>";
                echo  "Seleccione el lugar a eliminar:";
                echo  "<select name='delete' required/>";
                echo  "<option value=''> Seleccione el lugar que desea eliminar </option>";
                  $lugar3= mysqli_query($conexion, $idlugar);
                    while($row=mysqli_fetch_array($lugar3)){
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
              if ($tipo =='cambl')
              {
                echo "<form action='adminlugar.php' method='POST'>";
                echo   "Seleccione el lugar a modificar:";
                echo  "<select name='old' required/>";
                echo  "<option value=''> Seleccione el lugar que desea modificar </option>";
                  $lugar3= mysqli_query($conexion, $idlugar);
                    while($row=mysqli_fetch_array($lugar3)){
                        echo "<option value='".$row[1]."'>" .$row[1].' </option>';
                        }
               echo "</select>";
                 echo'
                  <br>
                  <br>
                  <label>Inserte el nuevo nombre</label>
                  <input type="text" name="newplace">
                  <input type="submit" value="Modificar">
                 </form>
                ';

              }
              }
             if ((isset($_POST['old']) && $_POST['old']!="") && (isset($_POST['newplace']) && $_POST['newplace']!=""))
            {
            $oldplace= $_POST['old'];
            $newplace= $_POST['newplace'];
              echo "Ha cambiado $oldplace por $newplace";
              echo "<br>";
              echo "<a href='adminlugar.php'> Actualizar Registros </a> ";
              $sql="UPDATE lugardeentrega SET nombre='$newplace' WHERE nombre='$oldplace'";
              mysqli_query($conexion,$sql);
          }
          if (isset($_POST['delete']) && $_POST['delete']!="")
          {
             $delete=$_POST['delete'];
            echo "Ha eliminado $delete";
            echo "<br>";
            echo "<a href='adminlugar.php'> Actualizar Registros </a> ";
            $sql="SELECT id_lugar FROM lugardeentrega WHERE nombre='$delete'";
            $sql2=mysqli_query($conexion,$sql);
            $sql3=mysqli_fetch_array($sql2,MYSQLI_NUM);
            $elimalugar= "DELETE FROM pedido WHERE id_lugar='$sql3[0]'";
            $answer=mysqli_query($conexion,$elimalugar);
            $elimsupremelugar= "DELETE FROM lugardeentrega WHERE nombre='$delete'";
            $resp=mysqli_query($conexion,  $elimsupremelugar);

          }
          if (isset($_POST['nouveau']) && $_POST['nouveau']!="")
          {
              $nouveau= $_POST['nouveau'];
              echo "Ha agregado $nouveau";
              echo "<br>";
              echo "<a href='adminlugar.php'> Actualizar Registros </a> ";
              $addlugar="INSERT INTO lugardeentrega (id_lugar,nombre) VALUES (null,\"$nouveau\")";
              mysqli_query($conexion,$addlugar);
          }
          }

?>
