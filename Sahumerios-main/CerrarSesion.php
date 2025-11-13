<?php
session_start(); // Necesario para acceder a la sesión

// Eliminar todas las variables de sesión
$_SESSION = [];

// Destruir la sesión
session_destroy();

// Redirigir al login o página principal
header("Location: index.php");
exit();
?>