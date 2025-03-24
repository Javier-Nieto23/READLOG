
<?php
require_once 'Db-conexiones/data_config.php';

$conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $conn->real_escape_string($_POST['productName']);
    $descripcion = $conn->real_escape_string($_POST['productDescription']);
    $costo_importe = floatval($_POST['editProductImporte']);
    $costo_iva = floatval($_POST['editProductIva']);
    $costo_total = floatval($_POST['editProductCostotal']);

    // Insertar en la base de datos
    $stmt = $conn->prepare("INSERT INTO productos (nombre, descripcion, costo_importe, costo_iva, costo_total) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssddd", $nombre, $descripcion, $costo_importe, $costo_iva, $costo_total);

if ($stmt->execute()) {
    // Obtener la fecha y hora actual
    $fecha = date("Y-m-d H:i:s");

    // Registro en archivo log
    $logMessage = "[$fecha] Producto añadido: $nombre | Descripción: $descripcion | Costo Importe: $costo_importe | Costo IVA: $costo_iva | Costo Total: $costo_total" . PHP_EOL;
    file_put_contents('Media/productos.log', $logMessage, FILE_APPEND);


    if ($conn->query($sql) === TRUE) {
        // Redireccionar de vuelta al dashboard con un mensaje de éxito
        header("Location: Vistas/dashboardproducts.php");
    } else {
        echo "Error al insertar el producto: " . $conn->error;
    }
    
    }

    $conn->close();
}
?>