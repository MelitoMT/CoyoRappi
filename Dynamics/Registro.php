<?php
    echo '<link rel="stylesheet" href="../Style/rappi.css">';
    echo'<ul>
        <li class="nav"><a class="nav" href="../Templates/CoyoRappi.html">Inicio</a></li>
        <li class="nav"><a class="nav" href="./Registro.php">Registrate</a></li>
        <li class="nav"><a class="nav" href="./Ingreso.php">Ingresa</a></li>
        <li class="nav"><a class="nav" href="../Templates/Ayuda.html">Ayuda</a></li>
    </ul>';
    echo"<br><br><br>";
    echo"<fieldset>";
    echo'<img src="../Media/LogoCoyo.png" height="200px">';
    echo"<br>";
        /* Si ya especifico qué cliente es llega a este condicional */
        if(isset($_POST['tipo']) && $_POST['tipo']!='' ){
            if(isset($_POST['Siguiente'])){
                include './AbrirConex.php';
                include 'functions.php';
                $contraseña=strip_tags($_POST['Contraseña']);
                $contraseña2=strip_tags($_POST['Contraseña2']);
                
                if($contraseña==$contraseña2){

                    $nombre=strip_tags($_POST['Nombre']);
                    $apaterno=strip_tags($_POST['Apaterno']);
                    $amaterno=strip_tags($_POST['Amaterno']);
                    $usuario=strip_tags($_POST['Usuario']);
                    $tipo=$_POST['tipo'];
                    $atributo='';
                    $dato='';
                    $cifrado=password_hash($contraseña,PASSWORD_BCRYPT);
                    if(isset($_POST['Colegio']))
                    $colegio=$_POST['Colegio'];
                    if(isset($_POST['Grupo']) && $_POST['Grupo']!='')
                    $grupo=strip_tags($_POST['Grupo']);
                    switch ($tipo){
                        case 'alumno':
                            $atributo='id_ncuenta';
                            $dato='Número de Cuenta';
                            break;
                        case 'trabajador':
                            $atributo='id_ntrabajador';
                            $dato='Número de Trabajador';
                            break;
                        case 'profefuncionario':
                            $atributo='id_rfc';
                            $dato='RFC';
                            break;
                    }
                    $n=0;
                    $consulta="SELECT * FROM ".$tipo." WHERE ".$atributo."=".$usuario."";
                    $consulta=mysqli_query($conexion, $consulta);
                    if($consulta && mysqli_num_rows($consulta)>0){
                        $n=1;
                    }
                    if($n==1){
                        mysqli_close($conexion);
                        echo"Ese ".$dato." ya está registrado, inicie sesión o ingrese uno válido.";
                        echo"<br>";
                        echo"<a href='./Ingreso.php'>Iniciar Sesión</a>";
                    }
                    else{
                        switch ($tipo){
                            case 'alumno':
                                $insert="INSERT INTO `alumno` (`id_ncuenta`, `nombre`, `contraseña`, `grupo`, `estado`, `apaterno`, `amaterno`) VALUES ('$usuario', '$nombre', '$cifrado', '$grupo', 'A', '$apaterno', '$amaterno');";
                                mysqli_query($conexion, $insert);
                                break;
                            case 'trabajador':
                                $insert="INSERT INTO `trabajador` (`id_ntrabajador`, `nombre`, `contraseña`, `estado`, `apaterno`, `amaterno`) VALUES ('$usuario', '$nombre', '$contraseña', 'A', '$apaterno', '$amaterno');";
                                mysqli_query($conexion, $insert);
                                break;
                            case 'profefuncionario':
                                $insert="INSERT INTO `profefuncionario` (`id_rfc`, `nombre`, `contraseña`, `colegio`, `estado`, `apaterno`, `amaterno`) VALUES ('$usuario', '$nombre', '$contraseña', '$colegio', 'A', '$apaterno', '$amaterno');";
                                mysqli_query($conexion, $insert);
                                break;
                        }
                        mysqli_close($conexion);
                        echo"Se ha registrado correctamente, inicie sesión para continuar";
                        echo"<br>";
                        echo"<a href='./Ingreso.php'>Iniciar Sesión</a>";
                    }
                }
                else{
                    echo"Las contraseñas no coinciden";
                }
            }
            /* Si no es alumno es trbajador o profe/funcionario */
            if(isset($_POST['tipo']) && $_POST['tipo']!='alumno'){
                if(isset($_POST['tipo']) && $_POST['tipo']!='trabajador'){
                    /* INSERTE REGISTRO DE PROFE Y FUNCIONARIO */
                    echo"<form method='POST' action='./Registro.php'>
                    <label>Nombre<label>
                    <br>
                    <input type='text' value='' name='Nombre' required
                    pattern='(([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ ]{2,20}){2})|([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ]{2,20})'
                    title='Entre 2-20 caracteres, puedes usar acentos'>

                    <br>
                    <label>Apellido Paterno<label>
                    <br>
                    <input type='text' value='' name='Apaterno' required
                    pattern='(([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ ]{2,20}){2})|([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ]{2,20})'
                    title='Entre 2-20 caracteres, puedes usar acentos'>
                    <br>
                    <label>Apellido Materno<label>
                    <br>
                    <input type='text' value='' name='Amaterno' required
                    pattern='(([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ ]{2,20}){2})|([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ]{2,20})'
                    title='Entre 2-20 caracteres, puedes usar acentos'>
                    <br>
                    <label>Colegio<label>
                    <br>

                    <select name='Colegio'>

                      <option value='Fisica'>Física</option>
                      <option value='Informatica'> Informática</option>
                      <option value='Matematicas'>Matemáticas</option>

                      <option value='Biologia'> Biología</option>
                      <option value='EduFisica'>Educación Física</option>
                      <option value='Morfologia'>Morfología, Fisiología y Salud</option>

                      <option value='OrientacionEdu'>Orientación Educativa</option>
                      <option value='PsicologiaEHigieneMental'>Psicologia e Higiene Mental</option>
                      <option value='Quimica'>Química</option>

                      <option value='CienciaSociales'>Ciencias Sociales</option>
                      <option value='Geografia'>Geografía</option>
                      <option value='Historia'> Historia</option>

                      <option value='Aleman'> Alemán</option>
                      <option value='ArtesPlasticas'> Artes Plásticas</option>
                      <option value='Danza'>Danza</option>

                      <option value='DibujoModelado'>Dibujo y Modelado</option>
                      <option value='Filosofia'>Filosofía</option>
                      <option value='Frances'>Francés</option>

                      <option value='Ingles'>Inglés</option>
                      <option value='Italiano'>Italiano</option>
                      <option value='LetrasClasicas'>Letras Clásicas</option>

                      <option value='Literatura'>Literatura</option>
                      <option value='Musica'>Música</option>
                      <option value='LetrasClasicas'>Teatro</option>

                      <option value='ETE'>Estudios Técnicos Especializados</option>

                   </select>
                    <br>
                    <label>RFC<label>
                    <br>
                    <input type='password' value='' name='Usuario' pattern='[A-Z]{4}[0-9]{2}((0)[0-9]|((1)[0-2]))(([0-2][0-9]|(3)[0-1]))\w{3}'>
                    <br>
                    <label>Contraseña<label>
                    <br>
                    <input type='password' value='' name='Contraseña' required  pattern='^(?=.{10,}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?\W).*$'
                    title='La contraseña debe tener al menos 10 caracteres, al menos un dígito, al menos una minúscula,
                   al menos una mayúscula y al menos un caracter no alfanumérico.'>
                    <br>
                    <label>Confirmar contraseña<label>
                    <br>
                    <input type='password' value='' name='Contraseña2' required pattern='^(?=.{10,}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?\W).*$'
                    title='La contraseña debe tener al menos 10 caracteres, al menos un dígito, al menos una minúscula,
                   al menos una mayúscula y al menos un caracter no alfanumérico.'>
                    <br><br>
                    <input type='hidden' name='tipo' value='".$_POST['tipo']."'>
                    <input type='submit' name='Siguiente' value='Siguiente' class='submit'><br>
                    </form>";
                }
                /* Si no es profe es trabajador */
                else{
                    /* INSERTE REGISTRO DE TRABAJADOR */
                    echo"<form method='POST' action='./Registro.php'>
                    <label>Nombre<label>
                    <br>
                    <input type='text' value='' name='Nombre' required pattern='(([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ ]{2,20}){2})|([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ]{2,20})'
                     title='Entre 2-20 caracteres, puedes usar acentos>
                    <br>
                    <label>Apellido Paterno<label>
                    <br>
                    <input type='text' value='' name='Apaterno' required pattern='(([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ ]{2,20}){2})|([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ]{2,20})'
                    title='Entre 2-20 caracteres, puedes usar acentos>
                    <br>
                    <label>Apellido Materno<label>
                    <br>
                    <input type='text' value='' name='Amaterno' required pattern='(([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ ]{2,20}){2})|([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ]{2,20})'
                    title='Entre 2-20 caracteres, puedes usar acentos><br>
                    <br>
                    <label>No. de Trabajador<label>
                    <br>
                    <input type='password' value='' name='Usuario' required pattern='\d{9}'><br>
                    <br>
                    <label>Contraseña<label>
                    <br>
                    <input type='password' value='' name='Contraseña' required pattern='^(?=.{10,}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?\W).*$'><br>
                    <br>
                    <label>Confirmar contraseña<label>
                    <br>
                    <input type='password' value='' name='Contraseña2' required='^(?=.{10,}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?\W).*$'>
                    <br><br>
                    <input type='hidden' name='tipo' value='".$_POST['tipo']."'>
                    <input type='submit' name='Siguiente' value='Siguiente' class='submit'><br>";

                }
            }
            /* Es alumno */
            else{
                /* INSERTE REGISTRO DE ALUMNOS */
                echo"<form method='POST' action='./Registro.php'>
                <label>Nombre<label>
                <br>
                <input type='text' value='' name='Nombre' required pattern='(([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ ]{2,20}){2})|([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ]{2,20})'
                title='Entre 2-20 caracteres, puedes usar acentos'>
                <br>
                <br>
                <label>Apellido Paterno<label>
                <br>
                <input type='text' value='' name='Apaterno' required pattern='(([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ ]{2,20}){2})|([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ]{2,20})'
                title='Entre 2-20 caracteres, puedes usar acentos'>
                <br>
                <label>Apellido Materno<label>
                <br>
                <input type='text' value='' name='Amaterno' required pattern='(([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ ]{2,20}){2})|([A-Z][a-zäÄëËïÏöÖüÜáéíóúáéíóúÁÉÍÓÚÂÊÎÔÛâêîôûàèìòùÀÈÌÒÙñ]{2,20})'
                title='Entre 2-20 caracteres, puedes usar acentos'>
                <br>
                <label>Grupo<label>
                <br>
                <input type='text' value='' name='Grupo' pattern='\d{3}'>
                <br>
                <label>No. de Cuenta<label>
                <br>
                <input type='password' value='' name='Usuario' required pattern='\d{9}'><br>
                <br>
                <label>Contraseña<label>
                <br>
                <input type='password' value='' name='Contraseña' required pattern='^(?=.{10,}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?\W).*$'><br>
                <br>
                <label>Confirmar contraseña<label>
                <br>
                <input type='password' value='' name='Contraseña2' required pattern='^(?=.{10,}$)(?=.*?[a-z])(?=.*?[A-Z])(?=.*?[0-9])(?=.*?\W).*$'><br><br>
                <input type='hidden' name='tipo' value='".$_POST['tipo']."'>
                <input type='submit' name='Siguiente' value='Siguiente' class='submit'><br>";
            }
        }
        /* Si no, aparece este formulario */
        else{
            echo"Ingrese tipo de usuario:";
            echo"<br>";
            echo"<br>";
            echo"<form action='Registro.php' method='POST'>
                <select name='tipo' required>
                    <option value='alumno'> Alumno </option>
                    <option value='profefuncionario'> Profesor </option>
                    <option value='profefuncionario'> Funcionario </option>
                    <option value='trabajador'> Trabajador </option>
                </select>
                <br>
                <br>
                <input type='submit' name='Aceptar' value='Aceptar' class='submit'>
                </form>";
        }
    echo"</fieldset>";
?>
