<?php
    /* Verifica que no exista ese usuario */
    function usuario($usuario,$tipo, $n, $conexion,$atributo){
        $consulta="SELECT * FROM ".$tipo." WHERE ".$atributo."=".$usuario."";
        $consulta=mysqli_query($conexion, $consulta);
        if($consulta && mysqli_num_rows($consulta)>0){
            $n=1;
        }
        return $n;
    }
    /* Verifica que las contraseñas coincidan */
    function contraseña($contraseña, $contraseña2, $c){
        $c=0;
        if($contraseña != $contraseña2){
            $c=1;
        }
        return $c;
    }
    function contraseñai($usuario,$contraseña,$tipo,$m){
        include 'AbrirConex.php';

    }
    function insert($n, $c, $Mil_parametros, $tipo){
        if($n==0 && $c==0){
            $insert="INSERT INTO $tipo() VALUES ($Mil_parametros)";
        }
        elseif($c>0){
            echo"Tus contraseñas no coinciden";
        }
        if($n>0){
            echo"Ese número de cuenta ya está registrado";
        }
    }
?>