<?php
    require_once('../model/AccesoBD.php');
    session_start();

    if (isset($_SESSION['usuario']) && isset($_POST['codigo'])) {
        $codigo = $_POST['codigo'];
        AccesoBD::eliminarUsuario($codigo);
        header("Location: ListarUsuarios.php"); // Redirige de vuelta al listado
        exit();
    } else {
        header("Location: ../vista/Login.php");
        exit();
    }
?>