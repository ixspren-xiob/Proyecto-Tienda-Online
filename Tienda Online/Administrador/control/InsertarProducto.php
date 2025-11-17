<?php
    require_once('../model/AccesoBD.php');
    session_start();

    if (isset($_SESSION['usuario'])) {
        include_once '../view/InsertarProductoView.php';
        if (
            isset($_POST['nombre'], $_POST['autor'],
                $_POST['precio'], $_POST['stock'], $_POST['sinopsis'])
        ) {
            $nombre = $_POST['nombre'];
            $autor = $_POST['autor'];
            $precio = $_POST['precio'];
            $stock = $_POST['stock'];
            $sinopsis = $_POST['sinopsis'];

            if (AccesoBD::insertarProducto($nombre, $autor, $precio, $stock, $sinopsis)){
                header("Location: ../control/ListarProductos.php");
            }
        }
    } 
?>