<?php
include 'conexion.php'; // Incluir el archivo de conexión a la base de datos

// Verificar si se ha enviado el formulario de agregar producto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    // Verificar si los campos están vacíos
    if (!empty($nombre) && !empty($descripcion) && !empty($precio) && !empty($cantidad)) {
        // Crear un documento con los datos del producto
        $producto = [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'cantidad' => $cantidad
        ];


        if (isset($producto->imagen)) {
            $rutaImagen = 'imagenes/' . $producto->imagen;
            if (file_exists($rutaImagen)) {
                echo "<img src='{$rutaImagen}' alt='{$producto->nombre}'>";
            } else {
                echo "<p>Error: No se pudo encontrar la imagen {$rutaImagen}</p>";
            }
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
}
?>

