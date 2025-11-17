<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" import="tienda.*" %>
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
		AccesoBD con = AccesoBD.getInstance();
		String codigo = request.getParameter("codigo");
        ProductoBD libro = null;
        int codigoInt = 0;

        // Verificar si el código es válido y obtener el producto
        if (codigo != null && !codigo.isEmpty()) {
            try {
                codigoInt = Integer.parseInt(codigo);
                
            } catch (NumberFormatException e) {
                out.println("<p>Error: Código no válido.</p>");
            }
        } else {
            out.println("<p>Error: Falta el parámetro 'codigo'.</p>");
        }

        // Obtener el producto de la base de datos
 		libro = con.obtenerProductoBD(codigoInt);
        if (libro == null) {
            out.println("<p>Error: Producto no encontrado.</p>");
        }
	%>
    <div class="fondo">
        <mi-menu></mi-menu>

        <div class="container mt-5">
            <div class="product-container">
                <!-- Imagen del libro fuera de la carta -->
                <div class="book-image">
                    <img src="./imagenes/<%=libro.getImagen()%>" class="img-fluid" alt="Portada del libro">
                </div>

                <!-- Tarjeta con información del libro -->
                <div class="card3 shadow-sm">
                    <div class="card3-body">
                        <h2 class="mb-3 centrado"><%=libro.getNombre()%></h2>
                        <p class="text-muted centrado">Autor: <%=libro.getAutor()%></p>
                        <p class="text-muted centrado">Precio: <%=libro.getPrecio()%></p>
						<!-- Botón para añadir al carrito, se llama a la función anadirCarrito() de ./js/carrito.js -->
                        <button class="btn btn-primary w-100" onclick="anadirCarrito(<%=libro.getCodigo()%>, '<%=libro.getNombre()%>', '<%=libro.getImagen()%>', 1, <%=libro.getPrecio()%>, <%=libro.getStock()%>)">Añadir al Carrito</button>
                        <div class="mt-3 d-flex justify-content-center gap-2">
                            <a href="productos.jsp" class="btn btn-secondary me-2">Seguir Comprando</a>
                            <a href="carrito.html" class="btn btn-success">Ir al Carrito</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Descripción fuera de la carta -->
            <div class="featured-section">
                <p><%=libro.getSinopsis()%></p>
            </div>
        </div>

        <mi-pie></mi-pie>
    </div>

    <script src="./js/mis-etiquetas.js"></script>
    <script src="./Css_general/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
	<script src="./js/carrito.js"></script>
</body>
</html>
