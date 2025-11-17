<?php
    require_once('../model/AccesoBD.php');

    session_start();

    if(isset($_SESSION['usuario'])) {

        $pedidos = AccesoBD::obtenerListadoPedidos();

        $_REQUEST['listado-pedidos'] = $pedidos;

        include_once '../view/ListadoPedidos.php';
    } else {
        header("Location: Login.php");
    }
 ?>