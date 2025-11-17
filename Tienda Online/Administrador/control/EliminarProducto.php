<?php
require_once('../model/AccesoBD.php');
session_start();

if (isset($_SESSION['usuario']) && isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    AccesoBD::eliminarProducto($codigo);
    header("Location: ListarProductos.php");
    exit();
} else {
    header("Location: Login.php");
    exit();
}
