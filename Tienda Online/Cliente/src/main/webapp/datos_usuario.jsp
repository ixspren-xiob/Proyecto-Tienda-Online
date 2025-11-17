<%@ page language="java" contentType="text/html; charset=UTF-8" import="java.util.List,tienda.*" pageEncoding="UTF-8" %>
<!DOCTYPE html>
<html lang="es">
<head>
    <title>La Ciudad Del Libro</title>
    <link rel="icon" type="image/ico" href="img/icono.ico" sizes="64x64">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./Css_general/bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="./Css_general/css_propio/style.css" rel="stylesheet">
</head>
<body>
	<%
		AccesoBD con=AccesoBD.getInstance();
		session = request.getSession(false);
		if (session == null || session.getAttribute("codigo") == null) {
			response.sendRedirect("usuario.jsp");
			return;
		}
		int codigoUsuario = (Integer) session.getAttribute("codigo");
		Usuario usuario = con.obtenerUsuario(codigoUsuario);
		%>
    <div class="fondo">
		<mi-menu></mi-menu>
		<div class="container mt-5 elemento">
			<h2 class="text-center mb-4">Zona Usuario</h2>

			<div class="card2 shadow-sm">
				<div class="card2-body">
					<h2 class="mb-3 centrado remarcar">Mis Datos</h2>
					<form id="userForm" method="post" action="CambiarDatos.html">
						<div class="mb-3">
							<label class="form-label">Nombre</label>
							<input type="text" id="nombre" name="nombre" class="form-control" value="<%= usuario.getNombre() %>">
						</div>
						<div class="mb-3">
							<label class="form-label">Contraseña</label>
							<input type="password" id="password" name="password" class="form-control" value="<%=usuario.getPassword() %>">
						</div>
						<div class="mb-3">
							<label class="form-label">Apellidos</label>
							<input type="text" id="apellidos" name="apellidos" class="form-control" value="<%= usuario.getApellidos() %>">
						</div>
						<div class="mb-3">
							<label class="form-label">Correo Electrónico</label>
							<input type="email" id="email" name="email" class="form-control" value="<%= usuario.getEmail() %>">
						</div>
						<div class="mb-3">
							<label class="form-label">Teléfono</label>
							<input type="tel" id="telefono" name="telefono" class="form-control" value="<%=usuario.getTelefono() %>">
						</div>
						<div class="mb-3">
							<label class="form-label">Domicilio</label>
							<input type="text" id="direccion" name="domicilio" class="form-control" value="<%= usuario.getDomicilio() %>">
						</div>
						<div class="mb-3">
							<label class="form-label">Código Postal</label>
							<input type="text" id="codigoPostal" name="cp" class="form-control" value="<%= usuario.getCp() %>">
						</div>
						<div class="mb-3">
							<label class="form-label">Ciudad</label>
							<input type="text" id="ciudad" name="localidad" class="form-control" value="<%= usuario.getPoblacion() %>">
						</div>
						<div class="mb-3">
							<label class="form-label">Provincia</label>
							<input type="text" id="provincia" name="provincia" class="form-control" value="<%= usuario.getProvincia() %>">
						</div>
						<div class="text-center">
							<button type="submit" id="saveBtn" class="btn btn-success">Guardar Cambios</button>
						</div>
					</form>
					<div class="text-center mt-3">
						<a href="logout.html" class="btn btn-danger">Cerrar Sesión</a>	
						<a href="pedidos.jsp" class="btn btn-info">Mis Pedidos</a>
					</div>
				</div>
			</div>
		</div>
		<mi-pie></mi-pie>
	</div>

 

    <script src="./js/mis-etiquetas.js"></script>
    <script src="./Css_general/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
