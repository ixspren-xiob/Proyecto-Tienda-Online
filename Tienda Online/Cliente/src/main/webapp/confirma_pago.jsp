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
    %>
    <script>
        localStorage.setItem("redirectUrl", window.location.href);
    </script>
    <%
            response.sendRedirect("usuario.jsp");
            return;
        }

        int codigoUsuario = (Integer) session.getAttribute("codigo");
        Usuario usuario = con.obtenerUsuario(codigoUsuario);
    %>

    <div class="fondo">
        <mi-menu></mi-menu>
        
        <div class="container mt-5 elemento">
            <h2 class="text-center mb-4">Confirmación de Pago</h2>

            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title">Resumen del Pedido</h3>
                    <div class="elemento">
                        <table class="table table-striped table-bordered text-center" id="tablaCarritoResguardo">
                            <thead class="table-dark">
                                <th>Título</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                            </thead>
                            <tbody id="cuerpoCarritoResguardo"></tbody>
                            <tfoot class="table-secondary">
                                <tr class="fw-bold">
                                    <td colspan="3">Total</td>
                                    <td id="precioTotalResguardo">$0.00</td>
                                </tr>
                            </tfoot>
                        </table>
                            <table class="table table-striped table-bordered text-center">
                                <thead class="table-dark">
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>E-mail</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>
                                    <th>Población</th>
                                    <th>Provincia</th>
                                    <th>Código Postal</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><input type="text" class="form-control" id="nombre" name="nombre" value="<%=usuario.getNombre()%>" disabled></td>
                                        <td><input type="text" class="form-control" id="apellidos" name="apellidos" value="<%=usuario.getApellidos()%>" disabled></td>
                                        <td><input type="email" class="form-control" id="email" name="email" value="<%=usuario.getEmail()%>" disabled></td>
                                        <td><input type="text" class="form-control" id="telefono" name="telefono" value="<%=usuario.getTelefono()%>" disabled></td>
                                        <td><input type="text" class="form-control" id="domicilio" name="domicilio" value="<%=usuario.getDomicilio()%>" disabled></td>
                                        <td><input type="text" class="form-control" id="poblacion" name="poblacion" value="<%=usuario.getPoblacion()%>" disabled></td>
                                        <td><input type="text" class="form-control" id="provincia" name="provincia" value="<%=usuario.getProvincia()%>" disabled></td>
                                        <td><input type="text" class="form-control" id="cp" name="cp" value="<%=usuario.getCp()%>" disabled></td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="text-muted centrado">¡Gracias por comprar con nosotros! Por favor, revise los detalles de su pedido antes de finalizar su compra.</p>
                            <div class="text-center">
                                <button type="button" class="btn btn-success me-2" onclick="EnviarCarrito('ProcesarPedido.html')">Finalizar Compra</button>
                            </div>
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
    function EnviarCarrito(url) {
        const valores = localStorage.getItem("carrito-guardado");

        if (!valores || valores === "[]") {
            alert("El carrito está vacío.");
            return false;
        }

        const options = {
            method: "POST",
            headers: {
                "Content-Type": "application/json; charset=utf-8"
            },
            body: valores
        };

        fetch(url, options)
            .then(response => response.text())
            .then(data => {
                document.body.innerHTML = data;
                localStorage.removeItem("carrito-guardado");
                localStorage.removeItem("precio_total");
            })
            .catch(error => console.error("Error al enviar el carrito:", error));

        return false; // Para evitar que el botón haga submit
    }

    window.addEventListener("DOMContentLoaded", () => {
        mostrarResguardoCarrito();
    });
</script>


</body>
</html>