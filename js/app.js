const calendario = document.querySelector("#fechaConsultas");
const tVentas = document.querySelector(".TotalVentas");
const nVentas = document.querySelector(".nVentas");
const nProductos = document.querySelector(".nProductos");



document.addEventListener('DOMContentLoaded', function (e) {
    let fechaHoy = document.querySelector("#fechaHoy");

    fetch(`pintarDashboard.php?fecha=${fechaHoy.textContent}`)
        .then(response => response.json())
        .then(data => pintarDashboard(data))
});


let myChart;
let myChart2;

calendario.addEventListener('change', function (e) {
    console.log(calendario.value)
    fetch(`pintarDashboard.php?fecha=${calendario.value}`)
        .then(response => response.json())
        .then(data => pintarDashboard(data))

});
const pintarDashboard = e => {
    console.log(e)
    tVentas.textContent = (JSON.parse(e.ventaDia).Totalventas);
    nVentas.textContent = e.nVentas;
    nProductos.textContent = e.nProductos;
    pintarGrafica(e);
}

const pintarGrafica = e => {
    let arrProducto = [];
    let arrCantidad = [];
    Object.values(JSON.parse(e.ProductosmasVendidos)).forEach(producto => {
        arrProducto.push(producto.producto)
        arrCantidad.push(producto.totalCantida)
    });
    if (myChart) {
        myChart.destroy();
    }
    if (myChart2) {
        myChart2.destroy();
    }
    const ctx = document.getElementById('grafica_1').getContext('2d');

    myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: arrProducto,
            datasets: [{
                label: 'Productos',
                data: arrCantidad,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });


    let arrNombre = [];
    let arrTotalVendido = [];
    
    Object.values(JSON.parse(e.usuariosmasVendidos)).forEach(usuario => {
        arrNombre.push(usuario.nombre);
        arrTotalVendido.push(usuario.precio);
    });
    const ctx2 = document.getElementById('grafica_2').getContext('2d');

    myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: arrNombre,
            datasets: [{
                label: 'Usuarios',
                data: arrTotalVendido,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

}
