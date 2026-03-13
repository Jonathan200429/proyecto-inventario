<?php
// Datos de conexión a la base de datos MongoDB
$host = 'localhost'; // Cambia esto si tu base de datos MongoDB no está en localhost
$puerto = 27017;
$usuario = ''; 
$contrasena = '';
$base_de_datos = 'gestion_negocios'; 
$coleccion_usuarios = 'usuarios';

// Establecer la conexión
try {
    $mongo = new MongoDB\Driver\Manager("mongodb://$host:$puerto");
    // echo "Conexión exitosa a MongoDB"; // Puedes descomentar esta línea para verificar que la conexión se realizó correctamente
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Error al conectar a MongoDB: " . $e->getMessage();
}
?>
