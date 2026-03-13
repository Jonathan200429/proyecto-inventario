<?php
// Iniciar sesión si no está iniciada
session_start();

// Finalizar la sesión
session_destroy();

// Redirigir al usuario a la página de inicio de sesión o a otra página deseada después de cerrar sesión
header("Location: login.php");
exit;
?>
