<?php
require_once('../model/AccesoBD.php');
session_start();

if (isset($_SESSION['usuario'])) {
    if (
        isset($_POST['codigo'], $_POST['nombre'], $_POST['autor'], $_POST['precio'], $_POST['stock'], $_POST['sinopsis'])
    ) {
        $codigo = $_POST['codigo'];
        $nombre = $_POST['nombre'];
        $autor = $_POST['autor'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $sinopsis = $_POST['sinopsis'];

        AccesoBD::modificarProducto($codigo, $nombre, $autor, $precio, $stock, $sinopsis);
    }

    header("Location: ListarProductos.php");
    exit();
} else {
    header("Location: Login.php");
    exit();
}
?>