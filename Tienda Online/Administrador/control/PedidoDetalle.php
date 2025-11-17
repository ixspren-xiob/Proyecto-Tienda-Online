<?php
    require_once('../model/AccesoBD.php');
    session_start();

    if (isset($_SESSION['usuario'])) {
        if (isset($_GET['codigo'])) {
            $id = intval($_GET['codigo']); // Seguridad básica: cast a entero
            $Pedido = AccesoBD::obtenerPedido($id);
            $usuarioPedido = AccesoBD::obtenerUsuario($Pedido['persona']);
            $detallePedido = AccesoBD::detallePedido(($id));
            $productosPedido = [];
            if($detallePedido){
                foreach($detallePedido as $linea){
                    $producto = AccesoBD::obtenerProducto($linea['codigo_producto']);
                    if($producto){
                        $producto['unidades'] = $linea['unidades'];
                        array_push($productosPedido, $producto);
                    }
                }
            }
            
            if ($detallePedido) {
                $_REQUEST['pedido'] = $Pedido;
                $_REQUEST['usuario-pedido'] = $usuarioPedido;
                $_REQUEST['productos-pedido'] = $productosPedido;
                include_once '../view/PedidoDetalleView.php';
            } else {
                echo "<div class='alert alert-danger m-5'>Pedido no encontrado.</div>";
            }
        } else {
            echo "<div class='alert alert-warning m-5'>No se ha especificado ningún pedido.</div>";
        }
    } else {
        header("Location: Login.php");
        exit();
    }
?>