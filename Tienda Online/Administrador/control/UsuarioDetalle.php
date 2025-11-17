<?php
    require_once('../model/AccesoBD.php');
    session_start();

    if (isset($_SESSION['usuario'])) {
        if (isset($_GET['codigo'])) {
            $id = intval($_GET['codigo']); // Seguridad básica: cast a entero
            $detalleUsuario = AccesoBD::obtenerUsuario($id);
            
            if ($detalleUsuario) {
                $_REQUEST['detalle-usuario'] = $detalleUsuario;
                include_once '../view/UsuarioDetalleView.php';
            } else {
                echo "<div class='alert alert-danger m-5'>Usuario no encontrado.</div>";
            }
        } else {
            echo "<div class='alert alert-warning m-5'>No se ha especificado ningún Usuario.</div>";
        }
    } else {
        header("Location: Login.php");
        exit();
    }
?>