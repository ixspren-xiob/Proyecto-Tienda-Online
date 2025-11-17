package tienda;

import java.io.IOException;
import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import jakarta.servlet.http.HttpSession;

public class LoginServlet extends HttpServlet {
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        String email = request.getParameter("login-email");
        String password = request.getParameter("login-password");
        String url = request.getParameter("url");

        //mandamos mensaje a la consola
        System.out.println("Email: " + email);
        System.out.println("Password: " + password);
        HttpSession session = request.getSession(true);
        AccesoBD accesoBD = AccesoBD.getInstance();

        if(accesoBD == null) {
            System.out.println("Error: No se pudo obtener la instancia de AccesoBD.");
        }

        if((email!= null) && (password != null)) {
           int codigo = accesoBD.comprobarUsuario(email, password);
           if (codigo>0){
                session.setAttribute("codigo", codigo);
                request.getRequestDispatcher(url).forward(request, response);
           } else {
            
                url = "usuario.jsp";
                request.setAttribute("mensaje", "Usuario y/o contraseña incorrectos");
                request.getRequestDispatcher(url).forward(request, response);
           }
        }
        else {
            url = "usuario.jsp";
            request.setAttribute("mensaje", "Usuario y/o contraseña nulos");
            request.getRequestDispatcher(url).forward(request, response);
        }
    }
}
