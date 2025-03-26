<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .table-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .btn-custom {
            background-color: #157347;
            color: #fff;
        }
        .btn-custom:hover {
            background-color: #145a32;
            color: #fff;
        }
        .header-title {
            color: #157347;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="text-center mb-4">
            <h1 class="header-title">Dashboard de Logs</h1>
            <p class="text-muted">Visualiza los registros de acceso y productos</p>
        </div>
        <div class="table-container">
            <table id="data_table" class="table table-striped table-bordered">
                <thead class="table-success">
                    <tr>
                        <th>N</th>
                        <th>FECHA</th>
                        <th>HORA</th>
                        <th>ACCION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    header('Content-Type: text/html; charset=UTF-8');
                    // Leer archivo de logs de usuarios
                    $ruta_logs = '../Media/login_attempts.log';
                    if (file_exists($ruta_logs) && is_readable($ruta_logs)) {
                        $lineas = file($ruta_logs);
                        $ciclo = 1;
                        foreach ($lineas as $linea) {
                            // Separar datos
                            $fecha = substr($linea, 0, 10);
                            $fechaSegmentada = explode("-", $fecha);
                            if (count($fechaSegmentada) == 3) {
                                $fecha = $fechaSegmentada[2] . "-" . $fechaSegmentada[1] . "-" . $fechaSegmentada[0];
                            } else {
                                $fecha = "Fecha inválida";
                            }
                            $hora = substr($linea, 11, 8);
                            $msg = substr($linea, 21);
                            $datos = array($fecha, $hora, htmlspecialchars($msg, ENT_QUOTES, 'UTF-8')); // Escapar mensaje
                            ?>
                            <tr>
                                <td><?php echo $ciclo; ?></td>
                                <td><?php echo $datos[0]; ?></td>
                                <td><?php echo $datos[1]; ?></td>
                                <td><?php echo $datos[2]; ?></td>
                            </tr>  
                            <?php
                            $ciclo++;
                        }
                    } else {
                        echo "<tr><td colspan='4'>No se pudo leer el archivo de log.</td></tr>";
                    }

                    // Leer archivo de productos
                    $ruta_productos = '../Media/productos.log';
                    $productos_data = [];
                    if (file_exists($ruta_productos) && is_readable($ruta_productos)) {
                        $lineas_productos = file($ruta_productos);
                        foreach ($lineas_productos as $linea) {
                            $productos_data[] = htmlspecialchars($linea, ENT_QUOTES, 'UTF-8'); // Escapar datos
                        }
                    }
                    ?>
                </tbody>
            </table>
            <div class="text-center mt-4">
                <a href="dashboard2.php" class="btn btn-secondary">Regresar al Dashboard</a>
                <a href="../Reportes/reporte.php?productos=<?php echo urlencode(json_encode($productos_data)); ?>" class="btn btn-custom">Generar PDF</a>
                <a href="../Vistas/enviar.php" class="btn btn-custom">Enviar Correo</a>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
