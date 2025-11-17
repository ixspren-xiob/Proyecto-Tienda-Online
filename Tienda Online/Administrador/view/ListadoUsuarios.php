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
                <h2>Gestionar Usuarios</h2>
                <div class="card">
                    <div class="card-body">
                        <table class="table - table responsive">
                            <thead>
                                <tr>
                                    <td>Código</td>
                                    <td>Login</td>
                                    <td>Es administrador</td>
                                    <td>Activo</td>
                                    <td>Eliminar</td>
                                    <td>Detalles</td>
                                </tr>
                            </thead>
                            <tbody>
                                
                        <?php

                            $usuarios = $_REQUEST['listado-usuarios'];
                            
                            foreach ($usuarios as $usuario) { 
                        ?>
                                <tr>
                                    <td><?php echo $usuario['codigo'] ?></td>
                                    <td><?php echo $usuario['email'] ?></td>
                                    <td><?php 
                                            if ($usuario['admin']==1) { ?>
                                                &#10003;
                                        <?php } else { ?>    
                                                &#10060; 
                                        <?php } ?>    
                                    </td>
                                    <td>
                                        <form action="../control/ToggleActivo.php" method="post">
                                            <input type="hidden" name="codigo" value="<?php echo $usuario['codigo']; ?>">
                                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline" style="text-decoration: none;">
                                                <?php if ($usuario['activo'] == 1): ?>
                                                    <span class="text-success">&#10003;</span>
                                                <?php else: ?>
                                                    <span class="text-danger">&#10060;</span>
                                                <?php endif; ?>
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="../control/EliminarUsuario.php" method="post" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este usuario?');" class="d-inline">
                                            <input type="hidden" name="codigo" value="<?php echo $usuario['codigo']; ?>">
                                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                        </form>
                                    </td>
                                    <td><a href="../control/UsuarioDetalle.php?codigo=<?php echo $usuario['codigo'] ?>" class="btn btn-primary">Detalles</a></td>
                                </tr>
                        <?php
                            }
                        ?>      
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </div>
            <mi-pie></mi-pie>
        </div>
        <script src="../js/mis-etiquetas_adm.js"></script>
    </body>
</html>

