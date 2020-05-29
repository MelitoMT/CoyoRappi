<?php
    $servidor='localhost';
    $bd='círculos matemáticos';
    $usuario='root';
    $contraseña='';
    $conexion=mysqli_connect(".$servidor.",".$contraseña.",".$root.",".$bd.");
    if( !$conexion ){
        echo mysqli_connect_error();
        echo mysqli_connect_errno();
        exit();
    }
?>