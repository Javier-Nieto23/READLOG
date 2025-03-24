<!doctype html>
<html lang="en">
    <head>
        <title>Title</title>
        <!-- Required meta tags -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"crossorigin="anonymous"/>
        <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
         <div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
                <div class="card shadow-lg" style="width: 100%; max-width: 400px;">
                <div class="card-body">
                    <h5 class="card-title text-center mb-4">Iniciar sesión</h5>
                    <form action="" method="POST">
                    <!-- Campo de Usuario -->
                    <div class="mb-3">
                        <label for="username" class="form-label">RFC Empresa</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Ingrese su usuario" required>
                    </div>
                    <!-- Campo de Contraseña -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingrese su contraseña" required>
                    </div>
                    <!-- Botón de Login -->
                    <button type="button" id="btnIniciarSesion" class="btn btn-primary w-100">Iniciar sesión</button>
                    </form>
                    <div class="text-center mt-3">
                    <a href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
                </div>
            </div>
        </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
        <script src="js/jQuery-3.6.0/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $("#btnIniciarSesion").click(function() {
                    var usuario = $("#username").val();
                    var contrasena = $("#password").val();
                    $.ajax({
                        url: 'login.php',
                        type: 'POST',
                        data: { username: usuario, password: contrasena },
                        success: function(response) {
                            if(response == "success") {
                                window.location.href = "Vistas/Dashboard2.php";
                            } else {
                                alert("Usuario o contraseña incorrecta");
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>




