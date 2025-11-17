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
        List<ProductoBD> productos = con.obtenerProductosBD();
    %>
    <div class="fondo">
        <mi-menu></mi-menu>
    
        <div class="container mt-4"><!-- añadir datos --> 
            <div class="elemento">
                <h2 class="text-center text-light">Productos</h2>
            </div>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                <!-- Productos BD -->
                <% for (ProductoBD producto : productos){
                    int codigo=producto.getCodigo();
                    String descripcion=producto.getNombre();
			        float precio=producto.getPrecio();
		            int existencias=producto.getStock();
			        String imagen=producto.getImagen();
                %>
                <div class="col">
                    <div class="card h-100">
                        <img src="imagenes/<%=imagen%>" class="card-img-top" alt="<%=descripcion%>">
                        <div class="card-body">
                            <h5 class="card-title"><%=descripcion%></h5>
                            <h5 class="card-text"><%=precio%></h5>
                            <a href="libro.jsp?codigo=<%=codigo%>" class="btn btn-primary">Ver más</a>
                            <% if (existencias > 0){ %>
                            <button class="btn btn-primary w-100" onclick="anadirCarrito(<%=codigo%>, '<%=descripcion%>', 'imagenes/<%=imagen%>', 1, <%=precio%>,<%=existencias%>)"> Añadir al Carrito</button>
                            <% }else{ %>
                            <h5 class="text-danger"> Producto No Disponible </h5>
                            <% } %>
                        </div>
                    </div>
                </div>
                <% } %>
            <div class="elemento">
                <div class="text-center mt-4">
                    <a href="carrito.html" class="btn btn-success">Ir al carrito</a>
                </div>
            </div>
        </div>

        <mi-pie></mi-pie>
    </div>
    <script src="./js/mis-etiquetas.js"></script>
    <script src="./Css_general/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/carrito.js"></script>
</body>
</html>
