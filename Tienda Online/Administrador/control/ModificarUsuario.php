<?php
require_once('../model/AccesoBD.php');
session_start();

if (isset($_SESSION['usuario'])) {
    if (
        isset($_POST['codigo'], $_POST['email'], $_POST['contraseña'], $_POST['admin'], $_POST['activo'], $_POST['nombre'], $_POST['apellidos'], $_POST['domicilio'], $_POST['poblacion'], $_POST['provincia'], $_POST['cp'], $_POST['telefono'])) {
        $codigo = $_POST['codigo'];
        $email = $_POST['email'];
        $contraseña = $_POST['contraseña'];
        $admin = $_POST['admin'];
        $activo = $_POST['activo'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $domicilio = $_POST['domicilio'];
        $poblacion = $_POST['poblacion'];
        $provincia = $_POST['provincia'];
        $cp = $_POST['cp'];
        $telefono = $_POST['telefono'];

        // Llamar a la función de modificación de usuario
        AccesoBD::modificarUsuario($codigo, $email, $contraseña, $admin, $activo, $nombre, $apellidos, $domicilio, $poblacion, $provincia, $cp, $telefono);

        header("Location: ListarUsuarios.php");
        exit();
    }
    else {
        echo "<div class='alert alert-danger m-5'>Faltan datos para modificar el usuario.</div>";
    }
} else {
    header("Location: Login.php");
    exit();
}
?>