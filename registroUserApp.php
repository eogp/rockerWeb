<?php
require_once 'models/UsuarioAppModel.php';
require_once 'entidades/usuarioapp.php';

function logResgitroApp($contenido) {
    $nombre_archivo = "logRegistroApp.txt";

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

$contenido = mb_convert_encoding(file_get_contents('php://input'), 'UTF-8');
logResgitroApp($contenido);


$json = json_decode(mb_convert_encoding(file_get_contents('php://input'), 'UTF-8'));

$usuarioAppModel = new UsuarioAppModel();


if ($usuarioAppModel->existeEmail($json->user)> 0) {
    $retorno = json_encode(array("status" => 0));
} else {
    
    $usuarioApp = new UsuarioApp(null, $json->user, $json->pass, null, null, null, null, date("Y-m-d H:i:s"), 1, null, null);
    $usuarioApp->setId($usuarioAppModel->insertar($usuarioApp));
    $retorno = json_encode(array("status" => 1, "usuario" => $usuarioApp));
}


echo $retorno;


