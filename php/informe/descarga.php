<?php
// Iniciar sesión para usar variables de sesión
session_start();

// Verificar si el usuario está autenticado, si no redirigir al inicio de sesión
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
    
    // Si el rol del usuario no es 'Administrador', redireccionar a ver2 o ver3 dependiendo el rol
    if ($rolUsuario == 'Gerente') {
        header("Location: ../../ver3.php");
        //exit();
    }elseif($rolUsuario == 'Empleado'){
        header("Location: ../../ver2.php");
        exit();
    }
}
?>
<?php

/**
 * Función para encriptar el mensaje con cifrado simétrico (AES-256-CBC).
 *
 * @param string $mensaje El mensaje a encriptar.
 * @param string $clave La clave utilizada para cifrar el mensaje.
 * @return string El mensaje encriptado en base64.
 */
function encriptar($mensaje, $clave) {
    $clave = openssl_digest($clave, 'SHA256', true);
    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv = openssl_random_pseudo_bytes($iv_length);
    $encriptacion = openssl_encrypt($mensaje, 'aes-256-cbc', $clave, OPENSSL_RAW_DATA, $iv);
    return base64_encode($iv . $encriptacion);
}

// Información de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "crud1";

try {
    // Conexión a la base de datos utilizando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta para obtener todos los registros de la tabla "productos"
    $sql = "SELECT * FROM productos";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $productos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generar el contenido del informe en formato de texto
    $informe = "INFORME DE PRODUCTOS\n\n";
    foreach ($productos as $producto) {
        $informe .= "ID: " . $producto['id'] . "\n";
        $informe .= "Nombre: " . $producto['nombre'] . "\n";
        $informe .= "Precio: " . $producto['precio'] . "\n";
        $informe .= "Marca: " . $producto['marca'] . "\n";
        $informe .= "Stock: " . $producto['stock'] . "\n";
        $informe .= "----------------------\n";
    }

    // Cerrar la conexión a la base de datos
    $conn = null;

    // Ruta y nombre del archivo donde se guardará el informe cifrado
    $ruta_directorio = "ruta/del/directorio/";
    $ruta_archivo = $ruta_directorio . "informe_productos.txt";

    // Crear el directorio si no existe
    if (!is_dir($ruta_directorio)) {
        mkdir($ruta_directorio, 0777, true);
    }

    // Cifrar el informe antes de guardarlo en el archivo
    $clave = $_SESSION['nombre']; // Utilizamos el nombre de usuario como clave para cifrar el informe
    $informe_cifrado = encriptar($informe, $clave);

    // Guardar el informe cifrado en el archivo especificado
    file_put_contents($ruta_archivo, $informe_cifrado);

    // Establecer las cabeceras para forzar la descarga del archivo cifrado
    header("Content-Disposition: attachment; filename=informe_productos.txt");
    header("Content-Type: application/octet-stream");
    header("Content-Length: " . strlen($informe_cifrado));

    // Enviar el contenido del archivo cifrado al navegador
    echo $informe_cifrado;
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
