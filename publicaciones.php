<?php
//ENTIDADES
require_once 'entidades/bandas.php';
require_once 'entidades/direccion.php';
require_once 'entidades/equipos.php';
require_once 'entidades/equipos_marcas.php';
require_once 'entidades/estilovida.php';
require_once 'entidades/estilovida_productos.php';
require_once 'entidades/fechas.php';
require_once 'entidades/horarios.php';
require_once 'entidades/imagen.php';
require_once 'entidades/instrumentos.php';
require_once 'entidades/instrumentos_datos.php';
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
require_once 'entidades/publicacion_productos.php';
require_once 'entidades/publicacion_servicios.php';
require_once 'entidades/publicacion_serviciosProf.php';
require_once 'entidades/publicacion_showeventos.php';
require_once 'entidades/publicacion_telefono.php';
require_once 'entidades/salas.php';
require_once 'entidades/servicios.php';
require_once 'entidades/serviciosProf.php';
require_once 'entidades/showeventos.php';
require_once 'entidades/telefono.php';
require_once 'entidades/tipoPub.php';
require_once 'entidades/usuarioWeb.php';
require_once 'entidades/usuarioweb_direccion.php';
require_once 'entidades/usuarioweb_telefono.php';
require_once 'entidades/video.php';
//MODELS
require_once 'models/BandasModel.php';
require_once 'models/DireccionModel.php';
require_once 'models/EquiposModel.php';
require_once 'models/Equipos_marcasModel.php';
require_once 'models/EstilovidaModel.php';
require_once 'models/Estilovida_productosModel.php';
require_once 'models/FechasModel.php';
require_once 'models/HorariosModel.php';
require_once 'models/ImagenModel.php';
require_once 'models/InstrumentosModel.php';
require_once 'models/Instrumentos_datosModel.php';
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
require_once 'models/Publicacion_productosModel.php';
require_once 'models/Publicacion_serviciosModel.php';
require_once 'models/Publicacion_serviciosProfModel.php';
require_once 'models/Publicacion_showeventosModel.php';
require_once 'models/Publicacion_telefonoModel.php';
require_once 'models/SalasModel.php';
require_once 'models/ServiciosModel.php';
require_once 'models/ServiciosProfModel.php';
require_once 'models/ShoweventosModel.php';
require_once 'models/TelefonoModel.php';
require_once 'models/TipoPubModel.php';
require_once 'models/UsuarioWebModel.php';
require_once 'models/Usuarioweb_direccionModel.php';
require_once 'models/Usuarioweb_telefonoModel.php';
require_once 'models/VideoModel.php';

// Si no hay una sesión creada, redireccionar al login. 
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
} else {
    session_destroy();
    header('Location: /LoginUsuarioWeb.php');
    exit();
}

//VALIDACION DE CAMPOS OBLIGATORIOS---------------------------------------------
//VALIDAR INPUTS 
function inputsNotNull($inputs) {
    $retorno = true;
    foreach ($inputs as $input) {

        ////print_r($input);
        //echo '<br />';

        $retorno = $retorno && isset($input);
    }
    return $retorno;
}
//VALIDAR INPUTS 
function validarCamposTipoPublicacion(TipoPub $tipoPub) {
    $inputs = [];
    switch ($tipoPub->getId()) {
        case 1:
            $inputs = [$_POST['valhora'], $_POST['cantidadSalas']];

            break;
        case 2:
            $inputs = [$_POST['instrumento'], $_POST['anioInstrimento'],
                $_POST['paisInstrimento'], $_POST['estadoInstrimento'],
                $_POST['valorInstrimento']];
            if (isset($_POST['instrumento']) && $_POST['instrumento'] == 15) {
                $inputs[] = $_POST['otroInstrumento'];
            } else {
                $inputs[] = $_POST['marcaInstrimento'];
            }
            break;
        case 3:
            $inputs = [$_POST['estilovida'], $_POST['horario']];
            break;
        case 4:
            $inputs = [$_POST['servProf'], $_POST['valhora']];
            break;
        case 5:
            $inputs = $_POST['fecha'];
            $inputs [] = $_POST['valor'];
            $inputs [] = $_POST['banda'];
            $inputs [] = $_POST['showEventos'];
            break;
        default:
            break;
    }
    return inputsNotNull($inputs);
}
//VALIDAR EMAIL
function validarEmail() {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        ////print_r("validarEmail: true");
        return true;
    }
    ////print_r("validarEmail: false");
    return false;
}

