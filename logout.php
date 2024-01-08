<?php
session_start(); // Iniciar la sesión

// Eliminar todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redireccionar al usuario a la página de inicio (index.html en tu caso)
header("Location: index.html");
exit();
?>