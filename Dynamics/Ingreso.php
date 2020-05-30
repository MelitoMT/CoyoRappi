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

  define("HASH", "sha256");
  define("PASSWORD","Secure password, plz make ec¿veryth!ng s3cUr3");
  define("METHOD","aes-128-cbc");

  function Cifrar($contra){

    $key= openssl_digest(PASSWORD,HASH);
    $iv_len= openssl_cipher_iv_length(METHOD);
    $iv= openssl_random_pseudo_bytes($iv_len);

    $ContraCifrada= openssl_encrypt(
      $contra,
      METHOD,
      $key,
      OPENSSL_RAW_DATA,
      $iv
    );

    $ciffWIv=base64_encode($iv.$ContraCifrada);

    return $ciffWIv;
  }


  if (isset($_SESSION['usuario']) && (isset($_SESSION['contrasenia'])))
  {
    /* AQUIIIIIIIIIIIIIIIIIIIIIIIIIII */
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

                  $mensaje= $_SESSION['contrasenia'];
                  $ciff= Cifrar($mensaje);
                  echo "Contraseña cifrada: ". $ciff."<br>";
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
                                    //La usuario cubre lo requerido";
                                    $_SESSION['usuario']=$_POST['numCuenta'];

                                        if (preg_match('/\w{10}/',$alumno)) {
                                          //La contraseña tiene 10 digitos
                                          $_SESSION['contrasenia']=$_POST['alumno'];
                                            header('Location: Ingreso.php');
                                      }
                                      echo "La contraseña no es correcta";
                                  }
                                  else { echo "El usuario no es correcto"; }
                              }
                              //-------------------
                              elseif (isset($_POST['trabajador']) && $_POST['trabajador']!=""
                                &&(isset($_POST['numTrabajador']) && $_POST['numTrabajador']!=""))
                                {
                                  $numTrabajador=strip_tags($_POST['numTrabajador']);
                                  $trabajador=strip_tags($_POST['trabajador']);
                                  //$trabajador=$_POST['trabajador'];
                                  //$numTrabajador=$_POST['numTrabajador'];

                                  if (preg_match('/\d{9}/',$numTrabajador))
                                    {
                                      //La usuario cubre lo requerido";
                                      $_SESSION['usuario']=$_POST['numTrabajador'];
                                          if (preg_match('/\w{10}/',$numTrabajador))
                                          {
                                            //La contraseña tiene 10 digitos
                                            $_SESSION['contrasenia']=$_POST['trabajador'];
                                              header('Location: Ingreso.php');
                                           }
                                          echo "La contraseña no es correcta";
                                    }
                                    else { echo "El usuario no es correcto"; }
                                }
                                //-------------------

                                elseif (isset($_POST['administrador']) && $_POST['administrador']!=""
                                  &&(isset($_POST['AdmiContra']) && $_POST['AdmiContra']!=""))
                                  {
                                    $administrador=strip_tags($_POST['administrador']);
                                    $AdmiContra=strip_tags($_POST['AdmiContra']);
                                    //$administrador=$_POST['administrador'];
                                    //$AdmiContra=$_POST['AdmiContra'];

                                    if (preg_match('/\w{10}/',$administrador))
                                      {
                                        //La usuario cubre lo requerido";
                                        $_SESSION['usuario']=$_POST['administrador'];

                                                if (preg_match('/\w{10}/',$AdmiContra)) {
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
                                        //$supervisor=$_POST['supervisor'];
                                        //$SuperContra=$_POST['SuperContra'];

                                        if (preg_match('/\w{10}/',$supervisor))
                                          {
                                            //La usuario cubre lo requerido
                                            $_SESSION['usuario']=$_POST['supervisor'];
                                                      if (preg_match('/\w{10}/',$SuperContra)) {
                                                        //La contraseña tiene 10 digitos
                                                        $_SESSION['contrasenia']=$_POST['SuperContra'];
                                                          header('Location: Ingreso.php');
                                                    }
                                                    echo "La contraseña no es correcta";
                                          }
                                          else { echo "El usuario no es correcto"; }
                                      }

                                      //--------------
                                              elseif (isset($_POST['ProfeFunci']) && $_POST['ProfeFunci']!=""
                                                &&(isset($_POST['ProfeFunciContra']) && $_POST['ProfeFunciContra']!=""))
                                                {
                                                  $ProfeFunci=strip_tags($_POST['ProfeFunci']);
                                                  $ProfeFunciContra=strip_tags($_POST['ProfeFunciContra']);
                                                  //$ProfeFunci=$_POST['ProfeFunci'];
                                                  //$ProfeFunciContra=$_POST['ProfeFunciContra'];

                                                  if (preg_match('/\w{10}/',$ProfeFunci))
                                                    {
                                                      //La usuario cubre lo requerido";
                                                      $_SESSION['usuario']=$_POST['ProfeFunci'];
                                                              if (preg_match('/\w{10}/',$numCuenta)) {
                                                                //La contraseña tiene 10 digitos
                                                                $_SESSION['contrasenia']=$_POST['ProfeFunciContra'];
                                                                  header('Location: Ingreso.php');
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
                              <input type="password" name="alumno" placeholder="Mínimo 10 caracteres" minlenght="10"/>
                              <input type="submit" value="Iniciar sesion" name="Inicio" class="submit">
                              </form>';
                        }

                        elseif ($tipo =='Trabajador')
                        {
                          echo '
                              <form action="Ingreso.php" method="POST">
                              <label> Ingrese su numero de trabajador</label>
                              <input name="numTrabajador" type=number  pattern="[0-9]{9}">
                              <br>
                              <label> Contraseña</label>
                              <input type="password" name="trabajador" placeholder="Mínimo 10 caracteres" minlenght="10"/>
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
                          <input type="password" name="AdmiContra" placeholder="Mínimo 10 caracteres" minlenght="10"/>
                          <input type="submit" value="Ingresar" name="Inicio" class="submit">';
                        }
                        elseif ($tipo=='Supervisor')
                        {
                          echo '
                          <form action="Ingreso.php" method="POST">
                          <label> Usuario </label>
                          <input type=number name="supervisor">
                          Contraseña:
                          <input type="password" name="SuperContra" placeholder="Mínimo 10 caracteres" minlenght="10"/>
                          <input type="submit" value="Ingresar" name="Inicio" class="submit">
                          </form>';
                        }
                        elseif ($tipo =='Profesor'||'Funcionario')
                        {
                        echo '
                              <form action="Ingreso.php" method="POST">
                              <label> Ingrese su numero RFC</label>
                              <input type=text pattern="^[A-Z]{4}[0-9]{2}((0)[0-9]|((1)[0-2]))(([0-2][0-9]|(3)[0-1]))\w{3}"
                              name="ProfeFunci">

                              <br>
                              <label> Contraseña</label>
                              <input type="password" name="ProfeFunciContra" placeholder="Mínimo 10 caracteres" minlenght="10"/>
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
                      <br>
                      <br>
                      <input type="submit" value="Selecciona" class="submit">
                      </form>
                      ';
                    }
                  }
              }

echo "<br><br>";

      /*
      Se ppodría alida$a=[];
      $b=[];
      $c=[];

      $n=$_POST['name'];
      $p=$_POST['lnf'];
      $m=$_POST['lnm'];


      $N=strtoupper($n);
      $P=strtoupper($p);
      $M=strtoupper($m);

      echo "$N $P $M";

      $subN= substr($N,0, 1);
      $subP= substr($P,0, 2);
      $subM= substr($M,0, 1);

      echo "<br>";
      echo "$subP$subM$subN";
      */


      /*
  $conexion = mysqli_connect(”localhost”, “usuario”, “contraseña”, “nombre de la base”);
  $conexion = mysqli_connect(”localhost”, “root”, “”, “prueba”);
      */
   ?>