//------------------------------------------------------------------------------
//ALTA PUBLICACION--------------------------------------------------------------
function obtenerTipoPublicacion() {
    $tipoPubModel = new TipoPubModel();
    return $tipoPubModel->ObtenerTipoPub($_POST['tipoPub']);
}
function obtenerMarcasPorEquipo($equipo) {
    $result = array();
    if (isset($_POST['marcasequipos' . $equipo])) {
        ////print_r('marcas'.$equipo);
        foreach ($_POST['marcasequipos' . $equipo] as $value) {
            $result[] = new Marcas($value, null);
        }
    }

    return $result;
}
function obtenerMarcas_idPorEquipo($equipo) {
    $result = array();
    if (isset($_POST['marcasequipos' . $equipo])) {
        ////print_r('marcas'.$equipo);
        foreach ($_POST['marcasequipos' . $equipo] as $value) {
            $result[] = $value;
        }
    }

    return $result;
}
function obetnerProductosEstiloVida() {
    $result = Array();
    if (isset($_POST['producto'])) {
        foreach ($_POST['producto'] as $producto) {
            $result = new Productos($producto, null);
        }
    }
    return $result;
}

//datos basicos//
function insertarPublicacion(TipoPub $tipoPub) {
    $fechaYhora = date("Y-m-d H:i:s");
    $publicacion = new Publicacion(
            null, $_POST['titulo'], null, $_SESSION['usuario']->getId(), $fechaYhora, true, $_POST['email'], false, $tipoPub->getId(), $_POST['web']
    );
    $publicacionModel = new PublicacionModel();
    $publicacion->setId($publicacionModel->insertar($publicacion));
    return $publicacion;
}
function insertarVideo($publicacion_id) {
    $video = new Video(null, $_POST['video'], null, $publicacion_id);
    $videoModel = new VideoModel();
    $videoModel->insertar($video);
}
function insertarTelefono($publicacion_id) {
    $telefono = new Telefono(null, $_POST['telefono'], $_POST['codarea'], null, null);
    $telefonoModel = new TelefonoModel();
    $telefono->setId($telefonoModel->insertar($telefono));
    $publicacion_telefono = new Publicacion_telefono(null, $publicacion_id, $telefono->getId());
    $publicacion_telefonoModel = new Publicacion_telefonoModel();
    $publicacion_telefonoModel->insertar($publicacion_telefono);
}
function insertarDireccion($publicacion_id) {
    $direccion = new Direccion(null, null, null, $_POST['street_number'], $_POST['route'], $_POST['locality'], null, null, $_POST['postal_code'], $_POST['country'], $_POST['administrative_area_level_1'], $_POST['lat'], $_POST['long']);
    $direccionModel = new DireccionModel();
    $publicacion_direccionModel = new Publicacion_direccionModel();
    $direccion->setId($direccionModel->insertar($direccion));
    $publicacion_direccion = new Publicacion_direccion(null, $publicacion_id, $direccion->getId());
    $publicacion_direccionModel->insertar($publicacion_direccion);
}
//-------------------//

