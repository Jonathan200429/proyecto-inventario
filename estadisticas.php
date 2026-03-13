<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Estadísticas</title>
    <link rel="stylesheet" href="estilos.css">
    <style>
    /* Estilos generales */
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f5f5f5;
        color: #333;
    }

    /* Encabezado */
    header {
        background-color: #3298dc; /* Azul brillante */
        color: #fff; /* Color del texto blanco */
        padding: 20px;
        text-align: center;
    }

    /* Menú de navegación */
    nav {
        background-color: #ffaf00; /* Amarillo anaranjado */
        color: #333; /* Color del texto gris oscuro */
        padding: 10px;
        float: left; /* Alinear a la izquierda */
    }

    nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        text-align: center;
        font-size: 20px; /* Aumentar tamaño de la fuente */
    }

    nav ul li {
        display: inline;
        margin-right: 20px;
    }

    nav ul li a {
        color: #333; /* Color del texto gris oscuro */
        text-decoration: none;
    }

    /* Estilos para el enlace "Menú anterior" */
    .back-link {
        color: #fff; /* Color del texto blanco */
        text-decoration: none;
        font-weight: bold;
        padding: 5px 10px;
        background-color: #0a78b0; /* Azul más oscuro */
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .back-link:hover {
        background-color: #085e87; /* Azul más oscuro al pasar el mouse */
    }

    /* Contenido principal */
    main {
        padding: 20px;
    }

    /* Formulario Registro de Ventas */
    #registro-ventas form label {
        display: block;
        margin-bottom: 5px;
        color: #333; /* Negro */
    }

    #registro-ventas form input[type="text"],
    #registro-ventas form input[type="date"],
    #registro-ventas form textarea,
    #registro-ventas form input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    #registro-ventas form button {
        width: 100%;
        padding: 10px;
        background-color: #3298dc; /* Azul brillante */
        color: #fff; /* Color del texto blanco */
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    #registro-ventas form button:hover {
        background-color: #1c6ca3; /* Azul más oscuro */
    }

    /* Formulario Registro de Clientes */
    #registro-clientes form label {
        display: block;
        margin-bottom: 5px;
        color: #333; /* Negro */
    }

    #registro-clientes form input[type="text"],
    #registro-clientes form input[type="email"],
    #registro-clientes form input[type="tel"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    #registro-clientes form button {
        width: 100%;
        padding: 10px;
        background-color: #ffaf00; /* Amarillo anaranjado */
        color: #333; /* Color del texto gris oscuro */
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    #registro-clientes form button:hover {
        background-color: #e58d00; /* Amarillo anaranjado más oscuro */
    }

    /* Pie de página */
    footer {
        background-color: #3298dc; /* Mismo color azul brillante del encabezado */
        color: #fff; /* Color del texto blanco */
        text-align: center;
        padding: 10px 0;
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    .tips {
    background-color: #f9f9f9;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 20px;
    padding: 20px;
}

.tips h2 {
    color: #333;
}

.tips ul {
    list-style-type: none;
    padding: 0;
}

.tips li {
    margin-bottom: 10px;
}
</style>


    <script>
        function mostrarCampos(id) {
            // Ocultar todas las secciones primero
            var secciones = document.querySelectorAll('.campos');
            secciones.forEach(function (seccion) {
                seccion.style.display = 'none';
            });

            // Mostrar la sección seleccionada
            var seccionSeleccionada = document.getElementById(id);
            seccionSeleccionada.style.display = 'block';
        }
    </script>
    <script>
        function mostrarVentas() {
            // Realizar una solicitud AJAX para obtener las ventas
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "obtener_ventas.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Mostrar las ventas en el contenedor
                    document.getElementById("ventas-container").innerHTML = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>

</head>

<body>
    <header>
        <!-- Encabezado -->
        <div class="header-content">
            <a href="panel_control.php" class="back-link">Menú anterior</a>
            <h1>Estadísticas</h1>
        </div>
    </header>

    <!-- Menú de navegación -->
    <nav>
        <ul>
            <li><a href="javascript:void(0)" onclick="mostrarCampos('registro-ventas')">Registro de Ventas</a></li>
            <li><a href="javascript:void(0)" onclick="mostrarCampos('registro-clientes')">Registro de Clientes</a></li>
            <li><a href="todas_ventas.php">Total de Ventas</a></li>
            <li><a href="graficos_ventas.php">Ver Estadísticas de Ventas</a></li>
            
        </ul>
    </nav>

    <main>
        <!-- Sección de Registro de Ventas -->
        <section id="registro-ventas" class="campos" style="display: none;">
            <h2>Registro de Ventas</h2>
            <!-- Formulario para registrar ventas -->
            <form action="registrar_venta.php" method="post">
                <label for="id_venta">ID:</label>
                <input type="text" id="id_venta" name="id_venta" required>
                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>
                <label for="cliente">Cliente:</label>
                <input type="text" id="cliente" name="cliente" required>
                <label for="productos">Productos:</label>
                <textarea id="productos" name="productos" required></textarea>
                <label for="total">Total:</label>
                <input type="number" id="total" name="total" required>
                <button type="submit">Registrar Venta</button>
            </form>
        </section>

        <!-- Sección de Registro de Clientes -->
        <section id="registro-clientes" class="campos" style="display: none;">
            <h2>Registro de Clientes</h2>
            <!-- Formulario para registrar clientes -->
            <form action="registrar_cliente.php" method="post">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>
                <label for="correo">Correo:</label>
                <input type="email" id="correo" name="correo" required>
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" required>
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" required>
                <button type="submit">Registrar Cliente</button>
            </form>
        </section>

        <!-- Contenedor para mostrar las ventas -->
        <div id="ventas-container"></div>

         <!-- Consejos o Recomendaciones -->
    <div class="tips">
        <h2>Consejos o Recomendaciones</h2>
        <ul>
            <li>Análisis de tendencias: Observa las tendencias de ventas a lo largo del tiempo y sugiere acciones basadas en estas tendencias. Por ejemplo, si ciertos productos muestran un aumento o disminución en las ventas, podrías sugerir ajustes en la estrategia de marketing.</li>
            <li>Segmentación de clientes: Si tus datos muestran que ciertos grupos demográficos son más propensos a comprar ciertos productos, podrías recomendar dirigir campañas publicitarias específicas a esos grupos.</li>
            <li>Promociones cruzadas: Identifica productos que tienden a ser comprados juntos y sugiere promociones cruzadas para aumentar las ventas. Por ejemplo, si los datos muestran que los clientes que compran un cierto tipo de producto también tienden a comprar otro, podrías ofrecer descuentos o paquetes especiales que incluyan ambos productos.</li>
            <li>Fidelización de clientes: Si tienes datos sobre la frecuencia de compra de ciertos clientes, podrías sugerir programas de fidelización o descuentos especiales para clientes habituales.</li>
            <li> Optimización de precios: Analiza los datos de precios y ventas para identificar oportunidades de ajuste de precios. Podrías recomendar estrategias de fijación de precios dinámicos o ajustes de precios para maximizar los márgenes de beneficio.</li>
            <li>Optimización de inventario: Utiliza datos de inventario para sugerir ajustes en la gestión de inventario. Por ejemplo, si ciertos productos tienen una rotación más rápida, podrías recomendar mantener un mayor nivel de stock de esos productos.</li>
        </ul>
    </div>
    </main>

    <footer>
        <!-- Pie de Página -->
        <p>© 2024 BusinessNet. Todos los derechos reservados.</p>
    </footer>
</body>

</html>
