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


//----------TIPO DE PUBLICACION----------------------------------
if (isset($_POST["tipoPub"])) {
    switch ($_POST["tipoPub"]) {
        //------------------SALAS Y ESTUDIOS---------------------
        case 1:
            $html = '<div class="row"> <br />'
                    . '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">'
                    . '<label> Ingrese el valor de por hora:</label>'
                    . '<div>'
                    . '<input class="form-control "type="text" id="valhora" name="valhora" placeholder="Desde..."/>  <br />'
                    . '</div>'
                    . '<label> Ingrese la cantidad de salas disponibles:</label>'
                    . '<div>'
                    . '<input class="form-control "type="text" id="cantidadSalas" name="cantidadSalas" placeholder="Valor numerico..."/>'
                    . '</div>'
                    . '</div>'
                    . '</div>'
                    . '<div class="row"> <br />'
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
                        . 'value="' . $servicios[$i]->getId() . '" '
                        . '/> ' . $servicios[$i]->getDescripcion() . '<br />';
            }
            $html .= '</div> '
                    . '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"> ';
            for ($i = $mitadServicios + 1; $i < $cantidadServicios; ++$i) {
                $html .= '<input type="checkbox" '
                        . 'name="servicios[]" '
                        . 'value="' . $servicios[$i]->getId() . '" '
                        . '/> ' . $servicios[$i]->getDescripcion() . '<br />';
            }
            $html .= '</div>'
                    . '</div> <br />'
                    . '<label>Seleccion los equipos que dispone:</label> <br />'
                    . '<div id="equipos" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
            $equiposModel = new EquiposModel();
            $equipos = $equiposModel->listar();
            foreach ($equipos as $equipo) {
                $html .= '<div class="row">'
                        . '<input type="checkbox" '
                        . 'name="equipos[]" '
                        . 'value="' . $equipo->getId() . '" '
                        . 'onclick="mostrar_marcas(this)" '
                        . '/> ' . $equipo->getDescripcion() . '<br />'
                        . '</div>';
            }
            $html .= '</div>';
            echo $html;
            break;
        case 2:
            //------------------VENTA DE INSTRUMENTOS---------------------
            $html = '<div> <br />'
                    . '<label>Seleccione un tipo de instrumento:</label>'
                    . '<select class="form-control" id="instrumento" name="instrumento" onchange="mostrarMarcasInstrumentos(this)">'
                    . '<option selected="true" disabled="disabled">Tipo de instrumento...</option>';
            $instrumentosModel = new InstrumentosModel();
            $instrumentos = $instrumentosModel->listar();
            foreach ($instrumentos as $instrumento) {
                $html .= '<option value=" ' . $instrumento->getId() . '">' . $instrumento->getDescripcion() . '</option>';
            }
            $html .= '</select>'
                    . '</div>';
            echo $html;
            break;
        case 3:
            //------------------ESTILO DE VIDA---------------------
            $html = '<div> <br />'
                    . '<label>Seleccione el tipo de establecimiento:</label>'
                    . '<div >'
                    . '<select class="form-control" id="estilovida" name="estilovida" onchange="mostrarProductos(this)">'
                    . '<option selected="true" disabled="disabled">Tipo de establecimiento...</option>';
            $estilovidaModel = new EstilovidaModel();
            $estilosvida = $estilovidaModel->listar();
            foreach ($estilosvida as $estilovida) {
                $html .= '<option value="' . $estilovida->getId() . '">' . $estilovida->getDescripcion() . '</option>';
            }
            $html .= '</select>'
                    . '</div>'
                    . '</div >';
            echo $html;
            break;
        case 4:
            //------------------SERVICIOS PROFESIONALES---------------------
            $html = '<div> <br />'
                    . '<label>Seleccione el tipo de servicio:</label>'
                    . '<div>'
                    . '<select class="form-control" id="servProf" name="servProf">'
                    . '<option selected="true" disabled="disabled">Tipo de servicio...</option>';
            $servProfesionalesModel = new ServiciosProfModel();
            $servProfesionales = $servProfesionalesModel->listar();
            foreach ($servProfesionales as $servProfesionales) {
                $html .= '<option value="' . $servProfesionales->getId() . '">' . $servProfesionales->getDescripcion() . '</option>';
            }
            $html .= '</select> '
                    . '<br/>'
                    . '</div>'
                    . '<label> Ingrese sus años de experiencia:</label>'
                    . '<div>' 
                    . '<input class="form-control" type="text" name="experiencia" placeholder="Ingrese solo el valor numerico."> <br/>'
                    . '</div>'
                    . '<label> Ingrese el valor por hora:</label> '
                    . '<div>'
                    . '<input class="form-control "type="text" id="valhora" name="valhora" placeholder="Desde..."/><br/>'
                    . '</div>'
                    . '</div>';
            echo $html;


            break;
        case 5:
            //------------------SHOWS Y EVENTOS---------------------
            $html = '<div> <br />'
                    . '<label>Seleccione el tipo de show/evento:</label>'
                    . '<div>'
                    . '<select class="form-control" id="showEventos" name="showEventos">'
                    . '<option selected="true" disabled="disabled">Tipo de show/evento...</option>';
            $showEventosModel = new ShoweventosModel();
            $showEventos = $showEventosModel->listar();
            foreach ($showEventos as $showEvento) {
                $html .= '<option value="' . $showEvento->getId() . '">' . $showEvento->getDescripcion() . '</option>';
            }
            $html .= '</select> <br/>'
                    . '</div>'
                    . '<label> Artistas del evento:</label> <br />'
                    . '<div>'
                    . '<input class="form-control" type="text" id="banda" name="banda" placeholder="Artistas, max 45 carateres..."> <br />'
                    . '</div>'
                    . '<label> Ingrese el valor de la entrada:</label> <br />'
                    . '<div>'
                    . '<input class="form-control" type="text" name="valor" placeholder="Valor entrada..."> <br />'
                    . '</div>'
                    . '<label> Ingrese las fechas del show/evento:</label> <br />'
                    . '<div id="fechasAgregadas">'
                    . '</div>'
                    . '<div id="fechaHora" >'
                    . '<input class="form-control" type="date" id="date" name="date"/>'
                    . '<input class="form-control" type="time" id="hora" name="hora"/>'
                    . '</div>'
                    . '<div>'
                    . '<input class="form-control" type="button" name="agregarFech" value="Agregar fecha" onClick="agregarFecha(this)" />'
                    . '</div>'
                    . '</div>';
            echo $html;
            break;
        default:
            break;
    }
}


