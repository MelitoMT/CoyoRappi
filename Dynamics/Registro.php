<?php
    /* Si ya especifico qué cliente es llega a este condicional */
    if(isset($_POST['registro']) && $_POST['registro']!='' ){
        /* Si no es alumno es trbajador o profe/funcionario */
        if(isset($_POST['tipo']) && $_POST['tipo']!='alumno'){
            if(isset($_POST['tipo']) && $_POST['tipo']!='trabajador'){
                /* INSERTE REGISTRO DE PROFE Y FUNCIONARIO */
                echo"profe/funcionario<br>";
                echo"<form method='POST' action='CoyoRappi.html'>
                <input type='text' value=''>Nombre<br>
                <input type='text' value=''>Colegio<br>
                <input type='password' value=''>RFC<br>
                <input type='password' value=''>Contraseña<br>
                <input type='submit' name='enviar' value='Siguiente'><br>
                </form>";
            }
            /* Si no es profe es trabajador */
            else{
                /* INSERTE REGISTRO DE TRABAJADOR */
                echo"trabajador<br>";
                echo"<form method='POST' action='CoyoRappi.html'>
                <input type='text' value=''>Nombre<br>
                <input type='password' value=''>No. de Trabajador<br>
                <input type='password' value=''>contraseña<br>
                <input type='submit' name='enviar' value='Siguiente'><br>";

            }
        }
        /* Es alumno */
        else{
            /* INSERTE REGISTRO DE ALUMNOS */
            echo"alumno<br>";
            echo"<form method='POST' action='CoyoRappi.html'>
            <input type='text' value=''>Nombre<br>
            <input type='text' value=''>Grupo<br>
            <input type='password' value=''>No. cuenta<br>
            <input type='password' value=''>contraseña<br>
            <input type='submit' name='enviar' value='Siguiente'><br>";
        }
    }
    /* Si no, aparece este formulario */
    else{
    echo"<form action='Registro.php' method='POST'>
        Elija una opción:<br>
        <input type='radio' name='tipo' value='alumno' required>Alumno<br>
        <input type='radio' name='tipo' value='profesor' required>Profesor<br>
        <input type='radio' name='tipo' value='funcionario' required>Funcionario<br>
        <input type='radio' name='tipo' value='trabajador' required>Trabajador<br>
        <input type='hidden' name='registro' value='registro'>
        <input type='submit' name='enviar' value='Siguiente'>
    </form>";
    }
?>