<?php
session_start();

if (!isset($_SESSION['nombre'])) {
    header("Location: ../../index.html");
    exit();
}
?>

<?php
$db = new mysqli('localhost', 'root', '', 'crud1');
if ($_POST) {
    $user = $_POST['nombre'];
    $password = $_POST['password'];
    $pass = password_hash($password, PASSWORD_BCRYPT);
    $rol = $_POST['rol'];

    // Generar las claves privada y pública a partir de la contraseña
    //$private_key = hash('sha256', $password . 'private_salt'); //generar la clave privada
    //$public_key = hash('sha256', $password . 'public_salt'); // /generar la clave pública

    $consulta = "INSERT INTO usuarios (nombre, password, rol) VALUES ('$user', '$pass', '$rol')";

    if ($db->query($consulta) === TRUE) {
        // Obtener el ID del nuevo usuario insertado
        $id_usuario = $db->insert_id;

        
        if (strtolower($rol) === 'administrador') {
            $consulta_claves = "INSERT INTO tabla_claves (usuario_id, nombre, clave_privada, clave_publica) VALUES ('$id_usuario', '$user', '$private_key', '$public_key')";
            $db->query($consulta_claves);
        }

        // Registro exitoso, se asigna la variable de sesión
        //$_SESSION['nombre'] = $user;
        //$_SESSION['rol'] = $rol;

        // Mostrar una alerta de éxito
        echo "<script>alert('Usuario registrado exitosamente.'); window.location='../../ver.php';</script>";
    } else {
        // Mostrar una alerta de error
        echo "<script>alert('Error al registrar al usuario: " . $db->error . "'); window.location='../../ver.php';</script>";
    }
}

$db->close();
?>
