<?php
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
    <input type="submit" value="Iniciar Sesion">
</form>
';
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

      if (isset($_POST['tipo']) && $_POST['tipo']!="")
      {
        $tipo= $_POST['tipo'];
        echo $tipo."<br>";

          if ($tipo =='Alumno')
          {
            echo '
                <form action= "Pedidos.php"  method="POST">
                <label> Ingrese su numero de cuenta</label>
                 <input type="number" name="nc"  placeholder="Escribe tu numero de cuenta"  pattern= "[0-9]{9}" title="Tiene que tener 9 dígitos." value="" > "^\d{10}"
               <br>
                <label> Contrasenia</label>
                <input type="password" name="contrasenia" placeholder="Mínimo 10 caracteres" minlenght="10"/>

                <input type="submit" value="Hacer Pedido">
                </form>
            ';
          }

          elseif ($tipo =='Trabajador')
          {
            echo '
                <form action="Pedidos.php" method="POST">
                <label> Ingrese su numero de trabajador</label>
                <input name="nt" type=number  pattern="[0-9]{9}">
                <br>
                <label> Contrasenia</label>
                <input type="password" name="contrasenia" placeholder="Mínimo 10 caracteres" minlenght="10"/>
                <input type="submit" value="Hacer Pedido">
                </form>
             ';
          }



          elseif ($tipo =='Profesor'||'Funcionario') {
          echo '
                <form action=Pedidos.php" method="POST">
                <label> Ingrese su numero RFC</label>
                <input type=text pattern="^[A-Z]{4}[0-9]{2}((0)[0-9]|((1)[0-2]))(([0-2][0-9]|(3)[0-1]))\w{3}">
                <br>
                <label> Contrasenia</label>
                <input type="password" name="contrasenia" placeholder="Mínimo 10 caracteres" minlenght="10"/>
                <input type="submit" value="Hacer Pedido">
                </form>
            ';
          }

        }

          /*if ($tipo=='Administrador') {
            echo '
                <form action="Ingreso.php" method="POST">
                <label> Usuario </label>
                <input type=number>
                Contraseña:
                <input type="password" name="contrasenia" placeholder="Mínimo 10 caracteres" minlenght="10"/>
                <input type="submit" value="Ingresar">
            ';
            if ($tipo=='Supervisor') {
              echo '
                  <form action="Ingreso.php" method="POST">
                  <label> Usuario </label>
                  <input type=number>
                  Contraseña:
                  <input type="password" name="contrasenia" placeholder="Mínimo 10 caracteres" minlenght="10"/>
                  <input type="submit" value="Ingresar">
              ';
          }*/


 ?>
