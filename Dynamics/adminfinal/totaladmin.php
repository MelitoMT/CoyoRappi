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
  $idworker= "SELECT * FROM trabajador";
  $worker= mysqli_query($conexion, $idworker);

  $idstudent= "SELECT * FROM alumno";
  $student= mysqli_query($conexion, $idstudent);

  $idteacher= "SELECT * FROM profefuncionario";
  $teacher= mysqli_query($conexion, $idteacher);

       echo '
       <form action="totaladmin.php" method="POST">
           <select name="modificar" required/>
              <option value="">Seleccione un tipo de usuario</option>
              <option value="stdn"> Alumno </option>
              <option value="tchr"> Profesor/Funcionario </option>
              <option value="wkr"> Trabajador </option>
           </select>
           <input type="submit" value="Ir">
       </form>
     ';
 if (isset($_POST['modificar']) && $_POST['modificar']!="")
 {
   $tipo=$_POST['modificar'];
      echo "<table border='1'>";
      echo"<tr>";
      switch($tipo){
        case 'stdn':
              echo"      <th>No. Cuenta</th>";
        break;
       }
       switch($tipo){
         case 'tchr':
               echo"      <th>RFC</th>";
         break;
        }
         switch($tipo){
           case 'wkr':
                 echo"      <th>No. trabajador</th>";
           break;
          }
      echo"      <th>Nombre</th>";
    //  echo"      <th>Contraseña</th>";
      switch($tipo){
        case 'stdn':
            echo"      <th>Grupo</th>";
             break;
            }
      switch($tipo){
        case 'tchr':
         echo"      <th>Colegio</th>";
         break;
          }

        echo"      <th>Estado</th>";
        echo"      <th>Ap Paterno</th>";
        echo"      <th>Ap Materno</th>";
        echo"</tr>";
        switch($tipo){
          case 'stdn':
          while($row=mysqli_fetch_array($student)){
            echo"<tr>";
              echo "     <td>" .$row[0]. "</td>";
              echo "     <td>" .$row[1]. "</td>";
            //  echo "     <td>" .$row[2]. "</td>";
              echo "     <td>" .$row[3]. "</td>";
              echo "     <td>" .$row[4]. "</td>";
              echo "     <td>" .$row[5]. "</td>";
              echo "     <td>" .$row[6]. "</td>";
            echo"</tr>";
              }
              break;
            }
            switch($tipo){
              case 'tchr':
              while($row=mysqli_fetch_array($teacher)){
                echo"<tr>";
                  echo "     <td>" .$row[0]. "</td>";
                  echo "     <td>" .$row[1]. "</td>";
                  //echo "     <td>" .$row[2]. "</td>";
                  echo "     <td>" .$row[3]. "</td>";
                  echo "     <td>" .$row[4]. "</td>";
                  echo "     <td>" .$row[5]. "</td>";
                  echo "     <td>" .$row[6]. "</td>";
                echo"</tr>";
                  }
                  break;
                }
                switch($tipo){
                  case 'wkr':
                  while($row=mysqli_fetch_array($worker)){
                    echo"<tr>";
                      echo "     <td>" .$row[0]. "</td>";
                      echo "     <td>" .$row[1]. "</td>";
                     //  echo "     <td>" .$row[2]. "</td>";
                      echo "     <td>" .$row[3]. "</td>";
                      echo "     <td>" .$row[4]. "</td>";
                      echo "     <td>" .$row[5]. "</td>";
                    echo"</tr>";
                      }
                      break;
                    }
                    echo "</table>";
                    echo "</br>";

                    switch($tipo){
                      case 'stdn':
                      echo '
                      <form action="totaladmin.php" method="POST">
                          <select name="modify" required/>
                             <option value="">Seleccione la acción que desea realizar</option>
                             <option value="addstdn"> Agregar Alumno </option>
                             <option value="upstdgr"> Actualizar Grupo </option>
                             <option value="upstdnst"> Actualizar Estado </option>
                             <option value="upstdnps"> Actualizar Contraseña </option>
                              <option value="delstdn"> Eliminar Alumno </option>
                          </select>
                          <input type="submit" value="Modificar">
                      </form>
                      ';
                          break;
                        }
                        switch($tipo){
                          case 'tchr':
                          echo '
                          <form action="totaladmin.php" method="POST">
                              <select name="modprf" required/>
                                 <option value="">Seleccione la acción que desea realizar</option>
                                 <option value="addtf"> Agregar Profe / Funcionario </option>
                                 <option value="uptfc"> Actualizar Colegio </option>
                                 <option value="uptfst"> Actualizar Estado </option>
                                 <option value="uptfps"> Actualizar Contraseña </option>
                                  <option value="deltf"> Eliminar Profe / Funcionario </option>
                              </select>
                              <input type="submit" value="Modificar">
                          </form>
                          ';
                              break;
                            }

                          switch($tipo){
                            case 'wkr':
                            echo '
                            <form action="totaladmin.php" method="POST">
                                <select name="modw" required/>
                                   <option value="">Seleccione la acción que desea realizar</option>
                                   <option value="addw"> Agregar Trabajador </option>
                                   <option value="upwst"> Actualizar Estado </option>
                                   <option value="upwps"> Actualizar Contraseña </option>
                                    <option value="delw"> Eliminar Trabajador  </option>
                                </select>
                                <input type="submit" value="Modificar">
                            </form>
                            ';
                                break;
                              }
                              }

                        if (isset($_POST['modify']) && $_POST['modify']!="")
                        {
                         $info= $_POST['modify'];
                           switch($info){
                           case 'addstdn':
                            echo '
                                 Inserte la información del nuevo alumno:<br> <br>
                                 <form action="totaladmin.php" method="POST">
                                 <label>Número de Cuenta:</label>
                                 <input type="password" name="newstdncountn" id ="password" placeholder="Máximo 9 caracteres" maxlenght="9" required/><br><br>
                                 <label>Nombre</label>
                                 <input type="text" name="newstdn" required/><br><br>
                                 <label>Contraseña:</label>
                                 <input type="password" name="newpasstdn" id ="password" placeholder="Mínimo 10 caracteres" minlenght="10" required/><br><br>
                                 <label>Grupo:</label>
                                 <input type="numbers" name="newstdngr"><br><br>
                                 <label>Estado:</label>
                                 <select name="stdnstatus" required/>
                                    <option value="">Seleccione el estado </option>
                                    <option value="A">Activo</option>
                                    <option value="I">Inactivo</option>
                                 </select>  <br><br>
                                 <label>Apellido Paterno:</label>
                                 <input type="text" name="newstdnlstf" required/><br><br>
                                 <label>Apellido Materno:</label>
                                 <input type="text" name="newstdnlstm" required/><br><br>
                                 <input type="submit" value="Agregar">
                                 ';
                                break;
                             }
                             switch($info){
                             case 'upstdgr':{
                               echo "<form action='totaladmin.php' method='POST'>";
                               echo   "Seleccione el número de cuenta del alumno que desea actualizar el grupo:";
                               echo  "<select name='oldgroup' required/>";
                               echo  "<option value=''> Seleccione el número de cuenta </option>";
                                 $student2= mysqli_query($conexion, $idstudent);
                                   while($row=mysqli_fetch_array($student2)){
                                       echo "<option value='".$row[0]."'> $row[0]- $row[1] $row[5] $row[6] Grupo:$row[3]";
                                       echo "</option>";
                                       }
                              echo "</select>";
                                echo'
                                 <br>
                                 <br>
                                 <label>Inserte el nuevo grupo</label>
                                 <input type="numbers" name="newgroup"><br><br>
                                 <input type="submit" value="Actualizar Grupo">
                                </form>
                               ';
                                break;
                             }
                           }
                             switch($info){
                             case 'upstdnst':{
                               echo "<form action='totaladmin.php' method='POST'>";
                               echo   "Seleccione el número de cuenta del alumno que desea actualizar el estado:";
                               echo  "<select name='oldstatus' required/>";
                               echo  "<option value=''> Seleccione el número de cuenta </option>";
                                 $student2= mysqli_query($conexion, $idstudent);
                                   while($row=mysqli_fetch_array($student2)){
                                       echo "<option value='".$row[0]."'> $row[0]- $row[1] $row[5] $row[6] Estado:$row[4] ";
                                       echo "</option>";
                                       }
                              echo "</select>";
                                echo'
                                 <br>
                                 <br>
                                 <select name="upstdstatus" required/>
                                    <option value="">Seleccione el estado </option>
                                    <option value="A">Activo</option>
                                    <option value="I">Inactivo</option>
                                 </select> <br> <br>
                                 <input type="submit" value="Actualizar Estado">
                                </form>
                               ';
                                break;
                             }
                           }
                           switch($info){
                           case 'upstdnps':{
                             echo "<form action='totaladmin.php' method='POST'>";
                             echo   "Seleccione el número de cuenta del alumno que desea actualizar la contraseña:";
                             echo  "<select name='oldpasup' required/>";
                             echo  "<option value=''> Seleccione el número de cuenta </option>";
                             $student2= mysqli_query($conexion, $idstudent);
                               while($row=mysqli_fetch_array($student2)){
                                   echo "<option value='".$row[0]."'> $row[0]- $row[1] $row[5] $row[6] ";
                                   echo "</option>";
                                   }
                            echo "</select>";
                            echo'
                             <br>
                             <br>
                             <label>Inserte la nueva contraseña</label>
                             <input type="password" name="stdnpasup" id ="password" placeholder="Mínimo 10 caracteres" minlenght="10" required/><br><br>
                             <input type="submit" value="Actualizar Contraseña">
                            </form>
                           ';
                            break;
                           }
                         }
                           switch($info){
                           case 'delstdn':{
                             echo "<form action='totaladmin.php' method='POST'>";
                             echo   "Seleccione el número de cuenta del alumno que desea eliminar:";
                             echo  "<select name='delforstdn' required/>";
                             echo  "<option value=''> Seleccione el número de cuenta </option>";
                             $student2= mysqli_query($conexion, $idstudent);
                               while($row=mysqli_fetch_array($student2)){
                                   echo "<option value='".$row[0]."'> $row[0]- $row[1] $row[5] $row[6] ";
                                   echo "</option>";
                                   }
                            echo "</select>";
                              echo'
                              <br> <br>
                               <input type="submit" value="Eliminar Alumno">
                              </form>
                             ';
                              break;
                           }
                         }
                       }

                       if (isset($_POST['modprf']) && $_POST['modprf']!="")
                       {
                        $info= $_POST['modprf'];
                          switch($info){
                          case 'addtf':
                           echo '
                                Inserte la información del nuevo Profesor/Funcionario:<br> <br>
                                <form action="totaladmin.php" method="POST">
                                <label>RFC:</label>
                                <input type="password" name="newtfrfc" id ="password" placeholder="Máximo 13 caracteres" maxlenght="13" required/><br><br>
                                <label>Nombre</label>
                                <input type="text" name="newstdn" required/><br><br>
                                <label>Contraseña:</label>
                                <input type="password" name="newpastf" id ="password" placeholder="Mínimo 10 caracteres" minlenght="10" required/><br><br>
                                <label>Colegio:</label>
                                <input type="text" name="newtfcol"><br><br>
                                <label>Estado:</label>
                                <select name="tfnstatus" required/>
                                   <option value="">Seleccione el estado </option>
                                   <option value="A">Activo</option>
                                   <option value="I">Inactivo</option>
                                </select>  <br><br>
                                <label>Apellido Paterno:</label>
                                <input type="text" name="newstdnlstf" required/><br><br>
                                <label>Apellido Materno:</label>
                                <input type="text" name="newstdnlstm" required/><br><br>
                                <input type="submit" value="Agregar">
                                ';
                               break;
                            }
                            switch($info){
                            case 'uptfc':{
                              echo "<form action='totaladmin.php' method='POST'>";
                              echo   "Seleccione el RFC del Profesor/Funcionario que desea actualizar el colegio:";
                              echo  "<select name='oldc' required/>";
                              echo  "<option value=''> Seleccione el RFC </option>";
                                $teacher2= mysqli_query($conexion, $idteacher);
                                  while($row=mysqli_fetch_array($teacher2)){
                                      echo "<option value='".$row[0]."'> $row[0]- $row[1] $row[5] $row[6] Colegio:$row[3]";
                                      echo "</option>";
                                      }
                             echo "</select>";
                               echo'
                                <br>
                                <br>
                                <label>Inserte el nuevo grupo</label>
                                <input type="text" name="newc"><br><br>
                                <input type="submit" value="Actualizar Grupo">
                               </form>
                              ';
                               break;
                            }
                            }
                            switch($info){
                            case 'uptfst':{
                              echo "<form action='totaladmin.php' method='POST'>";
                              echo   "Seleccione el RFC del Profe / Funcionario que desea actualizar el estado:";
                              echo  "<select name='oldtfstat' required/>";
                              echo  "<option value=''> Seleccione el RFC </option>";
                              $teacher2= mysqli_query($conexion, $idteacher);
                                while($row=mysqli_fetch_array($teacher2)){
                                    echo "<option value='".$row[0]."'> $row[0]- $row[1] $row[5] $row[6] Estado:$row[4]";
                                    echo "</option>";
                                    }
                             echo "</select>";
                               echo'
                                <br>
                                <br>
                                <select name="uptfstatus" required/>
                                   <option value="">Seleccione el estado </option>
                                   <option value="A">Activo</option>
                                   <option value="I">Inactivo</option>
                                </select> <br> <br>
                                <input type="submit" value="Actualizar Estado">
                               </form>
                              ';
                               break;
                          }
                        }

                        switch($info){
                        case 'uptfps':{
                          echo "<form action='totaladmin.php' method='POST'>";
                          echo   "Seleccione el RFC del Profe / Funcionario que desea actualizar la contraseña:";
                          echo  "<select name='oldtfpasup' required/>";
                          echo  "<option value=''> Seleccione el RFC </option>";
                          $teacher2= mysqli_query($conexion, $idteacher);
                            while($row=mysqli_fetch_array($teacher2)){
                                echo "<option value='".$row[0]."'> $row[0]- $row[1] $row[5] $row[6] ";
                                echo "</option>";
                                }
                         echo "</select>";
                         echo'
                          <br>
                          <br>
                          <label>Inserte la nueva contraseña</label>
                          <input type="password" name="newtfpasup" id ="password" placeholder="Mínimo 10 caracteres" minlenght="10" required/><br><br>
                          <input type="submit" value="Actualizar Contraseña">
                         </form>
                        ';
                         break;
                        }
                      }
                      switch($info){
                      case 'deltf':{
                        echo "<form action='totaladmin.php' method='POST'>";
                        echo  "Seleccione el RFC del Profe / Funcionario que desea eliminar:";
                        echo  "<select name='delfortf' required/>";
                        echo  "<option value=''> Seleccione el RFC </option>";
                        $teacher2= mysqli_query($conexion, $idteacher);
                          while($row=mysqli_fetch_array($teacher2)){
                              echo "<option value='".$row[0]."'> $row[0]- $row[1] $row[5] $row[6] ";
                              echo "</option>";
                              }
                       echo "</select>";
                         echo'
                         <br> <br>
                          <input type="submit" value="Eliminar Profe / Funcionario ">
                         </form>
                        ';
                         break;
                      }
                    }
                }

                if (isset($_POST['modw']) && $_POST['modw']!="")
                {
                 $info= $_POST['modw'];
                 switch($info){
                 case 'addw':
                  echo '
                       Inserte la información del nuevo Trabajador:<br> <br>
                       <form action="totaladmin.php" method="POST">
                       <label>Número de trabajador:</label>
                       <input type="password" name="workersnum" id ="password" placeholder="Máximo 9 caracteres" maxlenght="9" required/><br><br>
                       <label>Nombre</label>
                       <input type="text" name="newworker" required/><br><br>
                       <label>Contraseña:</label>
                       <input type="password" name="newpasw" id ="password" placeholder="Mínimo 10 caracteres" minlenght="10" required/><br><br>
                       <label>Estado:</label>
                       <select name="wrkstatus" required/>
                          <option value="">Seleccione el estado </option>
                          <option value="A">Activo</option>
                          <option value="I">Inactivo</option>
                       </select>  <br><br>
                       <label>Apellido Paterno:</label>
                       <input type="text" name="newworkerlstf" required/><br><br>
                       <label>Apellido Materno:</label>
                       <input type="text" name="newworkerlstm" required/><br><br>
                       <input type="submit" value="Agregar">
                       ';
                      break;
                   }
                   switch($info){
                   case 'upwst':{
                     echo "<form action='totaladmin.php' method='POST'>";
                     echo   "Seleccione el número de trabajador del  que desea actualizar el estado:";
                     echo  "<select name='oldwrkstatus' required/>";
                     echo  "<option value=''> Seleccione el número de cuenta </option>";
                       $worker2= mysqli_query($conexion, $idworker);
                         while($row=mysqli_fetch_array($worker2)){
                             echo "<option value='".$row[0]."'> $row[0]- $row[1] $row[4] $row[5] Estado:$row[3] ";
                             echo "</option>";
                             }
                     echo "</select>";
                      echo'
                       <br>
                       <br>
                       <select name="newkrstatus" required/>
                          <option value="">Seleccione el estado </option>
                          <option value="A">Activo</option>
                          <option value="I">Inactivo</option>
                       </select> <br> <br>
                       <input type="submit" value="Actualizar Estado">
                      </form>
                     ';
                      break;
                   }
                 }
                 switch($info){
                 case 'upwps':{
                   echo "<form action='totaladmin.php' method='POST'>";
                   echo   "Seleccione el RFC del Profe / Funcionario que desea actualizar la contraseña:";
                   echo  "<select name='oldwrkpas' required/>";
                   echo  "<option value=''> Seleccione el RFC </option>";
                   $worker2= mysqli_query($conexion, $idworker);
                     while($row=mysqli_fetch_array($worker2)){
                         echo "<option value='".$row[0]."'> $row[0]- $row[1] $row[4] $row[5]";
                         echo "</option>";
                         }
                  echo "</select>";
                  echo'
                   <br>
                   <br>
                   <label>Inserte la nueva contraseña</label>
                   <input type="password" name="newwkrpasup" id ="password" placeholder="Mínimo 10 caracteres" minlenght="10" required/><br><br>
                   <input type="submit" value="Actualizar Contraseña">
                  </form>
                 ';
                  break;
                 }
               }
               switch($info){
               case 'delw':{
                 echo "<form action='totaladmin.php' method='POST'>";
                 echo  "Seleccione el numero de Trabajador que desea eliminar:";
                 echo  "<select name='delforwkr' required/>";
                 echo  "<option value=''> Seleccione el número de trabajador</option>";
                 $worker2= mysqli_query($conexion, $idworker);
                   while($row=mysqli_fetch_array($worker2)){
                       echo "<option value='".$row[0]."'> $row[0]- $row[1] $row[4] $row[5]";
                       echo "</option>";
                       }
                echo "</select>";
                  echo'
                  <br> <br>
                   <input type="submit" value="Eliminar Trabajador ">
                  </form>
                 ';
                  break;
               }
              }
            }

                  if (isset($_POST['delforwkr']) && $_POST['delforwkr']!="")
                  {
                    $delforwkr= $_POST['delforwkr'];
                    echo "Ha eliminado al Trabajador con número de trabajador $delforwkr";
                    echo "<br>";
                    echo "<a href='totaladmin.php'> Actualizar Registros </a> ";
                    $delcliente="SELECT id_cliente FROM cliente WHERE usuario='$delforwkr'";
                    $respdelclinete=mysqli_query($conexion,$delcliente);
                    $delcliente3=mysqli_fetch_array($espdelclinete,MYSQLI_NUM);
                    $elimcliente= "DELETE FROM pedido WHERE id_cliente='$delcliente3[0]'";
                    $answer=mysqli_query($conexion,$elimcliente);
                    $deltfcliente= "DELETE FROM cliente WHERE usuario='$delforwkr'";
                    $resp=mysqli_query($conexion,$deltfcliente);
                    $elimtrabajador= "DELETE FROM trabajador WHERE id_ntrabajador='$delforwkr'";
                    $answer=mysqli_query($conexion,$elimtrabajador);
                  }
                if ((isset($_POST['newwkrpasup']) && $_POST['newwkrpasup']!="") && (isset($_POST['oldwrkpas']) && $_POST['oldwrkpas']!=""))
                {
                    $oldwrkpas= $_POST['oldwrkpas'];
                    $newwkrpasup= $_POST['newwkrpasup'];
                    echo "Ha cambiado la contraseña de $oldwrkpas exitosamente";
                    echo "<br>";
                    echo "<a href='totaladmin.php'> Actualizar Registros </a> ";
                    $passwordwkr="UPDATE trabajador SET contraseña='$newwkrpasup' WHERE id_ntrabajador='$oldwrkpas'";
                    mysqli_query($conexion,$passwordwkr);
                   }

                 if ((isset($_POST['oldwrkstatus']) && $_POST['oldwrkstatus']!="") && (isset($_POST['newkrstatus']) && $_POST['newkrstatus']!=""))
                  {
                    $oldwrkstatus= $_POST['oldwrkstatus'];
                    $newkrstatus= $_POST['newkrstatus'];
                    echo "Ha cambiado el estado de $oldwrkstatus a $newkrstatus";
                    echo "<br>";
                    echo "<a href='totaladmin.php'> Actualizar Registros </a> ";
                    $uwkrst="UPDATE trabajador SET estado='$newkrstatus' WHERE id_ntrabajador='$oldwrkstatus'";
                     mysqli_query($conexion,$uwkrst);

                   }
                       if ((isset($_POST['workersnum']) && $_POST['workersnum']!="") && (isset($_POST['newworker']) && $_POST['newworker']!="") && (isset($_POST['newpasw']) && $_POST['newpasw']!=""))
                       {
                         $workersnum= $_POST['workersnum'];
                         $newworker= $_POST['newworker'];
                         $newpasw=$_POST['newpasw'];
                         $wrkstatus= $_POST['wrkstatus'];
                         $newworkerlstf= $_POST['newworkerlstf'];
                         $newworkerlstm= $_POST['newworkerlstm'];
                           echo "Ha agregado al trabajador $newworker $newworkerlstf $newworkerlstm con el número de trabbajador:$workersnum";
                           echo "<br>";
                           echo "<a href='totaladmin.php'> Actualizar Registros </a> ";
                         $addtrab="INSERT INTO trabajador (id_ntrabajador, nombre, contraseña,estado, apaterno, amaterno) VALUES (\"$workersnum\",\"$newworker\",\" $newpasw\", \"$wrkstatus\",\"$newworkerlstf\",\"$newworkerlstm\")";
                           mysqli_query($conexion,$addtrab);
                          }
                      if (isset($_POST['delfortf']) && $_POST['delfortf']!="")
                      {
                        $delfortf= $_POST['delfortf'];
                        echo "Ha eliminado al Profe / Funcionario con RFC: $delfortf";
                        echo "<br>";
                        echo "<a href='totaladmin.php'> Actualizar Registros </a> ";
                        $delcliente="SELECT id_cliente FROM cliente WHERE usuario='$delfortf'";
                        $respdelclinete=mysqli_query($conexion,$delcliente);
                        $delcliente3=mysqli_fetch_array($espdelclinete,MYSQLI_NUM);
                        $elimcliente= "DELETE FROM pedido WHERE id_cliente='$delcliente3[0]'";
                        $answer=mysqli_query($conexion,$elimcliente);
                        $deltfcliente= "DELETE FROM cliente WHERE usuario='$delfortf'";
                        $resp=mysqli_query($conexion,$deltfcliente);
                        $elimalumno= "DELETE FROM profefuncionario WHERE id_rfc='$delfortf'";
                        $answer=mysqli_query($conexion,$elimalumno);
                      }
                     if ((isset($_POST['newtfpasup']) && $_POST['newtfpasup']!="") && (isset($_POST['oldtfpasup']) && $_POST['oldtfpasup']!=""))
                        {
                         $oldtfpasup= $_POST['oldtfpasup'];
                         $newtfpasup= $_POST['newtfpasup'];
                         echo "Ha cambiado la contraseña de $oldtfpasup exitosamente";
                         echo "<br>";
                         echo "<a href='totaladmin.php'> Actualizar Registros </a> ";
                         $passwordpf="UPDATE profefuncionario SET contraseña='$newtfpasup' WHERE id_rfc='$oldtfpasup'";
                         mysqli_query($conexion,$passwordpf);
                        }

                        if ((isset($_POST['oldtfstat']) && $_POST['oldtfstat']!="") && (isset($_POST['uptfstatus']) && $_POST['uptfstatus']!=""))
                         {
                           $oldtfstat= $_POST['oldtfstat'];
                           $uptfstatus= $_POST['uptfstatus'];
                           echo "Ha cambiado el estado de $oldtfstat a $uptfstatus";
                           echo "<br>";
                           echo "<a href='totaladmin.php'> Actualizar Registros </a> ";
                           $sql2="UPDATE profefuncionario SET estado='$uptfstatus' WHERE id_rfc='$oldtfstat'";
                            mysqli_query($conexion,$sql2);
                          }

                        if ((isset($_POST['oldc']) && $_POST['oldc']!="") && (isset($_POST['newc']) && $_POST['newc']!=""))
                        {
                          $oldc= $_POST['oldc'];
                          $newc= $_POST['newc'];
                          echo "Ha cambiado el colegio de $oldc a $newc";
                          echo "<br>";
                          echo "<a href='totaladmin.php'> Actualizar Registros </a> ";
                          $chcollege="UPDATE profefuncionario SET colegio='$newc' WHERE id_rfc='$oldc'";
                          mysqli_query($conexion,$chcollege);
                        }
                        if ((isset($_POST['newtfrfc']) && $_POST['newtfrfc']!="") && (isset($_POST['newstdn']) && $_POST['newstdn']!="") && (isset($_POST['newpastf']) && $_POST['newpastf']!=""))
                        {
                          $newtfrfc= $_POST['newtfrfc'];
                          $newstdn= $_POST['newstdn'];
                          $newpastf=$_POST['newpastf'];
                          $newtfcol= $_POST['newtfcol'];
                          $tfnstatus= $_POST['tfnstatus'];
                          $newstdnlstf= $_POST['newstdnlstf'];
                          $newstdnlstm= $_POST['newstdnlstm'];
                            echo "Ha agregado al profesor/funcionario  $newstdn $newstdnlstf $newstdnlstm con RFC  $newtfrfc del colegio $newtfcol";
                            echo "<br>";
                            echo "<a href='totaladmin.php'> Actualizar Registros </a> ";
                          $addprofe="INSERT INTO profefuncionario (id_rfc, nombre, contraseña, colegio, estado, apaterno, amaterno) VALUES (\"$newtfrfc\",\"$newstdn\",\" $newpastf\",  \"$newtfcol\",  \"$tfnstatus\",\"$newstdnlstf\",\"$newstdnlstm\")";
                            mysqli_query($conexion,$addprofe);
                      }
                        if ((isset($_POST['newstdncountn']) && $_POST['newstdncountn']!="") && (isset($_POST['newstdn']) && $_POST['newstdn']!="") && (isset($_POST['newpasstdn']) && $_POST['newpasstdn']!=""))
                      {
                       $newstdncountn= $_POST['newstdncountn'];
                       $newstdn= $_POST['newstdn'];
                       $newpasstdn=$_POST['newpasstdn'];
                       $newstdngr= $_POST['newstdngr'];
                       $stdnstatus= $_POST['stdnstatus'];
                       $newstdnlstf= $_POST['newstdnlstf'];
                       $newstdnlstm= $_POST['newstdnlstm'];
                         echo "Ha agregado al alumno $newstdn $newstdnlstf $newstdnlstm con número de cuenta $newstdncountn del grupo $newstdngr";
                         echo "<br>";
                         echo "<a href='totaladmin.php'> Actualizar Registros </a> ";
                       $addstudent="INSERT INTO alumno (id_ncuenta, nombre, contraseña, grupo, estado, apaterno, amaterno) VALUES (\"$newstdncountn\",\"$newstdn\",\" $newpasstdn\",  $newstdngr,  \"$stdnstatus\",\"$newstdnlstf\",\"$newstdnlstm\")";
                         mysqli_query($conexion,$addstudent);
                     }

                     if ((isset($_POST['oldgroup']) && $_POST['oldgroup']!="") && (isset($_POST['newgroup']) && $_POST['newgroup']!=""))
                     {
                       $oldgroup= $_POST['oldgroup'];
                       $newgroup= $_POST['newgroup'];
                       echo "Ha cambiado el grupo de $oldgroup a $newgroup";
                       echo "<br>";
                       echo "<a href='totaladmin.php'> Actualizar Registros </a> ";
                       $sql="UPDATE alumno SET grupo='$newgroup' WHERE id_ncuenta='$oldgroup'";
                       mysqli_query($conexion,$sql);
                     }
                     if ((isset($_POST['oldstatus']) && $_POST['oldstatus']!="") && (isset($_POST['upstdstatus']) && $_POST['upstdstatus']!=""))
                     {
                       $oldstatus= $_POST['oldstatus'];
                       $upstdstatus= $_POST['upstdstatus'];
                       echo "Ha cambiado el estado de $oldstatus a $upstdstatus";
                       echo "<br>";
                       echo "<a href='totaladmin.php'> Actualizar Registros </a> ";
                       $sql2="UPDATE alumno SET estado='$upstdstatus' WHERE id_ncuenta='$oldstatus'";
                       mysqli_query($conexion,$sql2);

                     }
                     if ((isset($_POST['stdnpasup']) && $_POST['stdnpasup']!="") && (isset($_POST['oldpasup']) && $_POST['oldpasup']!=""))
                     {
                       $oldpasup= $_POST['oldpasup'];
                       $stdnpasup= $_POST['stdnpasup'];
                       echo "Ha cambiado la contraseña de $oldpasup exitosamente";
                       echo "<br>";
                       echo "<a href='totaladmin.php'> Actualizar Registros </a> ";
                       $sql2="UPDATE alumno SET contraseña='$stdnpasup' WHERE id_ncuenta='$oldpasup'";
                       mysqli_query($conexion,$sql2);

                     }
                     if (isset($_POST['delforstdn']) && $_POST['delforstdn']!="")
                     {
                       $delforstdn= $_POST['delforstdn'];
                       echo "Ha eliminado al alumno con número de cuenta:$delforstdn";
                       echo "<br>";
                       echo "<a href='totaladmin.php'> Actualizar Registros </a> ";

                       $delcliente="SELECT id_cliente FROM cliente WHERE usuario='$delforstdn'";
                       $respdelclinete=mysqli_query($conexion,$delcliente);
                       $delcliente3=mysqli_fetch_array($espdelclinete,MYSQLI_NUM);
                       $elimcliente= "DELETE FROM pedido WHERE id_cliente='$delcliente3[0]'";
                       $answer=mysqli_query($conexion,$elimcliente);
                       $dealumncliete= "DELETE FROM cliente WHERE usuario='$delforstdn'";
                       $resp=mysqli_query($conexion,$dealumncliete);
                       $elimalumno= "DELETE FROM alumno WHERE id_ncuenta='$delforstdn'";
                       $answer=mysqli_query($conexion,$elimalumno);
                     }
                   }
?>
