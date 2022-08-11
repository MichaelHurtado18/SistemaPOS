const table = document.querySelector('.table');
const modalBody = document.querySelector(".modal-body")
const tBody = document.querySelector("#tbody")
const vendedor = document.querySelector("#vendedor")
const fecha = document.querySelector("#fecha")
const templateModal = document.querySelector("#templateModal").content;
const fragment = document.createDocumentFragment();


table.addEventListener('click', function (e) {
    if (e.target.classList.contains('btn')) {
        getData(e.target.getAttribute('dataset-id'));
    }
});


function getData(e) {
    tBody.innerHTML = '';
    fetch(`detalles.php?id=${e}`)
        .then(response => response.json())
        .then(data => pintarModal(data))
}


const pintarModal = data => {
    vendedor.textContent = data[0].nombre;
    fecha.textContent = data[0].fecha;
    Object.values(data).forEach(datos => {
        templateModal.querySelectorAll('td')[0].textContent = datos.productos;
        templateModal.querySelectorAll('td')[1].textContent = datos.cantidad;
        templateModal.querySelectorAll('td')[2].textContent = datos.precios;
        const clone = templateModal.cloneNode(true);
        fragment.appendChild(clone)
    })
    tBody.appendChild(fragment);
}



$(document).ready(function () {
    $('#tablVentas').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ Registros por pagina",
            "zeroRecords": "No se encontro información",
            "info": "Mostrando pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtered from _MAX_ total records)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Ultimo",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            }
        }
    });
});
