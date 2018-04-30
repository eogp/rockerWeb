<?php

require_once 'entidades/bandas.php';
require_once 'entidades/direccion.php';
require_once 'entidades/equipos.php';
require_once 'entidades/equipos_marcas.php';
require_once 'entidades/estilovida.php';
require_once 'entidades/estilovida_productos.php';
require_once 'entidades/horarios.php';
require_once 'entidades/imagen.php';
require_once 'entidades/instrumentos.php';
require_once 'entidades/instrumentos_marcas.php';
require_once 'entidades/marcas.php';
require_once 'entidades/pagos.php';
require_once 'entidades/pais.php';
require_once 'entidades/perfil.php';
require_once 'entidades/precioHora.php';
require_once 'entidades/productos.php';
require_once 'entidades/provincia.php';
require_once 'entidades/publicacion.php';
require_once 'entidades/publicacion_direccion.php';
require_once 'entidades/publicacion_equipos.php';
require_once 'entidades/publicacion_estilovida.php';
require_once 'entidades/publicacion_instrumentos.php';
require_once 'entidades/publicacion_servicios.php';
require_once 'entidades/publicacion_serviciosProf.php';
require_once 'entidades/publicacion_showeventos.php';
require_once 'entidades/publicacion_telefono.php';
require_once 'entidades/servicios.php';
require_once 'entidades/serviciosProf.php';
require_once 'entidades/showeventos.php';
require_once 'entidades/telefono.php';
require_once 'entidades/tipoPub.php';
require_once 'entidades/usuarioWeb.php';
require_once 'entidades/usuarioweb_direccion.php';
require_once 'entidades/usuarioweb_telefono.php';
require_once 'entidades/video.php';

require_once 'models/BandasModel.php';
require_once 'models/DireccionModel.php';
require_once 'models/EquiposModel.php';
require_once 'models/Equipos_marcasModel.php';
require_once 'models/EstilovidaModel.php';
require_once 'models/Estilovida_productosModel.php';
require_once 'models/HorariosModel.php';
require_once 'models/ImagenModel.php';
require_once 'models/InstrumentosModel.php';
require_once 'models/Instrumentos_marcasModel.php';
require_once 'models/MarcasModel.php';
require_once 'models/PagosModel.php';
require_once 'models/PaisModel.php';
require_once 'models/PerfilModel.php';
require_once 'models/PreciohoraModel.php';
require_once 'models/ProductosModel.php';
require_once 'models/ProvinciaModel.php';
require_once 'models/PublicacionModel.php';
require_once 'models/Publicacion_direccionModel.php';
require_once 'models/Publicacion_equiposModel.php';
require_once 'models/Publicacion_estilovidaModel.php';
require_once 'models/Publicacion_instrumentosModel.php';
require_once 'models/Publicacion_serviciosModel.php';
require_once 'models/Publicacion_serviciosProfModel.php';
require_once 'models/Publicacion_showeventosModel.php';
require_once 'models/Publicacion_telefonoModel.php';
require_once 'models/ServiciosModel.php';
require_once 'models/ServiciosProfModel.php';
require_once 'models/ShoweventosModel.php';
require_once 'models/TelefonoModel.php';
require_once 'models/TipoPubModel.php';
require_once 'models/UsuarioWebModel.php';
require_once 'models/Usuarioweb_direccionModel.php';
require_once 'models/Usuarioweb_telefonoModel.php';
require_once 'models/VideoModel.php';

require_once 'Password.php';
require_once "recaptchalib.php";

// your secret key
$secret = "6Ld8qkkUAAAAAMQGwNYcnWBKTF-eLXnlQV50ArI6";
 
// empty response
$response = null;
 
// check secret key
$reCaptcha = new ReCaptcha($secret);

//VAIDACIONES ------------------------------------------------------------------
function inputsNotNull() {
    //print_r("inputsNotNull");
    return isset($_POST['email'])
            and isset($_POST['retryEmail'])
            and isset($_POST['pass'])
            and isset($_POST['retryPass']);
}

function validarEmail() {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        //print_r("validarEmail: true");
        return true;
    }
    //print_r("validarEmail: false");
    return false;
}

function validarPass() {
    if (strlen($_POST['pass']) < 8) {
        //"La clave debe tener al menos 6 caracteres";
        //print_r("validarPass: pass < 4. ");
        return false;
    }
    if (strlen($_POST['pass']) > 20) {
        //"La clave no puede tener más de 16 caracteres";
        //print_r("validarPass: pass > 8. ");
        return false;
    }

    //print_r("validarPass: true. ");
    return true;
}

