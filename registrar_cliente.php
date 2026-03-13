<?php
require 'vendor/autoload.php';
// Conectar a MongoDB (ejemplo)
$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$clientesCollection = $mongoClient->gestion_negocios->clientes;
// Receive form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];

    // Validate other fields (if needed)

    // Prepare data for insertion
    $clienteData = [
        "nombre" => $nombre,
        "correo" => $correo,
        "direccion" => $direccion,
        "telefono" => $telefono,
    ];

    // Insert data into MongoDB
    $result = $clientesCollection->insertOne($clienteData);

    // Check insertion success
    if ($result->getInsertedCount() > 0) {
        echo "Cliente registrado exitosamente.";
    } else {
        echo "Error al registrar el cliente.";
    }

    // Redirect to appropriate page
    header("Location: estadisticas.php");
    exit;
}

// ...
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total de Ventas</title>
    <link rel="stylesheet" href="estilos.css">
</head>

