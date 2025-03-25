<?php
session_start();

// Verificar si ya hay un usuario almacenado en la sesión
if (!isset($_SESSION['usuario']) && isset($_POST['username'])) {
    $_SESSION['usuario'] = $_POST['username']; // Guardar el usuario en la sesión
}

$usuario = $_SESSION['username']; // Obtener el nombre del usuario en sesión
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard con Menú de Sesión</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .sidebar {
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 10px 31px;
            text-decoration: none;
            display: block;
        }
        .sidebar a:hover {
            background-color: #575757;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h4 class="text-white text-center mb-4">Mi Dashboard</h4>
        <!-- Menú de navegación lateral -->
        <a href="dashboardproductos.php">productos</a>
        <a href="#">Usuarios</a>
        <a href="#">Configuraciones</a>
        <a href="#">Reportes</a>
        <a href="LogDashboard.php">Logs</a>
        <a href="../logout.php">Cerrar sesión</a>
        
    </div>

   <!-- aqui se debera poner novedades de la pagina -->
    <div class="content">
        <h2>Bienvenido al Dashboard</h2>
        <p>Este es un dashboard con menú de sesión en PHP.</p>
    <!-- Bootstrap JS y dependencias -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
