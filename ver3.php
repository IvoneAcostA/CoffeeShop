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
    }elseif($rolUsuario == 'Empleado'){
        header("Location: ver2.php");
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
    include "php/navbar3.php";
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>VER PRODUCTOS</h2>
                <!-- Botón para mostrar el modal de agregar producto -->
                <a data-toggle="modal" href="#myModal" class="btn btn-default">Agregar</a>
                <br><br>
                <!-- Modal para agregar producto -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title">Agregar Producto</h4>
                            </div>
                            <div class="modal-body">
                                <!-- Formulario para agregar producto -->
                                <form role="form" method="post" action="php/agregar.php">
                                    <div class="form-group">
                                        <label for="nombre">Nombre</label>
                                        <input type="text" class="form-control" name="nombre" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="precio">Precio</label>
                                        <input type="text" class="form-control" name="precio" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="marca">Marca</label>
                                        <input type="text" class="form-control" name="marca" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="descripcion">Proveedor</label>
                                        <textarea class="form-control" name="descripcion" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Stock</label>
                                        <input type="text" class="form-control" name="stock" required>
                                    </div>

                                    <button type="submit" class="btn btn-default">Agregar</button>
                                </form>
                            </div>
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->

                <?php
                // Incluimos la tabla de productos desde el archivo tabla_productos.php.
                include "php/tabla_productos.php";
                ?>
                
            </div>
        </div>
    </div>

    <script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