//salas y estudios//
function insertarPrecioHora($publicacion_id) {
    $precioHora = new PrecioHora(null, $_POST['valhora'], $publicacion_id);
    $precioHoraModel = new PreciohoraModel();
    $precioHoraModel->insertar($precioHora);
}
function insertarSalas($publicacion_id) {
    $salas = new Salas(null, $_POST['cantidadSalas'], $publicacion_id);
    $salasModel = new SalasModel();
    $salasModel->insertar($salas);
}
function insertarServicios($publicacion_id) {
    $publicacion_serviciosModel = new Publicacion_serviciosModel();
    foreach ($_POST['servicios'] as $value) {
        $publicacion_servicios = new Publicacion_servicios(null, $publicacion_id, $value);
        $publicacion_serviciosModel->insertar($publicacion_servicios);
    }
}
function insertarServicio($publicacion_id, $servicios_id) {
    $publicacion_serviciosModel = new Publicacion_serviciosModel();
    $publicacion_serviciosModel->insertar(new Publicacion_servicios(null, $publicacion_id, $servicios_id));
}
function insertarEquipos($publicacion_id) {
    $publicacion_equiposModel = new Publicacion_equiposModel();
    foreach ($_POST['equipos'] as $equipo) {
        $marcas = obtenerMarcasPorEquipo($equipo);
        if (count($marcas) > 0) {
            foreach ($marcas as $marca) {
                $publicacion_equipos = new Publicacion_equipos(null, $publicacion_id, $equipo, $marca->getId());
                $publicacion_equiposModel->insertar($publicacion_equipos);
            }
        } else {
            //sin marca
            $marcasModel = new MarcasModel();
            $publicacion_equipos = new Publicacion_equipos(null, $publicacion_id, $equipo, $marcasModel->obetenerIDByNombre("Otros"));
            $publicacion_equiposModel->insertar($publicacion_equipos);
        }
    }
}
function insertarEquipo($publicacion_id, $equipos_id, $marcas_id) {
    $publicacion_equiposModel = new Publicacion_equiposModel();
    $publicacion_equiposModel->insertar(new Publicacion_equipos(null, $publicacion_id, $equipos_id, $marcas_id));
}
//-------------------//

//venta de instrumentos//
function insertarInstrumentos($publicacion_id) {
    $otroInstrumento = null;
    if (isset($_POST['otroInstrumento'])) {
        $otroInstrumento = $_POST['otroInstrumento'];
    }
    $instrumentos_datos = new Instrumentos_datos(null, $_POST['anioInstrimento'], $_POST['estadoInstrimento'], $_POST['paisInstrimento'], $otroInstrumento);
    $instrumentosDatosModel = new Instrumentos_datosModel();
    $instrumentos_datos->setId($instrumentosDatosModel->insertar($instrumentos_datos));

    $marcaInstrumento = null;
    if (isset($_POST['marcaInstrimento'])) {
        $marcaInstrumento = $_POST['marcaInstrimento'];
    }
    $publicacion_instrumentos = new Publicacion_instrumentos(null, $publicacion_id, $_POST['instrumento'], $marcaInstrumento, $instrumentos_datos->getId());
    $publicacion_instrumentosModel = new Publicacion_instrumentosModel();
    $publicacion_instrumentosModel->insertar($publicacion_instrumentos);
}
function insertarValorInstrmento($publicacion_id) {
    $precioHora = new PrecioHora(null, $_POST['valorInstrimento'], $publicacion_id);
    $precioHoraModel = new PreciohoraModel();
    $precioHoraModel->insertar($precioHora);
}
//-------------------//

//estilo de vida//
function insertarEstiloDeVida($publicacion_id) {
    $publicacion_estiloVida = new Publicacion_estilovida(null, $publicacion_id, $_POST['estilovida']);
    $publicacion_estiloVidaModel = new Publicacion_estilovidaModel();
    $publicacion_estiloVidaModel->insertar($publicacion_estiloVida);
}
function insertarProductos($publicacion_id) {
    $publicacion_productosModel = new Publicacion_productosModel();
    if (isset($_POST['producto'])) {
        foreach ($_POST['producto'] as $producto) {
            $publicacion_productos = new Publicacion_productos(null, $publicacion_id, $producto);
            $publicacion_productosModel->insertar($publicacion_productos);
        }
    }
}
function insertarHorarios($publicacion_id) {
    $horariosModel = new HorariosModel();
    foreach ($_POST['horario'] as $horario) {
        $horariosArray = explode(" ", $horario);
        if ($horariosArray[0] == "De") {
            //MAS DE UN DIA
            $horarios = new Horarios(null, $horariosArray[5], $horariosArray[8], $horariosArray[1], $horariosArray[3], $publicacion_id);
            $horariosModel->insertar($horarios);
        } else {
            //UN SOLO DIA
            $horarios = new Horarios(null, $horariosArray[2], $horariosArray[5], $horariosArray[0], $horariosArray[0], $publicacion_id);
            $horariosModel->insertar($horarios);
        }
    }
}
//-------------------//

