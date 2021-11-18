@extends('layouts.layout')

@section('content')
<div class="row mt--2">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-header">
                    <div class="card-head-row">
                        <div class="card-title">Grafica de Dirección</div>
                        <div class="card-tools">
                            <button style="display: none;" id="boton-actualizar" class="btn btn-icon btn-link btn-primary btn-xs"><span class="fa fa-sync-alt"></span></button>
                        </div>
                    </div>
                </div>
                
                <div class="card-category">
                    <form class="row">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rango de fechas</span>
                                </div>
                                <input id="fecha" type="text" name="fechas" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <button id="buscar" class="btn btn-primary mb-3" type="button">Aplicar</button>
                        </div>
                    </form>
                </div>
                    <div class="chart-container" id="direccion-chart-container">
                        <canvas id="direccionChart"></canvas>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        var API_URL = "http://localhost:8000/"
        var direccionChart = document.getElementById('direccionChart').getContext('2d')
        var botonBuscar = document.getElementById('buscar')
        var botonActualizar = document.getElementById('boton-actualizar')
        var datos = []
        var labels = []
        var variables = []
        var chart
        var actualizar = true

        function onInit() {
            let inicio = moment().subtract(30, 'minutes').format('YYYY-MM-DD HH:mm:ss')
            let final = moment().format('YYYY-MM-DD HH:mm:ss')
            selectorFecha(inicio, final)
            obtenerDatos(inicio, final).then(datos => {
                variables = datos
                grafica()
            })
        }

        function actualizarGrafica() {
            let inicio = moment().subtract(30, 'minutes').format('YYYY-MM-DD HH:mm:ss')
            let final = moment().format('YYYY-MM-DD HH:mm:ss')
            selectorFecha(inicio, final)
            obtenerDatos(inicio, final).then(datos => {
                variables = datos
                chart.destroy()
                grafica()
            })
        }

        function selectorFecha(inicio, final) {
            $('input[name="fechas"]').daterangepicker({
                timePicker: true,
                startDate: inicio,
                endDate: final,
                locale: {
                format: 'YYYY-MM-DD HH:mm:ss'
                }
            });
        }

        async function obtenerDatos(inicio, final) {
            const response = await fetch(API_URL + 'variables?inicio=' + inicio + '&final=' + final)
            return response.json()
        }

        function aplicarFiltro() {
            actualizar = false
            let fechaTexto = document.querySelector('input[name=fechas]').value
            let fechas = fechaTexto.split(' - ')
            obtenerDatos(fechas[0], fechas[1]).then(datos => {
                botonActualizar.style.display = ""
                variables = datos
                chart.destroy()
                grafica()
            })
        }

        function grafica() {
            
            const footer = (tooltipItems) => {
                let fecha 
                let valor

                tooltipItems.forEach(function(tooltipItem) {
                    fecha = moment(tooltipItem.xLabel)
                    fecha.locale('es')
                    valor = tooltipItem.yLabel
                });
                return 'El día ' + fecha.format('dddd') + ' ' + fecha.format('DD') + 
                ' de ' + fecha.format('MMMM')
                + ' de ' + fecha.format('YYYY') + ' a las ' + fecha.format('h:mm:ss a') + 
                ', la estación registro una Direccion de ' + valor;
            };

            datos = []
            labels = []
            variables.forEach(element => {
                datos.push(element.direccion)
                labels.push(element.fecha)
            })

            chart = new Chart(direccionChart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Dirección",
                        borderColor: "#1d7af3",
                        pointBorderColor: "#FFF",
                        pointBackgroundColor: "#1d7af3",
                        pointBorderWidth: 2,
                        pointHoverRadius: 4,
                        pointHoverBorderWidth: 1,
                        pointRadius: 4,
                        backgroundColor: 'transparent',
                        fill: true,
                        borderWidth: 2,
                        data: datos
                    }]
                },
                options : {
                    responsive: true, 
                    maintainAspectRatio: false,
                    legend: {
                        position: 'bottom',
                        labels : {
                            padding: 10,
                            fontColor: '#1d7af3',
                        }
                    },
                    tooltips: {
                        bodySpacing: 4,
                        mode:"nearest",
                        intersect: 0,
                        position:"nearest",
                        xPadding:10,
                        yPadding:10,
                        caretPadding:10,
                        callbacks: {
                            footer: footer
                        }
                    }
                }
            });
        }

        botonBuscar.addEventListener("click", function (){
            aplicarFiltro()
        })

        botonActualizar.addEventListener("click", function() {
            actualizar = true
            actualizarGrafica()
            botonActualizar.style.display = "none"
        })

        window.onload = onInit()
        setInterval(() => {
            if(actualizar) {
                actualizarGrafica()
            }
        }, 60000);

    </script>
@endsection