<?php

require_once 'models/UsuarioAppModel.php';
require_once 'entidades/usuarioapp.php';
//guardado en log de la peticion-----------------------
function logLoginApp($contenido) {
    $nombre_archivo = "logLoginAppFacebook.txt";

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
logLoginApp($contenido);
//-----------------------------------------------------

//obtencion de datos
$json = json_decode(mb_convert_encoding(file_get_contents('php://input'), 'UTF-8'));
//conuslta de ususarioApp a la BD

$usuarioAppModel=new UsuarioAppModel();
$usuarioApp=$usuarioAppModel->ObtenerUsuarioByFaceId($json->faceid);

//verificacion de resultado de consulta
if(isset($usuarioApp)){
    $usuarioApp->setEmail($json->email);
    $usuarioApp->setNombre($json->first_name);
    $usuarioApp->setApellido($json->last_name);
    $usuarioApp->setImageURI($json->imageURi);
    $usuarioAppModel->actualizarUsuario($usuarioApp);
}else{
    $usuarioApp=new UsuarioApp(null, 
                    $json->email, 
                    null, 
                    $json->first_name, 
                    $json->last_name, 
                    null, 
                    null, 
                    date("d-m-Y h:i:s"), 
                    1, 
                    $json->faceid, 
                    $json->imageURi);
    $usuarioApp->setId($usuarioAppModel->insertar($usuarioApp));
}

//retorno data sincronizada
echo json_encode(array("status"=>1,"usuario"=>$usuarioApp));

//http_response_code(200);