//servicios profesionales//
function insertarServiciosProf($publicacion_id) {
    $publicacion_serviciosProf = new Publicacion_serviciosProf(null, $publicacion_id, $_POST['servProf'], $_POST['experiencia']);
    $publicacion_serviciosProfModel = new Publicacion_serviciosProfModel();
    $publicacion_serviciosProfModel->insertar($publicacion_serviciosProf);
}
//-------------------//

//show y eventos//
function insertarShowEventosf($publicacion_id) {
    $publicacion_showEventos = new Publicacion_showeventos(null, $publicacion_id, $_POST['showEventos']);
    $publicacion_showEventosModel = new Publicacion_showeventosModel();
    $publicacion_showEventos->setId($publicacion_showEventosModel->insertar($publicacion_showEventos));
    return $publicacion_showEventos->getId();
}
function insertarBandas($publicacion_showEventos_id) {
    $bandas = new Bandas(null, $_POST['banda'], $publicacion_showEventos_id);
    $bandasModel = new BandasModel();
    $bandasModel->insertar($bandas);
}
function insertarFechas($publicacion_showEventos_id) {

    $fechasModel = new FechasModel();
    foreach ($_POST['fecha'] as $fecha) {
        $flag = 0;
        $anio = "";
        $mes = "";
        $dia = "";
        $time = "";
        $count = 0;
        for ($i = 0; $i < strlen($fecha); $i++) {
            if ($fecha[$i] === " ") {
                ++$flag;
            }
            if ($flag == 1) {

                if ($count > 0 && $count < 3) {
                    $dia .= $fecha[$i];
                }

                if ($count > 3 && $count < 6) {
                    $mes .= $fecha[$i];
                }
                if ($count > 6 && $count < 11) {

                    $anio .= $fecha[$i];
                }
                ++$count;
            }
            if ($flag == 4) {
                $time .= $fecha[$i];
            }
        }
        //echo $anio . "-" . $mes . "-" . $dia . " " . $time . ":00";
        $fechas = new Fechas(null, $anio . "-" . $mes . "-" . $dia . " " . $time . ":00", $publicacion_showEventos_id);
        $fechasModel->insertar($fechas);
    }
}
function insertarValorShowEvento($publicacion_id) {
    $precioHora = new PrecioHora(null, $_POST['valor'], $publicacion_id);
    $precioHoraModel = new PreciohoraModel();
    $precioHoraModel->insertar($precioHora);
}
//-------------------//

