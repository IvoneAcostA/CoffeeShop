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
// Función para encriptar el mensaje con cifrado simétrico (AES-256-CBC)
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

    // Consulta para obtener solo la columna "Descripcion" de la tabla "productos"
    $sql = "SELECT descripcion FROM productos";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $descripciones = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Cerrar la conexión a la base de datos
    $conn = null;

    // Concatenar las descripciones en un solo string con la línea divisoria
    $contenido = implode("\n----------------------\n", $descripciones);

    // Ruta y nombre del archivo donde se guardará la descripción cifrada
    $ruta_directorio = "ruta/del/directorio/";
    $ruta_archivo = $ruta_directorio . "proveedores_cifrados.txt";

    // Crear el directorio si no existe
    if (!is_dir($ruta_directorio)) {
        mkdir($ruta_directorio, 0777, true);
    }

    // Cifrar el contenido antes de guardarlo en el archivo
    $clave = $_SESSION['nombre']; // Utilizamos el nombre de usuario como clave para cifrar las descripciones
    $contenido_cifrado = encriptar($contenido, $clave);

    // Guardar el contenido cifrado en el archivo especificado
    file_put_contents($ruta_archivo, $contenido_cifrado);

    // Establecer las cabeceras para forzar la descarga del archivo cifrado
    header("Content-Disposition: attachment; filename=proveedores_cifrados.txt");
    header("Content-Type: application/octet-stream");
    header("Content-Length: " . strlen($contenido_cifrado));

    // Enviar el contenido del archivo cifrado al navegador
    echo $contenido_cifrado;
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
