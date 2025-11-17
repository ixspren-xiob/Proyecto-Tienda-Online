package tienda;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public final class AccesoBD {

	private static AccesoBD instanciaUnica = null;
	private Connection conexionBD = null;

	public static AccesoBD getInstance(){
		if (instanciaUnica == null){
			instanciaUnica = new AccesoBD();
		}
		return instanciaUnica;
	}

	private AccesoBD() {
		abrirConexionBD();
	}

	public void abrirConexionBD() {
		if (conexionBD == null)
		{
			String JDBC_DRIVER = "org.mariadb.jdbc.Driver";
			// daw es el nombre de la base de datos que hemos creado con anterioridad.
			String DB_URL = "jdbc:mariadb://localhost:3406/daw";
			// El usuario root y su clave son los que se puso al instalar MariaDB.
			String USER = "root";
			String PASS = "DawLab";
			try {
				Class.forName(JDBC_DRIVER);
				conexionBD = DriverManager.getConnection(DB_URL,USER,PASS);
			}
			catch(Exception e) {
				System.err.println("No se ha podido conectar a la base de datos");
				System.err.println(e.getMessage());
				e.printStackTrace();
			}
		}
	}
    public boolean comprobarAcceso() {
		abrirConexionBD();
		return (conexionBD != null);
	}

	public List<ProductoBD> obtenerProductosBD(){
		abrirConexionBD();
		ArrayList<ProductoBD> productos = new ArrayList<>();

		try {
			String query = "SELECT codigo,nombre,precio,stock,imagen,sinopsis, autor FROM productos";
			PreparedStatement s = conexionBD.prepareStatement(query);
			ResultSet resultado = s.executeQuery();
			while (resultado.next()){
				ProductoBD producto = new ProductoBD();
				producto.setCodigo(resultado.getInt("codigo"));
				producto.setNombre(resultado.getString("nombre"));
				producto.setPrecio(resultado.getFloat("precio"));
				producto.setStock(resultado.getInt("stock"));
				producto.setImagen(resultado.getString("imagen"));
				producto.setSinopsis(resultado.getString("sinopsis"));
				producto.setAutor(resultado.getString("autor"));
				productos.add(producto);
			}
		}catch (Exception e){
			System.err.println("Error ejecutando la consulta a la base de datos");
			System.err.println(e.getMessage());
		}

		return productos;

	}

	public ProductoBD obtenerProductoBD(int codigo){
		abrirConexionBD();
		ProductoBD producto = null;
		try {
			String query = "SELECT codigo,nombre,precio,stock,imagen,sinopsis, autor FROM productos WHERE codigo=?";
			PreparedStatement s = conexionBD.prepareStatement(query);
			s.setInt(1,codigo);
			ResultSet resultado = s.executeQuery();
			if (resultado.next()){
				producto = new ProductoBD();
				producto.setCodigo(resultado.getInt("codigo"));
				producto.setNombre(resultado.getString("nombre"));
				producto.setPrecio(resultado.getFloat("precio"));
				producto.setStock(resultado.getInt("stock"));
				producto.setImagen(resultado.getString("imagen"));
				producto.setSinopsis(resultado.getString("sinopsis"));
				producto.setAutor(resultado.getString("autor"));
			}
		}catch (Exception e){
			System.err.println("Error ejecutando la consulta a la base de datos");
			System.err.println(e.getMessage());
		}
		return producto;
	}

	//comprobarUsuario(email, password)
	public int comprobarUsuario(String email, String password){
		abrirConexionBD();
		int codigo = -1;

		try{
			String con = "SELECT codigo FROM usuarios WHERE email=? AND password=?";
			PreparedStatement s = conexionBD.prepareStatement(con);
			s.setString(1,email);
			s.setString(2,password);

			ResultSet resultado = s.executeQuery();

			if(resultado.next()){
				codigo = resultado.getInt("codigo");
			}
		}catch (Exception e){
			System.err.println("Error ejecutando la consulta a la base de datos");
			System.err.println(e.getMessage());
			e.printStackTrace();
		}

		return codigo;
	}

	public int registrarUsuario(String email, String password, String nombre, String apellidos, String domicilio, String poblacion, String provincia, String cp, String telefono){
		abrirConexionBD();
		int codigo = -1;

		try{
			String con = "INSERT INTO usuarios (email,password,nombre,apellidos,domicilio,poblacion,provincia,cp,telefono, admin, activo) VALUES (?,?,?,?,?,?,?,?,?, ?,?)";
			PreparedStatement s = conexionBD.prepareStatement(con, Statement.RETURN_GENERATED_KEYS);
			s.setString(1,email);
			s.setString(2,password);
			s.setString(3,nombre);
			s.setString(4,apellidos);
			s.setString(5,domicilio);
			s.setString(6,poblacion);
			s.setString(7,provincia);
			s.setString(8,cp);
			s.setString(9,telefono);
			s.setInt(10,0 );
			s.setInt(11,1 );


			int filasAfectadas = s.executeUpdate();
			if (filasAfectadas > 0){
				ResultSet resultado = s.getGeneratedKeys();
				if (resultado.next()){
					codigo = resultado.getInt(1);
				}
			}
		}catch (Exception e){
			System.err.println("Error ejecutando la consulta a la base de datos");
			System.err.println(e.getMessage());
			e.printStackTrace();
		}

		return codigo;
	}

	public int obtenerStock(int codigo){
		abrirConexionBD();
		int stock = -1;

		ProductoBD producto = obtenerProductoBD(codigo);
		if (producto != null){
			stock = producto.getStock();
		}
		else {
			System.err.println("Error al obtener el stock del producto con codigo " + codigo);
		}
	
		return stock;
	}

	public Usuario obtenerUsuario(int codigo){
		abrirConexionBD();
		Usuario usuario = null;
		try {
			String query = "SELECT codigo,email,password,activo,admin,nombre,apellidos,domicilio,poblacion,provincia,cp,telefono FROM usuarios WHERE codigo=?";
			PreparedStatement s = conexionBD.prepareStatement(query);
			s.setInt(1,codigo);
			ResultSet resultado = s.executeQuery();
			if (resultado.next()){
				usuario = new Usuario();
				usuario.setCodigo(resultado.getInt("codigo"));
				usuario.setEmail(resultado.getString("email"));
				usuario.setPassword(resultado.getString("password"));
				usuario.setActivo(resultado.getInt("activo"));
				usuario.setAdmin(resultado.getInt("admin"));
				usuario.setNombre(resultado.getString("nombre"));
				usuario.setApellidos(resultado.getString("apellidos"));
				usuario.setDomicilio(resultado.getString("domicilio"));
				usuario.setPoblacion(resultado.getString("poblacion"));
				usuario.setProvincia(resultado.getString("provincia"));
				usuario.setCp(resultado.getString("cp"));
				usuario.setTelefono(resultado.getString("telefono"));
			}
		}catch (Exception e){
			System.err.println("Error ejecutando la consulta a la base de datos");
			System.err.println(e.getMessage());
			e.printStackTrace();
		}
		return usuario;
	}

	public void nuevoPedido(Usuario usuario, List<Producto> carritoJSON, float importe){
		abrirConexionBD();
		try {
			String query = "INSERT INTO pedidos (persona, fecha, domicilio, localidad, provincia, cp, importe, estado) VALUES (?,?,?,?,?,?,?,?)";
			PreparedStatement s = conexionBD.prepareStatement(query, Statement.RETURN_GENERATED_KEYS);
			s.setInt(1,usuario.getCodigo());
			s.setDate(2,new java.sql.Date(System.currentTimeMillis()));
			s.setString(3,usuario.getDomicilio());
			s.setString(4,usuario.getPoblacion());
			s.setString(5,usuario.getProvincia());
			s.setString(6,usuario.getCp());
			s.setFloat(7,importe);
			s.setInt(8, 1);
			int filasAfectadas = s.executeUpdate();
			if (filasAfectadas > 0){
				ResultSet resultado = s.getGeneratedKeys();
				if (resultado.next()){
					int codigoPedido = resultado.getInt(1);
					for (Producto producto : carritoJSON){
						String query2 = "INSERT INTO detalle (codigo_pedido, codigo_producto, unidades) VALUES (?,?,?)";
						PreparedStatement s2 = conexionBD.prepareStatement(query2);
						s2.setInt(1,codigoPedido);
						s2.setInt(2,producto.getCodigo());
						s2.setInt(3,producto.getCantidad());
						s2.executeUpdate();
					}
				}
			}
		}catch (Exception e){
			System.err.println("Error ejecutando la consulta a la base de datos");
			System.err.println(e.getMessage());
			e.printStackTrace();
		}
	}

	public void actualizarUsuario(int codigo, String nombre, String apellidos, String telefono, String email, String domicilio, String poblacion, String provincia, String cp){
		abrirConexionBD();
		try {
			String query = "UPDATE usuarios SET nombre=?, apellidos=?, telefono=?, email=?, domicilio=?, poblacion=?, provincia=?, cp=? WHERE codigo=?";
			PreparedStatement s = conexionBD.prepareStatement(query);
			s.setString(1,nombre);
			s.setString(2,apellidos);
			s.setString(3,telefono);
			s.setString(4,email);
			s.setString(5,domicilio);
			s.setString(6,poblacion);
			s.setString(7,provincia);
			s.setString(8,cp);
			s.setInt(9,codigo);
			s.executeUpdate();
		} catch (Exception e){
			System.err.println("Error ejecutando la consulta a la base de datos");
			System.err.println(e.getMessage());
			e.printStackTrace();
		}
	}

	public List<Pedido> obtenerPedidosUsuario(int codigo){
		abrirConexionBD();
		ArrayList<Pedido> pedidos = new ArrayList<>();

		try {
			String query = "SELECT codigo, fecha, importe, estado FROM pedidos WHERE persona=?";
			PreparedStatement s = conexionBD.prepareStatement(query);
			s.setInt(1,codigo);
			ResultSet resultado = s.executeQuery();
			while (resultado.next()){
				Pedido pedido = new Pedido();
				pedido.setCodigo(resultado.getInt("codigo"));
				pedido.setFecha(resultado.getDate("fecha"));
				pedido.setImporte(resultado.getFloat("importe"));
				pedido.setEstado(resultado.getInt("estado"));
				pedidos.add(pedido);
			}
		}catch (Exception e){
			System.err.println("Error ejecutando la consulta a la base de datos pedidosusuario");
			System.err.println(e.getMessage());
		}

		return pedidos;
	}
	public Pedido obtenerPedido(int codigo){
    abrirConexionBD();
    Pedido pedido = null;

    try {
        String query = "SELECT codigo, fecha, importe, estado, domicilio, localidad, provincia, cp FROM pedidos WHERE codigo=?";
        PreparedStatement s = conexionBD.prepareStatement(query);
        s.setInt(1, codigo);
        ResultSet resultado = s.executeQuery();

        if (resultado.next()){
            pedido = new Pedido();
            pedido.setCodigo(resultado.getInt("codigo"));
            pedido.setFecha(resultado.getDate("fecha"));
            pedido.setImporte(resultado.getFloat("importe"));
            pedido.setEstado(resultado.getInt("estado"));
            pedido.setDomicilio(resultado.getString("domicilio"));
            pedido.setLocalidad(resultado.getString("localidad"));
            pedido.setProvincia(resultado.getString("provincia"));
            pedido.setCp(resultado.getString("cp"));
        }

    } catch (Exception e){
        System.err.println("Error ejecutando la consulta a la base de datos");
        System.err.println(e.getMessage());
    }

    return pedido;
}


	public List<Producto> obtenerProductosPedido(int codigo){
    abrirConexionBD();
    List<Producto> productos = new ArrayList<>();

    try {
        String query = "SELECT codigo_producto, unidades FROM detalle WHERE codigo_pedido=?";
        PreparedStatement s = conexionBD.prepareStatement(query);
        s.setInt(1, codigo);
        ResultSet resultado = s.executeQuery();

        while (resultado.next()) {
            int codigoProducto = resultado.getInt("codigo_producto");
            int unidades = resultado.getInt("unidades");

            ProductoBD productoBD = obtenerProductoBD(codigoProducto); // <--- Aquí estaba el fallo
            if (productoBD != null) {
                Producto producto = new Producto();
                producto.setCodigo(productoBD.getCodigo());
                producto.setNombre(productoBD.getNombre());
                producto.setSinopsis(productoBD.getSinopsis());
                producto.setPrecio(productoBD.getPrecio());
                producto.setImagen(productoBD.getImagen());
                producto.setCantidad(unidades); // ← cantidad del pedido
                producto.setAutor(productoBD.getAutor());
                productos.add(producto);
            }
        }
    } catch (Exception e) {
        System.err.println("Error ejecutando la consulta a la base de datos Obtener");
        System.err.println(e.getMessage());
    }

    return productos;
	}

	public void modificarEstadoPedido(int codigo, int estado){
		abrirConexionBD();
		try {
			String query = "UPDATE pedidos SET estado=? WHERE codigo=?";
			PreparedStatement s = conexionBD.prepareStatement(query);
			s.setInt(1,estado);
			s.setInt(2,codigo);
			s.executeUpdate();
		} catch (Exception e){
			System.err.println("Error ejecutando la consulta a la base de datos");
			System.err.println(e.getMessage());
		}
	}

	public void modificarStock(int codigo, int stock){
		abrirConexionBD();
		try{
			String query = "UPDATE productos SET stock=? WHERE codigo=?";
			PreparedStatement s = conexionBD.prepareStatement(query);
			s.setInt(1,stock);
			s.setInt(2,codigo);
			s.executeUpdate();
		} catch (Exception e){
			System.err.println("Error ejecutando la consulta a la base de datos");
			System.err.println(e.getMessage());
		}
	}
}