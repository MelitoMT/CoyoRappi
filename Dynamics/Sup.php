<?php
 /*IMPORTANTE: ESTA VARIABE PERMITE VISUALIZACION, SI SE QUITA POR SEGURIDAD, SE NECESITARA ENVIAR LA VARIABLE INGRESO  DESDE FORMULARIO  */
 $_POST['ingreso']=0;
    echo '<link rel="stylesheet" href="../Style/rappi.css">';
    /* Nav general */
    if(isset($_POST['Cerrar'])){
        session_name("Supervisor");
        session_id("3217411852982");
        session_start();
        session_unset();
        session_destroy();
        header("Location:../Templates/CoyoRappi.html");
    }  
    if(isset($_POST['ingreso'])){
        session_name("Supervisor");
        session_id("3217411852982");
        session_start();
        echo"<br><br><br>";
        echo'<img src="../Media/LogoCoyo.png" height="200px" class="logo">';
        echo"<div class='grid-container'>";
        /* Nav interna */
        echo"<form action='Sup.php' method='POST'>";
            echo"<input type=submit id='nav1' value='Pedidos' name='Pedidos'>";
            echo"<input type=submit id='nav2' value='Alertas' name='Alertas'>";
            echo"<input type=submit id='nav3' value='Cerrar Sesión' name='Cerrar'>";
            echo"<input type=hidden value='ingreso' name='ingreso'>";
        echo"</form>";
        /* Cambia el estado del usuario a 'I' , inactivo */
            if(isset($_POST['Sancionar']) && isset($_POST['tipo'])){
            $tipo=$_POST['tipo'];
            $usuarioname=$_POST['usuarioname'];
            $atributo='';
            switch ($tipo){
                case 'alumno':
                    $atributo='id_ncuenta';
                    break;
                case 'trabajador':
                    $atributo='id_ntrabajador';
                    break;
                case 'profefuncionario':
                    $atributo='id_rfc';
                    break;    
            }
            $sql2="UPDATE ".$tipo." SET estado='I' WHERE ".$atributo."=".$usuarioname."";
            mysqli_query($conexion, $sql2);
            $id_cliente=$_POST['cliente'];
            $sql="UPDATE pedido SET estado='Cancelado' WHERE id_cliente=$id_cliente";
            mysqli_query($conexion, $sql);
            echo "<span class='span'>Se ha sancionado al usuario y cancelado el pedido.</span>";
        }
        /* Segunda vista: Cuando se crea una cookie con el tiempo ingresado, se cambia el estado del pedido a 'Espera' de tal
        forma que si el pedido tiene estado 'Espera' y no cookie quiere decir que expiró, esto diferencia a esos pedidos de los demás sin cookie.*/
        if(isset($_POST['Alertas'])){
                    include 'AbrirConex.php';
                    $count="SELECT * FROM pedido WHERE estado ='Espera'";
                    $count2=mysqli_query($conexion,$count);
                    if(mysqli_num_rows($count2)>0){
                        $alert="SELECT MAX(id_pedido) FROM pedido WHERE estado ='Espera'";
                        $alert2=mysqli_query($conexion,$alert);
                        if(mysqli_num_rows($alert2)>0){
                            $alert3=mysqli_fetch_array($alert2,MYSQLI_NUM);
                            $idP=$alert3['0'];
                        }
                        echo"</form action='Sup.php' method='POST'>";
                            echo"<div class='tablap'>";
                                /* Tabla donde se agrupan los pedidos de un mismo cliente siempre y cuando estén en espera */
                                echo"<table id='table'>";
                                    echo"<tr>";
                                        echo"<th></th>";
                                        echo"<th>Cliente</th>";
                                        echo"<th>Orden</th>";
                                        echo"<th>Cantidad</th>";
                                        echo"<th>Estado</th>";
                                    echo"</tr>";
                                    for($i=1;$i<=$idP;$i++){
                                        $resultado="SELECT * FROM pedido WHERE estado ='Espera' && id_cliente=$i ORDER BY id_pedido";
                                        $resultado2=mysqli_query($conexion,$resultado);
                                        $resultado3=mysqli_fetch_array($resultado2,MYSQLI_NUM);
                                        if($resultado2 && mysqli_num_rows($resultado2)>0){
                                            if(!isset($_COOKIE["".$i.""])){
                                                echo"<tr>";
                                                echo"<td><input type='radio' name='cliente' value='".$resultado3[1]."' required></td>";
                                                echo"<td>".$resultado3[1]."</td>";
                                                echo"<td >";
                                                    $al="SELECT id_alimento,cantidad FROM pedido WHERE id_cliente=$i && estado ='Espera' ORDER BY id_pedido";
                                                    $al2=mysqli_query($conexion,$al);
                                                    while($al3=mysqli_fetch_array($al2,MYSQLI_NUM)){
                                                        $alimento="SELECT nombre FROM alimento WHERE id_alimento = $al3[0]";
                                                        $alimento2=mysqli_query($conexion,$alimento);
                                                        $alimento3=mysqli_fetch_array($alimento2,MYSQLI_NUM);
                                                        echo $alimento3['0']."<br>"; 
                                                    }
                                                echo"</td>";
                                                echo"<td>";
                                                    $cant="SELECT cantidad FROM pedido WHERE estado ='Espera' && id_cliente=$i  ORDER BY id_pedido";
                                                    $cant2=mysqli_query($conexion,$cant);
                                                    while($cant3=mysqli_fetch_array($cant2,MYSQLI_NUM)){
                                                        echo $cant3[0]."<br>";
                                                    }    
                                                echo"</td>";
                                                echo"<td>".$resultado3['6']."</td>";
                                                echo"</tr>";
                                                $usuario="SELECT tipo_usuario,usuario FROM cliente WHERE id_cliente = $resultado3[1]";
                                                $usuario2=mysqli_query($conexion,$usuario);
                                                $usuario3=mysqli_fetch_array($usuario2,MYSQLI_NUM);
                                                $tipo=$usuario3[0];
                                                $usuarioname=$usuario3[1]; 
                                            }
                                        }            
                                    }
                                echo"</table>";
                            echo"</div>";
                            echo"<div id='esperando'>";
                                echo"<input type=submit class='buttons' value='Sancionar' name='Sancionar2'>";
                            echo"</div>";
                            echo"<input type=hidden value='ingreso' name='ingreso'>";
                        echo"</form>";
                    }
            else{
                echo"No hay pedidos vencidos";
            }
        } 
        /* SI no se pide alertas, se despliega el menú principal */
        else{
            include 'AbrirConex.php';
            /* Cambia el estado del pedido a entregado */
            if(isset($_POST['Entregado'])){
                $id_cliente=$_POST['cliente'];
                $sql="UPDATE pedido SET estado='Entregado' WHERE id_cliente=$id_cliente";
                mysqli_query($conexion, $sql);
                echo"<span class='span'>Se ha marcado el pedido como entregado.</span>";
            }
            /* Crea la cookie y pone de estado 'Espera' */
            if(isset($_POST['Esperar'])){
                if(isset($_POST['Tiempo']) && $_POST['Tiempo']!=0){
                    if(isset($_POST['lugar']) && $_POST['lugar']==1){
                        $tiempo=$_POST['Tiempo'];
                        $id_cliente=$_POST['cliente'];
                        setcookie("".$id_cliente."","".$tiempo."",time()+ $tiempo*60);
                        $sql="UPDATE pedido SET estado='Espera' WHERE id_cliente=$id_cliente";
                        mysqli_query($conexion, $sql);        
                    }
                    else{
                        echo"Sólo se puede asignar tiempo a los pedidos que se recojan en cafetería.";
                    }
                }
                else{
                    echo"Por favor ingrese un tiempo aproximado.";
                }
            }
                /* Tabla donde se agrupan los pedidos de un mismo cliente en estado 'Pendiente' */
                echo"<div class='tablap'>";
                $count="SELECT * FROM pedido WHERE estado ='Pendiente'";
                $count2=mysqli_query($conexion,$count);
                if(mysqli_num_rows($count2)>0){
                    echo"<form action='./Sup.php' method='POST'>";
                    $idPedido=0;
                        $result="SELECT MAX(id_pedido) FROM pedido WHERE estado ='Pendiente'";
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
                                        echo"<input type='hidden' name='lugar' value='".$cliente3[3]."'";
                                        echo"<tr>";
                                            echo"<td><input type='radio' name='cliente' value='".$cliente3[1]."' required></td>";
                                            echo"<td>".$cliente3[1]."</td>";
                                            echo"<td >";
                                                $ida="SELECT id_alimento,cantidad FROM pedido WHERE id_cliente=$i && estado ='Pendiente' ORDER BY id_pedido";
                                                $ida2=mysqli_query($conexion,$ida);
                                                while($ida3=mysqli_fetch_array($ida2,MYSQLI_NUM)){
                                                    $alimento="SELECT nombre FROM alimento WHERE id_alimento = $ida3[0]";
                                                    $alimento2=mysqli_query($conexion,$alimento);
                                                    $alimento3=mysqli_fetch_array($alimento2,MYSQLI_NUM);
                                                    echo $alimento3['0']."<br>"; 
                                                }
                                            echo"</td>";
                                            echo"<td>";
                                                $cant="SELECT cantidad FROM pedido WHERE estado ='Pendiente' && id_cliente=$i  ORDER BY id_pedido";
                                                $cant2=mysqli_query($conexion,$cant);
                                                while($cant3=mysqli_fetch_array($cant2,MYSQLI_NUM)){
                                                    echo $cant3[0]."<br>";
                                                }    
                                            echo"</td>";
                                            $lugar="SELECT nombre FROM lugardeentrega WHERE id_lugar = $cliente3[3]";
                                            $lugar2=mysqli_query($conexion,$lugar);
                                            $lugar3=mysqli_fetch_array($lugar2,MYSQLI_NUM);
                                            echo"<td>".$lugar3['0']."</td>";
                                            echo"<td>".$cliente3['6']."</td>";
                                        echo"</tr>";
                                        echo "<br>";
                                        $usuariodef=0;
                                        $usuario="SELECT tipo_usuario,usuario FROM cliente WHERE id_cliente = $cliente3[1]";
                                        $usuario2=mysqli_query($conexion,$usuario);
                                        $usuario3=mysqli_fetch_array($usuario2,MYSQLI_NUM);
                                        $tipo=$usuario3[0];
                                        $usuarioname=$usuario3[1]; 
                                    }
                            }
                            mysqli_close($conexion);
                        echo"</table>";
                    echo"</div>";
                    echo"<div class='esperando'>";
                        echo"<input type=hidden value='".$usuarioname."' name='usuarioname'>";
                        echo"<input type=hidden value='".$tipo."' name='tipo'>";
                        echo"<input type=hidden value='ingreso' name='ingreso'>";
                        echo"<input type=submit id='esperar' value='Establecer Tiempo(min):' name='Esperar'>";
                        echo"<input type=number id='es' value='' name='Tiempo'>";
                    echo"</div>";
                    echo"<br>";
                    echo"<div class='entregando'>";
                        echo"<input type=submit class='buttons' value='Entregado' name='Entregado'>";
                    echo"</div>";
                    echo"<br>";
                    echo"<div class='sancionando'>";
                        echo"<input type=submit class='buttons' value='Sancionar' name='Sancionar'>";
                    echo"</form>";
                }
                else{
                    echo"No hay pedidos pendientes";
                }    
                echo"</div>";
            echo"</div>"; 
        }  
    }
    else{
        header("Location:../Templates/CoyoRappi.html");
    }     
?>