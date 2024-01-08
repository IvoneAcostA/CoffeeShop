<link rel="shortcut icon" href="img/icono.png">
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
    
    // Si el rol del usuario no es 'Gerente', redireccionar a ver o ver3 dependiendo el rol
    if ($rolUsuario == 'Administrador') {
        header("Location: ver.php");
        //exit();
    }elseif($rolUsuario == 'Gerente'){
        header("Location: ver3.php");
        exit();
    }
}

// Cerrar conexión
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inventario</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
</head>
<body>
    <?php
    // Incluimos la barra de navegación desde el archivo navbar.php.
    include "php/navbar2.php";
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>VER PRODUCTOS</h2>
                <!-- Botón para mostrar el modal de agregar producto -->
                
                <br><br>
                <!-- Modal para agregar producto -->
               

                <?php
                // Incluimos la tabla de productos desde el archivo tabla_productos.php.
                include "php/tabla_solo_ver.php";
                ?>
                
            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