//------CONTENIDOS PARA SALAS Y ESTUDIOS DE GRABACION--------------
//MARCAS POR EQUIPO
if (isset($_POST["marcasequipos"])) {

    $equipos_marcasModel = new Equipos_marcasModel();
    $equipos_marcas = $equipos_marcasModel->ListarEquipos_MarcasByEquiposID(new Equipos($_POST["marcasequipos"], null));
    $marcasModel = new MarcasModel();
    $marcas = array();
    foreach ($equipos_marcas as $equipo_marca) {
        $marcas[] = $marcasModel->ObetenerMarcasByID($equipo_marca->getMarcas_id());
    }

    $html = '<div class="panel panel-default"> '
            .'<div class="panel-heading"> Seleccione una o mas marcas:'
            . '</div> '
            . '<div class="panel-body"> ';
    foreach ($marcas as $marca) {
        $html .= '<input type="checkbox" '
                . 'name="marcasequipos'.$_POST["marcasequipos"].'[]" '
                . 'value="' . $marca->getId() . '"/> '
                . $marca->getDescripcion() . '<br />';
    }
    $html .= '</div>'
            . '</div>';
    echo $html;
}
//-----------------------------------------------------------------
//------CONTENIDOS PARA VENTA DE INSTRUMENTOS----------------------
//MARCAS POR INSTRUMENTO
if (isset($_POST["marcasInstrumentos"])) {

    $instrumentos_marcasModel = new Instrumentos_marcasModel();
    $instrumentos_marcas = $instrumentos_marcasModel->ListarInstrumentos_MarcasByInstrumentosID(new Instrumentos($_POST["marcasInstrumentos"], null));
    $marcasModel = new MarcasModel();
    $marcas = array();

    $html = '<div id="marcas" name="marcas"> <br />';
    if (count($instrumentos_marcas) > 0) {
        foreach ($instrumentos_marcas as $instrumento_marca) {
            $marcas[] = $marcasModel->ObetenerMarcasByID($instrumento_marca->getMarcas_id());
        }
        $html .= '<label>Seleccione un marca:</label>'
                . '<div>'
                . '<select class="form-control" id="marcaInstrimento" name="marcaInstrimento" >'
                . '<option selected="true" disabled="disabled">Marca...</option>';
        foreach ($marcas as $marca) {
            $html .= '<option value="' . $marca->getId() . '">' . $marca->getDescripcion() . '</option>';
        }
        $html .= '</select> '
                . '<br />'
                . '</div>';
    } else {
        $html .= '<label>Ingrese el nombre su instrumento:</label>'
                . '<div>'
                . '<input type="text" class="form-control" id="otroInstrumento" name="otroInstrumento" placeholder="Ej. guitarra electrica, max 45 carateres."/>'
                . '<br />'
                . '</div>';
    }

    $html .= '<label>Seleccione el modelo:</label>'
            . '<div>'
            . '<select class="form-control" id="anioInstrimento" name="anioInstrimento" >'
            . '<option selected="true" disabled="disabled">Año...</option>';
    for ($i = 1900; $i <= intval(date("Y")); ++$i) {
        $html .= '<option value="' . $i . '">' . $i . '</option>';
    }
    $html .= '</select>'
            . '<br />'
            . '</div>';

    $paisModel = new PaisModel();
    $paises = $paisModel->listar();
    $html .= '<label>Seleccione el origen:</label>'
            . '<div>'
            . '<select class="form-control" id="paisInstrimento" name="paisInstrimento" >'
            . '<option selected="true" disabled="disabled">Pais...</option>';
    foreach ($paises as $pais) {
        $html .= '<option value="' . $pais->getId() . '">' . $pais->getNombre() . '</option>';
    }
    $html .= '</select>'
            . '</div>'
            . '<br />'
            . '<label>Seleccione el estado:</label>'
            . '<div>'
            . '<select class="form-control" id="estadoInstrimento" name="estadoInstrimento" >'
            . '<option selected="true" disabled="disabled">Estado...</option>'
            . '<option value="Nuevo">Nuevo</option>'
            . '<option value="Usado">Usado</option>'
            . '</select> '
            . '</div>'
            . '<br />'
            . '<label>Ingrese el valor del equipo:</label> <br />'
            . '<div>'
            . '<input type="text" class="form-control" id="valorInstrimento" name="valorInstrimento" placeholder="Valor de venta."/>'
            . '</div>'
            . '</div>';
    echo $html;
}
//-----------------------------------------------------------------
//------CONTENIDOS PARA ESTILO DE VIDA-----------------------------
//PRODUCTOS PARA TODAS LAS SUBCATEGORIAS
if (isset($_POST["productos"])) {

    $estilovida_productosModel = new Estilovida_productosModel();
    $estilovida_productos = $estilovida_productosModel->ListarEstilovida_productosByEstilovidaID(new Estilovida($_POST["productos"], null, null, null, null));
    $productosModel = new ProductosModel();
    $productos = array();
    foreach ($estilovida_productos as $estilovida_producto) {
        $productos[] = $productosModel->ObetenerProductosByID($estilovida_producto->getProductos_id());
    }
    $html = '<div>';
    if (count($productos) > 0) {
        $html .= '<div id="productos" name="productos"> <br /> '
                . '<label>Seleccione uno o mas productos:</label> <br />';
        foreach ($productos as $producto) {
            $html .= '<input type="checkbox" name="producto[]" '
                    . 'value="' . $producto->getId() . ' "/> '
                    . $producto->getDescripcion() . '<br />';
        }
        $html .= "</div>";
    }

    $dias = ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'];

    $html .= '<div id="diasYhorarios" name="diasYhorarios" > <br />'
            . '<label>Seleccione días y horarios de apertura:</label> '
            . '<div id="horariosAgregados">'
            . '</div>'
            . '<div id="desde">'
            . '<select class="form-control" id="diaDesde" name="diaDesde"> '
            . '<option selected="true" disabled="disabled">Desde día...</option>';
    foreach ($dias as $dia) {
        $html .= '<option value="' . $dia . '">' . $dia . '</option>';
    }
    $html .= '</select>'
            . '<select class="form-control" id="diaHasta" name="diaHasta">  '
            . '<option selected="true" disabled="disabled">Hasta día...</option>';
    foreach ($dias as $dia) {
        $html .= '<option value="' . $dia . '">' . $dia . '</option>';
    }
    $html .= '</select>'
            . '</div>'
            . '<div id="hasta">'
            . '<select class="form-control" id="horaDesde" name="horaDesde"> '
            . '<option selected="true" disabled="disabled">Desde hora...</option>';
    for ($i = 1; $i <= 24; $i++) {
        $html .= '<option value="' . $i . '">' . $i . 'Hs. </option>';
    }
    $html .= '</select>';

    $html .= '<select class="form-control" id="horaHasta" name="horaHasta">  '
            . '<option selected="true" disabled="disabled">Hasta hora...</option>';
    for ($i = 1; $i <= 24; $i++) {
        $html .= '<option value="' . $i . '">' . $i . 'Hs. </option>';
    }
    $html .= '</select>'
            . '</div>'
            . '<div>'
            . '<input class="form-control" type="button" id="addHorario" name="addHorario" value="Agregar horario." onClick="agregarHorario()"/>'
            . '</div>'
            . '</div>'
            . '</div>';
    echo $html;
}
//-----------------------------------------------------------------
?>