<?php
    require_once('../model/AccesoBD.php');

    session_start();

    if(isset($_SESSION['usuario']) && isset($_POST['codigo'])){
        $codigo = $_POST['codigo'];
        AccesoBD::cancelarPedido($codigo);
        header("Location: ListarPedidos.php");
        exit();
    } else {
        header("Location: Login.php");
        exit();
    }
 ?>