<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se ha enviado el formulario de registro
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $empresa = $_POST['empresa'];
    $contrasena = $_POST['contrasena'];

    // Crear un documento con los datos del usuario
    $usuario = [
        'nombre' => $nombre,
        'correo' => $correo,
        'empresa' => $empresa,
        'contrasena' => $contrasena
    ];

    // Insertar el usuario en la colección
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert($usuario);
    $resultado = $mongo->executeBulkWrite("$base_de_datos.$coleccion_usuarios", $bulk);

    // Verificar si la inserción fue exitosa
    if($resultado) {
        echo "¡Registro exitoso! Gracias por registrarte.";
    } else {
        echo "Ha ocurrido un error durante el registro. Por favor, inténtalo de nuevo.";
    }
}
?>
