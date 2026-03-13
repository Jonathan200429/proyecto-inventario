<?php
// Datos de conexión a la base de datos MongoDB
$host = 'localhost'; // Cambia esto si tu base de datos MongoDB no está en localhost
$puerto = 27017;
$usuario = ''; // Inserta el nombre de usuario si tu MongoDB requiere autenticación
$contrasena = ''; // Inserta la contraseña si tu MongoDB requiere autenticación
$base_de_datos = 'gestion_negocios';
$coleccion_usuarios = 'usuarios';

// Establecer la conexión
try {
    if (!empty($usuario) && !empty($contrasena)) {
        $uri = "mongodb://$usuario:$contrasena@$host:$puerto/$base_de_datos";
    } else {
        $uri = "mongodb://$host:$puerto";
    }
    $mongo = new MongoDB\Driver\Manager($uri);
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo "Error al conectar a MongoDB: " . $e->getMessage();
}
$coleccion_productos = 'productos'; // Agregar esta línea para definir la colección de productos

?>
