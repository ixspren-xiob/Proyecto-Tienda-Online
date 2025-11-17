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
        AccesoBD con = AccesoBD.getInstance();
        session = request.getSession(false);
		if (session == null || session.getAttribute("codigo") == null) {
			response.sendRedirect("usuario.jsp");
			return;
		}
        int codigo = (Integer) session.getAttribute("codigo");
		Usuario usuario = con.obtenerUsuario(codigo);
        System.out.println("Usuario: " + usuario.getNombre() + " " + usuario.getApellidos());
        List<Pedido> pedidos = con.obtenerPedidosUsuario(usuario.getCodigo());
        if (pedidos.isEmpty()){
            System.out.println("No Pedidos para" + usuario.getCodigo());
        }
    %>
    <div class="fondo">
        <mi-menu></mi-menu>
        <div class="container mt-5 elemento">
            <h2 class="text-center mb-4">Mis pedidos</h2>
            <div class="card2 shadow-sm">
                <div class="card2-body">
                    <h2 class="mb-3 centrado remarcar">Mis Pedidos</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Pedido</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            <% for (Pedido pedido : pedidos) { %>
                                <tr>
                                    <td><%= pedido.getCodigo() %></td>
                                    <td><%= pedido.getFecha() %></td>
                                    <td><%= pedido.getImporte() %></td>
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
                                    <td><%= estado %></td>
                                    <td><a href="pedido_detalle.jsp?codigopedido=<%= pedido.getCodigo() %>" class="btn btn-info">Ver Detalles</a></td>
                                </tr>
                            <% } %>
                        </tbody>
                    </table>
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