const grafica_b = document.querySelectorAll('.grafica_b')[0];
const grafica_b1 = document.querySelectorAll('.grafica_b')[1];
const fecha_1 = document.querySelector("#fecha_1");
const fecha_2 = document.querySelector("#fecha_2");
const fecha_3 = document.querySelector("#fecha_3");
const fecha_4 = document.querySelector("#fecha_4");

let fecha = new Date();

let mes = fecha.getMonth() + 1;
if (mes < 10) {
    mes = "0" + mes;
}

let hoy = String(fecha.getFullYear() + "-" + mes + "-" + fecha.getDate());

fecha_1.addEventListener('change', function (e) {
    if (!fecha_2.value) {
        fecha_2.value = hoy;
    }

    getData(fecha_1.value, fecha_2.value, 'metrica_1');

});

fecha_2.addEventListener('change', function (e) {
    if (fecha_1.value) {
        getData(fecha_1.value, fecha_2.value, 'metrica_1');
    }

});


fecha_3.addEventListener('change', function (e) {
    if (!fecha_4.value) {
        fecha_4.value = hoy;
    }

    getData(fecha_3.value, fecha_4.value, 'metrica_2');
});

fecha_4.addEventListener('change', function (e) {
    if (fecha_3.value) {
        getData(fecha_3.value, fecha_4.value, 'metrica_2');
    }

});



async function getData(fecha_1, fecha_2, idCanvas) {
    const response = await fetch(`pintarComparativas.php?fecha_1=${fecha_1}&fecha_2=${fecha_2}`)
    const datos = await response.json();
    pintarGrafica(datos, idCanvas);
}


const pintarGrafica = (data, IdCanvas) => {
    let nVentas = [];
    let fechas = [];

    Object.values(data).forEach(datos => {
        fechas.push(datos.fecha);
        nVentas.push(datos.VentasTotales);
    });


    document.getElementById(`${IdCanvas}`).remove();
    element = document.createElement('canvas');
    element.id = IdCanvas;
    if (IdCanvas == "metrica_1") {
        grafica_b.appendChild(element)
    } else if (IdCanvas == "metrica_2") {
        grafica_b1.appendChild(element)
    }

    instancia = document.getElementById(IdCanvas).getContext('2d');
    myChart = new Chart(instancia, {
        type: 'line',
        data: {
            labels: fechas,
            datasets: [{
                label: 'Metricas',
                data: nVentas,
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


