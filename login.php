<?php
require_once 'Db-conexiones/data_config.php';

// Crear conexión
$conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $rfc_empresa = $_POST['username'];
    $contrasena = $_POST['password'];

    $sql = "SELECT * FROM usuarios WHERE rfc_empresa = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $rfc_empresa, $contrasena);
    $stmt->execute();
    $result = $stmt->get_result();

    // Registrar intento de inicio de sesión
    $log_message = date('Y-m-d H:i:s') . " - Usuario: $rfc_empresa - ";
    if ($result->num_rows > 0) {
        echo "success";
        $log_message .= "Inicio de sesion exitoso\n";
    } else {
        echo "error";
        $log_message .= "Error en inicio de sesion\n";
    }

    // Escribir en el archivo de log
    file_put_contents('Media/login_attempts.log', $log_message, FILE_APPEND);



    $stmt->close();
}

$conn->close();
?>
