<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../libs/vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

$correo_enviado = false;

try {
    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
// Looking to send emails in production? Check out our Email API/SMTP product!
   // Looking to send emails in production? Check out our Email API/SMTP product!
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = 'adfebaaa104d58';
    $mail->Password = 'cdd1bdeb9a9fb0';                 //SMTP password
    //$mail->SMTPSecure = tls;            //Enable implicit TLS encryption
    

    //Recipients
    $mail->setFrom('sistemas@caast.com.mx', 'Servicio de Entrega LOG'); //desde donde se envia
    $mail->addAddress('xfrykkynoobsterx@gmail.com', 'Javier Nieto');     //Add a recipient a quien se envia
    $mail->addAddress('sistemas@caast.com.mx');               //Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment('C:/laragon/www/READLOG/Media/login_attempts.log'); 
    $mail->addAttachment('C:/laragon/www/READLOG/Media/productos.log');       //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Aviso de accesos portal web';
    $mail->Body    = '<b>Entrega de log acceso a portal web!</b>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    $correo_enviado = true;
} catch (Exception $e) {
    echo "Mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
}

if ($correo_enviado) {
    echo '<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Correo Enviado</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <script>
            function redirectToLogDashboard() {
                window.location.href = "LogDashboard.php";
            }
        </script>
    </head>
    <body>
        <div class="modal" tabindex="-1" style="display: block; background-color: rgba(0, 0, 0, 0.5);">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Éxito</h5>
                    </div>
                    <div class="modal-body">
                        <p>Correo enviado exitosamente.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="redirectToLogDashboard()">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>';
} else {
    echo '<p>Error al enviar el correo. Por favor, inténtelo de nuevo.</p>';
}
?>