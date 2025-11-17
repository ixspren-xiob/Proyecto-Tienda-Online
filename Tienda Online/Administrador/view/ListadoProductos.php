<html>
    <head>
        <title>La Ciudad del Libro - Zona Administracion</title>
        <link rel="icon" type="image/ico" href="img/icono.ico" sizes="64x64">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../Css_general/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    	<link href="../Css_general/css_propio/style.css" rel="stylesheet">
    </head>
	<body>
        <div class="fondo">
            <mi-menu></mi-menu>
            <div class="container mt-5">
                <h2>Gestionar Productos</h2>
                <div class="card">
                    <div class="card-body">
                        <table class="table - table responsive">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Código</td>
                                    <td>Título</td>
                                    <td>Precio</td>
                                    <td>Autor</td>
                                    <td>Stock</td>
                                    <td>Editar</td>
                                    <td>Eliminar</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $productos = $_REQUEST['listado-productos'];

                                    foreach($productos as $producto) {
                                ?>
                                <tr>
                                
                                    <td><img src="../imagenes/<?php echo $producto['imagen'] ?>" alt="<?php echo $producto['nombre'] ?>" style="width: 30px; height: auto;"></td>
                                    <td><?php echo $producto['codigo'] ?></td>
                                    <td><?php echo $producto['nombre'] ?></td>
                                    <td><?php echo $producto['precio'] ?></td>
                                    <td><?php echo $producto['autor'] ?></td>
                                    <td><?php echo $producto['stock'] ?></td>
                                    <td><a href="../control/ProductoDetalle.php?codigo=<?php echo $producto['codigo'] ?>" class="btn btn-primary">Editar</a></td>
                                    <td>
                                        <form action="../control/EliminarProducto.php" method="post" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este libro?');" class="d-inline">
                                            <input type="hidden" name="codigo" value="<?php echo $producto['codigo']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php } ?>                
                            </tbody>        
                        </table>
                        <div class="text-center mt-4">
                            <a href="../control/InsertarProducto.php" class="btn btn-success px-4">Insertar Libro</a>
                        </div>
                    </div>
                </div>
            </div>
            <mi-pie></mi-pie>
        </div>
        <script src="../js/mis-etiquetas_adm.js"></script>
    </body>
</html>