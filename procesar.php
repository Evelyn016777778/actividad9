<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger y limpiar los datos
    $nombre = trim($_POST['nombre'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');

    $errores = [];

    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($correo) || empty($mensaje)) {
        $errores[] = "Todos los campos son obligatorios.";
    }

    // Validar que el correo tenga un formato válido
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El formato del correo electrónico no es válido.";
    }

    // Si hay errores, mostrarlos y detener el proceso
    if (!empty($errores)) {
        echo "<h3>Errores en el formulario:</h3><ul>";
        foreach ($errores as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul><br><a href='index.php'>Volver</a>";
        exit;
    }

    // Almacenar los datos validados en un archivo de texto plano en el servidor
    $fechaHora = date("Y-m-d H:i:s");
    $registro = "Fecha: $fechaHora | Nombre: $nombre | Correo: $correo | Mensaje: $mensaje\n";
    $archivo = 'datos.txt';
    
    if (file_put_contents($archivo, $registro, FILE_APPEND | LOCK_EX) !== false) {
        echo "<h2>¡Datos guardados con éxito en el archivo de texto!</h2>";
        echo "<p>Gracias por contactarnos, $nombre.</p>";
        echo "<br><a href='index.php'>Enviar otro mensaje</a>";
    } else {
        echo "<p>Hubo un error al almacenar los datos en el servidor.</p>";
        echo "<br><a href='index.php'>Volver</a>";
    }
} else {
    header("Location: index.php");
    exit;
}
?>