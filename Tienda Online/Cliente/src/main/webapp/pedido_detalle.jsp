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
        String codigopedido = request.getParameter("codigopedido");
        int codigoPedidoInt = Integer.parseInt(codigopedido);

        String action = request.getParameter("action");
        if ("cancelar".equals(action)) {
            con.modificarEstadoPedido(codigoPedidoInt, 4); // Cambia el estado a cancelado
        }

        Pedido pedido = con.obtenerPedido(codigoPedidoInt); // ← actualiza después de modificar
        List<Producto> productos = con.obtenerProductosPedido(pedido.getCodigo());
    %>

    <div class="fondo">
        <mi-menu></mi-menu>
        <div class="container mt-5 elemento">
            <h2 class="text-center mb-4">Detalles del Pedido</h2>
            <div class="card2 shadow-sm">
                <div class="card2-body">
                    <h2 class="mb-3 centrado remarcar">Detalles del Pedido</h2>
                    <p><strong>ID Pedido:</strong> <%= pedido.getCodigo() %></p>
                    <p><strong>Fecha:</strong> <%= pedido.getFecha() %></p>
                    <p><strong>Total:</strong> <%= pedido.getImporte() %></p>
                    <div>
                    <%
                        String estado = "";
                        switch (pedido.getEstado()){
                            case 1:
                                estado = "Pendiente";
                                break;
                            case 2:
                                estado = "Enviado";
                                break;
                            case 3:
                                estado = "Entregado";
                                break;
                            case 4:
                                estado = "Cancelado";
                                break;
                        } 
                    %>
                        <p><strong>Estado:</strong> <%= estado %></p>
                        <% if (pedido.getEstado() == 1) { %>
                            <a class="btn btn-danger" href="pedido_detalle.jsp?codigopedido=<%=codigoPedidoInt%>&action=cancelar">Cancelar Pedido</a>
                        <% } %>
                    </div>
                    <h3>Productos en el Pedido</h3> 
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Producto</th>
                                <th>Descripción</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <%
                            System.out.println("Productos en el pedido: " + productos.size()); 
                            for (Producto producto : productos) { 
                                int codigoProducto = producto.getCodigo();
                                String descripcion = producto.getNombre();
                                float precio = producto.getPrecio();
                                int cantidad = producto.getCantidad();
                                %>
                                <tr>
                                    <td><%= codigoProducto %></td>
                                    <td><%= descripcion %></td>
                                    <td><%= precio %></td>
                                    <td><%= cantidad %></td>
                                </tr>
                            <% } %>
                        </tbody>
                    </table>
                    <div class="text-center mt-4">
                        <a href="pedidos.jsp" class="btn btn-primary">Volver a Mis Pedidos</a>
                    </div>
                </div>
            </div>
        </div>
        <mi-pie></mi-pie>
    </div>
    <script src="./js/mis-etiquetas.js"></script>
    <script src="./Css_general/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/funciones.js"></script>
</body>
</html>

