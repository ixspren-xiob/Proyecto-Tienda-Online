<%@page language="java" contentType="text/html; charset=UTF-8" import="tienda.*" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html lang="es">

<head>
	<title>La Ciudad Del Libro</title>
	<link rel="icon" type="image/ico" href="img/icono.ico" sizes="64x64">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link  href="./Css_general/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="./Css_general/css_propio/style.css" rel="stylesheet">
</head>

<body>
	<% 
		if ((session.getAttribute("codigo") == null) ||
	    ((Integer)session.getAttribute("codigo") <=0 ))
		{ 
	%>
	<div class="fondo">
			<mi-menu></mi-menu>
			<div class="row justify-content-center">
			<%
				String mensaje = (String)request.getAttribute("mensaje");
				if (mensaje != null) {
				%>
				<div class="alert alert-danger alert-dismissible fade show">
    				<strong>Error!</strong> <%= mensaje %>
    				<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
				</div>
				<% 
					}
				%>
				<div class="col-md-6">
					<div class="card shadow-sm p-4 elemento">
						<h2 class="text-center">Zona de Usuario</h2>
						
						<ul class="nav nav-tabs" id="authTabs" role="tablist">
							<li class="nav-item" role="presentation">
								<button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab">Iniciar Sesión</button>
							</li>
							<li class="nav-item" role="presentation">
								<button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab">Registrarse</button>
							</li>
						</ul>
						
						<div class="tab-content mt-3" id="authTabsContent">
							<!-- Login Form -->
							<div class="tab-pane fade show active" id="login" role="tabpanel">
								<form method="post" action="login.html">
									<input type="hidden" name="url" value="./productos.jsp">
									<div class="mb-3">
										<label for="login-email" class="form-label">Email:</label>
										<input type="email" class="form-control" id="login-email" name="login-email" required>
									</div>
									<div class="mb-3">
										<label for="login-password" class="form-label">Contraseña:</label>
										<input type="password" class="form-control" id="login-password" name="login-password" required>
									</div>
									<input type="submit" class="btn btn-primary w-100" value="Entrar"/>
								</form>
							</div>

							<!-- Register Form -->
							<div class="tab-pane fade" id="register" role="tabpanel">
								<form method="post" action="registro.html">
									<input type="hidden" name="url" value="./usuario.jsp">
									<div class="mb-3">
										<label for="nombre" class="form-label">Nombre:</label>
										<input type="text" class="form-control" id="nombre" name="nombre" required>
									</div>
									<div class="mb-3">
										<label for="apellidos" class="form-label">Apellidos:</label>
										<input type="text" class="form-control" id="apellidos" name="apellidos" required>
									</div>
									<div class="mb-3">
										<label for="email" class="form-label">Email:</label>
										<input type="email" class="form-control" id="email" name="email" required>
									</div>
									<div class="mb-3">
										<label for="direccion" class="form-label">Dirección:</label>
										<input type="text" class="form-control" id="direccion" name="domicilio" required>
									</div>
									<div class="mb-3">
										<label for="telefono" class="form-label">Número de Teléfono:</label>
										<input type="tel" class="form-control" id="telefono" name="telefono" required>
									</div>
									<div class="mb-3">
										<label for="password" class="form-label">Contraseña:</label>
										<input type="password" class="form-control" id="password" name ="password" required>
									</div>
									<input type="submit" class="btn btn-primary w-100" value="Registrarse"/>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>

		<mi-pie></mi-pie>
	</div>
	<script>
    	// Comprobamos si la URL está en localStorage
    	const redirectUrl = localStorage.getItem('redirectUrl');
    	if (redirectUrl) {
        	// Guardamos la URL en una variable y la redirigimos
        	localStorage.removeItem('redirectUrl'); // Borramos la URL del localStorage
        	window.location.href = redirectUrl; // Redirigimos a la URL guardada
    }
</script>
	<%
		}else{
			response.sendRedirect("./datos_usuario.jsp");
		}
	%>

    <script src="./js/mis-etiquetas.js"></script>
    <script src="./Css_general/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>