//SUBIR IMAGENES E INSERTAR IMAGENES
function subirImagen($imputName, $publicacion_id) {
    // MODIFICAR RUTA AL SUBIR AL HOSTING
    //$dir_subida = '/Applications/XAMPP/xamppfiles/htdocs/test/var/www/uploads/image/' . 'pub' . $publicacion_id . '_';
    $dir_subida = '/home/c0990002/public_html/imagenes/' . 'pub' . $publicacion_id . '_';
    
    if (isset($_FILES[$imputName])) {
        $fichero_subido = $dir_subida . $imputName . '_' . $_FILES[$imputName]['name'];
        $dir_acceso = 'http://www.rockerapp.com/imagenes/' . 'pub' . $publicacion_id . '_'. $imputName . '_' . $_FILES[$imputName]['name'];
        //GUARDADO e INSERT de imagen
        if (move_uploaded_file($_FILES[$imputName]['tmp_name'], $fichero_subido)) {
            ////print_r( $fichero_subido);
            $imagenModel = new ImagenModel();
            $imagen = new Imagen(null, $dir_acceso, null, $publicacion_id);
            $imagenModel->insertar($imagen);
            ////print_r($imagen);
        }
        else{
            ////print_r($_FILES[$imputName]['tmp_name']);
            ////print_r("</br>");
            ////print_r($fichero_subido);

        }
    }
}
//QUITAR IMAGENES
function eleiminarImagen($imgId) {
    if ($imgId !== '') {
        $imagenModel = new ImagenModel();
        $imagenModel->eliminar(new Imagen($imgId, null, null, null));
    }
}
//ALTA PUBLICACION
function altaPublicacion(TipoPub $tipoPub) {
    $publicacion = insertarPublicacion($tipoPub);
    insertarVideo($publicacion->getId());
    subirImagen('imagen1', $publicacion->getId());
    subirImagen('imagen2', $publicacion->getId());
    subirImagen('imagen3', $publicacion->getId());
    insertarTelefono($publicacion->getId());
    insertarDireccion($publicacion->getId());
    switch ($publicacion->getTipoPub_id()) {
        case 1:
            //SALAS Y ESTUDIOS DE GRABACION
            insertarPrecioHora($publicacion->getId());
            insertarSalas($publicacion->getId());
            insertarServicios($publicacion->getId());
            insertarEquipos($publicacion->getId());
            break;
        case 2:
            //VENTA DE INSTRUMENTOS
            insertarInstrumentos($publicacion->getId());
            insertarValorInstrmento($publicacion->getId());
            break;
        case 3:
            //ESTILO DE VIDA
            insertarEstiloDeVida($publicacion->getId());
            insertarProductos($publicacion->getId());
            insertarHorarios($publicacion->getId());
            break;
        case 4:
            //SERVICIOS PROFESIONALES
            insertarServiciosProf($publicacion->getId());
            insertarPrecioHora($publicacion->getId());
            break;
        case 5:
            //SHOWS Y EVENTOS
            $publicacion_showEventos_id = insertarShowEventosf($publicacion->getId());
            insertarBandas($publicacion_showEventos_id);
            insertarFechas($publicacion_showEventos_id);
            insertarValorShowEvento($publicacion->getId());
            break;
    }
    //pagoPublicacion($publicacion->getId());
    if($publicacion->getId()!=null){
        header('Location: /PUserNPubOK.php');
    
    }else{
        header('Location: /ErrorAltaPub.php');
    }
}
//------------------------------------------------------------------------------

//ACTUALIZAR PUBLICACION--------------------------------------------------------
//datos basicos//
function updatePublicacion($id) {
    $publicacionModel = new PublicacionModel();
    $publicacionModel->actualizar(new Publicacion($id, $_POST['titulo'], null, null, null, null, $_POST['email'], null, null, $_POST['web']));
    return $publicacionModel->ObtenerPublicacion($id);
}
function updateVideo($id) {
    $videoModel = new VideoModel();
    $videoModel->actualizar(new Video(null, $_POST['video'], null, $id));
}
function updateImagenes($pubId) {
    $imagenModel = new ImagenModel();
    for ($i = 1; $i <= 3; $i++) {
        //reemplazar imagen
        if (isset($_POST['imagen' . $i]) && $_FILES['imagen' . $i]['error'] == 0) {
            ////print_r("REMPLAZANDO IMAGEN " . $i);
            $imagen = $imagenModel->obtenerImagenByIdAndPubId($_POST['imagen' . $i], $pubId);
            $imagenModel->eliminar($imagen);
            subirImagen('imagen' . $i, $pubId);
        }
        //agregar imagen
        if (!isset($_POST['imagen' . $i]) && $_FILES['imagen' . $i]['error'] == 0) {
            ////print_r("AGREGANDO IMAGEN " . $i);
            subirImagen('imagen' . $i, $pubId);
        }
    }
}
function updateTelefono($pubId) {
    $publicacion_telefonoModel = new Publicacion_telefonoModel();
    $publicacion_telefono = $publicacion_telefonoModel->obetnerPublicacionTelefonoByPubId($pubId);
    if (isset($publicacion_telefono)) {
        //actualizar telefono
        $publicacion_telefonoModel->eliminarPublicacionTelefono($publicacion_telefono);
        insertarTelefono($pubId);
    } else {
        //ingresar telefono
        insertarTelefono($pubId);
    }
}
function updateDireccion($pubId) {
    $publicacion_direccionModel = new Publicacion_direccionModel();
    $publicacion_direccion = $publicacion_direccionModel->obetnerPublicacionDireccionByPubId($pubId);
    if (isset($publicacion_direccion)) {
        //actualizar direccion
        $publicacion_direccionModel->eliminarPublicacionDireccion($publicacion_direccion);
        insertarDireccion($pubId);
    } else {
        //ingresar direccion
        insertarDireccion($pubId);
    }
}
//-------------------//

