<?php
    echo '<link rel="stylesheet" href="../Style/rappi.css">';
    echo'<ul>
        <li class="nav"><a class="nav" href="../Templates/CoyoRappi.html">Inicio</a></li>
        <li class="nav"><a class="nav" href="Registro.php">Registrate</a></li>
        <li class="nav"><a class="nav" href="Ingreso.php">Ingresa</a></li>
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
                $contraseña=$_POST['contraseña'];
                $contraseña2=$_POST['contraseña2'];
                $nombre=$_POST['nombre'];
                $usuario=$_POST['usuario'];
                usuario($usuario,$tipo,$n,$conexion);
                echo$n;
                echo"HOLA";
            }
            /* Si no es alumno es trbajador o profe/funcionario */
            if(isset($_POST['tipo']) && $_POST['tipo']!='alumno'){
                if(isset($_POST['tipo']) && $_POST['tipo']!='trabajador'){
                    /* INSERTE REGISTRO DE PROFE Y FUNCIONARIO */
                    echo"<form method='POST' action='Registro.php'>
                    <label>Nombre<label>
                    <br>
                    <input type='text' value='' name='Nombre' required><br>
                    <label>Colegio<label>
                    <br>
                    <input type='text' value='' name='Colegio' required><br>
                    <label>RFC<label>
                    <br>
                    <input type='password' value='' name='RFC' required><br>
                    <label>Contraseña<label>
                    <br>
                    <input type='password' value='' name='Contraseña' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-\/:-@\[-`{-~])([A-Za-z\d!-\/:-@\[-`{-~]|[^ ]){10,15}$' title='Se requiere una contraseña segura menor o igual a 15 carácteres' required><br>
                    <label>Confirmar contraseña<label>
                    <br>
                    <input type='password' value='' name='Contraseña2' required><br><br>
                    <input type='hidden' name='tipo' value=".$_POST['tipo'].">
                    <input type='submit' name='Siguiente' value='Siguiente' class='submit'><br>
                    </form>";
                }
                /* Si no es profe es trabajador */
                else{
                    /* INSERTE REGISTRO DE TRABAJADOR */
                    echo"<form method='POST' action='Registro.php'>
                    <label>Nombre<label>
                    <br>
                    <input type='text' value='' name='Nombre' required><br>
                    <br>
                    <label>No. de Trabajador<label>
                    <br>
                    <input type='password' value='' required>
                    <br>
                    <label>Contraseña<label>
                    <br>
                    <input type='password' value='' name='Contraseña' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-\/:-@\[-`{-~])([A-Za-z\d!-\/:-@\[-`{-~]|[^ ]){10,15}$' title='Se requiere una contraseña segura menor o igual a 15 carácteres' required>
                    <br>
                    <label>Confirmar contraseña<label>
                    <br>
                    <input type='password' value='' name='Contraseña2' required><br><br>
                    <input type='hidden' name='tipo' value=".$_POST['tipo'].">
                    <input type='submit' name='Siguiente' value='Siguiente' class='submit'><br>";

                }
            }
            /* Es alumno */
            else{
                /* INSERTE REGISTRO DE ALUMNOS */
                echo"<form method='POST' action='Regsitro.php'>
                <label>Nombre<label>
                <br>
                <input type='text' value='' required>
                <br>
                <label>Grupo<label>
                <br>
                <input type='text' value='' required>
                <br>
                <label>No. de Cuenta<label>
                <br>
                <input type='password' value='' required>
                <br>
                <label>Contraseña<label>
                <br>
                <input type='password' value='' name='Contraseña' pattern='^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!-\/:-@\[-`{-~])([A-Za-z\d!-\/:-@\[-`{-~]|[^ ]){10,15}$' title='Se requiere una contraseña segura menor o igual a 15 carácteres'>
                <br>
                <label>Confirmar contraseña<label>
                <br>
                <input type='password' value='' name='Contraseña2' required><br><br>
                <input type='hidden' name='tipo' value=".$_POST['tipo'].">
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
                    <option value='profesor'> Profesor </option>
                    <option value='funcionario'> Funcionario </option>
                    <option value='trabajador'> Trabajador </option>
                </select>
                <br>
                <br>
                <input type='submit' name='Aceptar' value='Aceptar' class='submit'>
                </form>";
        }
    echo"</fieldset>";

?>
