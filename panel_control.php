<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - BusinessNet</title>
    <style>
      /* Estilos para el encabezado */
      header {
            background-color: #007bff; /* Color de fondo azul corporativo */
            color: #fff; /* Color del texto blanco */
            padding: 20px;
            text-align: center;
        }

        /* Estilos para el menú de navegación */
        nav {
            background-color: #FFDAB9; /* Color de fondo pastel melocotón */
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

        /* Estilos para el panel de consejos */
        .panel-consejos {
            max-width: 600px;
            margin: 20px; /* Ajustar margen para evitar que tape otras secciones */
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            clear: both; /* Limpiar flotantes para evitar solapamientos */
        }

        .panel-consejos h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .panel-consejos ul {
            list-style-type: none;
            padding: 0;
        }

        .panel-consejos li {
            margin-bottom: 15px;
            font-size: 16px;
            line-height: 1.5;
            color: #666;
        }

        .panel-consejos li strong {
            color: #333;
        }

      /* Estilos para la lista de tareas pendientes */
.lista-tareas {
    max-width: 100%; /* Cambiar a 100% para permitir que el contenedor ocupe todo el ancho disponible */
    margin: 20px; /* Ajustar margen para evitar que tape otras secciones */
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    float: right;
    clear: both; /* Limpiar flotantes para evitar solapamientos */
}

.lista-tareas h2 {
    margin-bottom: 10px;
    font-size: 22px;
    color: #333;
}

.lista-tareas ul {
    list-style-type: none;
    padding: 0;
}

.lista-tareas li {
    margin-bottom: 8px;
    font-size: 16px;
    color: #666;
    white-space: normal; /* Asegurar que el texto puede pasar a la siguiente línea */
    word-wrap: break-word; /* Permitir que las palabras largas se rompan y pasen a la siguiente línea */
}

.lista-tareas input[type="checkbox"] {
    margin-right: 5px;
}

    </style>

</head>
<body>
<header>
    <!-- Encabezado con el nombre de la empresa y enlace para cerrar sesión -->
    <div class="header-content">
        <h1 style="margin: 0;">Panel de Control</h1>
        <div class="user-info">
            <p style="margin: 0;">Bienvenido.</p>
            <a href="index.html" style="color: white; text-decoration: none;">Cerrar sesión</a>
        </div>
    </div>
</header>

<nav>
    <!-- Menú de Navegación -->
    <ul>
        <li><a href="Gestion_de_Productos.php">Gestión de Productos</a></li>
        <li><a href="estadisticas.php">Estadísticas</a></li>
        <li><a href="generar_informes.html">Generar Informes</a></li>
    </ul>
</nav>

<div class="lista-tareas">
    <h2>Lista de tareas pendientes</h2>
    <ul id="lista-tareas">
        <!-- Las tareas se agregarán aquí dinámicamente -->
    </ul>
    <form id="agregar-tarea">
        <input type="text" id="nueva-tarea" placeholder="Agregar nueva tarea">
        <button type="submit">Agregar</button>
    </form>
</div>

<div class="panel-consejos">
    <h2>Consejos útiles y recordatorios</h2>
    <ul>
        <li><strong>Actualizar el inventario:</strong> Recuerda mantener tu inventario actualizado para evitar problemas de stock. Revisa regularmente los niveles de inventario y agrega nuevos productos según sea necesario.</li>
        <li><strong>Responder a consultas de clientes:</strong> No olvides revisar regularmente tu bandeja de entrada de consultas de clientes. Responder de manera oportuna y brindar un excelente servicio al cliente es clave para construir relaciones sólidas.</li>
        <li><strong>Verificar los pedidos pendientes:</strong> Es importante revisar los pedidos pendientes y procesarlos lo antes posible. Los clientes aprecian la rapidez en el envío y esto puede ayudar a mejorar la satisfacción del cliente.</li>
        <li><strong>Analizar las estadísticas de ventas:</strong> Utiliza las estadísticas de ventas para identificar tendencias y oportunidades de crecimiento. Analiza los productos más vendidos y ajusta tu estrategia de ventas en consecuencia.</li>
        <li><strong>Mantener la seguridad de la cuenta:</strong> Protege tu cuenta manteniendo tus credenciales seguras y cambiándolas regularmente. No compartas tu contraseña con nadie y habilita la autenticación de dos factores si está disponible.</li>
        <li><strong>Optimizar la experiencia del usuario:</strong> Revisa regularmente la usabilidad de tu sitio web y busca formas de mejorar la experiencia del usuario. Esto puede incluir la optimización de la velocidad de carga, la claridad del diseño y la facilidad de navegación.</li>
        <li><strong>Programar promociones o ventas:</strong> Planifica con anticipación tus promociones o ventas especiales para aumentar el compromiso de los clientes y estimular las ventas. Utiliza el calendario integrado para programar estas actividades con anticipación.</li>
    </ul>
</div>

<footer>
    <!-- Pie de Página -->
    <p>&copy; 2024 BusinessNet. Todos los derechos reservados.</p>
</footer>

<script>
window.onload = function() {
    cargarTareas();
    var form = document.getElementById('agregar-tarea');
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar el envío del formulario
        agregarTarea();
    });
};

function cargarTareas() {
    var listaTareas = JSON.parse(localStorage.getItem('tareas'));
    if (listaTareas) {
        var ul = document.getElementById('lista-tareas');
        ul.innerHTML = '';
        listaTareas.forEach(function(tarea) {
            var li = document.createElement('li');
            li.innerHTML = '<input type="checkbox"> ' + tarea + ' <button onclick="eliminarTarea(this)">Eliminar</button>';
            ul.appendChild(li);
        });
    }
}

function agregarTarea() {
    var nuevaTareaInput = document.getElementById('nueva-tarea');
    var nuevaTarea = nuevaTareaInput.value.trim();
    if (nuevaTarea !== '') {
        var ul = document.getElementById('lista-tareas');
        var li = document.createElement('li');
        li.innerHTML = '<input type="checkbox"> ' + nuevaTarea + ' <button onclick="eliminarTarea(this)">Eliminar</button>';
        ul.appendChild(li);
        guardarTareas();
        nuevaTareaInput.value = '';
    }
}

function guardarTareas() {
    var listaTareas = [];
    var lis = document.querySelectorAll('.lista-tareas li');
    lis.forEach(function(li) {
        listaTareas.push(li.textContent.trim().slice(3));
    });
    localStorage.setItem('tareas', JSON.stringify(listaTareas));
}

// Función para eliminar una tarea
function eliminarTarea(button) {
    var li = button.parentNode;
    li.parentNode.removeChild(li);
    guardarTareas();
}
</script>


</body>
</html>