<?php
  echo '<link rel="stylesheet" href="../Style/rappi.css">';
  echo'<ul>
      <li class="nav"><a class="nav" href="../Templates/CoyoRappi.html">Inicio</a></li>
      <li class="nav"><a class="nav" href="Registro.php">Registrate</a></li>
      <li class="nav"><a class="nav" href="Ingreso.php">Ingresa</a></li>
      <li class="nav"><a class="nav" href="./Ayuda.html">Ayuda</a></li>
  </ul>';
  echo"<br><br><br>";
  echo"<fieldset>";
  echo'<img src="../Media/LogoCoyo.png" height="200px">';
  echo"<br>";

  session_start();

  function cerrarSesion(){
    session_unset();
    session_destroy();
  }

  include './AbrirConex.php';

  if (isset($_SESSION['usuario']) && (isset($_SESSION['contrasenia'])))
  {
    echo "La sesion de ".$_SESSION['usuario']."  esta activa";
                  if(isset($_POST["close"]))
                  {
                    /*Si el boton de cerrar sesion fue presionado se llama a la funcion homónima
                    y se carga nuevamente la pagina
                    */
                    cerrarSesion();
                    header("Location: Ingreso.php");

                  }
                  echo "<br><br>";
                  echo "<form action='Ingreso.php' method='POST'>";
                  echo "<input type='submit' name='close' value='Cerrar Sesion' class='submit'>";
                  echo "</form>";

                  $contrasenia= $_SESSION['contrasenia'];
  }
  else
  {
                            if (isset($_POST['alumno']) && $_POST['alumno']!=""
                              &&(isset($_POST['numCuenta']) && $_POST['numCuenta']!=""))
                              {

                               $numCuenta=strip_tags($_POST['numCuenta']);
                               $alumno=strip_tags($_POST['alumno']);

                               if (preg_match('/\d{9}/',$numCuenta))
                                  {
                                    //La usuario cubre lo requerido
                                        if (preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/',$alumno))
                                        {
                                          //La contraseña cubre lo requerido
                                          $n=0;
                                          $m=0;
                                          $consulta="SELECT * FROM alumno WHERE id_ncuenta = ".$numCuenta."";
                                          $consulta2=mysqli_query($conexion, $consulta);
                                          if($consulta2 && mysqli_num_rows($consulta2)>0){
                                              $n=1;

                                              echo "El usuario no existe";
                                              }
                                         if($n==1){
                                            $consultaContraseña="SELECT * FROM alumno WHERE contraseña='".$alumno."'";
                                            $consultaContraseña2=mysqli_query($conexion,$consultaContraseña);
                                            print_r($consultaContraseña2);
                                                if ($consultaContraseña2 && mysqli_num_rows($consultaContraseña2)>0){
                                                  $m=1;
                                                  mysqli_close($conexion);
                                                  echo "La contraseña no existe";
                                                }
                                                if($m==1){
                                                  echo "La contraseña esta correcta";

                                                  echo"<br>";
                                                  $_SESSION['usuario']=$_POST['numCuenta'];
                                                  $_SESSION['contrasenia']=$_POST['alumno'];
                                                  header('Location: Ingreso.php');
                                                }
                                           }
                                      }
                                      else {
                                    echo "La contraseña no es correcta";}
                                  }
                                  else { echo "El usuario no es correcto"; }
                          }

                              //-------------------
                              elseif (isset($_POST['trabajador']) && $_POST['trabajador']!=""
                                &&(isset($_POST['numTrabajador']) && $_POST['numTrabajador']!=""))
                                {
                                  $numTrabajador=strip_tags($_POST['numTrabajador']);
                                  $trabajador=strip_tags($_POST['trabajador']);


                                  if (preg_match('/\d{9}/',$numTrabajador))
                                    {
                                      //La usuario cubre lo requerido";
                                          if (preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/',$trabajador))
                                          {
                                            $n=0;
                                            $m=0;
                                            $consulta="SELECT * FROM trabajador WHERE id_ntrabajador = ".$numTrabajador."";
                                            $consulta2=mysqli_query($conexion, $consulta);
                                            if($consulta2 && mysqli_num_rows($consulta2)>0){
                                                $n=1;
                                                echo "El usuario no existe";
                                                }
                                           if($n==1){
                                              $consultaContraseña="SELECT * FROM trabajador WHERE contraseña='".$trabajador."'";
                                              $consultaContraseña2=mysqli_query($conexion,$consultaContraseña);
                                              print_r($consultaContraseña2);
                                                  if ($consultaContraseña2 && mysqli_num_rows($consultaContraseña2)>0){
                                                    $m=1;
                                                    mysqli_close($conexion);
                                                    echo "La contraseña no existe";
                                                  }
                                                  if($m==1){
                                                    echo "La contraseña esta correcta";

                                                    echo"<br>";
                                                    $_SESSION['usuario']=$_POST['numTrabajador'];
                                                    $_SESSION['contrasenia']=$_POST['alumno'];
                                                    header('Location: Ingreso.php');
                                                }
                                             }
                                           }
                                          echo "La contraseña no es correcta";
                                    }
                                    else { echo "El usuario no es correcto"; }
                                }
                                //-------------------

                                /*elseif (isset($_POST['administrador']) && $_POST['administrador']!=""
                                  &&(isset($_POST['AdmiContra']) && $_POST['AdmiContra']!=""))
                                  {
                                    $administrador=strip_tags($_POST['administrador']);
                                    $AdmiContra=strip_tags($_POST['AdmiContra']);

                                    if (preg_match('/\w{10}/',$administrador))
                                      {
                                        //La usuario cubre lo requerido";
                                        $_SESSION['usuario']=$_POST['administrador'];

                                                if (preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/',$AdmiContra)) {
                                                //La contraseña tiene 10 digitos
                                                $_SESSION['contrasenia']=$_POST['AdmiContra'];
                                                  header('Location: Ingreso.php');
                                            }
                                            echo "La contraseña no es correcta";
                                      }
                                      else { echo "El usuario no es correcto"; }
                                  }

                              //---------------------

                                    elseif (isset($_POST['supervisor']) && $_POST['supervisor']!=""
                                      &&(isset($_POST['SuperContra']) && $_POST['SuperContra']!=""))
                                      {
                                        $supervisor=strip_tags($_POST['supervisor']);
                                        $SuperContra=strip_tags($_POST['SuperContra']);


                                        if (preg_match('/\w{10}/',$supervisor))
                                          {
                                            //La usuario cubre lo requerido
                                            $_SESSION['usuario']=$_POST['supervisor'];
                                                      if (preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/',$SuperContra)) {
                                                        //La contraseña tiene 10 digitos
                                                        $_SESSION['contrasenia']=$_POST['SuperContra'];
                                                          header('Location: Ingreso.php');
                                                    }
                                                    echo "La contraseña no es correcta";
                                          }
                                          else { echo "El usuario no es correcto"; }
                                      }*/

                                      //--------------
                                              elseif (isset($_POST['ProfeFunci']) && $_POST['ProfeFunci']!=""
                                                &&(isset($_POST['ProfeFunciContra']) && $_POST['ProfeFunciContra']!=""))
                                                {
                                                  $ProfeFunci=strip_tags($_POST['ProfeFunci']);
                                                  $ProfeFunciContra=strip_tags($_POST['ProfeFunciContra']);

                                                  if (preg_match('/[A-Z]{4}[0-9]{2}((0)[0-9]|((1)[0-2]))(([0-2][0-9]|(3)[0-1]))\w{3}/',$ProfeFunci))
                                                    {
                                                      //La usuario cubre lo requerido";
                                                              if (preg_match('/^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$/',$ProfeFunciContra))
                                                              {

                                                                $n=0;
                                                                $m=0;
                                                                $consulta="SELECT * FROM profefuncionario WHERE id_rfc = ".$ProfeFunci."";
                                                                $consulta2=mysqli_query($conexion, $consulta);
                                                                if($consulta2 && mysqli_num_rows($consulta2)>0){
                                                                    $n=1;
                                                                    echo "El usuario no existe";
                                                                    }
                                                               if($n==1){
                                                                  $consultaContraseña="SELECT * FROM alumno WHERE contraseña='".$ProfeFunci."'";
                                                                  $consultaContraseña2=mysqli_query($conexion,$consultaContraseña);
                                                                  print_r($consultaContraseña2);
                                                                      if ($consultaContraseña2 && mysqli_num_rows($consultaContraseña2)>0){
                                                                        $m=1;
                                                                        mysqli_close($conexion);
                                                                        echo "La contraseña no existe";
                                                                      }
                                                                      if($m==1){
                                                                        echo "La contraseña esta correcta";

                                                                        echo"<br>";
                                                                        $_SESSION['usuario']=$_POST['ProfeFunci'];
                                                                        $_SESSION['contrasenia']=$_POST['ProfeFunciContra'];
                                                                        header('Location: Ingreso.php');
                                                                      }
                                                                 }
                                                              }
                                                          echo "La contraseña no es correcta";
                                                    }
                                                    else { echo "El usuario no es correcto"; }
                                                }
  /*+++++++++++++++++++++++++++++++++++++++++++++++*/

                else
                {
                    if (isset($_POST['tipo']))
                    {
                      $tipo= $_POST['tipo'];
                      echo $tipo."<br>";

                        if ($tipo =='Alumno')
                        {
                          echo '
                              <form action= "Ingreso.php"  method="POST">
                              <label> Ingrese su numero de cuenta</label>
                               <input type="number" name="numCuenta"   pattern= "\d{10}" title="Tiene que tener 9 dígitos." value="" >
                             <br>
                              <label> Contraseña</label>
                              <input type="password" name="alumno" pattern="^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$)">
                              <input type="submit" value="Iniciar sesion" name="Inicio" class="submit">
                              </form>';
                        }

                        /*elseif ($tipo =='Trabajador')
                        {
                          echo '
                              <form action="Ingreso.php" method="POST">
                              <label> Ingrese su numero de trabajador</label>
                              <input name="numTrabajador" type=number  pattern="[0-9]{9}">
                              <br>
                              <label> Contraseña</label>
                              <input type="password" name="trabajador" pattern="^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$"/>
                              <input type="submit" value="Iniciar Sesion" name="Inicio" class="submit">
                              </form>';
                        }

                        elseif ($tipo=='Administrador')
                        {
                          echo '
                          <form action="Ingreso.php" method="POST">
                          <label> Usuario </label>
                          <input type=text name="administrador">
                          Contraseña:
                          <input type="password" name="AdmiContra" pattern="^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$"/>
                          <input type="submit" value="Ingresar" name="Inicio" class="submit">';
                        }
                        elseif ($tipo=='Supervisor')
                        {
                          echo '
                          <form action="Ingreso.php" method="POST">
                          <label> Usuario </label>
                          <input type=number name="supervisor">
                          Contraseña:
                          <input type="password" name="SuperContra" pattern="^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$"/>
                          <input type="submit" value="Ingresar" name="Inicio" class="submit">
                          </form>';
                        }*/
                        elseif ($tipo =='Profesor'||'Funcionario')
                        {
                        echo '
                              <form action="Ingreso.php" method="POST">
                              <label> Ingrese su numero RFC</label>
                              <input type=text pattern="^[A-Z]{4}[0-9]{2}((0)[0-9]|((1)[0-2]))(([0-2][0-9]|(3)[0-1]))\w{3}"
                              name="ProfeFunci">

                              <br>
                              <label> Contraseña</label>
                              <input type="password" name="ProfeFunciContra" pattern="^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{8,16}$"/>
                              <input type="submit" value="Iniciar Sesion" name="Inicio" class="submit">
                              </form>';

                        }
                    }
                    else {
                      //Si no se envio el tipo de Usuario
                      echo '
                      <form action="Ingreso.php" method="POST">
                      Ingrese tipo de Usuario:
                      <select name="tipo" required/>
                      <option value="Alumno"> Alumno </option>
                      <option value="Profesor"> Profesor </option>
                      <option value="Funcionario"> Funcionario </option>
                      <option value="Trabajador"> Trabajador </option>
                      <option value="Administrador"> Administrador </option>
                      <option value="Supervisor"> Supervisor </option>
                      </select>
                      <input type="submit" value="Selecciona" class="submit">
                      </form>
                      ';
                    }
                  }
              }

echo "<br><br>";
   ?>