//salas y estudios//
function updatePrecioHora($pubId) {
    $precioHoraModel = new PreciohoraModel();
    $precioHoraModel->actualizar(new PrecioHora(null, $_POST['valhora'], $pubId));
}
function updateSalas($pubId) {
    $salasModel = new SalasModel;
    $salasModel->actualizar(new Salas(null, $_POST['cantidadSalas'], $pubId));
}
function updateServicios($pubId) {
    $publicacion_serviciosModel = new Publicacion_serviciosModel();
    $publicaciones_servicios = $publicacion_serviciosModel->obtenerPublicaciones_serviciosByPubId($pubId);
    if (isset($_POST['servicios'])) {
        ////print_r("HAY SERVICIOS <br/>");
        //actualizar servicios
        $id_servicios = array();
        foreach ($publicaciones_servicios as $publicacion_servicio) {
            ////print_r("HAY SERVICIOS PREXISTENTES ID: ".$publicacion_servicio->getServicios_id()."<br/>");
            //recoleccion de id existentes 
            $id_servicios[] = $publicacion_servicio->getServicios_id();
            //elimina servicios prexistentes no seleccionados
            if (!in_array($publicacion_servicio->getServicios_id(), $_POST['servicios'])) {
                ////print_r("ELIMINANDO SERVICIOS ID: ".$publicacion_servicio->getServicios_id()."<br/>");
                $publicacion_serviciosModel->eliminarPublicacionServicios($publicacion_servicio);
            }
        }
        foreach ($_POST['servicios'] as $servicio) {
            //insertar servicios seleccionados no prexistentes 
            if (!in_array($servicio, $id_servicios)) {
                ////print_r("INSERTANDO SERVICIOS ID: ".$servicio."<br/>");

                insertarServicio($pubId, $servicio);
            }
        }
    } else {
        ////print_r("NO HAY SERVICIOS <br/>");
        //eliminar todos los servicios
        foreach ($publicaciones_servicios as $publicacion_servicio) {
            $publicacion_serviciosModel->eliminarPublicacionServicios($publicacion_servicio);
        }
    }
}
function eliminarEquipos($pubId) {
    $publicacion_equiposModel = new Publicacion_equiposModel();
    $publicaciones_equipos = $publicacion_equiposModel->obtenerPublicaciones_equiposByPubId($pubId);
    foreach ($publicaciones_equipos as $publicacion_equipo) {
        $publicacion_equiposModel->eliminarPublicacionEquipos($publicacion_equipo);
    }
}
function updateEquipos($pubId) {
    eliminarEquipos($pubId);
    if (isset($_POST['equipos'])) {
        insertarEquipos($pubId);
    }
}
//-------------------//

