<?php
require 'vendor/autoload.php';

// Conectar a MongoDB
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");

// Seleccionar la colección de ventas
$ventasCollection = $mongoClient->gestion_negocios->ventas;

// Recibir los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fecha = trim($_POST['fecha']); // Validar y limpiar el valor de la fecha
    $cliente = trim($_POST['cliente']); // Validar y limpiar el valor del cliente
    $productos = $_POST['productos']; // Asumiendo que 'productos' es un array asociativo
    $total = (float) trim($_POST['total']); // Convertir el total a float y validarlo

    // Validar que los datos no sean vacíos
    if (empty($fecha) || empty($cliente) || empty($productos) || is_nan($total)) {
        echo "<p style='color: red;'>Error: Los datos del formulario no son válidos</p>";
        exit;
    }

    // Aquí puedes preparar los datos que deseas insertar en la colección de ventas
    $ventaData = [
        "fecha" => $fecha,
        "cliente" => $cliente,
        "productos" => $productos,
        "total" => $total
    ];

    // Insertar los datos en la colección de ventas
    $result = $ventasCollection->insertOne($ventaData);

    // Verificar si la inserción fue exitosa
    if ($result->getInsertedCount() > 0) {
        echo "<p style='color: green;'>Venta registrada exitosamente.</p>";
    } else {
        echo "<p style='color: red;'>Error al registrar la venta.</p>";
    }

    // Redirigir a la página principal o a donde desees después de registrar la venta
    header("Location: estadisticas.php");
    exit; // Asegura que el script se detenga después de la redirección
}
?>
