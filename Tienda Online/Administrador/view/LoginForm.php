<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Zona Administración</title>
        <link href="../Css_general/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet" />
        <link href="../Css_general/css_propio/style.css" rel="stylesheet" />
    </head>
    <body>
        <?php 
        if (isset($_REQUEST['msg'])) {
        ?>
        <div class="alert alert-danger mt-3 text-center">
        <?php echo $_REQUEST['msg']?>
        </div>
        <?php
        }
        if (isset($_REQUEST['a_usuario'])) {
            $a_usuario = $_REQUEST['a_usuario'];
        } else {
             $a_usuario = '';
        }   
        ?>
        
        <div class="fondo">
            <mi-cabecera></mi-cabecera>
            <div class="container d-flex justify-content-center align-items-center vh-100">
                <div class="card p-4 shadow" style="max-width: 400px; width: 100%;">
                    <h2 class="text-center mb-4">Acceso Administrador</h2>
                    <form method="POST" action="../control/Login.php" autocomplete="off">
                        <div class="mb-3">
                            <label for="p_usuario" class="form-label">Usuario:</label>
                            <input type="text" name="p_usuario" id="p_usuario" class="form-control" value="<?= htmlspecialchars($a_usuario) ?>" required autocomplete="off" />
                        </div>
                        <div class="mb-3">
                            <label for="p_clave" class="form-label">Clave:</label>
                            <input type="password" name="p_clave" id="p_clave" class="form-control" required autocomplete="off" />
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Entrar</button>
                        </div>
                    </form>
                </div>
            </div>
            <mi-pie></mi-pie>
        </div>
        <script src="../js/mis-etiquetas_adm.js"></script>
        <script src="../Css_general/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>