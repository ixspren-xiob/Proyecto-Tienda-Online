class ProductoCarrito{
    constructor(cod, desc, img, cant, pr, exist){
        this.cod = cod;
        this.desc = desc;
        this.img = img;
        this.cant = cant;
        this.pr = pr;
        this.exist= exist;
    }
}

let carrito = [];
let cambio = false;
let precio_total = 0.0;
carrito = null;

//let producto = new ProductoCarrito(1, "Elantris", "imagenes/elantris_ed_especial.jpg", 1, 20.0, 7);

//carrito.push(producto);


function cargarCarrito(){
    if(carrito == null){
        carrito = JSON.parse(localStorage.getItem("carrito-guardado"));
        if(carrito == null){
            carrito = [];
        } else {
            // Aseguramos que cant y pr sean números
            carrito.forEach(producto => {
                producto.cant = Number(producto.cant);
                producto.pr = Number(producto.pr);
                producto.exist = Number(producto.exist);
            });
        }
    }
}

function guardarCarrito(){
    localStorage.setItem("carrito-guardado", JSON.stringify(carrito));
    localStorage.setItem("precio_total", JSON.stringify(precio_total));
}

function anadirCarrito(id, titulo, portada, numero, precio_unitario, existencias){
    console.log("AñadirCarrito");
    cargarCarrito();
    cambio = false;
    let existe = false;
    let producto = new ProductoCarrito(id, titulo, portada, numero, precio_unitario, existencias);
    if (carrito.length > 0){
        for (let i = 0; i < carrito.length; i++){
            if (carrito[i].cod == id){
                existe = true;
                cambio = true;
                if (producto.cant <= carrito[i].exist){
                carrito[i].cant += numero;
                } else if(producto.cant > carrito[i].exist){
                    carrito[i].cant += carrito[i].exist;
                }
            }
        }
    }   
    if (!existe){
        cambio = true;
        if (producto.cant <= producto.exist){
            carrito.push(producto);
        } else if(producto.cant > producto.exist){
            numero = existencias;
            producto = new ProductoCarrito(id, titulo, portada, numero, precio_unitario, existencias);
            carrito.push(producto);
        }
        
    }
    alert(`✅ ¡"${titulo}" añadido al carrito!`);
    if (cambio){
        guardarCarrito();
    }
    cambio = false;
}

function modificarCantidad(id, cantidad){
    cambio = false;
    cargarCarrito();
    for (let i = 0; i < carrito.length; i++){
        if (carrito[i].cod == id){
            cambio = true;
            let total = carrito[i].exist + carrito[i].cant;
            if (cantidad <= total){
                carrito[i].cant = cantidad;
            } else if (cantidad > total){
                carrito[i].cant = total;
            }
        }
    }
    if(cambio){
        guardarCarrito();
    }
    cambio = false;
}

function eliminarProducto(id){
    cambio = false;
    cargarCarrito();
    for (let i = 0; i < carrito.length; i++){
        if(carrito[i].cod == id){
            cambio = true;
            carrito.splice(i, 1);
        }
    }
    if(cambio){
        guardarCarrito();
    }
    cambio = false;
}

function borraCarrito(){
    cargarCarrito();
    carrito = [];           // vaciar el carrito
    precio_total = 0.0;     // reiniciar total
    guardarCarrito();       // guardar cambios
    mostrarCarrito();       // actualizar la vista
    alert("🗑️ Carrito vaciado correctamente.");

}


function calcularPrecioTotal() {
    cargarCarrito();
    precio_total = 0.0; // ← RESET aquí
    for (let i = 0; i < carrito.length; i++) {
        precio_total += precio_subtotal(carrito[i].cod);
    }
    guardarCarrito();
    return precio_total; // ← así puedes usarlo directamente
}


function precio_subtotal(id){
    cargarCarrito();
    let subtotal = 0.0;
    for (let i = 0; i < carrito.length; i++){
        if(carrito[i].cod == id){
            subtotal += carrito[i].cant * carrito[i].pr;
        }
    }
    return subtotal;
}
function mostrarCarrito() {
    cargarCarrito();
    const cuerpoCarritoElemento = document.getElementById('cuerpoCarrito');
    const precioTotalElemento = document.getElementById('precioTotal');
    cuerpoCarritoElemento.innerHTML = '';

    if (carrito.length == 0) {
        cuerpoCarritoElemento.innerHTML = '<tr><td colspan="5">El carrito está vacío</td></tr>';
        precioTotalElemento.textContent = '$0.00';
        return;
    }

    for (let i = 0; i < carrito.length; i++) {
        const subt = precio_subtotal(carrito[i].cod);
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${carrito[i].desc}</td>
            <td>
                <input type="number" min="1" max="${carrito[i].exist}" value="${carrito[i].cant}" onchange="modificarCantidad(${carrito[i].cod}, parseInt(this.value || 0)); mostrarCarrito()">
            </td>
            <td>$${carrito[i].pr.toFixed(2)}</td>
            <td>$${subt.toFixed(2)}</td>
            <td>
                <button class="btn btn-sm btn-danger" onclick="eliminarProducto(${carrito[i].cod}); mostrarCarrito()">Eliminar</button>
            </td>
        `;
        cuerpoCarritoElemento.appendChild(row);
    }

    const total = calcularPrecioTotal(); // ← aquí recalculas
    precioTotalElemento.textContent = `$${total.toFixed(2)}`;
}

function mostrarResguardoCarrito() {
    cargarCarrito();  
    const cuerpoCarritoElemento = document.getElementById('cuerpoCarritoResguardo');
    const precioTotalElemento = document.getElementById('precioTotalResguardo');
    cuerpoCarritoElemento.innerHTML = '';

    if (carrito.length === 0) {
        cuerpoCarritoElemento.innerHTML = '<tr><td colspan="4">El carrito está vacío</td></tr>';
        precioTotalElemento.textContent = '$0.00';
        return;
    }

    let carritoActualizado = false;

    for (let i = 0; i < carrito.length; i++) {
        const totalDisponible = carrito[i].exist;

        if (carrito[i].cant > totalDisponible) {
            carrito[i].cant = totalDisponible;
            carritoActualizado = true;
        }

        const subt = precio_subtotal(carrito[i].cod); 
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${carrito[i].desc}</td>  
            <td>${carrito[i].cant}</td>  
            <td>$${carrito[i].pr.toFixed(2)}</td>  
            <td>$${subt.toFixed(2)}</td> 
        `;
        cuerpoCarritoElemento.appendChild(row);
    }

    const total = calcularPrecioTotal();
    precioTotalElemento.textContent = `$${total.toFixed(2)}`;

    if (carritoActualizado) {
        guardarCarrito();
    }
}

