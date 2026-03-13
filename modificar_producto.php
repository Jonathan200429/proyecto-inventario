<?php
// Manejo de la solicitud de edición de producto
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conectar a MongoDB
    $mongoClient = new MongoDB\Client("mongodb://localhost:27017");
    $collection = $mongoClient->gestion_negocios->productos;

    // Obtener datos del formulario
    $nombre = $_POST['editNombre'];
    $descripcion = $_POST['editDescripcion'];
    $precio = $_POST['editPrecio'];
    $cantidad = $_POST['editCantidad'];

    // Validar entrada de usuario (implementar validaciones según tus necesidades)

    // ID del producto a editar (suponiendo que se pasa como parámetro en la solicitud POST)
    $productoId = $_POST['productoId'];

    // Actualizar producto en la base de datos
    $result = $collection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectID($productoId)],
        ['$set' => [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'cantidad' => $cantidad
        ]]
    );

    // Redirigir al usuario a la página de detalles del producto actualizado o mostrar un mensaje de éxito
    if ($result->getModifiedCount() > 0) {
        header("Location: detalles_producto.php?id=" . $productoId);
    } else {
        echo "No se pudo actualizar el producto.";
    }
}
?>
