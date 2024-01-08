<?php
// Función para decifrar el mensaje con cifrado simétrico (AES-256-CBC)
function decifrar($mensaje_cifrado, $clave) {
    $clave = openssl_digest($clave, 'SHA256', true);
    $mensaje_cifrado = base64_decode($mensaje_cifrado);
    $iv_length = openssl_cipher_iv_length('aes-256-cbc');
    $iv = substr($mensaje_cifrado, 0, $iv_length);
    $encriptacion = substr($mensaje_cifrado, $iv_length);
    return openssl_decrypt($encriptacion, 'aes-256-cbc', $clave, OPENSSL_RAW_DATA, $iv);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que se haya enviado un archivo y una clave
    if (isset($_FILES['archivo_cifrado']['tmp_name']) && isset($_POST['clave'])) {
        // Información del archivo
        $archivo_tmp = $_FILES['archivo_cifrado']['tmp_name'];
        $nombre_archivo = $_FILES['archivo_cifrado']['name'];

        // Leer el contenido del archivo cifrado
        $contenido_cifrado = file_get_contents($archivo_tmp);

        // Clave de descifrado
        $clave = $_POST['clave'];

        // Decifrar el contenido
        $contenido_descifrado = decifrar($contenido_cifrado, $clave);

        // Mostrar el contenido descifrado en el navegador
        header("Content-Disposition: attachment; filename=$nombre_archivo.decifrado.txt");
        header("Content-Type: text/plain");
        header("Content-Length: " . strlen($contenido_descifrado));
        echo $contenido_descifrado;
    } else {
        // Si no se enviaron los datos adecuados, redirigir al formulario
        header("Location: formulario_decifrar.html");
    }
} else {
    // Si se intenta acceder directamente al script, redirigir al formulario
    header("Location: formulario_decifrar.html");
}
?>
