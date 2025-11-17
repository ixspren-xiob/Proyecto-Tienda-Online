<?php
require_once('../model/AccesoBD.php');
session_start();

if (isset($_SESSION['usuario'])) {
    if (
        isset($_POST['codigo'], $_POST['estado'])
    ) {
        $codigo = $_POST['codigo'];
        $estado = $_POST['estado'];
        $codigoestado;
        switch ($estado) {
            case 'pendiente':
                $codigoestado = 1;
                break;
            case 'enviado':
                $codigoestado = 2;
                break;
            case 'entregado':
                $codigoestado = 3;
                break;
            case 'cancelado':
                $codigoestado = 4;
                break;
            default:
                $codigoestado = 1;
        }

        AccesoBD::modificarEstado($codigo, $codigoestado);
    }

    header("Location: ListarPedidos.php");
    exit();
} else {
    header("Location: Login.php");
    exit();
}
?>