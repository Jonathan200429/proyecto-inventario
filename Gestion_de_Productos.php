<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Consultar todos los productos
$query = new MongoDB\Driver\Query([]);
$cursor = $mongo->executeQuery("$base_de_datos.$coleccion_productos", $query);

// Verificar si se encontraron productos
if ($cursor->isDead()) {
    echo "No se encontraron productos.";
} else {
    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar y Agregar Productos</title>
    <!-- Agrega el enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<style>
        body {
            padding: 20px;
            background-color: #f8f9fa;
        }
        .navbar {
            margin-bottom: 20px;
        }
        .navbar-light .navbar-nav .nav-link {
            color: #007bff;
        }
        .navbar-light .navbar-nav .nav-link:hover {
            color: #0056b3;
        }
        .form-control {
            margin-bottom: 10px;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
    </style>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <button type="button" id="agregarProductoOption" class="btn btn-link nav-link">Agregar Producto</button>
                    </li>
                    <li class="nav-item">
                        <button type="button" id="editarProductoOption" class="btn btn-link nav-link">Editar Producto</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulario de Agregar Producto -->
    <form id="formularioAgregarProducto" action="procesar_agregar_producto.php" method="POST" enctype="multipart/form-data" style="display: none;">
        <div class="container mt-3">
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" required class="form-control">

            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="4" required class="form-control"></textarea>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" min="0" step="0.01" required class="form-control">

            <label for="cantidad">Cantidad Disponible:</label>
            <input type="number" id="cantidad" name="cantidad" min="0" required class="form-control">

            <label for="imagen">Imagen del Producto:</label>
            <input type="file" id="imagen" name="imagen" required class="form-control">

            <button type="submit" class="btn btn-primary mt-3">Agregar Producto</button>
        </div>
    </form>

    <!-- Modal para editar producto -->
    <div class="modal fade" id="editarProductoModal" tabindex="-1" role="dialog" aria-labelledby="editarProductoModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarProductoModalLabel">Editar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formularioEditarProducto">
                        <div class="form-group">
                            <label for="editNombre">Nombre del Producto:</label>
                            <input type="text" id="editNombre" name="editNombre" required class="form-control">

                            <label for="editDescripcion">Descripción del Producto</label>
                            <textarea id="editDescripcion" name="editDescripcion" rows="4" required class="form-control"></textarea>
                        </div>
                     
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Incluir el archivo de conexión a la base de datos
    include 'conexion.php';

    // Consultar todos los productos
    $query = new MongoDB\Driver\Query([]);
    $cursor = $mongo->executeQuery("$base_de_datos.$coleccion_productos", $query);

    // Verificar si se encontraron productos
    if ($cursor->isDead()) {
        echo "<div class='container mt-3'>No se encontraron productos.</div>";
    } else {
    // Mostrar los productos uno por uno
foreach ($cursor as $producto) {
    echo "<div class='container mt-3'>";
    echo "<div class='row align-items-center'>"; // Añade 'align-items-center' para centrar los elementos
    if (isset($producto->imagen)) {
        echo "<div class='col-md-2'>";
        echo "<img src='imagenes/{$producto->imagen}' alt='{$producto->nombre}' style='width: 100%; max-width: 100px;'>";
        echo "</div>";
    }
    echo "<div class='col-md-9'>"; // Cambia a 'col-md-9' para dejar espacio para el botón
    echo "<h3>Producto</h3>";
    echo "<p><strong>Nombre:</strong> {$producto->nombre}</p>";
    echo "<p><strong>Descripción:</strong> {$producto->descripcion}</p>";
    echo "<p><strong>Precio:</strong> {$producto->precio}</p>";
    echo "<p><strong>Cantidad:</strong> {$producto->cantidad}</p>";
    echo "</div>";
    echo "<div class='col-md-1 text-center'>"; // Añade una columna para el botón
    echo "<button class='btn btn-primary editarProductoBtn' data-nombre='{$producto->nombre}' data-descripcion='{$producto->descripcion}'>Editar</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}



    }
    ?>

    <!-- Agrega los enlaces a jQuery y Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-BvCmMmSSiI7gZQoX9nnvGX35JZzgsbtwxFMKnHqsD0M7Ix7EaKlBcsKt3W/LqwKv"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-pzjw8f+UA5NZC+1wzrOxC1mPJiHN7j/n5+6bYqzV6zDwHv9+6FC7EaxIZTkqcP1L"
        crossorigin="anonymous"></script>

    <!-- Agrega tu código JavaScript personalizado aquí -->
    <script>
        $(document).ready(function () {
            // Mostrar formulario de agregar producto cuando se seleccione la opción correspondiente
            $('#agregarProductoOption').click(function () {
                $('#formularioAgregarProducto').toggle();
                $('#formularioEditarProducto').hide();
            });

            // Ocultar formulario de agregar producto cuando se seleccione la opción correspondiente
            $('#editarProductoOption').click(function () {
                $('#formularioAgregarProducto').hide();
                $('#formularioEditarProducto').toggle();
            });

            // Manejar la lógica para mostrar el modal de edición de producto
            $('.editarProductoBtn').click(function () {
                // Obtener el nombre del producto seleccionado
                var nombreProducto = $(this).siblings(".nombreProducto").text();
                
                // Obtener la descripción del producto seleccionado
                var descripcionProducto = $(this).siblings(".descripcionProducto").text();

                // Poblar el formulario de edición con los detalles del producto seleccionado
                $('#editNombre').val(nombreProducto);
                $('#editDescripcion').val(descripcionProducto);

                // Mostrar el modal de edición
                $('#editarProductoModal').modal('show');
            });
        });
    </script>
</body>

</html>

