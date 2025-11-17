<?php 
    require_once('../model/AccesoBD.php');

	session_start();

	if (isset($_SESSION['usuario'])) {
    
    	$productos = AccesoBD::obtenerListadoProductos();
		
		$_REQUEST['listado-productos']=$productos;
    
    	include_once '../view/ListadoProductos.php';
	} else {
    	header("Location: Login.php");
	}
      
?>