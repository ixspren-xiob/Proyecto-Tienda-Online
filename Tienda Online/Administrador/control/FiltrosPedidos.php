<?php
    require_once('../model/AccesoBD.php');

    session_start();
    if(isset($_SESSION['usuario']) && isset($_POST['filtro'])){
        $valor = $_POST['valor'];
        switch ($_POST['filtro']) {
            case 'todos':
                header("Location: ListarPedidos.php");
                break;
            case 'usuario':
                $codigo = $valor;
                $pedidos = AccesoBD::filtroUsuarioPedidos($codigo);
                $_REQUEST['listado-pedidos'] = $pedidos;
                include_once '../view/ListadoPedidos.php';
                break;
            case 'producto':
                $codigoProducto = $valor;
                $pedidos = AccesoBD::filtroProductoPedidos($codigoProducto);
                $_REQUEST['listado-pedidos'] = $pedidos;
                include_once '../view/ListadoPedidos.php';
                break;
            case 'fecha':
                $fecha = $valor;
                $pedidos = AccesoBD::filtroFechaPedidos($fecha);
                $_REQUEST['listado-pedidos'] = $pedidos;
                include_once '../view/ListadoPedidos.php';
                break;
        }

        exit();
    } else {
        header("Location: Login.php");
        exit();
    }
 ?>