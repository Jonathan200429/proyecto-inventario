<?php
require 'vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Ventas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
            color: #333;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:hover {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <a href='estadisticas.php'>Menú anterior</a>
    
    <?php
    // Conectar a MongoDB
    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");

    // Obtener la colección de ventas
    $ventasCollection = $mongoClient->gestion_negocios->ventas;

    // Obtener todas las ventas y almacenarlas en un arreglo
    $ventasArray = iterator_to_array($ventasCollection->find());

    // Calcular el total de ventas
    $totalVentas = 0;
    foreach ($ventasArray as $venta) {
        $totalVentas += $venta['total'];
    }
    ?>

    <p>Total de ventas: $<?php echo number_format($totalVentas, 2); ?></p>

    <!-- Mostrar las ventas en una tabla -->
    <table>
        <tr>
            <th>ID</th>
            <th>Fecha</th>
            <th>Cliente</th>
            <th>Productos</th>
            <th>Total</th>
        </tr>
        <?php foreach ($ventasArray as $venta): ?>
        <tr>
            <td><?php echo $venta['_id']; ?></td>
            <td><?php echo $venta['fecha']; ?></td>
            <td><?php echo $venta['cliente']; ?></td>
            <td><?php echo $venta['productos']; ?></td>
            <td>$<?php echo number_format($venta['total'], 2); ?></td>
        </tr>
        <?php endforeach; ?>
    </table>

    <!-- Agregar un enlace para volver a la página de estadísticas -->
</body>
</html>
