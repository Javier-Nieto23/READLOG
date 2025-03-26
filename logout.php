<?php
session_start();

// Verificar si hay un usuario en sesión
if (isset($_SESSION['usuario'])) {
    $usuario = htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8'); // Escapar caracteres especiales

    // Registrar en el log el cierre de sesión
    $log_file = 'Media/login_attempts.log';
    if (file_exists($log_file) && is_writable($log_file)) {
        $log_message = date('Y-m-d H:i:s') . " - RFC Empresa: $usuario - Cerró sesión\n";
        file_put_contents($log_file, $log_message, FILE_APPEND);
    }

    // Destruir sesión
    session_unset();
    session_destroy();
}

// Redirigir al index.php
header("Location: index.php");
exit();
?>
