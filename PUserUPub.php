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
require_once 'models/UsuarioWebModel.php';
require_once 'models/Usuarioweb_direccionModel.php';
require_once 'models/Usuarioweb_telefonoModel.php';
require_once 'models/VideoModel.php';

ob_start();
session_start();
/* Si no hay una sesión creada, redireccionar al login. */
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    //Obtener datos basicos de la publicacion---------------------------------//
    $publicacionModel = new PublicacionModel();
    $publicacion = new Publicacion($_POST["publicacion"], null, null, null, null, null, null, null, null, null);
    $publicacion = $publicacionModel->ObtenerPublicacion($publicacion->getId());
    $publicacion_telefonoModel = new Publicacion_telefonoModel();
    $publicacion_telefono = new Publicacion_telefono(null, $publicacion->getId(), null);
    $publicacion_telefono = $publicacion_telefonoModel->obetnerPublicacionTelefonoByPubId($publicacion->getId());
    $telefonoModel = new TelefonoModel();
    $telefono = new Telefono(null, null, null, null, null);
    $telefono = $telefonoModel->ObtenerTelefonoById($publicacion_telefono->getTelefono_id());
    $publicacion_direccionModel = new Publicacion_direccionModel();
    $publicacion_direccion = new Publicacion_direccion(null, $publicacion->getId(), null);
    $publicacion_direccion = $publicacion_direccionModel->obetnerPublicacionDireccionByPubId($publicacion->getId());
    $direccionModel = new DireccionModel();
    $direccion = new Direccion(null, null, null, null, null, null, null, null, null, null, null, null, null);
    $direccion = $direccionModel->ObtenerDireccionById($publicacion_direccion->getDireccion_id());
    $imagenModel = new ImagenModel();
    $imagenes = Array();
    $imagenes = $imagenModel->obtenerImagenesByPubId($publicacion->getId());
    $_SESSION['imagenes'] = $imagenes;
    $videoModel = new VideoModel();
    $video = new Video(null, null, null, $publicacion->getId());
    $video = $videoModel->obtenerVideoByPubId($publicacion->getId());
    //------------------------------------------------------------------------//
} else {
    session_destroy();
    header('Location: /LoginUsuarioWeb.php');
    exit();
}

