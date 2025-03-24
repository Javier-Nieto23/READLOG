
<?php
require_once 'Db-conexiones/data_config.php';

$conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

    // E|iminar el producto de la base de datos
if (isset($_GET['id'])) {   
    $sql = "DELETE FROM productos WHERE id = " . $_GET['id'];

    if ($conn->query($sql) === TRUE) {
        // Redireccionar de vuelta al dashboard con un mensaje de éxito
        header("Location: /Vistas/dashboardproducts.php");
    } else {
        echo "Error al insertar el producto: " . $conn->error;
    }
}

$conn->close();
?>