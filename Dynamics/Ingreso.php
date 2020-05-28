<?php
  echo '<link rel="stylesheet" href="../Style/rappi.css">';   
  echo'<ul>
      <li class="nav"><a class="nav" href="../Templates/CoyoRappi.html">Inicio</a></li>
      <li class="nav"><a class="nav" href="Registro.php">Registrate</a></li>
      <li class="nav"><a class="nav" href="Ingreso.php">Ingresa</a></li>
      <li class="nav"><a class="nav" href="#">Ayuda</a></li>
  </ul>';
  echo"<br><br><br>";
  echo"<fieldset>";
  echo'<img src="../Media/LogoCoyo.png" height="200px">';
	if(isset($_POST['adm'])){
		echo '<form action="#" method="POST">
		<label>Usuario</label>
		<br>
		<br>
		<input name="usuario" type="text">
		<br>
		<br>
		<label> Contraseña</label>
		<br>
		<br>
		<input type="password" name="contrasenia">
		<br>
		<br>
		<input type="submit" value="Ingresar" name="Ingresar" class="submit">
		</form>';
	}
	else{	
		if(isset($_POST['sup'])){
			echo '<form action="#" method="POST">
			<label>Usuario</label>
			<br>
			<br>
			<input name="usuario" type="text">
			<br>
			<br>
			<label> Contraseña</label>
			<br>
			<br>
			<input type="password" name="contrasenia">
			<br>
			<br>
			<input type="submit" value="Ingresar" name="Ingresar" class="submit">
			</form>';
		}
		else{
			/* Si ya ingresó tipo */
			if (isset($_POST['tipo']) && $_POST['tipo']!=""){
			$tipo= $_POST['tipo'];
				if ($tipo =='Alumno'){
				echo '<form action= "Pedidos.php"  method="POST">
				<label> Ingrese su numero de cuenta</label>
				<br>
				<br>
				<input type="number" name="nc"  placeholder="Escribe tu numero de cuenta"  pattern= "[0-9]{9}" title="Tiene que tener 9 dígitos." value="" "^\d{10}">
				<br>
				<br>
				<label> Contraseña</label>
				<br>
				<br>
				<input type="password" name="contrasenia" placeholder="Contraseña">
				<br>
				<br>
				<input type="submit" value="Ingresar" name="Ingresar" class="submit">
				</form>';
				}
				elseif ($tipo =='Trabajador'){
				echo '<form action="Pedidos.php" method="POST">
				<label> Ingrese su numero de trabajador</label>
				<br>
				<br>
				<input name="nt" type=number  pattern="[0-9]{9}">
				<br>
				<br>
				<label> Contraseña</label>
				<br>
				<br>
				<input type="password" name="contrasenia" placeholder="Contraseña" >
				<br>
				<br>
				<input type="submit" value="Ingresar" name="Ingresar" class="submit">
				</form>';
				}
				elseif ($tipo =='Profesor'||'Funcionario') {
				echo '<form action=Pedidos.php" method="POST">
				<label> Ingrese su RFC</label>
				<br>
				<br>
				<input type=text pattern="^[A-Z]{4}[0-9]{2}((0)[0-9]|((1)[0-2]))(([0-2][0-9]|(3)[0-1]))\w{3}" placeholder="RFC">
				<br>
				<br>
				<label> Contraseña</label>
				<br>
				<br>
				<input type="password" name="contrasenia" placeholder="Contraseña">
				<br>
				<br>
				<input type="submit" value="Ingresar" name="Ingresar" class="submit">
				</form>';
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

			}
			else{
			/* Es primera vez */
			echo'<form action="Ingreso.php" method="POST">
				Ingrese tipo de Usuario:
				<br><br>
				<select name="tipo" required/>
					<option value="Alumno"> Alumno </option>
					<option value="Profesor"> Profesor </option>
					<option value="Funcionario"> Funcionario </option>
					<option value="Trabajador"> Trabajador </option>
				</select>
				<br>
				<br>
				<input type="submit" name="cliente" value="Aceptar" class="submit">
			</form>';
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
			}
	
		}
	}	
	echo"</fieldset>";	
 ?>
