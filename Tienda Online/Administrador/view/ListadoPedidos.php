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
                <h2>Gestionar Pedidos</h2>
                <div class="card">
                    <div class="card-body">
                        <!-- añadimos un selector de filtro (productos, pedidos, fecha), un campo para añadir el valor según el filtro seleccionado (int, int, date) y un botón para aplicar el filtro-->
                        <form action="../control/FiltrosPedidos.php" method="post" class="mb-3">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="filtro" class="form-label">Filtro</label>
                                    <select name="filtro" id="filtro" class="form-select">
                                        <option value="todos">Todos</option>
                                        <option value="producto">Código Producto</option>
                                        <option value="usuario">Código Usuario</option>
                                        <option value="fecha">Fecha</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="valor" class="form-label">Valor</label>
                                    <input type="text" name="valor" id="valor" class="form-control" placeholder="Ingrese el valor del filtro">
                                </div>
                                <div class="col-md-4 d-flex align-items-end">
                                    <button type="submit" class="btn btn-primary">Filtrar</button>
                                </div>
                            </div>
                        </form>
                        <table class="table - table responsive">
                            <thead>
                                <tr>
                                    <td>Código Pedido</td>
                                    <td>Código Usuario</td>
                                    <td>Fecha</td>
                                    <td>Importe</td>
                                    <td>Estado</td>
                                    <td>Cancelar</td>
                                    <td>Detalles</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $pedidos = $_REQUEST['listado-pedidos'];

                                    foreach($pedidos as $pedido) {
                                ?>
                                <tr>
                                    <td><?php echo $pedido['codigo'] ?></td>
                                    <td><?php echo $pedido['persona'] ?></td>
                                    <td><?php echo $pedido['fecha'] ?></td>
                                    <td><?php echo $pedido['importe'] ?></td>
                                    <td>
                                        <?php
                                            switch ($pedido['estado']) {
                                                case 1:
                                                    echo '<span class="text-warning fw-bold">Pendiente</span>';
                                                    break;
                                                case 2:
                                                    echo '<span class="text-success fw-bold">Enviado</span>';
                                                    break;
                                                case 3:
                                                    echo '<span class="text-success fw-bold">Entregado</span>';
                                                    break;
                                                case 4:
                                                    echo '<span class="text-danger fw-bold">Cancelado</span>';
                                                    break;
                                                default:
                                                    echo '<span class="text-secondary">Desconocido</span>';
                                                    break;
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($pedido['estado'] == 1): ?>
                                            <form action="../control/CancelarPedido.php" method="post" onsubmit="return confirm('¿Cancelar este pedido?');" class="d-inline">
                                                <input type="hidden" name="codigo" value="<?php echo $pedido['codigo']; ?>">
                                                <button type="submit" class="btn btn-warning btn-sm">Cancelar</button>
                                            </form>
                                        <?php elseif ($pedido['estado'] == 4): ?>
                                            <form action="../control/EliminarPedido.php" method="post" onsubmit="return confirm('¿Eliminar este pedido cancelado?');" class="d-inline">
                                                <input type="hidden" name="codigo" value="<?php echo $pedido['codigo']; ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="../control/PedidoDetalle.php?codigo=<?php echo $pedido['codigo']; ?>" class="btn btn-primary btn-sm">Detalles</a>
                                    </td>
                                </tr>

                                <?php } ?>                
                            </tbody>        
                        </table>
                    </div>
                </div>
            </div>
            <mi-pie></mi-pie>
        </div>
        <script src="../js/mis-etiquetas_adm.js"></script>
        <script>
            const filtroSelect = document.getElementById("filtro");
            const valorInput = document.getElementById("valor");

            filtroSelect.addEventListener("change", () => {
                const selected = filtroSelect.value;

                if (selected === "fecha") {
                    valorInput.type = "date";
                    valorInput.placeholder = "";
                } else if (selected === "producto" || selected === "usuario") {
                    valorInput.type = "number";
                    valorInput.placeholder = "Ingrese el valor del filtro";
                } else {
                    valorInput.type = "text";
                    valorInput.placeholder = "Ingrese el valor del filtro";
                }

                // Limpia el valor al cambiar tipo
                valorInput.value = "";
            });
    </script>

    </body>
</html>