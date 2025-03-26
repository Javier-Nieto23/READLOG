<?php
function db_connect() {
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'readlog';

    $conn = new mysqli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    return $conn;
}
?>
