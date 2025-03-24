<div class="container">
    <div class="" style="margin: 8px;">
        <table id="data_table" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr style="color:#157347; background-color:#fff;">
                    <th>N</th>
                    <th>FECHA</th>
                    <th>HORA</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
            <div class="text-center mt-3">
            <a href="dashboard2.php" class="btn btn-secondary">Regresar al Dashboard</a>
            </div>
                <?php
                    header('Content-Type: text/html; charset=UTF-8');
                    // Leer archivo            
                    $ruta='../Media/login_attempts.log';
                    $lineas = file($ruta);
                    $ciclo=1;
                    foreach ($lineas as $linea) {
                        // Separar datos
                        $fecha = substr($linea, 0, 10);
                        $fechaSegmentada = explode("-", $fecha);
                        if (count($fechaSegmentada) == 3) {
                            $fecha = $fechaSegmentada[2]."-".$fechaSegmentada[1]."-".$fechaSegmentada[0];
                        } else {
                            $fecha = "Fecha inválida";
                        }
                        $hora = substr($linea, 11, 8);
                        $msg = substr($linea, 21);
                        $datos = array($fecha, $hora, utf8_encode($msg));
                        
                        // Mostrar datos
                        ?>
                        <tr>
                            <td><?php echo $ciclo;?></td>
                            <td><?php echo $datos[0];?></td>
                            <td><?php echo $datos[1];?></td>
                            <td><?php echo $datos[2];?></td>
                        </tr>  
                        <?php
                        $ciclo++;
                    }
                    
                    // Generar PDF
                    echo '<a href="../Reportes/reporte.php">Generar PDF</a>';
                    echo '<hr>';
                    // Enviar correo
                    echo '<a href="../Vistas/enviar.php">Enviar correo</a>';
                ?>
            </tbody>
        </table>
        <!-- Botón para regresar a LogDashboard2.php -->

    </div><!-- /.container vacio-->
</div><!-- /.container -->
