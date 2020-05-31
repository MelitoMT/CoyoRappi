<?php
    /*IMPORTANTE: ESTA VARIABE PERMITE VISUALIZACION, SI SE QUITA POR SEGURIDAD, SE NECESITARA ENVIAR EL ID_CLIENTE DESDE FORMULARIO  */
    $id_cliente=2;
    echo '<link rel="stylesheet" href="../Style/rappi.css">';    
    if(isset($id_cliente)){
        include './AbrirConex.php';
        /* Si se cancela, vacìa la variable cantidad para que no entre en el condicional */
        if(isset($_POST['Cancelar'])){
            $_POST['cant']=0;
        }
        /* Si se confirma se insertan los datos en la tabla pedido con valor de pendiente para que le aparezcan al supervisor*/
        elseif(isset($_POST['Confirmar'])&&isset($_POST['id_alimento'])){
            $cant=$_POST['cant'];
            $id_alimento=$_POST['id_alimento'];
            $total=$_POST['total'];
            $time=$_POST['time'];
            $lugar=$_POST['lugar'];
            $insert="INSERT INTO `pedido` (`id_pedido`, `id_cliente`, `id_alimento`, `id_lugar`, `hpedido`, `estado`, `cantidad`, `total`) VALUES (NULL,'$id_cliente','$id_alimento','$lugar','$time','Pendiente','$cant','$total');";
            mysqli_query($conexion, $insert);
            mysqli_close($conexion);
            header("Location:./Pedidos.php");
            $_POST['cant']=0;
        }
        else{    
            /* Si ya se cotiza un producto, se calcularà el total */
            if((isset($_POST['cant'])&&$_POST['cant']!=0)&&isset($_POST['costo'])&&isset($_POST['id_alimento'])){
                $cant=$_POST['cant'];
                $costo=$_POST['costo'];
                $nombre=$_POST['nombre'];
                $id_alimento=$_POST['id_alimento'];
                $total=$cant * $costo;
                $time;
                /* Resumen del pedido */
                echo"<form method='POST' action='Pedidos.php'>";
                    echo"Pedido:";
                    echo "<hr>";
                    echo $nombre."(".$cant."pzas):";
                    echo $total;
                    echo"<br>";
                    /* Permite seleccionar lugar de entrega */
                    echo"<select name='lugar'>";
                        $msql="SELECT * FROM lugardeentrega";
                        $msql2=mysqli_query($conexion,$msql);
                        while($rmsql=mysqli_fetch_array($msql2,MYSQLI_NUM)){
                            echo"<option value'".$rmsql[0]."'>".$rmsql[1]."</option>";
                        }
                    echo"</select>";
                    echo"<br>";
                    /* Devuelve la hora exacta del pedido */
                    $hora="SELECT NOW()";
                    $hour=mysqli_query($conexion,$hora);
                    while($heure=mysqli_fetch_array($hour,MYSQLI_NUM)){
                        $time=$heure [0];
                    }
                    /* Se da la oportunidad de confirmar o de cacelar la compra */
                    echo"<input type='hidden' value='".$cant."' name='cant'>";
                    echo"<input type='hidden' value='".$total."' name='total'>";
                    echo"<input type='hidden' value='".$id_alimento."' name='id_alimento'>";
                    echo"<input type='hidden' value='".$time."' name='time'>"; 
                    echo"<input type='submit' value='Confirmar Compra' name='Confirmar'>";
                    echo"<input type='submit' value='Cancelar Compra' name='Cancelar'>";
                    echo"</form>";
            }
            else{
                echo"<div id='card'>";
                    /* Ocupamos una cinsulta para que se genere un registro por producto siempre que la disponibilidad sea 0 */
                        $sql="SELECT * FROM alimento WHERE disponibilidad > 0";
                        $result=mysqli_query($conexion,$sql);
                        if(mysqli_num_rows($result)>0){
                            while($resultado=mysqli_fetch_array($result,MYSQLI_NUM)){
                            echo"<form method='POST' action='Pedidos.php'>";
                                echo"<div id='header'>";
                                    echo $resultado[1];
                                    echo "$".$resultado[3];
                                echo"</div>";
                                echo"<br>";
                                echo"<div id='container'>";
                                    /* Pone como tope màximo la disponibilidad registrada en la base */
                                    echo "<input type='number' value='' name='cant' max='".$resultado[2]."' required>";
                                    /* Envìo informaciòn extra para imprimirla despuès y registrarla en la base */
                                    echo"<input type='hidden' value='".$resultado[1]."' name='nombre'>";
                                    echo"<input type='hidden' value='".$resultado[3]."' name='costo'>";
                                    echo"<input type='hidden' value='".$resultado[0]."' name='id_alimento'>";
                                    echo"<input type='submit' value='Comprar' name='Comprar'>";
                                echo"</div>";
                            echo"</form>";
                            }
                        }    
                        else{
                            echo"No hay alimentos disponibles";
                        }    
                echo"</div>";
                mysqli_close($conexion);
            }
        }
    }
    else{
        header("Location:cd../Templates/Coyo_Rappi.html");
    }
?>