function obtenerDireccion(Direccion $direccion) {
    $html = "";
    if (isset($direccion)) {
        if ($direccion->getCalle() !== null) {
            $html .= $direccion->getCalle() . " ";
        }
        if ($direccion->getAltura() !== null) {
            $html .= $direccion->getAltura();
        }
        $html .= ", ";
        if ($direccion->getLocalidad() !== null && $direccion->getLocalidad() !== "") {
            $html .= $direccion->getLocalidad() . ", ";
        }
        if ($direccion->getProvincia() !== null) {
            $html .= $direccion->getProvincia() . ", ";
        }
        if ($direccion->getPais() !== null) {
            $html .= $direccion->getPais();
        }
    }
    return $html;
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>ROCKER APP . La guía del músico</title>

        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta charset="UTF-8">

        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" /><!-- Bootstrap -->
        <link rel="stylesheet" href="css/sombra.css" type="text/css" /><!-- Sombra -->
        <link rel="stylesheet" href="css/preview.css" type="text/css" /><!-- Preview -->
        <link rel="stylesheet" href="css/maps.css" type="text/css" /><!-- Maps -->
        <link rel="stylesheet" href="css/textArea.css" type="text/css" /><!-- TextArea -->
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-114906961-1"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag() {
                dataLayer.push(arguments);
            }
            gtag('js', new Date());

            gtag('config', 'UA-114906961-1');
        </script>


    </head>
    <body>
        <header>
            <div class="container">
                <div class="col-lg-9 col-md-9 ">
                    <p> 
                    <h1>ROCKEP APP</h1>
                    La guia del musico
                    </p>
                </div>
                <br />
                <div class="col-lg-3 col-md-3 "><label > Hola    <?php echo " " . $usuario->getPnombre() . " :)"; ?>
                        <a href="LogOut.php" class="btn btn-default">Salir</a> </label> 
                </div>
            </div>
        </header>
        <div class="container">
            <br/>
            <h3>Edita tu publicación</h3>
            <br/>
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                <div class="center-block">
                    <form id="updatePublicacion" name="updatePublicacion" enctype="multipart/form-data" class="form-group" action="publicaciones.php" method="POST">
                        <div >
                            <!--datos basicos publicación--------------------------------------->
                            <input type="text" name="id" value="<?php echo $publicacion->getId(); ?>" hidden="true"/>
                            <div class="row">
                                <div >
                                    <label>Nombre de la Publicación:</label>
                                    <div >
                                        <input class="form-control" type="text" id="titulo" name="titulo" placeholder="Mi publicación" value="<?php echo $publicacion->getNombre(); ?>"/>
                                    </div>
                                    <label>Teléfono:</label>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                            <input class="form-control" type="tel" name="codarea" placeholder="Area" value="<?php echo $telefono->getCodarea(); ?>"/>
                                        </div>
                                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                            <input class="form-control" type="tel" name="telefono" placeholder="Numero" value="<?php echo $telefono->getNumero(); ?>"/>
                                        </div>
                                    </div>
                                    <label>Email:</label>
                                    <div >
                                        <input class="form-control" type="text" name="email" placeholder="nombre@dominio.com" value="<?php echo $publicacion->getEmail(); ?>"/>
                                    </div>
                                    <label>Sitio Web:</label>
                                    <div >
                                        <input class="form-control" type="text" name="web" placeholder="www.tusitio.com" value="<?php echo $publicacion->getWeb(); ?>"/>
                                    </div>
                                </div>

                                <div >
                                    <!--Google Maps y Autocomplete--------------------------------------->
                                    <label>Dirección:</label>
                                    <div >
                                        <input class="form-control" type="text" name="direccion" placeholder="Calle y altura, localidad" id="search" 
                                               value="<?php echo obtenerDireccion($direccion); ?>" />
                                    </div>
                                    <br />
                                    <div id="map" >
                                    </div>
                                </div>
                            </div >
                            <div>
                                <!--------------RECUPERO DE INFORMACION DE DIRECCION-------------------------------------->
                                <input type="text" id="lat" name="lat" value="<?php echo $direccion->getLatitud(); ?>" hidden="true">
                                <input type="text" id="long" name="long" value="<?php echo $direccion->getLongitud(); ?>" hidden="true">
                                <table id="address" hidden="true">
                                    <tr>
                                        <td class="label">Street address</td>
                                        <td class="slimField"><input class="field" id="street_number" name="street_number" value="<?php echo $direccion->getAltura(); ?>"/></td>
                                        <td class="wideField" colspan="2"><input class="field" id="route" name="route" value="<?php echo $direccion->getCalle(); ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td class="label">City</td>
                                        <td class="wideField" colspan="3"><input class="field" id="locality" name="locality" value="<?php echo $direccion->getLocalidad(); ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td class="label">State</td>
                                        <td class="slimField"><input class="field" id="administrative_area_level_1" name="administrative_area_level_1" value="<?php echo $direccion->getProvincia(); ?>" /></td>
                                        <td class="label">Zip code</td>
                                        <td class="wideField"><input class="field" id="postal_code" name="postal_code" value="<?php echo $direccion->getCp(); ?>" /></td>
                                    </tr>
                                    <tr>
                                        <td class="label">Country</td>
                                        <td class="wideField" colspan="3"><input class="field" id="country" name="country" value="<?php echo $direccion->getPais(); ?>" /></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="row">
                                <div >
                                    <br />
                                    <label>Sube imagenes de tu publicación:</label>
                                    <br />
                                    <!-- Preview1 -->
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="form-control" id="image-preview" style="margin: 5px; 
                                             background-image: url('<?php
                                             if (isset($imagenes[0])) {
                                                 echo $imagenes[0]->getUri();
                                             }
                                             ?>'); 
                                             background-size: cover;
                                             background-position: center center;
                                             background-position-x: center;
                                             background-position-y: center;">
                                            <label for="image-upload" id="image-label">Click aquí</label>
                                            <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                            <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                                            <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                                            <input type="file" name="imagen1" id="image-upload"/>
                                            <?php
                                            if (isset($imagenes[0])) {
                                                echo '<input type="hidden" id="imagen1" name="imagen1" value="' . $imagenes[0]->getId() . '" />';
                                            }
                                            ?>

                                        </div>
                                        <div >
                                            <input class="form-control" type="button"  value="Quitar Imagen" onclick="quitarImagen('imagen1', 'image-preview')" style=" width: 180px;
                                                   margin: 5px;
                                                   background-size: cover;
                                                   background-position: center center;
                                                   background-position-x: center;
                                                   background-position-y: center;"/>

                                        </div>
                                    </div>
                                    <!-- Preview2 -->
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="form-control" id="image-preview2" style="margin: 5px; 
                                             background-image: url('<?php
                                             if (isset($imagenes[1])) {
                                                 echo $imagenes[1]->getUri();
                                             }
                                             ?>'); 
                                             background-size: cover;
                                             background-position: center center;
                                             background-position-x: center;
                                             background-position-y: center;">
                                            <label for="image-upload2" id="image-label2">Click aquí</label>
                                            <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                            <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                                            <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                                            <input type="file" name="imagen2" id="image-upload2"/>
                                            <?php
                                            if (isset($imagenes[1])) {
                                                echo '<input type="hidden" id="imagen2" name="imagen2" value="' . $imagenes[1]->getId() . '" />';
                                            }
                                            ?>

                                        </div>
                                        <div >
                                            <input class="form-control" type="button"  value="Quitar Imagen" onclick="quitarImagen('imagen2', 'image-preview2')" style=" width: 180px;
                                                   margin: 5px;
                                                   background-size: cover;
                                                   background-position: center center;
                                                   background-position-x: center;
                                                   background-position-y: center;"/>

                                        </div>
                                    </div>
                                    <!-- Preview3 -->
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                        <div class="form-control" id="image-preview3" style="margin: 5px; 
                                             background-image: url('<?php
                                             if (isset($imagenes[2])) {
                                                 echo $imagenes[2]->getUri();
                                             }
                                             ?>'); 
                                             background-size: cover;
                                             background-position: center center;
                                             background-position-x: center;
                                             background-position-y: center;">
                                            <!-- Preview -->
                                            <label for="image-upload3" id="image-label3">Click aquí</label>
                                            <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                            <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                                            <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                                            <input type="file" name="imagen3" id="image-upload3"/>
                                            <?php
                                            if (isset($imagenes[2])) {
                                                echo '<input type="hidden" id="imagen3" name="imagen3" value="' . $imagenes[2]->getId() . '" />';
                                            }
                                            ?>

                                        </div>
                                        <div >
                                            <input class="form-control" type="button"  value="Quitar Imagen" onclick="quitarImagen('imagen3', 'image-preview3')" style=" width: 180px;
                                                   margin: 5px;
                                                   background-size: cover;
                                                   background-position: center center;
                                                   background-position-x: center;
                                                   background-position-y: center;"/>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >

                                <br />
                                <label>Subi tu video de youtube:</label>

                                <input class="form-control" id="urlYouTube" name="video" type="text" placeholder="Copia la dirección de tu video y clickea fuera del cuadro." value="<?php echo $video->getUri(); ?>"/>
                                <br />
                                <div id="player"></div>
                            </div>
                        </div>


                        <div class="main row " >

                            <br />

                            <label>Selecciona la categoria de tu publicación:</label>
                            <div>
                                <select class="form-control" id="tipoPub" name="tipoPub">
                                    <?php
                                    $tipoPubModel = new TipoPubModel();
                                    $tiposPub = $tipoPubModel->listar();
                                    foreach ($tiposPub as $tipoPub) {
                                        if ($tipoPub->getId() === $publicacion->getTipoPub_id()) {
                                            echo '<option selected="true" value="' . $tipoPub->getId() . '">' . $tipoPub->getDescripcion() . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div id="contenido" name="contenido">

                                <?php
//SELECTOR DE CONTENIDOS
                                switch ($publicacion->getTipoPub_id()) {
                                    case 1:
                                        //--Obtener datos especificos de la publicacion-------------------------------------
                                        $publicacion_equiposModel = new Publicacion_equiposModel();
                                        $publicaciones_equipos = $publicacion_equiposModel->obtenerPublicaciones_equiposByPubId($publicacion->getId());
                                        $publicacion_serviciosModel = new Publicacion_serviciosModel();
                                        $publicaciones_servicios = $publicacion_serviciosModel->obtenerPublicaciones_serviciosByPubId($publicacion->getId());
                                        $salasModel = new SalasModel();
                                        $salas = $salasModel->obtenerSalasByPubId($publicacion->getId());
                                        $precioHoraModel = new PrecioHoraModel();
                                        $precioHora = $precioHoraModel->obtenerPreciohoraByPubId($publicacion->getId());
                                        //------------------------------------------------------------------------------------
                                        // INPUT VALOR HORA-------------------------------------------------------------------
                                        $html = '<div class="row"> <br />'
                                                . '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">'
                                                . '<label> Ingrese el valor de por hora:</label>'
                                                . '<div>'
                                                . '<input class="form-control" type="text" id="valhora" name="valhora" placeholder="Desde..." '
                                                . 'value="' . $precioHora->getValor()
                                                . '"/>  <br />'
                                                . '</div>';
                                        //------------------------------------------------------------------------------------
                                        // INPUT CANTIDAD DE SALAS------------------------------------------------------------        
                                        $html .= '<label> Ingrese la cantidad de salas disponibles:</label>'
                                                . '<div>'
                                                . '<input class="form-control" type="text" id="cantidadSalas" name="cantidadSalas" placeholder="Valor numerico..." '
                                                . 'value="' . $salas->getCantidad()
                                                . '" />'
                                                . '</div>'
                                                . '</div>'
                                                . '</div>';
                                        //------------------------------------------------------------------------------------
                                        // CHECKBOX SERVICIOS-----------------------------------------------------------------     
                                        $html .= '<div class="row"> <br />'
                                                . '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">'
                                                . '<label> Seleccione los servicios que ofrece:</label>'
                                                . '</div>'
                                                . '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"> ';
                                        $serviciosModel = new ServiciosModel();
                                        $servicios = $serviciosModel->listar();
                                        $cantidadServicios = count($servicios);
                                        $mitadServicios = $cantidadServicios / 2;
                                        for ($i = 0; $i <= $mitadServicios; ++$i) {
                                            $html .= '<input type="checkbox" '
                                                    . 'name="servicios[]" '
                                                    . 'value="' . $servicios[$i]->getId() . '" ';
                                            foreach ($publicaciones_servicios as $publicacion_servcios) {
                                                if ($publicacion_servcios->getServicios_id() == $servicios[$i]->getId()) {
                                                    $html .= "checked";
                                                }
                                            }
                                            $html .= ' /> ' . $servicios[$i]->getDescripcion() . '<br />';
                                        }
                                        $html .= '</div> '
                                                . '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"> ';
                                        for ($i = $mitadServicios + 1; $i < $cantidadServicios; ++$i) {
                                            $html .= '<input type="checkbox" '
                                                    . 'name="servicios[]" '
                                                    . 'value="' . $servicios[$i]->getId() . '" ';
                                            foreach ($publicaciones_servicios as $publicacion_servcios) {
                                                if ($publicacion_servcios->getServicios_id() == $servicios[$i]->getId()) {
                                                    $html .= "checked";
                                                }
                                            }
                                            $html .= ' /> ' . $servicios[$i]->getDescripcion() . '<br />';
                                        }
                                        $html .= '</div>'
                                                . '</div> <br />';
                                        //------------------------------------------------------------------------------------
                                        // CHECKBOX EQUIPOS-------------------------------------------------------------------          
                                        $html .= '<label> Seleccione los equipos que dispone:</label>'
                                                . '<div id="equipos" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
                                        $equiposModel = new EquiposModel();
                                        $equipos = $equiposModel->listar();
                                        foreach ($equipos as $equipo) {
                                            $idMacasPorEquipo = array();
                                            $idEquiposRepetidos = array();
                                            foreach ($publicaciones_equipos as $publicacion_equipo) {
                                                if ($publicacion_equipo->getEquipos_id() == $equipo->getId()) {
                                                    $idMacasPorEquipo[] = $publicacion_equipo->getMarcas_id();
                                                    $idEquiposRepetidos[] = $publicacion_equipo->getEquipos_id();
                                                }
                                            }
                                            $html .= '<div class="row" >'
                                                    . '<input type="checkbox" '
                                                    . 'name="equipos[]" '
                                                    . 'value="' . $equipo->getId() . '" '
                                                    . 'onclick="mostrar_marcas(this)" ';
                                            if (in_array($equipo->getId(), $idEquiposRepetidos)) {
                                                $html .= "checked";
                                            }

                                            $html .= ' /> ' . $equipo->getDescripcion() . '<br />'
                                                    . '</div>';
                                            // CHECKBOX MARCAS ----------------------------------------------//
                                            if (count($idMacasPorEquipo) > 0) {
                                                $equipos_marcasModel = new Equipos_marcasModel();
                                                $equipos_marcas = $equipos_marcasModel->ListarEquipos_MarcasByEquiposID(new Equipos($equipo->getId(), null));
                                                $marcasModel = new MarcasModel();
                                                $marcas = array();
                                                foreach ($equipos_marcas as $equipo_marca) {
                                                    $marcas[] = $marcasModel->ObetenerMarcasByID($equipo_marca->getMarcas_id());
                                                }

                                                $html .= '<div class="panel panel-default"> '
                                                        . '<div class="panel-heading"> Seleccione una o mas marcas: '
                                                        . '</div> '
                                                        . '<div class="panel-body"> ';
                                                foreach ($marcas as $marca) {
                                                    $html .= '<input type="checkbox" '
                                                            . 'name="marcasequipos' . $equipo->getId() . '[]" '
                                                            . 'value="' . $marca->getId() . '"';
                                                    if (in_array($marca->getId(), $idMacasPorEquipo)) {
                                                        $html .= "checked";
                                                    }
                                                    $html .= ' /> '
                                                            . $marca->getDescripcion() . '<br />';
                                                }
                                                $html .= '</div>'
                                                        . '</div> ';
                                            }
                                        }
                                        $html .= '</div>';
                                        echo $html;

                                        break;
                                    //VENTA DE INSTRUMENTOS
                                    case 2:
                                        //--Obtener datos especificos de la publicacion-------------------------------------
                                        $publicacion_instrumentosModel = new Publicacion_instrumentosModel();
                                        $publicacion_instrumentos = $publicacion_instrumentosModel->obtenerPublicacion_instrumentosByPubId($publicacion->getId());
                                        $instrumentos_datosModel = new Instrumentos_datosModel();
                                        $instrumentos_datos = $instrumentos_datosModel->obtenerInstrumentos_datosById($publicacion_instrumentos->getInstrumentos_datos_id());
                                        $precioHoraModel = new PrecioHoraModel();
                                        $precioHora = $precioHoraModel->obtenerPreciohoraByPubId($publicacion->getId());
                                        //------------------------------------------------------------------------------------
                                        // SELECT TIPO DE INSTRUMENTO---------------------------------------------------------
                                        $html = '<div> <br />'
                                                . '<label>Seleccione un tipo de instrumento:</label>'
                                                . '<select class="form-control" id="instrumento" name="instrumento" onchange="mostrarMarcasInstrumentos(this)">';
                                        $instrumentosModel = new InstrumentosModel();
                                        $instrumentos = $instrumentosModel->listar();
                                        foreach ($instrumentos as $instrumento) {
                                            if ($instrumento->getId() === $publicacion_instrumentos->getInstrumentos_id()) {
                                                $html .= '<option selected="true" value=" ' . $instrumento->getId() . '">' . $instrumento->getDescripcion() . '</option>';
                                            }
                                        }
                                        $html .= '</select>'
                                                . '</div>';
                                        //------------------------------------------------------------------------------------
                                        // SELECT/INPUT MARCA DE INSTRUMENTO--------------------------------------------------
                                        $instrumentos_marcasModel = new Instrumentos_marcasModel();
                                        $instrumentos_marcas = $instrumentos_marcasModel->ListarInstrumentos_MarcasByInstrumentosID(new Instrumentos($publicacion_instrumentos->getInstrumentos_id(), null));
                                        $marcasModel = new MarcasModel();
                                        $marcas = array();
                                        $html .= '<div id="marcas" name="marcas"> <br />';
                                        if (count($instrumentos_marcas) > 0) {
                                            foreach ($instrumentos_marcas as $instrumento_marca) {
                                                $marcas[] = $marcasModel->ObetenerMarcasByID($instrumento_marca->getMarcas_id());
                                            }
                                            $html .= '<label>Seleccione un marca:</label>'
                                                    . '<div>'
                                                    . '<select class="form-control" id="marcaInstrimento" name="marcaInstrimento" >'
                                                    . '<option selected="true" disabled="disabled">Marca...</option>';
                                            foreach ($marcas as $marca) {
                                                $html .= '<option value="' . $marca->getId() . '"';
                                                if ($marca->getId() === $publicacion_instrumentos->getMarcas_id()) {
                                                    $html .= 'selected="true"';
                                                }
                                                $html .= '>' . $marca->getDescripcion() . '</option>';
                                            }
                                            $html .= '</select> '
                                                    . '<br />'
                                                    . '</div>';
                                        } else {
                                            $html .= '<label>Ingrese el nombre su instrumento:</label>'
                                                    . '<div>'
                                                    . '<input type="text" class="form-control" id="otroInstrumento" name="otroInstrumento" placeholder="Ej. guitarra electrica."'
                                                    . 'value="' . $instrumentos_datos->getOtro()
                                                    . '"/>'
                                                    . '<br />'
                                                    . '</div>';
                                        }
                                        //------------------------------------------------------------------------------------
                                        // SELECT AÑO DE INSTRUMENTO--------------------------------------------------------
                                        $html .= '<label>Seleccione el modelo:</label>'
                                                . '<div>'
                                                . '<select class="form-control" id="anioInstrimento" name="anioInstrimento" >';

                                        for ($i = 1900; $i <= intval(date("Y")); ++$i) {
                                            $html .= '<option ';
                                            if ($instrumentos_datos->getAnio() == $i) {
                                                $html .= 'selected="true"';
                                            }
                                            $html .= 'value="' . $i . '">' . $i . '</option>';
                                        }
                                        $html .= '</select>'
                                                . '<br />'
                                                . '</div>';
                                        //------------------------------------------------------------------------------------
                                        // SELECT PAIS DE INSTRUMENTO--------------------------------------------------------
                                        $paisModel = new PaisModel();
                                        $paises = $paisModel->listar();
                                        $html .= '<label>Seleccione el origen:</label>'
                                                . '<div>'
                                                . '<select class="form-control" id="paisInstrimento" name="paisInstrimento" >';
                                        foreach ($paises as $pais) {
                                            $html .= '<option ';
                                            if ($instrumentos_datos->getPais_id() === $pais->getId()) {
                                                $html .= 'selected="true"';
                                            }

                                            $html .= 'value="' . $pais->getId() . '">' . $pais->getNombre() . '</option>';
                                        }
                                        $html .= '</select>'
                                                . '</div>'
                                                . '<br />';
                                        //------------------------------------------------------------------------------------
                                        // SELECT MARCA DE INSTRUMENTO--------------------------------------------------------
                                        $html .= '<label>Seleccione el estado:</label>'
                                                . '<div>'
                                                . '<select class="form-control" id="estadoInstrimento" name="estadoInstrimento" >';
                                        if ($instrumentos_datos->getEstado() === "Nuevo") {

                                            $html .= '<option value="Nuevo">Nuevo</option>'
                                                    . '<option value="Usado">Usado</option>';
                                        } else {
                                            $html .= '<option selected="true" value="Nuevo">Nuevo</option>'
                                                    . '<option selected="true" value="Usado">Usado</option>';
                                        }


                                        $html .= '</select> '
                                                . '</div>'
                                                . '<br />';
                                        //------------------------------------------------------------------------------------
                                        // INPUT VALOR DE INSTRUMENTO--------------------------------------------------------      
                                        $html .= '<label>Ingrese el valor del equipo:</label> <br />'
                                                . '<div>'
                                                . '<input type="text" class="form-control" id="valorInstrimento" name="valorInstrimento" placeholder="Valor de venta."'
                                                . 'value="' . $precioHora->getValor() . '"/>'
                                                . '</div>'
                                                . '</div>';

                                        echo $html;

                                        break;
                                    //ESTILO DE VIDA
                                    case 3:
                                        //--Obtener datos especificos de la publicacion-------------------------------------
                                        $publicacion_estilovidaModel = new Publicacion_estilovidaModel();
                                        $publicacion_estiloVida = $publicacion_estilovidaModel->obtenerPublicacion_estiloVidaByPubId($publicacion->getId());
                                        $publicacion_prodcutosModel = new Publicacion_productosModel();
                                        $publicaciones_productos = $publicacion_prodcutosModel->obtenerPublicacion_productosByPubId($publicacion->getId());
                                        $horariosModel = new HorariosModel();
                                        $horarios = $horariosModel->obtenerHorariosByPubId($publicacion->getId());
                                        $precioHoraModel = new PreciohoraModel();
                                        $precioHora = $precioHoraModel->obtenerPreciohoraByPubId($publicacion->getId());
                                        //------------------------------------------------------------------------------------
                                        //SELECT TIPO ESTABLECIMIENTO---------------------------------------------------------
                                        $html = '<div> '
                                                . '<br /> '
                                                . '<label>Seleccione el tipo de establecimiento:</label> '
                                                . '<div> '
                                                . '<select class="form-control" id="estilovida" name="estilovida" onchange="mostrarProductos(this)">';
                                        $estilovidaModel = new EstilovidaModel();
                                        $estilosvida = $estilovidaModel->listar();

                                        foreach ($estilosvida as $estilovida) {
                                            if ($publicacion_estiloVida->getEstilovida_id() === $estilovida->getId()) {
                                                $html .= '<option selected="true" value="' . $estilovida->getId() . '">' . $estilovida->getDescripcion() . '</option>';
                                            }
                                        }
                                        $html .= '</select>'
                                                . '</div>'
                                                . '</div>';
                                        //------------------------------------------------------------------------------------
                                        //SELECT PRODUCTOS--------------------------------------------------------------------
                                        $estilovida_productosModel = new Estilovida_productosModel();
                                        $estilovida_productos = $estilovida_productosModel->ListarEstilovida_productosByEstilovidaID(new Estilovida($publicacion_estiloVida->getEstilovida_id(), null, null, null, null));
                                        $productosModel = new ProductosModel();
                                        $productos = array();
                                        foreach ($estilovida_productos as $estilovida_producto) {
                                            $productos[] = $productosModel->ObetenerProductosByID($estilovida_producto->getProductos_id());
                                        }
                                        $html .= '<div>';
                                        if (count($productos) > 0) {
                                            $html .= '<div id="productos" name="productos"> <br /> '
                                                    . '<label>Seleccione uno o mas productos:</label> <br />';
                                            foreach ($productos as $producto) {
                                                $html .= '<input type="checkbox" name="producto[]" '
                                                        . 'value="' . $producto->getId() . ' "';
                                                foreach ($publicaciones_productos as $publicacion_productos) {
                                                    if ($producto->getId() === $publicacion_productos->getProductos_id()) {
                                                        $html .= 'checked';
                                                    }
                                                }
                                                $html .= '/> '
                                                        . $producto->getDescripcion() . '<br />';
                                            }
                                            $html .= "</div></div>";
                                        }
                                        //------------------------------------------------------------------------------------
                                        //INPUTS HORARIOS--------------------------------------------------------------------
                                        $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];

                                        $html .= '<div id="diasYhorarios" name="diasYhorarios" > <br />'
                                                . '<label>Seleccione días y horarios de apertura:</label> '
                                                . '<div id="horariosAgregados">';
                                        foreach ($horarios as $horario) {
                                            if ($horario->getDesdeDia() != $horario->getHastaDia()) {
                                                //MAS DE UN DIA
                                                $html .= '<div>'
                                                        . '<div class="input-group">'
                                                        . '<input type="text" class="form-control" id="horario" name="horario[]" value="De '
                                                        . $horario->getDesdeDia() . ' a ' . $horario->getHastaDia() . ' de '
                                                        . $horario->getDesdeHora() . ' hs. a ' . $horario->getHastaHora() . ' hs." readonly/>'
                                                        . '<span class="input-group-btn">'
                                                        . '<button class="btn btn-secondary" type="button" onClick="quitarHorario(this)">Quitar</button>'
                                                        . '</span>'
                                                        . '</div>'
                                                        . '<br/>'
                                                        . '</div>';
                                            } else {
                                                // SOLO UN DIA
                                                $html .= '<div>'
                                                        . '<div class="input-group">'
                                                        . '<input type="text" class="form-control" id="horario" name="horario[]" value="'
                                                        . $horario->getDesdeDia() . ' de '
                                                        . $horario->getDesdeHora() . ' hs. a ' . $horario->getHastaHora() . ' hs." readonly/>'
                                                        . '<span class="input-group-btn">'
                                                        . '<button class="btn btn-secondary" type="button" onClick="quitarHorario(this)">Quitar</button>'
                                                        . '</span>'
                                                        . '</div>'
                                                        . '<br/>'
                                                        . '</div>';
                                            }
                                        }
                                        $html .= '</div>'
                                                //------------------------------------------------------------------------------------
                                                //SELECTS AGREGAR HORARIOS------------------------------------------------------------ 
                                                . '<div id="desdeDia">'
                                                . '<select class="form-control" id="diaDesde" name="diaDesde"> '
                                                . '<option selected="true" disabled="disabled">Desde día...</option>';
                                        foreach ($dias as $dia) {
                                            $html .= '<option value="' . $dia . '">' . $dia . '</option>';
                                        }
                                        $html .= '</select>'
                                                . '</div>'
                                                . '<div id="hastaDia">'
                                                . '<select class="form-control" id="diaHasta" name="diaHasta">  '
                                                . '<option selected="true" disabled="disabled">Hasta día...</option>';
                                        foreach ($dias as $dia) {
                                            $html .= '<option value="' . $dia . '">' . $dia . '</option>';
                                        }
                                        $html .= '</select>'
                                                . '</div>'
                                                . '<div id="desdeHora">'
                                                . '<select class="form-control" id="horaDesde" name="horaDesde"> '
                                                . '<option selected="true" disabled="disabled">Desde hora...</option>';
                                        for ($i = 1; $i <= 24; $i++) {
                                            $html .= '<option value="' . $i . '">' . $i . 'Hs. </option>';
                                        }
                                        $html .= '</select>'
                                                . '</div>'
                                                . '<div id="hastaHora">'
                                                . '<select class="form-control" id="horaHasta" name="horaHasta">  '
                                                . '<option selected="true" disabled="disabled">Hasta hora...</option>';
                                        for ($i = 1; $i <= 24; $i++) {
                                            $html .= '<option value="' . $i . '">' . $i . 'Hs. </option>';
                                        }
                                        $html .= '</select>'
                                                . '</div>'
                                                . '<div>'
                                                . '<input class="form-control" type="button" id="addHorario" name="addHorario" value="Agregar horario." onClick="agregarHorario()"/>'
                                                . '</div>'
                                                . '</div>';

                                        echo $html;

                                        break;
                                    //SERVICIOS PROFESIONALES
                                    case 4:
                                        //--Obtener datos especificos de la publicacion-------------------------------------
                                        $publicacion_servProfModel = new Publicacion_serviciosProfModel();
                                        $publicacion_servProf = $publicacion_servProfModel->obtenerPublicacion_servProfByPubId($publicacion->getId());
                                        $serviciosProfModel = new ServiciosProfModel();
                                        $serviciosProf = $serviciosProfModel->obtenerServicioProfBybId($publicacion_servProf->getServiciosProf_id());
                                        $precioHoraModel = new PreciohoraModel();
                                        $precioHora = $precioHoraModel->obtenerPreciohoraByPubId($publicacion->getId());
                                        //------------------------------------------------------------------------------------
                                        //SELECT TIPO SERVICIO PROFESIONAL----------------------------------------------------
                                        $html = '<div> <br />'
                                                . '<label>Seleccione el tipo de servicio:</label>'
                                                . '<div>'
                                                . '<select class="form-control" id="servProf" name="servProf">'
                                                . '<option selected="true" value="' . $serviciosProf->getID() . '">' . $serviciosProf->getDescripcion() . '</option>'
                                                . '</select> '
                                                . '<br/>'
                                                . '</div>';
                                        //------------------------------------------------------------------------------------
                                        //INPUT AÑOS EXPERIENCIA--------------------------------------------------------------     
                                        $html .= '<label> Ingrese sus años de experiencia:</label>'
                                                . '<div>'
                                                . '<input class="form-control" type="text" name="experiencia" placeholder="Ingrese solo el valor numerico."'
                                                . 'value="' . $publicacion_servProf->getExperiencia()
                                                . '" /> <br/>'
                                                . '</div>';
                                        //------------------------------------------------------------------------------------
                                        //INPUT VALOR HORA--------------------------------------------------------------------
                                        $html .= '<label> Ingrese el valor por hora:</label> '
                                                . '<div>'
                                                . '<input class="form-control "type="text" id"valhora" name="valhora" placeholder="Desde..."'
                                                . 'value="' . $precioHora->getValor()
                                                . '" /><br/>'
                                                . '</div>'
                                                . '</div>';
                                        echo $html;

                                        break;
                                    case 5:
                                        //--Obtener datos especificos de la publicacion-------------------------------------
                                        $publicacion_showEventosModel = new Publicacion_showeventosModel();
                                        $publicacion_showEventos = $publicacion_showEventosModel->obtenerPublicacion_showeventosByPubId($publicacion->getId());
                                        $fechasModel = new FechasModel();
                                        $fechas = $fechasModel->obtenerFechasByPub_ShowEventosId($publicacion_showEventos->getId());
                                        $precioHoraModel = new PreciohoraModel();
                                        $precioHora = $precioHoraModel->obtenerPreciohoraByPubId($publicacion->getId());
                                        $bandasModel = new BandasModel();
                                        $bandas = $bandasModel->obtenerBandasByPub_ShowEventosId($publicacion_showEventos->getId());
                                        //------------------------------------------------------------------------------------
                                        //SELECT TIPO SHOW/EVENTO-------------------------------------------------------------
                                        $html = '<div> <br />'
                                                . '<label>Seleccione el tipo de show/evento:</label>'
                                                . '<div>'
                                                . '<select class="form-control" id="showEventos" name="showEventos">';
                                        $showEventosModel = new ShoweventosModel();
                                        $showEventos = $showEventosModel->listar();
                                        foreach ($showEventos as $showEvento) {
                                            if ($showEvento->getId() == $publicacion_showEventos->getShoweventos_id()) {
                                                $html .= '<option value="' . $showEvento->getId() . '">' . $showEvento->getDescripcion() . '</option>';
                                            }
                                        }
                                        $html .= '</select> <br/>'
                                                . '</div>';
                                        //------------------------------------------------------------------------------------
                                        //INPUT ARTISTA/BANDA-----------------------------------------------------------------
                                        $html .= '<label> Artistas del evento:</label> <br />'
                                                . '<div>'
                                                . '<input class="form-control" type="text" id="banda" name="banda" placeholder="Artistas, max 45 carateres..." '
                                                . 'value="' . $bandas->getDescripcion()
                                                . '"/> <br />'
                                                . '</div>';
                                        //------------------------------------------------------------------------------------
                                        //INPUT valor show/evento-------------------------------------------------------------
                                        $html .= '<label> Ingrese el valor de la entrada:</label> <br />'
                                                . '<div>'
                                                . '<input class="form-control" type="text" name="valor" placeholder="Valor entrada..." '
                                                . 'value="' . $precioHora->getValor()
                                                . '"/> <br />'
                                                . '</div>';
                                        //------------------------------------------------------------------------------------
                                        //INPUTS FECHAS AGREGADAS----------------------------------------------------------------
                                        $html .= '<label> Ingrese las fechas del show/evento:</label> <br />'
                                                . '<div id="fechasAgregadas">';
                                        foreach ($fechas as $fecha) {
                                            $fechaAux = preg_split("/[\s-]/", $fecha->getDiaHora());
                                            $html .= '<div><div class="input-group">'
                                                    . '<input type="text" class="form-control" id="fecha" name="fecha[]" value="El '
                                                    . $fechaAux[2] . '-' . $fechaAux[1] . '-' . $fechaAux[0] . ' a las ' . $fechaAux[3] . ' hs." readonly/>'
                                                    . '<span class="input-group-btn">'
                                                    . '<button class="btn btn-secondary" type="button" onClick="quitarHorario(this)">Quitar</button>'
                                                    . '</span></div><br/></div>'
                                                    . '</div>';
                                        }
                                        //------------------------------------------------------------------------------------
                                        //INPUTS PARA AGREGAR FECHAS----------------------------------------------------------------
                                        $html .= '<div id="fechaHora" >'
                                                . '<input class="form-control" type="date" id="date" name="date"/>'
                                                . '<input class="form-control" type="time" id="hora" name="hora"/>'
                                                . '</div>'
                                                . '<div>'
                                                . '<input class="form-control" type="button" name="agregarFech" value="Agregar fecha" onClick="agregarFecha(this)" />'
                                                . '</div>';
                                        echo $html;
                                        break;
                                }
                                ?>


                            </div>
                        </div>
                        <br />
                        <br />
                        <input class="form-control" type="submit" name="actualizarPub" value="Guardar sala" />
                        <br />
                    </form>
                </div>
            </div>
        </div>

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYgMRql3zMtDw_I4MEGwTEtD2u_iNytI4&libraries=places" ></script><!-- Maps and Librearies -->
        <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
        <script type="text/javascript" src="js/jquery.uploadPreview.min.js"></script><!-- Preview -->
        <script type="text/javascript" src="js/preview.js"></script><!-- Preview -->
        <script type="text/javascript" src="js/maps.js"></script><!-- Maps -->
        <script type="text/javascript" src="js/youtube.js"></script><!-- YouTube -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" type="text/javascript"></script><!-- Validar Campos -->
        <script type="text/javascript" src="js/PuserUPub.js"></script><!-- validar y contenido dinamico -->
    </body>
</html>
