class Cabecera extends HTMLElement {
  constructor() {
    super();
    this.innerHTML = `<header><h1>La Ciudad del Libro</h1></header>`;
  }
}
window.customElements.define("mi-cabecera", Cabecera);

class Pie extends HTMLElement {
  constructor() {
    super();
    this.innerHTML = `<footer>&copy; 2025 - Eric Tejedor Boix - <a href="https://www.uv.es/">RRSS</a></footer>    
        `;
  }
}
window.customElements.define("mi-pie", Pie);

class Menu extends HTMLElement {
  constructor() {
    super();
    this.innerHTML = ` 
                    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
                        <div class="container-fluid">
                            <a class="navbar-brand" href="index.jsp">Logo</a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a class="nav-link" href="empresa.html">Quienes Somos</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="productos.jsp">Libros</a>
                                    </li>  
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Zona de Usuario</a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item" href="datos_usuario.jsp">Mis Datos</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="pedidos.jsp">Mis Pedidos</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="contacto.html">Contacto</a>
                                            </li>
                                            <li>
                                                <a class="dorpdown-item" href="carrito.html">Carrito</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>    
        `;
  }
}
window.customElements.define("mi-menu", Menu);
