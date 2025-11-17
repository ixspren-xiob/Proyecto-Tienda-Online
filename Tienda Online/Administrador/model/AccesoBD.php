<?php

class AccesoBD
{
    private static function conectar()
    {
       $bbdd = mysqli_connect("localhost:3406","root","DawLab","daw");
       if (mysqli_connect_error()) {
          printf("Error conectando a la base de datos: %s\n",mysqli_connect_error());
          exit();
       }
       return $bbdd;
    }
    
    private static function desconectar($bbdd)
    {
       mysqli_close($bbdd);
    }
    
    public static function comprobarUsuarioAdmin($login,$clave) {
        $bbdd = AccesoBD::conectar();
        $result = FALSE;
        
        if ($st = mysqli_prepare($bbdd, "SELECT * FROM usuarios WHERE email=? and password=? and admin=1")) {
            mysqli_stmt_bind_param($st,"ss",$login,$clave);
            mysqli_stmt_execute($st);
           
            $result=mysqli_stmt_fetch($st);
         
            AccesoBD::desconectar($bbdd);
        }
        
        return $result;
    }
    
    public static function obtenerListadoUsuarios() {
        
        $bbdd = AccesoBD::conectar();
         
        $usuarios= [];
        
        if ($resultado = mysqli_query($bbdd,"SELECT codigo, email, activo, admin  FROM usuarios")) {
            while ($fila = mysqli_fetch_array($resultado)) {
                array_push($usuarios, $fila);
            }
            
        }
        
        AccesoBD::desconectar($bbdd);
        
        return $usuarios;
    } 

    public static function obtenerListadoProductos() {
        $bbdd = AccesoBD::conectar();

        $productos= [];

        if ($resultado = mysqli_query($bbdd, "SELECT codigo, nombre, imagen, autor, precio, stock FROM productos")) {
            while($fila = mysqli_fetch_array($resultado)) {
                array_push($productos, $fila);
            }
        } 

        AccesoBD::desconectar($bbdd);

        return $productos;
    }

    public static function obtenerLIstadoPedidos(){
        $bbdd = AccesoBD::conectar();
        $pedidos = [];
        if($resultado = mysqli_query($bbdd, "SELECT codigo, persona, fecha, importe, estado, domicilio, localidad, provincia, cp FROM pedidos")) {
            while($fila = mysqli_fetch_array($resultado)){
                array_push($pedidos, $fila);
            }
        }
        AccesoBD::desconectar($bbdd);
        return $pedidos;
    }

    public static function obtenerProducto($id){
        $bbdd = AccesoBD::conectar();
        $producto = null;

        if ($resultado = mysqli_prepare($bbdd, "SELECT codigo, nombre, imagen, autor, precio, stock, sinopsis FROM productos WHERE codigo=?")) {
            mysqli_stmt_bind_param($resultado, "i", $id);
            mysqli_stmt_execute($resultado);
            mysqli_stmt_bind_result($resultado, $codigo, $nombre, $imagen, $autor, $precio, $stock, $sinopsis);

            if (mysqli_stmt_fetch($resultado)) {
                $producto = [
                    'codigo' => $codigo,
                    'nombre' => $nombre,
                    'imagen' => $imagen,
                    'autor' => $autor,
                    'precio' => $precio,
                    'stock' => $stock,
                    'sinopsis' => $sinopsis
                ];
            }

            mysqli_stmt_close($resultado);
        }

        AccesoBD::desconectar($bbdd);
        return $producto;
    }

    public static function modificarProducto($codigo, $nombre, $autor, $precio, $stock, $sinopsis) {
        $bbdd = AccesoBD::conectar();
        if($st = mysqli_prepare($bbdd, "UPDATE productos SET nombre=?, autor=?, precio=?, stock=?, sinopsis=? WHERE codigo=?")) {
            mysqli_stmt_bind_param($st, "ssdisi", $nombre, $autor, $precio, $stock, $sinopsis, $codigo);
            mysqli_stmt_execute($st);
            mysqli_stmt_close($st);
            AccesoBD::desconectar($bbdd);
            return true;
        }
        return false;
    }

    public static function eliminarProducto($codigo) {
        $bbdd = AccesoBD::conectar();
        if ($st = mysqli_prepare($bbdd, "DELETE FROM productos WHERE codigo = ?")) {
            mysqli_stmt_bind_param($st, "s", $codigo);
            mysqli_stmt_execute($st);
            mysqli_stmt_close($st);
            AccesoBD::desconectar($bbdd);
            return true;
        }
        return false;
    }

