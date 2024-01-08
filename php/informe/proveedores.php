<?php
// Iniciamos la sesión para permitir el uso de variables de sesión.
session_start();

// Verificamos si la variable de sesión 'nombre' está definida.
// Si no está definida, redirigimos al usuario a la página de inicio de sesión (index.html) y detenemos la ejecución del script.
if (!isset($_SESSION['nombre'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Formulario de carga de archivos</title>
    <link rel="stylesheet" type="text/css" href="estilos.css">
</head>
<body>
<div class="navbar_registro">
<nav class="navbar">
  <ul class="navbar-nav">
    <li><a href="/CoffeeShop/ver.php">PRODUCTOS</a></li>
    <li><a href="/CoffeeShop/php/registro/registro.php">USUARIOS</a></li>
    <li><a href="/CoffeeShop/php/informe/descarga.php">INFORME</a></li>
    <!--<li><a href="/CoffeeShop/php/informe/proveedores.php">LISTA</a></li>-->
    <li><a href="/CoffeeShop/php/descifrar.php">DESCIFRAR</a></li>
  </ul>
</nav>
<div>
    <h2>Cargue los archivos</h2>
    <form action="procesar_archivos.php" method="post" enctype="multipart/form-data">
    
        <label for="csvFile">Archivo .txt:</label> <!-- Cambiamos el texto a .txt -->
        <input type="file" id="csvFile" name="csvFile" accept=".txt"><br><br> <!-- Cambiamos el tipo de archivo a .txt -->

        <!-- Textarea para el archivo .key -->
        <label for="keyContent">Clave:</label><br>
        <textarea id="keyContent" name="keyContent" rows="10" cols="50"></textarea><br><br>
        <!-- Termina textarea -->

        <!-- Agregamos el campo para la contraseña -->
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password"><br><br>

        <input type="submit" value="Descifrar" name="submit"> <!-- Cambiamos el texto del botón a "Descifrar" -->
    </form>
</body>
</html>
