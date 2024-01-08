<?php
session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: ../../index.html");
    exit();
}

/*Evitar acceso*/
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
    
    // Si el rol del usuario no es 'Administrador', redireccionar a ver2 o ver3 dependiendo del rol
    if ($rolUsuario == 'Gerente') {
        header("Location: ../../ver3.php");
        //exit();
    } elseif ($rolUsuario == 'Empleado') {
        header("Location: ../../ver2.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="estilos_registro.css">
</head>
<body>

<?php //include "../navbar.php"; ?>
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
</div>
<!-- formulario para registrar al usuario. Pedir nombre, contraseña y rol -->
<div class="registro">
    <form action="registrar.php" method="post">
        <h2>Registro</h2>
        <h4>Usuario</h4>
        <input type="text" name="nombre" placeholder="inserte su texto" required><br>

        <h4>Contraseña</h4>
        <input type="password" name="password" placeholder="inserte su texto" required><br>
        <div class="roles">
        <h4>Rol</h4>
        <select name="rol" required><!-- desplegar menu -->
            <option value="" disabled selected>Rol</option><!-- No se ha seleccionado-->
            <option value="Administrador">Administrador</option>
            <option value="Gerente">Gerente</option>
            <option value="Empleado">Empleado</option>
        </select>


        <input type="submit" name="enviar" Value="Registrar">
    </form>
</div>

</body>
</html>