//venta de instrumentos//
function updateMarcaInstrumento($pubId) {
    $publicacion_instrumentosModel = new Publicacion_instrumentosModel();
    $publicacion_instrumentos = $publicacion_instrumentosModel->obtenerPublicacion_instrumentosByPubId($pubId);

    $instrumentosDatosModel = new Instrumentos_datosModel();
    $instrumentos_datos = $instrumentosDatosModel->obtenerInstrumentos_datosById($publicacion_instrumentos->getInstrumentos_datos_id());

    $otroInstrumento = null;
    if (isset($_POST['otroInstrumento'])) {
        $otroInstrumento = $_POST['otroInstrumento'];
    }
    $instrumentos_datos = new Instrumentos_datos($instrumentos_datos->getId(), $_POST['anioInstrimento'], $_POST['estadoInstrimento'], $_POST['paisInstrimento'], $otroInstrumento);
    $instrumentosDatosModel->actualizar($instrumentos_datos);

    $marcaInstrumento = null;
    if (isset($_POST['marcaInstrimento'])) {
        $marcaInstrumento = $_POST['marcaInstrimento'];
    }
    $publicacion_instrumentos = new Publicacion_instrumentos($publicacion_instrumentos->getId(), $pubId, $_POST['instrumento'], $marcaInstrumento, $instrumentos_datos->getId());
    $publicacion_instrumentosModel->actualizar($publicacion_instrumentos);
}
function updateValorInstrumento($pubId) {
    $precioHoraModel = new PreciohoraModel();
    $precioHoraModel->actualizar(new PrecioHora(null, $_POST['valorInstrimento'], $pubId));
}
//-------------------//

//estilo de vida//
function updateProductos($pubId){
    $publicacion_productosModel = new Publicacion_productosModel();
    $publicacion_productosModel->eliminarPublicacionProductos($pubId);
    insertarProductos($pubId);
}
function updateHorarios($pubId){
    $horariosModel=new HorariosModel();
    $horariosModel->eliminar($pubId);
    insertarHorarios($pubId);
}
//-------------------//
        
//servicos profesionales//
function updateServiosProf($pubId){
    $publicaicon_servicosProfModel=new Publicacion_serviciosProfModel();
    $publicaicon_servicosProfModel->actualizar(new Publicacion_serviciosProf(null, $pubId, $_POST['servProf'], $_POST['experiencia']));

}
//-------------------//

//show y eventos//
function updateBandas($pubId){
    $publicacion_showeventosModel=new Publicacion_showeventosModel();
    $publicacion_showEventos=$publicacion_showeventosModel->obtenerPublicacion_showeventosByPubId($pubId);
    $bandasModel=new BandasModel();
    $bandasModel->actualizar(new Bandas(null, $_POST['banda'], $publicacion_showEventos->getId()));
}
function eliminarFechas($pubShowEventoId){
    $fechasModel= new FechasModel();
    $fechasModel->eliminar($pubShowEventoId);
}
function updateFechas($pubId){
    $publicacion_showEventoModel=new Publicacion_showeventosModel();
    $publicacion_showEvento=$publicacion_showEventoModel->obtenerPublicacion_showeventosByPubId($pubId);
    eliminarFechas($publicacion_showEvento->getId());
    insertarFechas($publicacion_showEvento->getId());
    
}
function updateValorEvento($pubId){
    $precioHoraModel = new PreciohoraModel();
    $precioHoraModel->actualizar(new PrecioHora(null, $_POST['valor'], $pubId));
}
//-------------------//

//ACTUALIZAR PUBLICACION
function actualizarPublicacion(TipoPub $tipoPub) {
    $publicacion = updatePublicacion($_POST['id']);
    updateVideo($publicacion->getId());
    updateImagenes($publicacion->getId());
    updateTelefono($publicacion->getId());
    updateDireccion($publicacion->getId());
    switch ($publicacion->getTipoPub_id()) {
        case 1:
            //SALAS Y ESTUDIOS DE GRABACION
            updatePrecioHora($publicacion->getId());
            updateSalas($publicacion->getId());
            updateServicios($publicacion->getId());
            updateEquipos($publicacion->getId());
            break;
        case 2:
            //VENTA DE INSTRUMENTOS
            updateMarcaInstrumento($publicacion->getId());
            updateValorInstrumento($publicacion->getId());
            break;
        case 3:
            //ESTILO DE VIDA
            updateProductos($publicacion->getId());
            updateHorarios($publicacion->getId());
            break;
        case 4:
            //SERVICIOS PROFESIONALES
            updateServiosProf($publicacion->getId());
            updatePrecioHora($publicacion->getId());
            break;
        case 5:
            //SHOW EVENTOS  
            updateBandas($publicacion->getId());
            updateFechas($publicacion->getId());
            updateValorEvento($publicacion->getId());
            break;
    }
}
//------------------------------------------------------------------------------

