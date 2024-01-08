<?php
session_start(); // Iniciar la sesión

$dbl = new mysqli('localhost', 'root', '', 'crud1');

if ($_POST) {
    $user_login = $_POST['nombre'];
    $pass_login = $_POST['password'];

    $consultal = "SELECT * FROM usuarios WHERE nombre = '$user_login'";
    $resultadol = $dbl->query($consultal);

    if ($resultadol->num_rows > 0) {
        $users = $resultadol->fetch_assoc();

        if (password_verify($pass_login, $users['password'])) {
            // Verificación exitosa y asignar variable de sesión
            $_SESSION['nombre'] = $user_login;
            //permisos, redirigir a otras paginas sino cumple los roles
            $rol = $users['rol'];
            if ($rol === 'Administrador') {
                header("Location: ver.php");
            } elseif ($rol === 'Gerente') {
                header("Location: ver3.php");
            } elseif ($rol === 'Empleado') {
                header("Location: ver2.php");
            } else {
                echo "<script>alert('Rol no válido'); window.location.href = 'index.html/script>";
            }
            exit(); // Finalizar redirecciones
        } else {
            echo "<script>alert('Usuario o contraseña incorrectas'); window.location.href = 'index.html';</script>";
        }
    } else {
        echo "<script>alert('El usuario no existe'); window.location.href = 'index.html';</script>";
    }
}

$dbl->close();
?>
