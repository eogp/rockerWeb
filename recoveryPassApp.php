<?php

require_once 'models/UsuarioAppModel.php';
require_once 'entidades/usuarioapp.php';

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';
require 'vendor/phpmailer/phpmailer/src/OAuth.php';

function logResgitroApp($contenido) {
    $nombre_archivo = "logRecoveryPassApp.txt";

    if (file_exists($nombre_archivo)) {
        $mensaje = "\n ----------------------------INICIO------------------------- \n"
                . "El Archivo $nombre_archivo se ha modificado";
    } else {
        $mensaje = "El Archivo $nombre_archivo se ha creado";
    }

    if ($archivo = fopen($nombre_archivo, "a+")) {
        if (fwrite($archivo, $mensaje . date("d-m-Y h:i:s") . "\n")) {
            fwrite($archivo, date("d-m-Y h:i:s") . " " . $contenido . "\n");
            fwrite($archivo, "\n ----------------------------FIN--------------------------- \n");
        } else {
            echo "Ha habido un problema al crear el archivo";
        }

        fclose($archivo);
    }
}

function generarContraseña() {
    //Carácteres para la contraseña
    $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
    $password = "";
    //Reconstruimos la contraseña segun la longitud que se quiera
    for ($i = 0; $i < 8; $i++) {
        //obtenemos un caracter aleatorio escogido de la cadena de caracteres
        $password .= substr($str, rand(0, 62), 1);
    }
    return $password;
}

function insertarContraseña($email, $pass) {
    $usuarioAppModel = new UsuarioAppModel();
    $usuarioApp = $usuarioAppModel->ObtenerUsuarioByEmail($email);
    $usuarioApp->setPass($pass);
    $usuarioAppModel->actualizarUsuario($usuarioApp);
}

function recoveryPass() {
    $json = json_decode(mb_convert_encoding(file_get_contents('php://input'), 'UTF-8'));
    $usuarioAppModel = new UsuarioAppModel();
    if ($usuarioAppModel->existeEmail($json->user)) {
        $contenido = mb_convert_encoding(file_get_contents('php://input'), 'UTF-8');
        $pass = generarContraseña();
        $mail = new PHPMailer(true);                                // Passing `true` enables exceptions
        try {
            //Server settings
            //$mail->SMTPDebug = 4;                                 // Enable verbose debug output
            $mail->isSMTP();                                        // Set mailer to use SMTP
            $mail->SMTPAuth = true;                                 // Enable SMTP authentication
            $mail->Port = 587;                                      // TCP port to connect to
            $mail->isHTML(true);                                    // Set email format to HTML
            $mail->CharSet = "utf-8";

            $mail->Host = 'mail.c0990002.ferozo.com';               // Specify main and backup SMTP servers
            $mail->Username = 'no-reply@c0990002.ferozo.com';                 // SMTP username
            $mail->Password = 'R853VjN*M0';                         // SMTP password
            //$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
            //Recipients
            $mail->From = 'no-reply@c0990002.ferozo.com';
            $mail->FromName = "RockerApp";
            //$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
            $mail->addAddress($json->user);              // Name is optional
            $mail->addReplyTo('info@rockerapp.com');
            //$mail->addCC('cc@example.com');
            //$mail->addBCC('bcc@example.com');
            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
            //Content
            $mail->Subject = 'Recupero de constraseña';
            $mensajeHtml = nl2br('Generamos una nueva contraseña para ti, recuerda cambiarla. CONTRASEÑA: ' . $pass);
            $mensaje = 'Generamos una nueva contraseña para ti, recuerda cambiarla. CONTRASEÑA :' . $pass;
            $mail->Body = "{$mensajeHtml} <br /><br />Atte. El equipo de Rockerapp.com";

            $mail->AltBody = "{$mensaje}  \n\n Atte. El equipo de Rockerapp.com";
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $estado = $mail->send();

            if ($estado) {
                insertarContraseña($json->user, $pass);
                $contenido .= "\n Recupero de contraseña solicitado y enviado con exito para: " . $json->user;
                $retorno = json_encode(array("status" => 1));
            } else {
                $contenido .= "\n Recupero de contraseña solicitado pero enviado sin exito para: " . $json->user;
                $retorno = json_encode(array("status" => 2));
            }
        } catch (Exception $e) {
            $retorno = json_encode(array("status" => 2));
        }
    } else {
        $contenido .= "\n Recupero de contraseña solicitado para mail fuera de db: " . $json->user;
        $retorno = json_encode(array("status" => 0));
    }
    logResgitroApp($contenido);
    echo $retorno;
}

recoveryPass();

