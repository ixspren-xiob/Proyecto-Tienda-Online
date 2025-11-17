package tienda;
import java.io.IOException;
import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import jakarta.servlet.http.HttpSession;

public class RegistroServlet extends HttpServlet {
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String email = request.getParameter("email");
        String password = request.getParameter("password");
        String nombre = request.getParameter("nombre");
        String apellidos = request.getParameter("apellidos");
        String domicilio = request.getParameter("domicilio");
        String poblacion = request.getParameter("poblacion");
        String provincia = request.getParameter("provincia");
        String cp = request.getParameter("cp");
        String telefono = request.getParameter("telefono");
        String url = request.getParameter("url");

        HttpSession session = request.getSession(true);
        AccesoBD accesoBD = AccesoBD.getInstance();

        if((email!= null) && (password != null)) {
            int codigo = accesoBD.registrarUsuario(email, password, nombre, apellidos, domicilio, poblacion, provincia, cp, telefono);
            if (codigo>0){
                session.setAttribute("codigo", codigo);
            } else {
                session.setAttribute("mensaje", "Error al registrar el usuario");
            }
        }

        request.getRequestDispatcher(url).forward(request, response);
    }
}
