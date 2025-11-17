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
                <?php
                    $Pedido = $_REQUEST['pedido']; 
                    $usuarioPedido = $_REQUEST['usuario-pedido'];
                    $productosPedido = $_REQUEST['productos-pedido'];
                ?>  
               <h2 class="mb-4">Editar Pedido</h2>
                <form action="../control/ModificarPedido.php" method="POST">
                    <div class="card mb-5">
                        <div class="row g-0">
                            <div class="card-body">
                                <input type="hidden" name="codigo" value="<?php echo $Pedido['codigo']; ?>">
                                <div class="mb-3">
                                    <label class="form-label">Importe Total</label>
                                    <input type="text" name="importe" class="form-control" value="<?php echo $Pedido['importe']; ?>"readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Fecha de Pedido</label>
                                    <input type="text" name="fecha_pedido" class="form-control" value="<?php echo $Pedido['fecha']; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Estado</label>
                                    <select name="estado" class="form-select">
                                        <option value="pendiente" <?php if($Pedido['estado'] == '1') echo 'selected'; ?>>Pendiente</option>
                                        <option value="enviado" <?php if($Pedido['estado'] == '2') echo 'selected'; ?>>Enviado</option>
                                        <option value="entregado" <?php if($Pedido['estado'] == '3') echo 'selected'; ?>>Entregado</option>
                                        <option value="cancelado" <?php if($Pedido['estado'] == '4') echo 'selected'; ?>>Cancelado</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Dirección</label>
                                    <input type="text" name="direccion" class="form-control" value="<?php echo $Pedido['domicilio']; ?>"readonly>
                                    <label class="form-label">Localidad</label>
                                    <input type="text" name="localidad" class="form-control" value="<?php echo $Pedido['localidad']; ?>"readonly>
                                    <label class="form-label">Provincia</label>
                                    <input type="text" name="provincia" class="form-control" value="<?php echo $Pedido['provincia']; ?>"readonly>
                                    <label class="form-label">Código Postal</label>
                                    <input type="text" name="codigo_postal" class="form-control" value="<?php echo $Pedido['cp']; ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Usuario del Pedido</label>
                                    <input type="text" class="form-control" value="<?php echo $usuarioPedido['nombre'] . ' ' . $usuarioPedido['apellidos']; ?>" readonly>
                                </div>
                                <!--Cuadrícula con los productos del pedido y sus cantidades: se muestra de cada producto la imagen, el nombre, el precio y la cantidad-->
                                <h5>Productos del Pedido</h5>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Imagen</th>
                                                <th>Nombre</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($productosPedido as $producto): ?>
                                                <tr>
                                                    <td><img src="../imagenes/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['nombre']; ?>" class="img-thumbnail" style="width: 50px;"></td>
                                                    <td><?php echo $producto['nombre']; ?></td>
                                                    <td><?php echo $producto['precio']; ?> €</td>
                                                    <td><?php echo $producto['unidades']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                            <button type="submit" class="btn btn-success">Guardar Cambios</button>
                            <a href="../control/ListarPedidos.php" class="btn btn-secondary ms-2">Volver</a>
                        </div>
                    </div>
                </div>
                </form>
            </div>
            <mi-pie></mi-pie>
        </div>
        <script src="../js/mis-etiquetas_adm.js"></script>
    </body>
</html>