    public static function insertarProducto($nombre, $autor, $precio, $stock, $sinopsis) {
        $bbdd = AccesoBD::conectar();
        if ($st = mysqli_prepare($bbdd, "INSERT INTO productos (nombre, autor, precio, stock, sinopsis) VALUES (?, ?, ?, ?, ?)")) {
            mysqli_stmt_bind_param($st, "ssdis",  $nombre, $autor, $precio, $stock, $sinopsis);
            mysqli_stmt_execute($st);
            mysqli_stmt_close($st);
            AccesoBD::desconectar($bbdd);
            return true;
        }
        return false;
    }

    public static function toggleActivoUsuario($codigo) {
        $bbdd = AccesoBD::conectar();
        $query = "UPDATE usuarios SET activo = NOT activo WHERE codigo = ?";
        if ($st = mysqli_prepare($bbdd, $query)) {
            mysqli_stmt_bind_param($st, "i", $codigo);
            mysqli_stmt_execute($st);
            mysqli_stmt_close($st);
        }
        AccesoBD::desconectar($bbdd);
    }

    public static function eliminarUsuario($codigo) {
        $bbdd = AccesoBD::conectar();
        $query = "DELETE FROM usuarios WHERE codigo = ?";
        if ($st = mysqli_prepare($bbdd, $query)) {
            mysqli_stmt_bind_param($st, "i", $codigo);
            mysqli_stmt_execute($st);
            mysqli_stmt_close($st);
        }
        AccesoBD::desconectar($bbdd);
    }

    public static function cancelarPedido($id){
        $bbdd = AccesoBD::conectar();
        $query = "UPDATE pedidos SET estado = 4 WHERE codigo = ?";
        if ($st = mysqli_prepare($bbdd, $query)) {
            mysqli_stmt_bind_param($st, "i", $id);
            mysqli_stmt_execute($st);
            mysqli_stmt_close($st);
        }
        AccesoBD::desconectar($bbdd);
    }

    public static function modificarEstado($id, $estado){
        $bbdd = AccesoBD::conectar();
        $query = "UPDATE pedidos SET estado=? WHERE codigo=?";
        if ($st = mysqli_prepare($bbdd,$query)) {
            mysqli_stmt_bind_param($st, "ii", $estado, $id);
            mysqli_stmt_execute($st);
            mysqli_stmt_close($st);
        }
        AccesoBD::desconectar($bbdd);
    }

    public static function eliminarPedido($id) {
        $bbdd = AccesoBD::conectar();

        // 1. Eliminar detalles del pedido
        $query1 = "DELETE FROM detalle WHERE codigo_pedido = ?";
        if ($st1 = mysqli_prepare($bbdd, $query1)) {
            mysqli_stmt_bind_param($st1, "i", $id);
            mysqli_stmt_execute($st1);
            mysqli_stmt_close($st1);
        }

        // 2. Eliminar el pedido
        $query2 = "DELETE FROM pedidos WHERE codigo = ?";
        if ($st2 = mysqli_prepare($bbdd, $query2)) {
            mysqli_stmt_bind_param($st2, "i", $id);
            mysqli_stmt_execute($st2);
            mysqli_stmt_close($st2);
        }

        AccesoBD::desconectar($bbdd);
    }

    public static function obtenerUsuario($id){
        $bbdd = AccesoBD::conectar();
        $query = "SELECT * FROM usuarios WHERE codigo = ?";
        $usuario = null;
        if ($st = mysqli_prepare($bbdd, $query)) {
            mysqli_stmt_bind_param($st, "i", $id);
            mysqli_stmt_execute($st);
            mysqli_stmt_bind_result($st, $codigo, $email, $password, $activo, $admin, $nombre, $apellidos, $domicilio, $poblacion, $provincia, $cp, $telefono);
            if (mysqli_stmt_fetch($st)) {
                $usuario = [
                    'codigo' => $codigo,
                    'email' => $email,
                    'password' => $password,
                    'activo' => $activo,
                    'admin' => $admin,
                    'nombre' => $nombre,
                    'apellidos' => $apellidos,
                    'domicilio' => $domicilio,
                    'poblacion' => $poblacion,
                    'provincia' => $provincia,
                    'cp' => $cp,
                    'telefono' => $telefono
                ];
            }
            mysqli_stmt_close($st);
        }
        AccesoBD::desconectar($bbdd);
        return $usuario;
    }

