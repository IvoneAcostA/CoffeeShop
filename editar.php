<link rel="shortcut icon" href="img/icono.png">
    <title>Editar producto</title>
<?php
session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: login.php");
    exit();
}
?>
<html>
<head>
    <title>.: CRUD :.</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script src="js/jquery.min.js"></script>
</head>
<body>
<?php include "php/navbar.php"; ?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>EDITAR PRODUCTO</h2>

            <?php
            include "php/conexion.php";

            // Verificar si se ha enviado un ID válido a través de la URL
            if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                $id = $_GET['id'];

                // Consultar el producto correspondiente al ID
                $sql = "SELECT * FROM productos WHERE id = $id";
                $query = $con->query($sql);

                // Verificar si se encontró el producto con el ID especificado
                if ($query->num_rows > 0) {
                    $producto = $query->fetch_assoc();
                    include "php/formulario.php"; // Mostrar el formulario con los datos del producto
                } else {
                    echo "<p class='alert alert-warning'>El producto no existe.</p>";
                }
            } else {
                echo "<p class='alert alert-danger'>ID de producto inválido.</p>";
            }
            ?>
        </div>
    </div>
</div>

<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
