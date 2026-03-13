<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Verificar si se ha enviado el formulario de agregar producto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    // Crear un documento con los datos del producto
    $producto = [
        'nombre' => $nombre,
        'descripcion' => $descripcion,
        'precio' => $precio,
        'cantidad' => $cantidad
    ];

    // Verificar si se subió una imagen
    if (isset($_FILES['imagen'])) {
        $imagen = $_FILES['imagen'];

        // Crear un nombre único para la imagen
        $nombreImagen = uniqid() . '.' . pathinfo($imagen['name'], PATHINFO_EXTENSION);

        // Mover la imagen a una carpeta de imágenes en tu servidor
        // Asegúrate de que el directorio 'imagenes/' exista
        if (!file_exists('imagenes/')) {
            mkdir('imagenes/', 0777, true);
        }
        move_uploaded_file($imagen['tmp_name'], 'imagenes/' . $nombreImagen);

        // Guarda el nombre de la imagen en la base de datos
        $producto['imagen'] = $nombreImagen;
    }

    // Insertar el producto en la colección
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->insert($producto);
    $resultado = $mongo->executeBulkWrite("$base_de_datos.$coleccion_productos", $bulk);

    // Verificar si la inserción fue exitosa
    if($resultado) {
        // Redirigir al usuario de nuevo al panel de control después de agregar el producto
        header("Location: panel_control.php");
        exit;
    } else {
        // Mostrar un mensaje de error si la inserción falló
        echo "Error al agregar el producto. Por favor, inténtalo de nuevo.";
    }
} else {
    // Mostrar un mensaje de error si algún campo está vacío
    echo "Todos los campos son obligatorios.";
}
?>

