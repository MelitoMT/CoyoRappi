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
    echo"<br>";
        /* Si ya especifico qué cliente es llega a este condicional */
        if(isset($_POST['tipo']) && $_POST['tipo']!='' ){
            /* Si no es alumno es trbajador o profe/funcionario */
            if(isset($_POST['tipo']) && $_POST['tipo']!='alumno'){
                if(isset($_POST['tipo']) && $_POST['tipo']!='trabajador'){
                    /* INSERTE REGISTRO DE PROFE Y FUNCIONARIO */
                    echo"<form method='POST' action='../Templates/CoyoRappi.html'>
                    <label>Nombre<label>
                    <br>          
                    <input type='text' value='' name='Nombre'><br>
                    <label>Colegio<label>
                    <br>  
                    <input type='text' value='' name='Colegio'><br>
                    <label>RFC<label>
                    <br>  
                    <input type='password' value='' name='RFC'><br>
                    <label>Contraseña<label>
                    <br>  
                    <input type='password' value='' name='Contraseña'><br>
                    <label>Confirmar contraseña<label>
                    <br>  
                    <input type='password' value='' name='Contraseña2'><br><br>
                    <input type='submit' name='enviar' value='Siguiente' class='submit'><br>
                    </form>";
                }
                /* Si no es profe es trabajador */
                else{
                    /* INSERTE REGISTRO DE TRABAJADOR */
                    echo"<form method='POST' action='../Templates/CoyoRappi.html'>
                    <label>Nombre<label>
                    <br> 
                    <input type='text' value=''>
                    <br>
                    <label>No. de Trabajador<label>
                    <br> 
                    <input type='password' value=''>
                    <br>
                    <label>Contraseña<label>
                    <br>  
                    <input type='password' value='' name='Contraseña'>
                    <br>
                    <label>Confirmar contraseña<label>
                    <br>  
                    <input type='password' value='' name='Contraseña2'><br><br>
                    <input type='submit' name='enviar' value='Siguiente'><br>";

                }
            }
            /* Es alumno */
            else{
                /* INSERTE REGISTRO DE ALUMNOS */
                echo"alumno<br>";
                echo"<form method='POST' action='../Templates/CoyoRappi.html'>
                <input type='text' value=''>Nombre<br>
                <input type='text' value=''>Grupo<br>
                <input type='password' value=''>No. cuenta<br>
                <input type='password' value=''>contraseña<br>
                <input type='submit' name='enviar' value='Siguiente'><br>";
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
    echo"</fieldset>";
    }
?>