const iProducto = document.querySelector("#iProducto");
const eProducto = document.querySelector("#eProducto");
const templateCarrito = document.querySelector("#template-carrito").content;
const templateFooter = document.querySelector("#template-footer").content;
const items = document.querySelector("#items");
const fragment = document.createDocumentFragment();
const footer = document.querySelector("#footer");
const btnComprar = document.querySelector("#comprar");
const modal = document.querySelector("#close");
const alerta = document.querySelector("#alerta");
let carrito = {};



/*CUANDO SE DE CLICK EN FINALIZAR COMPRA SE ENVIA EL OBJETO CARRITO AL SERVIDOR PARA QUE CAMBIE EL STOCK EN LA BD */
btnComprar.addEventListener('click', e => {
    if (Object.keys(carrito).length != 0) {
        $.ajax({
            type: "POST",
            url: "cajero.php",
            data: carrito,
            success: function (e) {
                location.reload();
            }
        })
    } else {
        alerta.querySelector("h5").textContent = "Agregue productos al carrito";
    }
});

const eliminar = event => {
    if (event.keyCode == 13) {
        Object.values(carrito).find(producto => {
            if (producto.referencia == eProducto.value) {
                carrito[producto.id].cantidad -= 1;
                if (carrito[producto.id].cantidad == 0) {
                    delete carrito[producto.id];
                }
                modal.click();
                pintarCarrito();
                return
            }
        });
    }
}


/*ESTE CODIGO SE EJECUTA CUANDO SE INSERTA CON LA TECLA ENTER UN PRODUCTO AL CARRITO */
let hacer = event => {
    alerta.querySelector('h5').textContent = '';
    if (event.keyCode == 13) {
        let referencia = iProducto.value;
        /*LE ENVIAMOS AL SERVIDOR LA REFERENCIA DEL PRODUCTO QUE SE QUIERE INSERTAR SI ESA REFERENCIA EXISTE NOS DEVUELVE UN OBJETO CON LA INFORMACIÓN DEL PRODUCTO */
        let ajax = new XMLHttpRequest();
        ajax.open('GET', `buscProduct.php?producto=${referencia}`, true);
        ajax.setRequestHeader('Content-type', 'application/json; charset=utf-8');
        ajax.onreadystatechange = function () {
            if (ajax.readyState == 4) {
                if (ajax.status == 200) {
                    ajax.responseText;
                } else {
                    console.log('Error al conectar al Servidor')
                }
            }
        }
        ajax.send();
        ajax.onload = e => {
            let respuesta = ajax.response;
            if (respuesta == 'null') {
                alerta.querySelector('h5').textContent = 'Producto No Existe';
                return
            }
            if (JSON.parse(respuesta).cantidad == '0') {
                alerta.querySelector('h5').textContent = `El producto con la referencia ${JSON.parse(respuesta).referencia} ya supero el stock `;
                return
            }


            if (carrito.hasOwnProperty(JSON.parse(respuesta).id)) {

                if (carrito[JSON.parse(respuesta).id].cantidad < JSON.parse(respuesta).cantidad) {
                    carrito[JSON.parse(respuesta).id].cantidad += 1;
                } else {
                    alerta.querySelector("h5").textContent = `El producto  con la referencia ${carrito[JSON.parse(respuesta).id].referencia} ya supero su stock`;
                }
                pintarCarrito();
                return
            }
            carrito[JSON.parse(respuesta).id] = JSON.parse(respuesta);
            carrito[JSON.parse(respuesta).id].cantidad = 1;
            pintarCarrito();
        }

    };
}

const pintarCarrito = e => {
    items.innerHTML = '';
    Object.values(carrito).forEach(producto => {
        templateCarrito.querySelectorAll('td')[0].textContent = producto.referencia;
        templateCarrito.querySelectorAll('td')[1].textContent = producto.producto;
        templateCarrito.querySelectorAll('td')[2].textContent = producto.cantidad;
        templateCarrito.querySelectorAll('td')[3].textContent = (producto.precio * producto.cantidad).toFixed(3);
        const clone = templateCarrito.cloneNode(true);
        fragment.appendChild(clone);
    });
    items.appendChild(fragment);
    pintarFooter();
}


const pintarFooter = e => {
    footer.innerHTML = '';
    if (Object.values(carrito).length == 0) {
        footer.innerHTML = "<th scope='row' colspan='5'>Carrito Vacio</th>";
        return
    }
    const nCantidad = Object.values(carrito).reduce((acc, { cantidad }) => acc + cantidad, 0);
    const nPrecio = Object.values(carrito).reduce((acc, { cantidad, precio }) => acc += cantidad * precio, 0);
    templateFooter.querySelectorAll('td')[0].textContent = nCantidad;
    templateFooter.querySelectorAll('td')[1].textContent = nPrecio.toFixed(3);

    const clone = templateFooter.cloneNode(true);
    fragment.appendChild(clone);
    footer.appendChild(fragment);

}

