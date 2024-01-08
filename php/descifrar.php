<?php
// Iniciamos la sesión para permitir el uso de variables de sesión.
session_start();

// Verificamos si la variable de sesión 'nombre' está definida.
// Si no está definida, redirigimos al usuario a la página de inicio de sesión (index.html) y detenemos la ejecución del script.
if (!isset($_SESSION['nombre'])) {
    header("Location: index.html");
    exit();
}
//Evitar acceso
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud1";

// Crear conexión para obtener valores para la consulta
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el rol del usuario desde la base de datos en la tabla usuarios
$nombreUsuario = $_SESSION['nombre'];
$sql = "SELECT rol FROM usuarios WHERE nombre = '$nombreUsuario'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $rolUsuario = $row['rol'];
    
    // Si el rol del usuario no es 'Administrador', redireccionar a ver2 o ver3 dependiendo el rol
    if ($rolUsuario == 'Gerente') {
        header("Location: ../ver3.php");
        //exit();
    }elseif($rolUsuario == 'Empleado'){
        header("Location: ../ver2.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Formulario para Descifrar Archivos</title>
</head>
<body>
    <h1>Formulario para Descifrar Archivos Cifrados</h1>
    <form action="decifrar_archivo.php" method="post" enctype="multipart/form-data">
        <label for="archivo_cifrado">Selecciona un archivo cifrado (.txt):</label>
        <input type="file" name="archivo_cifrado" id="archivo_cifrado" accept=".txt" required>
        <br><br>
        <label for="clave">Clave de Descifrado:</label>
        <input type="password" name="clave" id="clave" required>
        <br><br>
        <input type="submit" value="Descifrar Archivo">
    </form>
</body>
</html>
