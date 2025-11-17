class Cabecera extends HTMLElement {
    constructor() {
        super()
        this.innerHTML = `<header><h1>Logo Tienda - Administraci&oacute;n Tienda Virtual</h1></header>`
    }
}
window.customElements.define('mi-cabecera', Cabecera);

class Pie extends HTMLElement {
    constructor() {
        super()
        this.innerHTML = `<footer>&copy; 2024 - Programaci&oacute; Hipermedia</footer> 
        `
    }
}
window.customElements.define('mi-pie', Pie);

class Menu extends HTMLElement {
    constructor() {
        super()
        this.innerHTML = `<menu><ul>
                    <li><a href="../control/ListarUsuarios.php">Usuarios</a></li>
                    <li><a href="../control/ListarProductos.php">Productos</a></li>
                    <li><a href="#">Pedidos</a></li>
                    <li><a href="../control/Logout.php">Cerrar sesi&oacute;n</a></li>
                    </ul>
                    </menu>     
        `
    }
}
window.customElements.define('mi-menu', Menu);
