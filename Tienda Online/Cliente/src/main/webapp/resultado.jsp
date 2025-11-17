<%@page language="java" contentType="text/html charset=UTF-8" import="prueba.*" pageEncoding="UTF-8" %>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>Formulario de prueba</title>
        <meta charset="UTF-8">
    </head>

    <body>
        <h2>Recibiendo los valores desde un Servlet</h2>
        <% String texto=(String)request.getAttribute("mensaje"); %>
        <h3><%=texto%></h3>
        <a href="formulario.html">Volver al formulario</a>
    </body>
</html>