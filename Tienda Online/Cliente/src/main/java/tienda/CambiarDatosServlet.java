package tienda;

import java.io.IOException;
import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import jakarta.servlet.http.HttpSession;


public class CambiarDatosServlet extends HttpServlet {
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String nombre = request.getParameter("nombre");
        String apellidos = request.getParameter("apellidos");
        String email = request.getParameter("email");
        String telefono = request.getParameter("telefono");
        String password = request.getParameter("password");
        String domicilio = request.getParameter("domicilio");
        String localidad = request.getParameter("localidad");
        String provincia = request.getParameter("provincia");
        String cp = request.getParameter("cp");

        HttpSession session = request.getSession(false);
        AccesoBD accesoBD = AccesoBD.getInstance();

        System.out.println("Datos recibidos: " + nombre + ", " + apellidos + ", " + email + ", " + telefono + ", " + password + ", " + domicilio + ", " + localidad + ", " + provincia + ", " + cp);

        if (nombre != null && apellidos != null && email != null && password != null && telefono != null && domicilio != null && localidad != null && provincia != null && cp != null) {
            int codigo = (int) session.getAttribute("codigo");
            accesoBD.actualizarUsuario(codigo, nombre, apellidos, telefono, email, domicilio, localidad, provincia, cp);
            session.setAttribute("mensaje", "Datos actualizados correctamente");
        } else {
            session.setAttribute("mensaje", "Error al actualizar los datos");
        }
        request.getRequestDispatcher("datos_usuario.jsp").forward(request, response);
    }
}
