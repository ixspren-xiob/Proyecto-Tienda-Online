class Cabecera extends HTMLElement {
    constructor() {
        super()
        this.innerHTML = `<header><h1 class="centrado remarcar">La Ciudad del Libro - Zona Jefe Supremo</h1></header>`
    }
}
window.customElements.define('mi-cabecera', Cabecera);

class Pie extends HTMLElement {
    constructor() {
        super()
        this.innerHTML = `<footer>&copy; 2025 - Eric Tejedor Boix - Universitat de València</footer>    
        `
    }
}
window.customElements.define('mi-pie', Pie);

class Menu extends HTMLElement {
    constructor() {
        super()
        this.innerHTML = `  <nav class="navbar navbar-expand-lg navbar-light bg-light">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                    </button>
                                <div class="collapse navbar-collapse" id="navbarNav">
                                    <ul class="navbar-nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="../control/ListarPedidos.php">Pedidos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../control/ListarProductos.php">Productos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../control/ListarUsuarios.php">Usuarios</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="../control/Logout.php">Cerrar Sesión</a>
                                        </li>    
                                    </ul>
                                </div>
                            </nav>     
        `
    }
}
window.customElements.define('mi-menu', Menu);
