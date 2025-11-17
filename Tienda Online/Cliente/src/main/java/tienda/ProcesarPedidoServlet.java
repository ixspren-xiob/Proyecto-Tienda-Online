package tienda;

import java.io.IOException;
import java.io.InputStreamReader;
import java.util.ArrayList;

import jakarta.servlet.RequestDispatcher;
import jakarta.servlet.ServletException;
import jakarta.servlet.http.HttpServlet;
import jakarta.servlet.http.HttpServletRequest;
import jakarta.servlet.http.HttpServletResponse;
import jakarta.servlet.http.HttpSession;

import jakarta.json.*;


public class ProcesarPedidoServlet extends HttpServlet{
    protected void doPost(HttpServletRequest request, HttpServletResponse response) throws ServletException, IOException {
        HttpSession session = request.getSession(true);
        int codigoUsuario = (Integer) session.getAttribute("codigo");
        

        if (session.getAttribute("carritoJSON") != null){
            session.removeAttribute("carritoJSON");
        }

        ArrayList<Producto> carritoJSON = new ArrayList<Producto>();
        AccesoBD accesoBD = AccesoBD.getInstance();
        Usuario usuario = accesoBD.obtenerUsuario(codigoUsuario);

        JsonReader jsonReader = Json.createReader(new InputStreamReader(
                request.getInputStream(), "utf-8"));
        JsonArray jobj = jsonReader.readArray();
        float importe = 0;

        for (int i = 0; i < jobj.size(); i++) {
            JsonObject prod = jobj.getJsonObject(i);
            Producto nuevo = new Producto();
            nuevo.setCodigo(prod.getInt("cod"));
            nuevo.setNombre(prod.getString("desc"));
            nuevo.setPrecio(Float.parseFloat(prod.get("pr").toString()));
            nuevo.setImagen(prod.getString("img"));

            int cantidad = prod.getInt("cant");
            int stock = accesoBD.obtenerStock(nuevo.getCodigo());

            if (cantidad > stock){
                cantidad = stock;
            } 
            if (cantidad > 0){
                nuevo.setCantidad(cantidad);
                carritoJSON.add(nuevo);
            }
            int resto = stock - cantidad;
            accesoBD.modificarStock(nuevo.getCodigo(), resto);

            importe += nuevo.getPrecio() * nuevo.getCantidad();
        }

        //Vemos el tamaño del carrito
        System.out.println("Tamaño del carrito: " + carritoJSON.size());
        request.setAttribute("importe", importe);
        request.setAttribute("carritoJSON", carritoJSON);
        if (carritoJSON.size() > 0){
            System.out.println("Carrito con productos");
        } else {
           System.out.println("Carrito vacío");
        }

        accesoBD.nuevoPedido(usuario, carritoJSON, importe);

        RequestDispatcher rd = request.getRequestDispatcher("resguardo.jsp");
        rd.forward(request, response);

    }
}
