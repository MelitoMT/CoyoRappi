<?php
    define('DB','Coyo_Rappi') ;   
    define('PASSWORD','') ;
    define('USER','root') ;
    define('A','localhost') ;
    $conexion = mysqli_connect(A,USER,PASSWORD, DB);
    if( !$conexion ){
        echo mysqli_connect_error();
        echo mysqli_connect_errno();
        echo"ERROR";
        exit();
    }
?>