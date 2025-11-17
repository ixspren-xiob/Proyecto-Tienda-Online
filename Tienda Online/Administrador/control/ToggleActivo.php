<?php
require_once('../model/AccesoBD.php');
session_start();

if (isset($_SESSION['usuario']) && isset($_POST['codigo'])) {
    $codigo = $_POST['codigo'];
    AccesoBD::toggleActivoUsuario($codigo);
    header("Location: ../control/ListarUsuarios.php");
    exit();
} else {
    header("Location: ../vista/Login.php");
    exit();
}
