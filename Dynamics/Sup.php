<?php
    echo '<link rel="stylesheet" href="../Style/rappi.css">';
    echo'<ul>
        <li class="nav"><a class="nav" href="../Templates/CoyoRappi.html">Inicio</a></li>
        <li class="nav"><a class="nav" href="Registro.php">Registrate</a></li>
        <li class="nav"><a class="nav" href="Ingreso.php">Ingresa</a></li>
        <li class="nav"><a class="nav" href="./Ayuda.html">Ayuda</a></li>
    </ul>';
    echo"<br><br><br>";
    include 'AbrirConex.php';
    $idPedido=0;
    $result="SELECT MAX(id_pedido) FROM pedido";
    $result2=mysqli_query($conexion,$result);
    if($result2 && mysqli_num_rows($result2)>0){
        $id=mysqli_fetch_array($result2,MYSQLI_NUM);
        $idPedido=$id['0'];
    }
    echo"<table id='table'>";
    echo"<tr>";
    echo"<th></th>";
    echo"<th>Cliente</th>";
    echo"<th>Orden</th>";
    echo"<th>Cantidad</th>";
    echo"<th>Lugar de Entrega</th>";
    echo"<th>Estado</th>";
    echo"</tr>";
    for($i=1;$i<=$idPedido;$i++){
        $cliente="SELECT * FROM pedido WHERE estado ='Pendiente' && id_cliente=$i ORDER BY id_pedido";
        $cliente2=mysqli_query($conexion,$cliente);
        $cliente3=mysqli_fetch_array($cliente2,MYSQLI_NUM);
            if($cliente2 && mysqli_num_rows($cliente2)>0){
                echo"<tr>";
                    echo"<td><input type='radio' name='cliente' value='".$cliente3['0']."'></td>";
                    echo"<td>".$cliente3[1]."</td>";
                    echo"<td>";
                        $ida="SELECT id_alimento,cantidad FROM pedido WHERE id_cliente=$i && estado ='Pendiente' ORDER BY id_pedido";
                        $ida2=mysqli_query($conexion,$ida);
                        $ida3=mysqli_fetch_array($ida2,MYSQLI_NUM);   
                        while($ida3=mysqli_fetch_array($ida2)){
                            $alimento="SELECT nombre FROM alimento WHERE id_alimento = $ida3[0]";
                            $alimento2=mysqli_query($conexion,$alimento);
                            $alimento3=mysqli_fetch_array($alimento2,MYSQLI_NUM);
                            echo $alimento3['0']."<br>"; 
                        }
                    echo"<td>";
                        $cant="SELECT cantidad FROM pedido WHERE estado ='Pendiente' && id_cliente=$i  ORDER BY id_pedido";
                        $cant2=mysqli_query($conexion,$cant);
                        $cant3=mysqli_fetch_array($cant2,MYSQLI_NUM);            
                        while($cant3=mysqli_fetch_array($cant2)){
                            echo $cant3[0]."<br>";
                        }    
                    echo"</td>";
                    echo"</td>";
                    $lugar="SELECT nombre FROM lugardeentrega WHERE id_lugar = $cliente3[3]";
                    $lugar2=mysqli_query($conexion,$lugar);
                    $lugar3=mysqli_fetch_array($lugar2,MYSQLI_NUM);
                    echo"<td>".$lugar3['0']."</td>";
                    echo"<td>".$cliente3['6']."</td>";
                echo"</tr>";
                echo "<br>";
            }
    }
    mysqli_close($conexion);
    echo"</table>";
?>