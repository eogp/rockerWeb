<?php

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
require_once 'entidades/usuarioapp.php';
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
require_once 'models/UsuarioAppModel.php';
require_once 'models/UsuarioWebModel.php';
require_once 'models/Usuarioweb_direccionModel.php';
require_once 'models/Usuarioweb_telefonoModel.php';
require_once 'models/VideoModel.php';

//obtencion de datos
$json = json_decode(mb_convert_encoding(file_get_contents('php://input'), 'UTF-8'));
//conuslta de ususarioApp a la BD
$usuarioAppModel = new UsuarioAppModel();
$usuarioApp = $usuarioAppModel->ObtenerUsuarioApp($json->user, $json->pass);
$usuarioAppModel = null;
//verificacion de resultado de consulta isset($usuarioApp)

if (isset($usuarioApp)) {
    $retorno = array("status" => 1);
    //TIPOS DE PUBLICACION
    $tipoPubModel = new TipoPubModel();
    $tiposPub = $tipoPubModel->listar();
    $tipoPubModel = null;
    $retorno["tiposPub"] = $tiposPub;
    
    $estilovidaModel=new EstilovidaModel();
    $estilosVida=$estilovidaModel->listar();
    $estilovidaModel=null;
    $retorno["estiloVida"]=$estilosVida;     
            
    $retorno_publicaciones=array();

    //PUBLICACION DATOS BASICOS
    $publicacionModel = new PublicacionModel();
    $publicacion_telefonoModel = new Publicacion_telefonoModel();
    $telefonoModel = new TelefonoModel();
    $publicacion_direccionModel = new Publicacion_direccionModel();
    $direccionModel = new DireccionModel();
    $imagenModel = new ImagenModel();
    $videoModel = new VideoModel();

    //PUBLICACION DATOS ESPECIFICOS
    $publicaciones = $publicacionModel->listarActivas();
    foreach ($publicaciones as $publicacion) {
        $publicacion_direccion = $publicacion_direccionModel->obetnerPublicacionDireccionByPubId($publicacion->getId());
        $direccion = $direccionModel->ObtenerDireccionById($publicacion_direccion->getDireccion_id());
        $publicacion_telefono = $publicacion_telefonoModel->obetnerPublicacionTelefonoByPubId($publicacion->getId());
        $telefono = $telefonoModel->ObtenerTelefonoById($publicacion_telefono->getTelefono_id());
        $imagenes = $imagenModel->obtenerImagenesByPubId($publicacion->getId());
        $video = $videoModel->obtenerVideoByPubId($publicacion->getId());

        switch ($publicacion->getTipoPub_id()) {
            case 1:
                //Salas y estudios de grabación.
                //---------------
                $publicacion_equiposModel = new Publicacion_equiposModel();
                $publicaciones_equipos = $publicacion_equiposModel->obtenerPublicaciones_equiposByPubId($publicacion->getId());
                $publicacion_equiposModel = null;
                //---------------
                $equiposModel = new EquiposModel();
                $marcasModel = new MarcasModel();
                $equipos = array();
                foreach ($publicaciones_equipos as $publicacion_equipo) {
                    $equipo = $equiposModel->obtenerEquiposBybId($publicacion_equipo->getEquipos_id());
                    $marca = $marcasModel->ObetenerMarcasByID($publicacion_equipo->getMarcas_id());
                    $equipo_marca = array("tipo" => $equipo, "marca" => $marca);
                    $equipos[] = $equipo_marca;
                }
                $equiposModel = null;
                $marcasModel = null;
                //---------------
                $publicacion_servciosModel = new Publicacion_serviciosModel();
                $publicaciones_servicios = $publicacion_servciosModel->obtenerPublicaciones_serviciosByPubId($publicacion->getId());
                $publicacion_servciosModel = null;
                //---------------
                $serviciosModel = new ServiciosModel();
                $servicios = array();
                foreach ($publicaciones_servicios as $publicacion_servicio) {
                    $servicio = $serviciosModel->obtenerServicioBybId($publicacion_servicio->getServicios_id());
                    $servicios[] = $servicio;
                }
                $serviciosModel = null;
                //---------------
                $salasModel = new SalasModel();
                $salas = $salasModel->obtenerSalasByPubId($publicacion->getId());
                $salasModel = null;
                //---------------        
                $precioHoraModel = new PreciohoraModel();
                $precioHora = $precioHoraModel->obtenerPreciohoraByPubId($publicacion->getId());
                $precioHoraModel = null;
                //--------------
                $publicacionCompleta = array("publicacion" =>  array("tipoPub"=>$publicacion->getTipoPub_id(),
                        "datosBasicos" => $publicacion,
                        "direccion" => $direccion,
                        "telefono" => $telefono,
                        "imagenes" => $imagenes,
                        "video" => $video,
                        "equipos" => $equipos,
                        "servicios" => $servicios,
                        "salas" => $salas,
                        "precioHora" => $precioHora));
                break;
            case 2:
                //Venta de instrumentos.
                $publicacion_instrumentosModel = new Publicacion_instrumentosModel();
                $publicacion_instrumentos = $publicacion_instrumentosModel->obtenerPublicacion_instrumentosByPubId($publicacion->getId());
                $publicacion_instrumentosModel = null;
                //--------------
                $instrumentosModel = new InstrumentosModel();
                $instrumento = $instrumentosModel->obetenerInstrumentosByID($publicacion_instrumentos->getInstrumentos_id());
                $instrumentosModel = null;

                $marcasModel = new MarcasModel();
                $marca = $marcasModel->ObetenerMarcasByID($publicacion_instrumentos->getMarcas_id());
                $marcasModel = null;

                $instrumento_marca = array("tipo" => $instrumento, "marca" => $marca);
                //--------------
                $instrumentos_datosModel = new Instrumentos_datosModel();
                $instrumentos_datos = $instrumentos_datosModel->obtenerInstrumentos_datosById($publicacion_instrumentos->getInstrumentos_datos_id());
                $instrumentos_datosModel = null;
                //--------------
                $paisModel = new PaisModel();
                $pais = $paisModel->ObtenerPaisById($instrumentos_datos->getPais_id());
                $paisModel = null;
                //--------------
                $precioHoraModel = new PreciohoraModel();
                $precioHora = $precioHoraModel->obtenerPreciohoraByPubId($publicacion->getId());
                $precioHoraModel = null;
                //--------------
                $publicacionCompleta = array("publicacion" => array("tipoPub"=>$publicacion->getTipoPub_id(),
                        "datosBasicos" => $publicacion,
                        "direccion" => $direccion,
                        "telefono" => $telefono,
                        "imagenes" => $imagenes,
                        "video" => $video,
                        "instrumento" => $instrumento_marca,
                        "instrumento_datos" => $instrumentos_datos,
                        "pais" => $pais,
                        "valor" => $precioHora));
                break;
            case 3:
                //Estilo de vida.
                $publicacion_estiloVidaModel = new Publicacion_estilovidaModel();
                $publicacion_estiloVida = $publicacion_estiloVidaModel->obtenerPublicacion_estiloVidaByPubId($publicacion->getId());
                $publicacion_estiloVidaModel = null;
                //--------------
                $estilovida_Model = new EstilovidaModel();
                $estiloVida = $estilovida_Model->obetenerEstiloVidaByID($publicacion_estiloVida->getEstilovida_id());
                $estilovida_Model = null;
                //--------------
                $publicacion_productosModel = new Publicacion_productosModel();
                $publicacion_productos = $publicacion_productosModel->obtenerPublicacion_productosByPubId($publicacion->getId());
                $publicacion_productosModel = null;
                //--------------            
                $productosModel = new ProductosModel();
                $productos = array();
                foreach ($publicacion_productos as $publicacion_producto) {
                    $productos[] = $productosModel->ObetenerProductosByID($publicacion_producto->getProductos_id());
                }
                $productosModel = null;
                //--------------
                $horariosModel = new HorariosModel();
                $horarios = $horariosModel->obtenerHorariosByPubId($publicacion->getId());
                $horariosModel = null;
                //--------------
                $publicacionCompleta = array("publicacion" => array("tipoPub"=>$publicacion->getTipoPub_id(),
                        "datosBasicos" => $publicacion,
                        "direccion" => $direccion,
                        "telefono" => $telefono,
                        "imagenes" => $imagenes,
                        "video" => $video,
                        "estiloVida" => $estiloVida,
                        "produtos" => $productos,
                        "horarios" => $horarios));
                break;
            case 4:
                //Servicios  profesionales.
                //--------------
                $publicacion_servProfModel = new Publicacion_serviciosProfModel();
                $publicacion_servProf = $publicacion_servProfModel->obtenerPublicacion_servProfByPubId($publicacion->getId());
                $publicacion_servProfModel = null;
                //--------------
                $serviciosProfModel = new ServiciosProfModel();
                $servProf = $serviciosProfModel->obtenerServicioProfBybId($publicacion_servProf->getServiciosProf_id());
                $serviciosProfModel = null;
                //--------------
                $precioHoraModel = new PreciohoraModel();
                $precioHora = $precioHoraModel->obtenerPreciohoraByPubId($publicacion->getId());
                $precioHoraModel = null;
                //--------------
                $publicacionCompleta = array("publicacion" => array("tipoPub"=>$publicacion->getTipoPub_id(),
                        "datosBasicos" => $publicacion,
                        "direccion" => $direccion,
                        "telefono" => $telefono,
                        "imagenes" => $imagenes,
                        "video" => $video,
                        "experiencia" => $publicacion_servProf,
                        "servProf" => $servProf,
                        "precioHora" => $precioHora));
                break;
            case 5:
                //Shows y Eventos.
                $publicacion_showEventosModel = new Publicacion_showeventosModel();
                $publicacion_showEventos = $publicacion_showEventosModel->obtenerPublicacion_showeventosByPubId($publicacion->getId());
                $publicacion_showEventosModel = null;
                //--------------
                $showEventosModel = new ShoweventosModel();
                $showEventos = $showEventosModel->obetenerShowEventosByID($publicacion_showEventos->getShoweventos_id());
                $showEventosModel = null;
                //--------------
                $fechasModel = new FechasModel();
                $fechas = $fechasModel->obtenerFechasByPub_ShowEventosId($publicacion_showEventos->getId());
                $fechasModel = null;
                //--------------
                $bandasModel = new BandasModel();
                $bandas = $bandasModel->obtenerBandasByPub_ShowEventosId($publicacion_showEventos->getId());
                $bandasModel = null;
                //--------------
                $precioHoraModel = new PreciohoraModel();
                $precioHora = $precioHoraModel->obtenerPreciohoraByPubId($publicacion->getId());
                $precioHoraModel = null;
                //--------------
                $publicacionCompleta = array("publicacion" => array("tipoPub"=>$publicacion->getTipoPub_id(),
                        "datosBasicos" => $publicacion,
                        "direccion" => $direccion,
                        "telefono" => $telefono,
                        "imagenes" => $imagenes,
                        "video" => $video,
                        "showEventos" => $showEventos,
                        "fechas" => $fechas,
                        "bandas" => $bandas,
                        "valor" => $precioHora));
                break;
            default:
                break;
        }
        $retorno_publicaciones[]= $publicacionCompleta;
    }
    
    $retorno["publicaciones"] = $retorno_publicaciones;

    $responseBody = json_encode($retorno);
} else {
    $responseBody = json_encode(array("status" => 0));
}

echo $responseBody;