//------------------------------------------------------------------------------
//LOGIN USUSARIO ---------------------------------------------------------------
function loginUsuarioWeb($email, $pass) {
    if (isset($email) && isset($pass)) {
        $usuarioWebModel = new UsuarioWebModel();
        $usuarioWeb = $usuarioWebModel->ObtenerUsuarioWebByEmail($email);
        //print_r($usuarioWeb);

        if (isset($usuarioWeb)) {
            if (Password::verify($pass, $usuarioWeb->getPass())) {
                //iniciar secion y abrir cpanelUser
                session_start();
                $_SESSION['usuario'] = $usuarioWeb;
                header('Location: /PUser.php');
                exit();
            } else {
                header('Location: /ErrorLogin.php');
                exit();
            }
        } else {
            header('Location: /ErrorLogin.php');
            exit();
            //print_r("Email o contraseña incorrectos.");
        }
    } else {
        header('Location: /ErrorLogin.php');
        exit();
        //print_r("complete los campos email y pass correctamente.");
    }
    //abrir cpanelUser
    //header('Location: PUser.php');
    //exit();
}

//------------------------------------------------------------------------------
//ALTA DE USUARIO---------------------------------------------------------------
function altaUsuarioWeb() {
    //print_r("altaUsuarioWeb: iniciando verifiacion de datos");
    if (inputsNotNull() && validarEmail() && validarPass()) {
        $fechaYhora = date("Y-m-d H:i:s");
        $usuarioWebModel = new UsuarioWebModel();

        if ($usuarioWebModel->existeEmail($_POST['email']) > 0) {
            //print_r("altaUsuarioWeb: ya existe email en BD");
            //abre pagina de ExisteEmail
            header('Location: /ExisteEmail.php');
            exit();
        } else {
            //print_r("altaUsuarioWeb: iniciando insert de ususario");
            //UsuarioWeb no existe en BD, se procede al alta.
            //generamos contraseña
            $hash = Password::hash($_POST['pass']);
            $usuarioWeb = new UsuarioWeb(null, $_POST['email'], $hash, null, null, null, null, null, null, $fechaYhora, 1, null, 2);
            $usuarioWebModel->insertar($usuarioWeb);
            //$usuarioWebModel->ObtenerUsuarioWeb($_POST['email'], $_POST['pass'])->getId();
            //Login nuevo usuarioWeb
            loginUsuarioWeb($_POST['email'], $_POST['pass']);
        }
    } else {
        //print_r("altaUsuarioWeb: error validando imputs");
        //abre pagina de error
        header('Location: /ErrorAlta.php');
        //print_r("formulario null");
        exit();
    }
}

//------------------------------------------------------------------------------
//BLOQUE PARA ACTUALIZAR DATOS DEL USUARIO--------------------------------------
//DIRECCION
function actualizarDireccion(Usuarioweb_direccion $usuarioweb_direcion) {

    $direccionModel = new DireccionModel();
    $direccion = new Direccion($usuarioweb_direcion->getDireccion_id(), null, null, $_POST["altura"], $_POST["calle"], null, $_POST["ciudad"], null, null, $_POST["pais"], $_POST["provincia"], null, null);
    $direccionModel->actualizarDireccion($direccion);
}

function insertarDireccion(UsuarioWeb $usuario) {
    $direccionModel = new DireccionModel();
    $direccion = new Direccion(null, null, null, $_POST["altura"], $_POST["calle"], null, $_POST["ciudad"], null, null, $_POST["pais"], $_POST["provincia"], null, null);
    $direccion_id = $direccionModel->insertar($direccion);
    $usuarioweb_direccionModel = new Usuarioweb_direccionModel();
    $usuarioweb_direccion = new Usuarioweb_direccion(null, $usuario->getId(), $direccion_id);
    $usuarioweb_direccionModel->insertar($usuarioweb_direccion);
}

//TELEFONO
function actualizarTelefono(Usuarioweb_telefono $usuarioweb_telefono) {
    $telefonoModel = new TelefonoModel();
    $telefono = new Telefono($usuarioweb_telefono->getTelefono_id(), $_POST["telefono"], $_POST["codarea"], null, isset($_POST["celular"]));
    $telefonoModel->actualizarTelefono($telefono);
}

function insertarTelefono(UsuarioWeb $usuario) {
    $telefonoModel = new TelefonoModel();
    $telefono = new Telefono(null, $_POST["telefono"], $_POST["codarea"], null, isset($_POST["celular"]));
    $telefono_id = $telefonoModel->insertar($telefono);
    $usuarioweb_telefonoModel = new Usuarioweb_telefonoModel();
    $usuarioweb_telefono = new Usuarioweb_telefono(null, $usuario->getId(), $telefono_id);
    $usuarioweb_telefonoModel->insertar($usuarioweb_telefono);
}

