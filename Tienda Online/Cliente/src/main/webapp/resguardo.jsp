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
        //obtenemosmos el carrito de la sesión
        int codigoUsuario = (Integer) session.getAttribute("codigo");
        Usuario usuario = con.obtenerUsuario(codigoUsuario);
        //obtenemos la fecha actual
        java.util.Date fecha = new java.util.Date();
        //formateamos la fecha
        java.text.SimpleDateFormat formatoFecha = new java.text.SimpleDateFormat("dd/MM/yyyy HH:mm:ss");
        String fechaFormateada = formatoFecha.format(fecha);
    %>
    <div class="fondo">
        <mi-menu></mi-menu>

        <div class="container mt-5 elemento">
            <h2 class="text-center mb-4">Resguardo de Compra</h2>

            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title">Número de Pedido:</h4>
                    <p class="card-text"><strong>Fecha de Compra:</strong> <%= fechaFormateada %></p>
                    <hr>

                    <h5>Productos Comprados</h5>
                    <table class="table table-striped table-bordered text-center" id="tablaCarritoResguardo">
                        <thead class="table-dark">
                            <th>Título</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Subtotal</th>
                        </thead>
                        <tbody>
                            <% 
                                List<Producto> carrito = (List<Producto>) request.getAttribute("carritoJSON");
                                float total = (float) request.getAttribute("importe");
                                if (carrito == null || carrito.isEmpty()) {
                            %>
                            <tr><td colspan="4">No hay productos comprados.</td></tr>
                            <% } else {
                                for (Producto p : carrito) { %>
                                    <tr>
                                        <td><%= p.getNombre() %></td>
                                        <td><%= p.getCantidad() %></td>
                                        <td>$<%= String.format("%.2f", p.getPrecio()) %></td>
                                        <td>$<%= String.format("%.2f", p.getPrecio() * p.getCantidad()) %></td>
                                    </tr>
                            <% } } %>
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3">Total</td>
                            <td>$<%= String.format("%.2f", total) %></td>
                        </tr>
                        </tfoot>
                    </table>

                    <table class="table table-striped table-bordered text-center">
                        <thead class="table-dark">
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Dirección</th>
                            <th>Población</th>
                            <th>Provincia</th>
                            <th>Código Postal</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><%= usuario.getNombre() %></td>
                                <td><%= usuario.getApellidos() %></td>
                                <td><%= usuario.getDomicilio() %></td>
                                <td><%= usuario.getPoblacion() %></td>
                                <td><%= usuario.getProvincia() %></td>
                                <td><%= usuario.getCp() %></td>
                                <td><%= usuario.getTelefono() %></td>
                                <td><%= usuario.getEmail() %></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="text-center">
                        <p class="text-muted">¡Gracias por tu compra! El pedido será procesado y enviado pronto.</p>
                        <a href="index.jsp" class="btn btn-primary">Volver a la Página Principal</a>
                    </div>
                </div>
            </div>
        </div>

        <mi-pie></mi-pie>
    </div>

    <script src="./js/mis-etiquetas.js"></script>
    <script src="./Css_general/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/carrito.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            mostrarResguardoCarrito();
        });
    </script>

    </body>
</html>