    public static function obtenerPedido($id){
        $bbdd = AccesoBD::conectar();
        $query = "SELECT * FROM pedidos WHERE codigo = ?";
        $pedido = null;
        if($st = mysqli_prepare($bbdd, $query)) {
            mysqli_stmt_bind_param($st, "i", $id);
            mysqli_stmt_execute($st);
            mysqli_stmt_bind_result($st, $codigo, $persona, $fecha, $importe, $estado, $domicilio, $localidad, $provincia, $cp);
            if (mysqli_stmt_fetch($st)){
                $pedido = [
                    'codigo' => $codigo,
                    'persona' => $persona,
                    'fecha' => $fecha,
                    'importe' => $importe,
                    'estado' => $estado,
                    'domicilio' => $domicilio,
                    'localidad' => $localidad,
                    'provincia' => $provincia,
                    'cp' => $cp
                ];
            }
            mysqli_stmt_close($st);
        }
        AccesoBD::desconectar($bbdd);
        return $pedido;
    }

    public static function detallePedido($id){
        $bbdd = AccesoBD::conectar();
        $query = "SELECT * FROM detalle WHERE codigo_pedido=?";
        if ($st = mysqli_prepare($bbdd, $query)){
            mysqli_stmt_bind_param($st, "i", $id);
            mysqli_stmt_execute($st);
            $resultado = mysqli_stmt_get_result($st);
            //esto devuelve código_producto y cantidad, para cada producto quiero tener su cantidad
            $detalle = [];
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $detalle[] = $fila;
            }
            mysqli_stmt_close($st);
            AccesoBD::desconectar($bbdd);
            return $detalle;
        }
    }

    public static function modificarUsuario($codigo, $email, $password, $admin, $activo, $nombre, $apellidos, $domicilio, $poblacion, $provincia, $cp, $telefono) {
        $bbdd = AccesoBD::conectar();
        if ($st = mysqli_prepare($bbdd, "UPDATE usuarios SET email=?, password=?, admin=?, activo=?, nombre=?, apellidos=?, domicilio=?, poblacion=?, provincia=?, cp=?, telefono=? WHERE codigo=?")) {
            mysqli_stmt_bind_param($st, "ssiisssssssi", $email, $password, $admin, $activo, $nombre, $apellidos, $domicilio, $poblacion, $provincia, $cp, $telefono, $codigo);
            mysqli_stmt_execute($st);
            mysqli_stmt_close($st);
        }
        AccesoBD::desconectar($bbdd);
    }

    public static function filtroUsuarioPedidos($persona){
        $bbdd = AccesoBD::conectar();
        $query = "SELECT * FROM pedidos WHERE persona=?";
        if($st = mysqli_prepare($bbdd, $query)){
            mysqli_stmt_bind_param($st, "i", $persona);
            mysqli_stmt_execute($st);
            $resultado = mysqli_stmt_get_result($st);

            $pedidos=[];
            while($fila = mysqli_fetch_assoc($resultado)){
                array_push($pedidos, $fila);
            }
            mysqli_stmt_close($st);
            AccesoBD::desconectar($bbdd);
            return $pedidos;
        }
    }
    
    public static function filtroProductoPedidos($producto){
        $bbdd = AccesoBD::conectar();
        $query = "SELECT codigo_pedido FROM detalle WHERE codigo_producto=?";
        if($st = mysqli_prepare($bbdd, $query)){
            mysqli_stmt_bind_param($st, "i", $producto);
            mysqli_stmt_execute($st);
            $resultado = mysqli_stmt_get_result($st);

            $pedidos=[];
            while($fila = mysqli_fetch_assoc($resultado)){
                array_push($pedidos, AccesoBD::obtenerPedido($fila));
            }
            mysqli_stmt_close($st);
            AccesoBD::desconectar($bbdd);
            return $pedidos;
        }
    }

    public static function filtroFechaPedidos($fecha){
        $bbdd = AccesoBD::conectar();
        $query = "SELECT * FROM pedidos WHERE fecha=?";
        if($st = mysqli_prepare($bbdd, $query)){
            mysqli_stmt_bind_param($st, "s", $fecha);
            mysqli_stmt_execute($st);
            $resultado = mysqli_stmt_get_result($st);

            $pedidos=[];
            while($fila = mysqli_fetch_assoc($resultado)){
                array_push($pedidos, $fila);
            }
            mysqli_stmt_close($st);
            AccesoBD::desconectar($bbdd);
            return $pedidos;
      
        }
    }
}

?>
