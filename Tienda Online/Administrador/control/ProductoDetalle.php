<?php
    require_once('../model/AccesoBD.php');
    session_start();

    if (isset($_SESSION['usuario'])) {
        if (isset($_GET['codigo'])) {
            $id = intval($_GET['codigo']); // Seguridad básica: cast a entero
            $detalleProducto = AccesoBD::obtenerProducto($id);
            
            if ($detalleProducto) {
                $_REQUEST['detalle-producto'] = $detalleProducto;
                include_once '../view/ProductoDetalleView.php';
            } else {
                echo "<div class='alert alert-danger m-5'>Producto no encontrado.</div>";
            }
        } else {
            echo "<div class='alert alert-warning m-5'>No se ha especificado ningún producto.</div>";
        }
    } else {
        header("Location: Login.php");
        exit();
    }
?>