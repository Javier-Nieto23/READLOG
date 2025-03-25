<?php
session_start();

// Verificar si hay un usuario en sesión
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];

    // Registrar en el log el cierre de sesión
    $log_message = date('Y-m-d H:i:s') . " - Usuario: $usuario - Cerró sesión\n";
    file_put_contents('Media/login_attempts.log', $log_message, FILE_APPEND);

    // Destruir sesión
    session_unset();
    session_destroy();
}
// Redirigir al index.php
header("Location: index.php");
exit();
?>
