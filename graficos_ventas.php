<!DOCTYPE html>
<html lang="es">
<head>
<a href='estadisticas.php'>Menu anterior</a>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas de Ventas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.css">
    <style>
     body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f0f5f5;
    color: #333;
}

a {
    color: #4285f4;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
    font-size: 28px;
}

canvas {
    margin: 0 auto;
    display: block;
    max-width: 800px;
    width: 100%;
    margin-bottom: 40px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

    </style>
</head>

<body>
    <h1>Estadísticas de Ventas</h1>

    <!-- Coloca el canvas para tu gráfico de ventas por cliente aquí -->
    <canvas id="ventasPorCliente"></canvas>

    <!-- Coloca el canvas para tu gráfico de productos más comprados aquí -->
    <canvas id="productosMasComprados"></canvas>

    <?php
    // Aquí va el código PHP para obtener los datos de ventas por cliente y productos más comprados
    require 'vendor/autoload.php';

    // Conectar a MongoDB
    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");

    // Obtener la colección de ventas
    $ventasCollection = $mongoClient->gestion_negocios->ventas;

    // Consulta para contar la frecuencia de cada cliente
    $pipelineClientes = [
        [
            '$group' => [
                '_id' => '$cliente',
                'count' => ['$sum' => 1]
            ]
        ],
        ['$sort' => ['count' => -1]] // Ordenar por frecuencia descendente
    ];

    // Ejecutar la consulta
    $clientesFrecuentes = $ventasCollection->aggregate($pipelineClientes);

    // Inicializar un array para almacenar los nombres de los clientes y sus frecuencias
    $labelsClientes = [];
    $dataClientes = [];

    // Recorrer los resultados y almacenar los datos
    foreach ($clientesFrecuentes as $cliente) {
        $labelsClientes[] = $cliente['_id'];
        $dataClientes[] = $cliente['count'];
    }

    // Consulta para contar la frecuencia de cada producto
    $pipelineProductos = [
        [
            '$unwind' => '$productos'
        ],
        [
            '$group' => [
                '_id' => '$productos',
                'count' => ['$sum' => 1]
            ]
        ],
        ['$sort' => ['count' => -1]] // Ordenar por frecuencia descendente
    ];

    // Ejecutar la consulta
    $productosMasComprados = $ventasCollection->aggregate($pipelineProductos);

    // Inicializar un array para almacenar los nombres de los productos y sus frecuencias
    $labelsProductos = [];
    $dataProductos = [];

    // Recorrer los resultados y almacenar los datos
    foreach ($productosMasComprados as $producto) {
        $labelsProductos[] = $producto['_id'];
        $dataProductos[] = $producto['count'];
    }
    ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <script>
        // Datos de ventas por cliente
        const datosVentasPorCliente = {
            labels: <?php echo json_encode($labelsClientes); ?>,
            datasets: [{
                label: 'Ventas por Cliente',
                data: <?php echo json_encode($dataClientes); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    // Agrega más colores aquí si hay más clientes
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    // Agrega más colores aquí si hay más clientes
                ],
                borderWidth: 1
            }]
        };
        // Configuración del gráfico de ventas por cliente
        const opcionesVentasPorCliente = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Crear gráfico de barras para ventas por cliente
        var ctxVentasPorCliente = document.getElementById('ventasPorCliente').getContext('2d');
        var myChartVentasPorCliente = new Chart(ctxVentasPorCliente, {
            type: 'bar',
            data: datosVentasPorCliente,
            options: opcionesVentasPorCliente
        });

        // Datos de productos más comprados
        const datosProductosMasComprados = {
            labels: <?php echo json_encode($labelsProductos); ?>,
            datasets: [{
                label: 'Productos más Comprados',
                data: <?php echo json_encode($dataProductos); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    // Agrega más colores aquí si hay más productos
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    // Agrega más colores aquí si hay más productos
                ],
                borderWidth: 1
            }]
        };

        // Configuración del gráfico de productos más comprados
        const opcionesProductosMasComprados = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };

        // Crear gráfico de barras para productos más comprados
        var ctxProductos = document.getElementById('productosMasComprados').getContext('2d');
        var myChartProductos = new Chart(ctxProductos, {
            type: 'bar',
            data: datosProductosMasComprados,
            options: opcionesProductosMasComprados
        });
    </script>
</body>
</html>




