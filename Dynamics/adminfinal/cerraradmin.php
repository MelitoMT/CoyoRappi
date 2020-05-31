<?php
    session_name("Administrador");
    session_start();
    session_unset();
    session_destroy();
    header("Location:../../Templates/CoyoRappi.html");
?>
