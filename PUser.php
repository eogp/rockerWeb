<?php
require_once 'entidades/usuarioWeb.php';
require_once 'entidades/telefono.php';
require_once 'entidades/direccion.php';
require_once 'entidades/pagos.php';
require_once 'entidades/pais.php';
require_once 'entidades/publicacion.php';

require_once 'models/DireccionModel.php';
require_once 'models/PagosModel.php';
require_once 'models/PaisModel.php';
require_once 'models/TelefonoModel.php';
require_once 'models/PublicacionModel.php';
/* Empezamos la sesión */
$usuario;
$telefono = null;
$direccion = null;
$pais = null;
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

function vencimiento(Pagos $pagos) {
    $retorno;
    $hoy = new DateTime(time());
    //$hoy=new DateTime("2011-01-01T15:03:01");
    $fechaPago = new DateTime($pagos->getFecha_acreditacion());
    switch ($pagos->getCategoria()) {
        case "Mensual":
            $fechaPago->add(new DateInterval('P1M'));
            $retorno = 'Valido hasta el ' . $fechaPago->format('d-m-Y H:i') . ' a las ' . $fechaPago->format('H:i') . ' hs.';

            break;
        case "Anual":
            $fechaPago->add(new DateInterval('P12M'));
            $retorno = 'Valido hasta el ' . $fechaPago->format('d-m-Y') . ' a las ' . $fechaPago->format('H:i') . ' hs.';

            break;
        case "deporvida":
            $retorno = "Tu publicación estara activa de por vida.";

            break;
        default:
            break;
    }


    $resto = $fechaPago->diff($hoy);
    if ($resto->invert == 1) {
        $retorno .= '</br><b>Debe realizar un nuevo pago.</b>';
    }

    return $retorno;
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
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>ROCKER APP . La guía del músico</title>

        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" /><!-- Bootstrap -->
        <link rel="stylesheet" href="css/sombra.css" type="text/css" /><!-- Sombra -->
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
                <div class="col-lg-9 col-md-9">
                    <p> 
                    <h1>ROCKEP APP</h1>
                    La guia del musico
                    </p>
                </div>
                <br>
                <div class="col-lg-3 col-md-3"><label > Hola    <?php echo " " . $usuario->getPnombre() . " :)"; ?>
                        <a href="LogOut.php" class="btn btn-default">Salir</a> </label> 
                </div>
        </header>
        <div class="container">       
            <section class="main row">

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <br/>
                    <p>
                    <h3>Tus datos</h3>
                    <br/>
                    Recorda tener tus datos actualizados para no  perderte ninguna novedad y/o promoción.

                    <div> 
                        <br>
                        <a href="PUserUUser.php">
                            <img src="images/resource/actualizarDatos.jpg" alt="Actualiza tus datos."  > 
                        </a>
                    </div>
                    </p>

                    <p>
                        <br/>
                    <h3>Tus puntos</h3>
                    <br/>
                    Estos son los puntos que tenes cargados en rocker App.
                    Elegi el que quieras para actualizar información o acceder a los reportes.

                    <div> 
                        <br>
                        <a href="PUserNPub.php">
                            <img src="images/resource/nuevaPublicacion.jpg" alt="Crea una nueva puclicación"  > 
                        </a>
                    </div>
                    <br/>
                    <div>
                        <?php
                        $publicacionModel = new PublicacionModel();
                        $publicaciones = $publicacionModel->obetenerPublicacionesByUser($usuario->getId());
                        $pagosModel = new PagosModel();
                        if (count($publicaciones) > 0) {
                            foreach ($publicaciones as $publicacion) {
                                $pagos = $pagosModel->obetenerPagosByPubId($publicacion->getId());
                                $html = '<div >'
                                        . '<form class="form-group" action="PUserUPub.php" method="POST">'
                                        . '<div class="panel panel-default">'
                                        . '<div class="panel-heading">'
                                        . $publicacion->getNombre()
                                        . '</div> '
                                        . '<div class="panel-body">'
                                        . '<div id="estadoPub"> '
                                        . 'Estado: ';
                                
                                if ($publicacion->getActiva()) {
                                    $html .= 'Activa.';
                                } else {
                                    $html .= 'Inactiva.';
                                }
                                $html .= '</div> '
                                        . '</br> '
                                        . '<div id="estadoPago" ';

                                if (count($pagos) > 0) {
                                    //rejected=rechazado
                                    //pending=pendiente
                                    //approved=aprovado
                                    //print_r(end($pagos));
                                    $pago = end($pagos);
                                    
                                    
                

                                    if ($pago->getActivo() == 1) {
                                        $html .= ' class="alert alert-success" >';
                                    } else {
                                        $html .= ' class="alert alert-danger" >';
                                    }
                                    $fecha = new DateTime($pago->getFecha());
                                    $html .= 'Pago: Generado el ' . $fecha->format('d-m-Y H:i') . ' a las ' . $fecha->format('H:i') . ' hs. </br>';
                                    if ($pago->getEstado() == '') {
                                        $html .= 'Estado: En proceso.';
                                    }
                                    if ($pago->getEstado() == 'approved') {
                                        $fechaPago = new DateTime($pago->getFecha_acreditacion());
                                        $html .= 'Estado: Acreditado el ' . $fechaPago->format('d-m-Y H:i') . ' a las ' . $fechaPago->format('H:i') . ' hs. </br>'
                                                . vencimiento($pago);
                                    }
                                    if ($pago->getEstado() == 'pending') {
                                        $html .= 'Estado: Pendiente de acreditación.';
                                    }
                                    if ($pago->getEstado() == 'rejected') {

                                        $html .= 'Estado: Rechazado. Por favor intente nuevamente';
                                    }
                                } else {
                                    $html .= ' class="alert alert-danger" >';
                                    $html .= 'Pago: No se ha generado el pago. </br> '
                                            . 'Recuerde que debe pagar concretar el alta de la publicación.';
                                }



                                $html .= '</div> '
                                        . '<div class="btn-group ">'
                                        . '<input type="submit" name="actualizarPub" class="btn btn-default " value="Editar">'
                                        . '<input type="button" id="pausarReanudarPub" class="btn btn-default" ';
                                if ($publicacion->getActiva() == 1) {
                                    $html .= 'value="Pausar" onclick=pausarReaudarPub("#publicacion")';
                                } else {
                                    $html .= 'value="Reanudar" onclick=pausarReaudarPub("#publicacion")';
                                }
                                if (count($pagos) == 0) {
                                    $html .= " disabled";
                                } else {
                                    if ($pago->getActivo() == 0) {
                                        $html .= " disabled";
                                    }
                                }
                                $html .= '>'
                                        . '<input type="button" id="pagarPub" class="btn btn-default" value="Pagar" onclick=pagarPublicacion()';
                                if ($pago->getCategoria() == "deporvida") {
                                    $html .= " disabled";
                                }

                                $html .= '>'
                                        . '<input name="publicacion" id="publicacion" type="hidden" value="' . $publicacion->getId() . '" />'
                                        . '</div>'
                                        . '</div>'
                                        . '</div>'
                                        . '</form>'
                                        . '<form id="pagoForm" action="publicaciones.php" method="POST">'
                                        . '<input name="publicacionPago" id="publicacionPago" type="hidden" value="' . $publicacion->getId() . '" />'
                                        . '</form>'
                                        . '</div>';
                                echo $html;
                            }
                        }
                        ?>


                    </div>
                    </p>

                </div>
            </section>
        </div>

        <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
        <script type="text/javascript" src="js/Puser.js"></script><!-- PUser -->

    </body>

</html>