//PAGO PUBLICACION--------------------------------------------------------------
function pagoPublicacion($pubId){
    $_SESSION['pubId']=$pubId;
    header('Location: /PUserPago.php');
}
//------------------------------------------------------------------------------

function pausarPublicacion($pubId){
    $publicacionModel=new PublicacionModel();
    $publicacionModel->pausar($pubId);
}

//TEST--------------------------------------------------------------------------
function verInputs() {
    foreach ($_POST as $clave => $valor) {
        if ($clave !== 'producto' && $clave !== 'servicios' && $clave !== 'equipos' && $clave !== 'marcasequipos') {
            //echo "El valor de $clave es: $valor <br />";
        } else if ($clave === 'producto') {
            foreach ($_POST['producto'] as $value) {
                //echo "El valor de producto es: $value <br />";
            }
        } else if ($clave === 'servicios') {
            foreach ($_POST['servicios'] as $value) {
                //echo "El valor de servicio es: $value <br />";
            }
        } else if ($clave === 'equipos') {
            foreach ($_POST['equipos'] as $value) {
                //echo "El valor de equipo es: $value <br />";
            }
        } else if ($clave === 'marcasequipos') {
            foreach ($_POST['marcasequipos'] as $value) {
                //echo "El valor de marcasequipo es: $value <br />";
            }
        }
    }
    foreach ($_FILES as $clave => $valor) {
        //echo "El valor de $clave es:<br />";
        foreach ($valor as $c => $v) {
            //echo "El valor de $c es: $v <br />";
        }
    }
}
//------------------------------------------------------------------------------

//ABM PUBLICACIONES-------------------------------------------------------------
//alta
if (isset($_POST['altaPub'])) {
    //datos basicos
    $inputs = [$_POST['titulo'], $_POST['codarea'], $_POST['telefono'], $_POST['email'], $_POST['lat'], $_POST['long'], $_POST['tipoPub']];
    if (inputsNotNull($inputs) && validarEmail() && validarCamposTipoPublicacion(obtenerTipoPublicacion())) {
        altaPublicacion(obtenerTipoPublicacion());
        //verInputs();
    } else {
        header('Location: /ErrorAltaPub.php');
    }
}
//pausar reanudar
if (isset($_POST['pausarReanudarPub'])) {
    $publicacionModel=new PublicacionModel();
    $publicacion=$publicacionModel->ObtenerPublicacion($_POST['pausarReanudarPub']);
    if($publicacion->getActiva()){
        $publicacionModel->pausar($_POST['pausarReanudarPub']);
        echo "Estado: Inactiva.";
    }else{
        $publicacionModel->reanudar($_POST['pausarReanudarPub']);
        echo "Estado: Activa.";
    }
    
}

//update
if (isset($_POST['actualizarPub'])) {
    //datos basicos
    $inputs = [$_POST['id'], $_POST['titulo'], $_POST['codarea'], $_POST['telefono'], $_POST['email'], $_POST['lat'], $_POST['long'], $_POST['tipoPub']];
    if (inputsNotNull($inputs) && validarEmail() && validarCamposTipoPublicacion(obtenerTipoPublicacion())) {
        //verInputs();
        actualizarPublicacion(obtenerTipoPublicacion());
        header('Location: /ExitoUpdatePub.php');
    } else {
        header('Location: /ErrorUpdatePub.php');
    }
}

//quitar Imagenes
if (isset($_POST['quitarImgagen'])) {
    eleiminarImagen($_POST['quitarImgagen']);
    //echo 'imagen eliminada id: ' . $_POST['quitarImgagen'];
}
//------------------------------------------------------------------------------

//PAGOS-------------------------------------------------------------------------
if(isset($_POST['publicacionPago'])){
    pagoPublicacion($_POST["publicacionPago"]);
    
}
//------------------------------------------------------------------------------

