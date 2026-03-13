<?php
require 'vendor/autoload.php';

// Conectar a MongoDB
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");

// Obtener la colección de ventas
$ventasCollection = $mongoClient->gestion_negocios->ventas;

// Consulta para contar la frecuencia de cada cliente
$pipelineClientes = [
    ['$group' => ['_id' => '$cliente', 'count' => ['$sum' => 1]]],
    ['$sort' => ['count' => -1]] // Ordenar por frecuencia descendente
];

// Ejecutar la consulta
$clientesFrecuentes = $ventasCollection->aggregate($pipelineClientes);

// Preparar los datos de clientes
$datosClientes = [];
foreach ($clientesFrecuentes as $cliente) {
    $datosClientes[$cliente['_id']] = $cliente['count'];
}

// Consulta para contar la cantidad de productos vendidos
$pipelineProductos = [
    ['$group' => ['_id' => '$nombreProducto', 'count' => ['$sum' => '$cantidad']]],
    ['$sort' => ['count' => -1]] // Ordenar por cantidad descendente
];

// Ejecutar la consulta
$productosVendidos = $ventasCollection->aggregate($pipelineProductos);

// Preparar los datos de productos
$datosProductos = [];
foreach ($productosVendidos as $producto) {
    $datosProductos[$producto['_id']] = $producto['count'];
}

// Devolver los datos en formato JSON
$datos = [
    'clientes' => $datosClientes,
    'productos' => $datosProductos
];
header('Content-Type: application/json');
echo json_encode($datos);
?>
