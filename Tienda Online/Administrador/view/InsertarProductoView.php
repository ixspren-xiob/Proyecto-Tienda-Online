<html>
<head>
    <title>La Ciudad del Libro - Insertar Libro</title>
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
            <h2 class="mb-4">Insertar Nuevo Libro</h2>
            <form action="../control/InsertarProducto.php" method="POST">
                <div class="card mb-5">
                    <div class="row g-0">
                        <div class="col-md-4 text-center p-3">
                            <img src="../imagenes/default.jpg" alt="Nuevo libro" class="img-fluid rounded" style="max-height: 250px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Título</label>
                                    <input type="text" name="nombre" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Autor</label>
                                    <input type="text" name="autor" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Precio (€)</label>
                                    <input type="number" step="0.01" name="precio" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Stock</label>
                                    <input type="number" name="stock" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Sinopsis</label>
                                    <textarea name="sinopsis" class="form-control" rows="4" required></textarea>
                                </div>

                                <button type="submit" class="btn btn-primary">Insertar Libro</button>
                                <a href="../control/ListarProductos.php" class="btn btn-secondary ms-2">Cancelar</a>
                            </div>
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