function actualizarUsuarioWeb(UsuarioWeb $usuario) {
    //actuliza campos tabla usuario
    if (isset($_POST["nombre"]) && isset($_POST["apellido"])) {
        $usuariowebModel = new UsuarioWebModel();
        $usuario->setPnombre($_POST["nombre"]);
        $usuario->setPapellido($_POST["apellido"]);
        $usuariowebModel->actualizarUsuarioWeb($usuario);
    }
    //actuliza o crea tabla direccion y vincula con usuarioWeb
    if (isset($_POST["calle"]) &&
            isset($_POST["altura"]) &&
            isset($_POST["ciudad"]) &&
            isset($_POST["provincia"]) &&
            isset($_POST["pais"])) {
        $usuarioweb_direccionModel = new Usuarioweb_direccionModel();
        $usuarioweb_direcion = $usuarioweb_direccionModel->ObtenerUsuarioweb_direccionByUserID($usuario->getId());
        if (isset($usuarioweb_direcion)) {
            actualizarDireccion($usuarioweb_direcion);
        } else {
            insertarDireccion($usuario);
        }
    } else {
        header('Location: /ErrorActualizarDatos.php');
        exit();
    }
    //actualiza o crea tabla telefono y la vincula con usuarioweb
    if (isset($_POST["telefono"])) {
        $usuarioweb_telefonoModel = new Usuarioweb_telefonoModel();
        $usuarioweb_telefono = $usuarioweb_telefonoModel->ObtenerUsuarioweb_telefonoByUserID($usuario->getId());
        if (isset($usuarioweb_telefono)) {
            actualizarTelefono($usuarioweb_telefono);
        } else {
            insertarTelefono($usuario);
        }
    }
    header('Location: /ExitoActualizarDatos.php');
    exit();
}

//------------------------------------------------------------------------------
//ACTUALIZAR DATOS DE ACCESO DE USUARIO-----------------------------------------
function actualizarAccesoUsuarioWeb(UsuarioWeb $usuario) {
    if (inputsNotNull() && validarEmail() && validarPass()) {
        $usuarioWebModel = new UsuarioWebModel();
        $usuarioWeb = $usuarioWebModel->ObtenerUsuarioId($usuario);
        if (isset($usuarioWeb)) {
            $usuarioWeb->setEmail($_POST["email"]);
            $hash= Password::hash($_POST["pass"]);
            $usuarioWeb->setPass($hash);
            $usuarioWebModel->actualizarUsuarioWeb($usuarioWeb);
            $_SESSION['usuario'] = $usuarioWeb;
        } else {
            header('Location: /ErrorActualizarDatos.php');
            exit();
        }
    } else {
        header('Location: /ErrorActualizarDatos.php');
        exit();
    }
    header('Location: /ExitoActualizarDatos.php');
    exit();
}

//------------------------------------------------------------------------------
//BLOQUE CONTROL DE ORIGEN------------------------------------------------------
//ALTA USUARIO
if (isset($_POST['sumate'])) {
    // if submitted check response
    if ($_POST["g-recaptcha-response"]) {
        $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
        );
    }
    //si hubo respuesta positiva procede al alta
    if ($response != null && $response->success) {
        altaUsuarioWeb();
    } else {
        header('Location: /ErrorAlta.php');
        exit();
    }
}
//LOGIN USUARIO
if (isset($_POST['login'])) {
    // if submitted check response
    if ($_POST["g-recaptcha-response"]) {
        $response = $reCaptcha->verifyResponse(
        $_SERVER["REMOTE_ADDR"],
        $_POST["g-recaptcha-response"]
        );
    }
    //si hubo respuesta positiva procede al login
    if ($response != null && $response->success) {
        loginUsuarioWeb($_POST['email'], $_POST['pass']);
    } else {
        header('Location: /ErrorLogin.php');
        exit();
    }
}
//ACTUALIZAR DATOS USUARIO
if (isset($_POST['actualizar'])) {
    /* Empezamos la sesión */
    session_start();

    /* Si no hay una sesión creada, redireccionar al login. */
    if (isset($_SESSION['usuario'])) {
        //echo "Usuario logueado \n: ";
        //print_r($_SESSION['usuario']);
        $usuario = $_SESSION['usuario'];
    } else {
        session_destroy();
        header('Location: /LoginUsuarioWeb.php');
        exit();
    }

    actualizarUsuarioWeb($usuario);
}
//ACTULIAZAR DATOS DE ACCESO DE USUARIO
if (isset($_POST['actualizarAcceso'])) {
    /* Empezamos la sesión */
    session_start();

    /* Si no hay una sesión creada, redireccionar al login. */
    if (isset($_SESSION['usuario'])) {
        //echo "Usuario logueado \n: ";
        //print_r($_SESSION['usuario']);
        $usuario = $_SESSION['usuario'];
    } else {
        session_destroy();
        header('Location: /LoginUsuarioWeb.php');
        exit();
    }

    actualizarAccesoUsuarioWeb($usuario);
}

//------------------------------------------------------------------------------