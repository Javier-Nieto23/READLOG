<?php
// Iniciar sesión
session_start();

// Obtener el nombre de usuario antes de destruir la sesión
$rfc_empresa = isset($_SESSION['username']) ? $_SESSION['username'] : 'Desconocido';

// Registrar cierre de sesión
$log_message = date('Y-m-d H:i:s') . " - Usuario: $rfc_empresa - Cierre de sesion\n";
file_put_contents('Media/login_attempts.log', $log_message, FILE_APPEND);

// Destruir todas las sesiones
session_destroy();

// Redirigir al index.php
header("Location: index.php");
exit();
?>
