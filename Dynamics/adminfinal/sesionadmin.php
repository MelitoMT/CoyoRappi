<?php
echo '<link rel="stylesheet" href="../../Style/rappi.css">';
session_name("Administrador");
session_start();
echo "Bienvenido Administrador:<br>";
echo "Dé click en el módulo que desea consultar";
echo '
<ul>
    <li><a id="adm" href="adminlugar.php">Consultar Lugares de Entrega</a></li>
    <li><a id="adm" href="adminalimento.php">Consultar Alimentos</a></li>
    <li><a id="adm" href="totaladmin.php">Consultar Usuarios</a></li>
    <li><a id="adm" href="adminsupervisor.php">Consultar Supervisores</a></li>
    <br><br><br>
    <a href="cerraradmin.php">Cerrar la sesion</a>
</ul>
';
?>
