const btnCrearProducto = document.querySelector("#btnCrearProducto");
const formCrear = document.querySelector("#formCrear");

btnCrearProducto.addEventListener('click', function (e) {
    formCrear.submit();
});




$(document).ready(function () {
    $('#tablaProductos').DataTable({
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

