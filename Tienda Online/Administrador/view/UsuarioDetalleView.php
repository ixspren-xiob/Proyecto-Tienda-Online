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
                $detalleUsuario = $_REQUEST['detalle-usuario']; 
            ?>  
               <h2 class="mb-4">Detalle Usuario</h2>
                <form action="../control/ModificarUsuario.php" method="POST">
                    <div class="card mb-5">
                        <div class="row g-0">
                            <div class="col-md-8">
                                <div class="card-body">
                                    <input type="hidden" name="codigo" value="<?php echo $detalleUsuario['codigo']; ?>">
                                    <div class="mb-3">
                                        <label class="form-label">email</label>
                                        <input type="text" name="email" class="form-control" value="<?php echo $detalleUsuario['email']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label"> Contraseña</label>
                                        <input type="password" name="contraseña" class="form-control" placeholder="Introduce nueva contraseña si deseas cambiarla" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Activo</label>
                                        <select name="activo" class="form-select">
                                            <option value="1" <?php if ($detalleUsuario['activo'] == 1) echo 'selected'; ?>>Sí</option>
                                            <option value="0" <?php if ($detalleUsuario['activo'] == 0) echo 'selected'; ?>>No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Es administrador</label>
                                        <select name="admin" class="form-select">
                                            <option value="1" <?php if ($detalleUsuario['admin'] == 1) echo 'selected'; ?>>Sí</option>
                                            <option value="0" <?php if ($detalleUsuario['admin'] == 0) echo 'selected'; ?>>No</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nombre</label>
                                        <input type="text" name="nombre" class="form-control" value="<?php echo $detalleUsuario['nombre']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Apellidos</label>
                                        <input type="text" name="apellidos" class="form-control" value="<?php echo $detalleUsuario['apellidos']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Domicilio</label>
                                        <input type="text" name="domicilio" class="form-control" value="<?php echo $detalleUsuario['domicilio']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Población</label>
                                        <input type="text" name="poblacion" class="form-control" value="<?php echo $detalleUsuario['poblacion']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Provincia</label>
                                        <input type="text" name="provincia" class="form-control" value="<?php echo $detalleUsuario['provincia']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Código Postal</label>
                                        <input type="text" name="cp" class="form-control" value="<?php echo $detalleUsuario['cp']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Teléfono</label>
                                        <input type="text" name="telefono" class="form-control" value="<?php echo $detalleUsuario['telefono']; ?>" required>
                                    </div>
                                    <button type="submit" class="btn btn-success">Guardar Cambios</button>
                                    <a href="../control/ListarUsuarios.php" class="btn btn-secondary ms-2">Volver</a>
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