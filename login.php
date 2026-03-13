<?php
session_start(); // Iniciar la sesión si no está iniciada

// Incluir el archivo de conexión
include 'conexion.php';

// Verificar si se ha enviado el formulario de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Consultar la colección de usuarios para encontrar al usuario
    try {
        $query = new MongoDB\Driver\Query(['correo' => $correo, 'contrasena' => $contrasena]);
        $cursor = $mongo->executeQuery("$base_de_datos.$coleccion_usuarios", $query);

        // Verificar si se encontró un usuario con las credenciales proporcionadas
        if ($cursor->isDead()) {
            // Mostrar mensaje de error
            $error_message = "Correo electrónico o contraseña incorrectos. Por favor, inténtalo de nuevo.";
        } else {
            // Iniciar sesión
            session_start();
            $_SESSION['correo'] = $correo; // Establecer la variable de sesión con el correo electrónico del usuario
            header("Location: panel_control.php"); // Redirigir al usuario al panel de control
            exit;
        }
    } catch (Exception $e) {
        echo 'Excepción capturada: ',  $e->getMessage();
    }
}
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Plataforma de Gestión de Negocios</title>
    <style>
/* Estilos para el formulario de inicio de sesión */
.login-container {
  background-color: #f9f9f9;
  padding: 40px;
  border-radius: 10px;
  box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  max-width: 500px;
  margin: 0 auto;
  text-align: center;
}

.login-container h2 {
  font-size: 2em;
  margin-bottom: 30px;
  color: #007bff;
}

.login-form .form-group {
  margin-bottom: 20px;
  text-align: left;
}

.login-form label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
  color: #555;
}

.login-form input[type="email"],
.login-form input[type="password"] {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 16px;
}

.login-button {
  width: 100%;
  padding: 15px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 8px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

.login-button:hover {
  background-color: #0056b3;
}

.error-message {
  color: #dc3545;
  margin-bottom: 20px;
  font-weight: bold;
}

.index-button {
  display: inline-block;
  margin-top: 20px;
  color: #007bff;
  text-decoration: none;
}

.index-button:hover {
  text-decoration: underline;
}



</style>

</head>
<body>
<div class="login-container">
    <h2>Iniciar Sesión</h2>
    <!-- Mostrar el mensaje de error -->
    <?php if (isset($error_message)) : ?>
        <div id="error-message" class="error-message" style="display: block;">
            <?php echo $error_message; ?>
        </div>
    <?php endif; ?>

    <form action="login.php" method="POST" class="login-form">
        <div class="form-group">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" required>
        </div>

        <div class="form-group">
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena" required>
        </div>

        <button type="submit" class="login-button">Iniciar Sesión</button>
    </form>
    
    <!-- Botón para redirigir al index -->
    <a href="index.html" class="index-button">Volver al Inicio</a>
</div>

<script>
    // Mostrar el mensaje de error
    <?php if (isset($error_message)) : ?>
        document.getElementById('error-message').style.display = 'block';
    <?php endif; ?>

    // Ocultar el mensaje después de 3 segundos (3000 milisegundos)
    setTimeout(function() {
        document.getElementById('error-message').style.display = 'none';
    }, 3000);
</script>
</body>
</html>

