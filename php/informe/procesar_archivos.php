<?php
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

// Función para cifrar el contenido utilizando AES
function encryptData($data, $key) {
    // (Mantener el resto del código de cifrado igual)
}

// Función para descifrar el contenido utilizando AES
function decryptData($data, $key) {
    $key = openssl_digest($key, 'SHA256', TRUE);
    $data = base64_decode($data);
    $iv_length = openssl_cipher_iv_length('AES-256-CBC');
    $iv = substr($data, 0, $iv_length);
    $data = substr($data, $iv_length);
    return openssl_decrypt($data, 'AES-256-CBC', $key, OPENSSL_RAW_DATA, $iv);
}

// Conexión a la base de datos
// (Mantener el código de conexión a la base de datos)

if (isset($_POST['submit'])) {
    // Verificar si se ha subido el archivo .txt y se ha proporcionado la clave y la contraseña
    if (isset($_FILES['csvFile']['tmp_name']) && isset($_POST['keyContent']) && isset($_POST['password'])) {
        $csvFile = $_FILES['csvFile'];
        $keyContent = $_POST['keyContent'];
        $password = $_POST['password'];

        // Obtener el nombre del usuario en sesión
        $nombre_usuario = $_SESSION['nombre'];

        // Consultar la clave del usuario en la tabla "tabla_claves"
        // (Mantener el código de consulta de clave del usuario)

        // Verificar si se encontró la clave del usuario
        // (Mantener el código para obtener la clave del usuario)

        // Leer el contenido del archivo .txt cifrado
        $csvContentCifrado = file_get_contents($csvFile['tmp_name']);

        // Descifrar el contenido del archivo TXT utilizando la clave
        $csvContentDescifrado = decryptData($csvContentCifrado, $password);

        // Generar el nombre del archivo TXT descifrado
        $nombre_archivo_descifrado = 'lista_proveedores_descifrado.txt';

        // Agregar encabezados para la descarga del archivo TXT
        header('Content-Type: text/plain'); // Cambiamos el tipo de contenido a "text/plain"
        header('Content-Disposition: attachment; filename=' . $nombre_archivo_descifrado);

        // Abrir el archivo en modo escritura
        $archivo_descifrado = fopen('php://output', 'w');

        // Escribir el contenido descifrado en el archivo TXT
        fwrite($archivo_descifrado, $csvContentDescifrado);

        // Cerrar el archivo
        fclose($archivo_descifrado);

        // Finalizar el script
        exit();
    } else {
        echo "Por favor, asegúrate de cargar el archivo .txt, proporcionar la clave y la contraseña.";
    }
}
?>
