const bntCrearUsuario = document.querySelector("#btnCrearUsuario");
const formCrear = document.querySelector("#formCrear");
const inputNombre = document.querySelector(".nombre");
const inputCorreo = document.querySelector(".correo");
const inputPass = document.querySelector(".password");
const inputRol = document.querySelector(".rol");
const divErrores = document.querySelector(".alerta");
let errores = [];
/*Validar formulario antes de enviar */
bntCrearUsuario.addEventListener('click', function (e) {
    errores = [];
    divErrores.innerHTML = "";
    if (!inputNombre.value) {
        errores.push("El nombre no puede estar vacio");
    } if (!inputPass.value) {
        errores.push("La contraseña no puede estar vacia");
    } if (!inputCorreo.value) {
        errores.push("El Correo no puede estar vacio");
    } if (!inputRol.value) {
        errores.push("El Rol del usuario no puede estar vacio");
    } if (errores.length > 0) {
        console.log(errores)
        errores.forEach(error => {
            let p = document.createElement('p');
            p.textContent = error;
            divErrores.appendChild(p);
        });

    } else {
        formCrear.submit();
    }
});


$(document).ready(function () {
    $('#tablaUsuarios').DataTable({
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
