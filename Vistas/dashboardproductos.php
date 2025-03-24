<?php
// Conexión a la base de datos
require_once '../Db-conexiones/data_config.php';
$conn = new mysqli(HOSTNAME, USERNAME, PASSWORD, DBNAME);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obtener los productos desde la base de datos
$sql = "SELECT * FROM productos";
$result = $conn->query($sql);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Dashboard - Productos</title>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Dashboard - Productos</h2>
        
        <!-- Botón Nuevo Producto -->
        <div class="mb-4 text-right">
            <a href="nuevo_producto.php" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddProduct">Nuevo Producto</a>
        </div>

        <!-- Tabla de productos -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Costo</th>
                    <th>Costo IVA</th>
                    <th>Costo Total</th>
                    <th>Acciones</th>
                </tr>
            </thead> 
            <tbody>
            <?php
            // Suponiendo que tienes una variable $productos que contiene los productos
            while ($producto = $result->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $producto['id']; ?></td>
                <td><?php echo $producto['nombre']; ?></td>
                <td><?php echo $producto['descripcion']; ?></td>
                <td><?php echo $producto['costo_importe']; ?></td>
                <td><?php echo $producto['costo_iva']; ?></td>
                <td>
                    <!-- Botón de editar -->
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalEditProduct" onclick="editProduct(<?php echo $producto['id']; ?>)">Editar</button>
                    <!-- Botón de eliminar -->
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteProduct" onclick="confirmDelete(<?php echo $producto['id']; ?>)">Eliminar</button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
        </table>
    </div>

    <!-- Modal para añadir producto -->
    <div class="modal fade" id="modalAddProduct" tabindex="-1" aria-labelledby="modalAddProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddProductLabel">Añadir Nuevo Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="add_product.php" method="POST">
                        <div class="mb-3">
                            <label for="productName" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="productName" name="productName" required>
                        </div>
                        <div class="mb-3">
                            <label for="productDescription" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="productDescription" name="productDescription" required>
                            </div>
                            <div class="mb-3">
                                <label for="editProductImporte" class="form-label">Costo Importe</label>
                                <input type="number" class="form-control" id="editProductImporte" name="editProductImporte" required>
                            </div>
                            <div class="mb-3">
                                <label for="editProductIva" class="form-label">Costo iva </label>
                                <input type="number" class="form-control" id="editProductIva" name="editProductIva" required>
                            </div>
                            <div class="mb-3">
                                <label for="editProductCostotal" class="form-label">Costo Total </label>
                                <input type="number" class="form-control" id="editProductCostotal" name="editProductCostotal" required>
                            </div>
                        <button type="submit" class="btn btn-primary">Añadir Producto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para editar producto -->
    <div class="modal fade" id="modalEditProduct" tabindex="-1" aria-labelledby="modalEditProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditProductLabel">Editar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="edit_product.php" method="POST">
                        <input type="hidden" id="editProductId" name="editProductId">
                        <div class="mb-3">
                            <label for="editProductName" class="form-label">Nombre del Producto</label>
                            <input type="text" class="form-control" id="editProductName" name="editProductName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductDescription" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="editProductDescription" name="editProductDescription" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductImporte" class="form-label">Costo Importe</label>
                            <input type="number" class="form-control" id="editProductImporte" name="editProductImporte" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductIva" class="form-label">Costo iva </label>
                            <input type="number" class="form-control" id="editProductIva" name="editProductIva" required>
                        </div>
                        <div class="mb-3">
                            <label for="editProductCostotal" class="form-label">Costo Total </label>
                            <input type="number" class="form-control" id="editProductCostotal" name="editProductCostotal" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para eliminar producto -->
    <div class="modal fade" id="modalDeleteProduct" tabindex="-1" aria-labelledby="modalDeleteProductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalDeleteProductLabel">Eliminar Producto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar este producto?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <a href="#" id="deleteConfirmButton" class="btn btn-danger">Eliminar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Función para llenar el modal de editar producto
        function editProduct(id) {
            // Aquí debes obtener los datos del producto por su ID y llenar los campos del formulario
            // Ejemplo:
            document.getElementById("editProductId").value = id;
            document.getElementById("editProductName").value = "Nombre del Producto";
            document.getElementById("editProductDescription").value = "Descripción";
            document.getElementById("editProductPrice").value = "Costo_importe";
            document.getElementById("editProductStock").value = "Costo_iva";
            document.getElementById("editProductTotal").value = "Costo_Total";
        }

        // Función para confirmar eliminación
        function confirmDelete(id) {
            var deleteUrl = "delete_product.php?id=" + id; // URL para eliminar el producto
            document.getElementById("deleteConfirmButton").href = deleteUrl;
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
