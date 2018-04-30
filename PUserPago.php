<?php
require_once 'entidades/usuarioWeb.php';
require_once 'entidades/pagos.php';

require_once 'models/PagosModel.php';

$usuario;
$pubId;
$pagos;


/* Empezamos la sesión */
session_start();
/* Si no hay una sesión creada, redireccionar al login. */
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    if (isset($_SESSION['pubId'])) {
        $pubId = $_SESSION['pubId'];
        $fechaYhora = date("Y-m-d H:i:s");
        $pagosModel = new PagosModel();
        $pagos = new Pagos(null, $fechaYhora, null, null, 0, null, null, $pubId, null);
        $pagos->setId($pagosModel->insertar($pagos));
    } else {
        header('Location: /ErrorWebPago.php');
        exit();
    }
} else {
    session_destroy();
    header('Location: /LoginUsuarioWeb.php');
    exit();
}

//MERCADOPAGO 
//librerias
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/mercadopago/dx-php/src/MercadoPago/Sdk.php';
//credenciales
MercadoPago\SDK::setClientId("3066631672394764");
MercadoPago\SDK::setClientSecret("ZQd8G7w8rPa2gTWj1bRYNCDi10zu7j6G");

//TEST
//MercadoPago\SDK::setClientId("691777233569033");
//MercadoPago\SDK::setClientSecret("qpsv5Sf9yj7Nic6yZKbIxJLO3RoDMEt3");
//print_r("anda2");
//preferencia mensual
function preferenciaMensual($pagoId, $userEmail) {
# Create a preference object
    $preference = new MercadoPago\Preference();
# Create an item object
    $item = new MercadoPago\Item();
    $item->id = $pagoId;
    $item->title = "Publicación Mensual RockerApp";
    $item->quantity = 1;
    $item->currency_id = "ARS";
    $item->unit_price = 100;

# Create a payer object
    $payer = new MercadoPago\Payer();
    $payer->email = $userEmail;
# Setting preference properties
    $preference->items = array($item);
    $preference->payer = $payer;
# Setting back_urls properties
    $preference->back_urls = array(
        "success" => "https://www.rockerapp.com/PUserPagoExitoso.php",
        "failure" => "https://www.rockerapp.com/PUserPagoFallo.php",
        "pending" => "https://www.rockerapp.com/PUserPagoProceso.php"
    );
    $preference->auto_return = "approved";
    $preference->external_reference = "Mensual";
# Save and posting preference
    $preference->save();
    return $preference->init_point;
}

//preferencia anual
function preferenciaAnual($pagoId, $userEmail) {
# Create a preference object
    $preference = new MercadoPago\Preference();
# Create an item object
    $item = new MercadoPago\Item();
    $item->id = $pagoId;
    $item->title = "Publicación Anual RockerApp";
    $item->quantity = 1;
    $item->currency_id = "ARS";
    $item->unit_price = 600;

# Create a payer object
    $payer = new MercadoPago\Payer();
    $payer->email = $userEmail;
# Setting preference properties
    $preference->items = array($item);
    $preference->payer = $payer;
# Setting back_urls properties
    $preference->back_urls = array(
        "success" => "https://www.rockerapp.com/PUserPagoExitoso.php",
        "failure" => "https://www.rockerapp.com/PUserPagoFallo.php",
        "pending" => "https://www.rockerapp.com/PUserPagoProceso.php"
    );
    $preference->auto_return = "approved";
    $preference->external_reference = "Anual";

# Save and posting preference
    $preference->save();
    return $preference->init_point;
}

//preferencia de por vida
function preferenciaDePorVida($pagoId, $userEmail) {
# Create a preference object
    $preference = new MercadoPago\Preference();
# Create an item object
    $item = new MercadoPago\Item();
    $item->id = $pagoId;
    $item->title = "Publicación de por vida RockerApp";
    $item->quantity = 1;
    $item->currency_id = "ARS";
    $item->unit_price = 1200;

# Create a payer object
    $payer = new MercadoPago\Payer();
    $payer->email = $userEmail;
# Setting preference properties
    $preference->items = array($item);
    $preference->payer = $payer;
# Setting back_urls properties
    $preference->back_urls = array(
        "success" => "https://www.rockerapp.com/PUserPagoExitoso.php",
        "failure" => "https://www.rockerapp.com/PUserPagoFallo.php",
        "pending" => "https://www.rockerapp.com/PUserPagoProceso.php"
    );
    $preference->auto_return = "approved";
    $preference->external_reference = "deporvida";

# Save and posting preference
    $preference->save();
    return $preference->init_point;
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
    <body >
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
            <br/>
            <h3>Pago</h3>

            <section class="main row">
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <h4>
                            Elige el tipo de publicación.
                        </h4>
                        <br/>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <div  class="panel panel-default">
                            <div class="panel-heading">Publicación mensual.</div>
                            <div class="panel-body">
                                <p>
                                    <br/>
                                    <br/>
                                    1 Punto en el mapa Rocker.
                                    <br/>
                                    Duración de la publicación 15 días.
                                    <br/>
                                    <br/>
                                    <br/>
                                    Pago por única vez de $100,-
                                    <br/>
                                    ó 12 cuotas de $12,50 con MercadoPago
                                    <br/>
                                    <br/>
                                    <br/>

                                </p>


                            </div>
                            <div class="panel-footer text-center">
                                <input type="radio" id="1" name="pago" onchange="radioChecked('mensual', 'Mensual', '100')" >
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <div  class="panel panel-default">
                            <div class="panel-heading">Publicación anual.</div>
                            <div class="panel-body">
                                <p>
                                    <br/>
                                    <br/>
                                    1 Punto en el mapa Rocker.
                                    <br/>
                                    Duración de la publicación 1 año.
                                    <br/>
                                    Reportes mensuales
                                    <br/>
                                    <br/>
                                    Pago por única vez de $600,-
                                    <br/>
                                    ó 12 cuotas de $50 con MercadoPago
                                    <br/>
                                    <br/>
                                    <br/>

                                </p>

                            </div>
                            <div class="panel-footer text-center">
                                <input type="radio" name="pago" id="2" checked onchange="radioChecked('anual', 'Anual', '600')">
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <div  class="panel panel-default">

                            <div class="panel-heading">Publicación de por vida.</div>
                            <div class="panel-body">
                                <p>
                                    <br/>
                                    <br/>
                                    1 Punto en el mapa Rocker.
                                    <br/>
                                    Duración de la publicación por siempre.
                                    <br/>
                                    Reportes mensuales
                                    <br/>
                                    <br/>
                                    Pago por única vez de $1200,-
                                    <br/>
                                    ó 12 cuotas de $100 con MercadoPago
                                    <br/>
                                    <br/>
                                </p>

                            </div>
                            <div class="panel-footer text-center">
                                <input type="radio" name="pago" id="3"  onchange="radioChecked('deporvida', 'De por vida', '1200')">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    </div>
                    <div  class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                        <div class="text-center" id="pagoSeleccionado">

                            Elegiste la publicacion Anual. 
                            <br/>
                            Precio $600,-

                        </div>
                        <div class="text-center">
                            <div hidden="" id="mensual">
                                <a href="<?php echo preferenciaMensual($pagos->getId(), $usuario->getEmail()); ?>" name="MP-Checkout" class="lightblue-L-Ov-ArAll" mp-mode="modal" onreturn="onreturn()">Pagar</a>
                            </div>
                            <div  id="anual">
                                <a href="<?php echo preferenciaAnual($pagos->getId(), $usuario->getEmail()); ?>" name="MP-Checkout" class="lightblue-L-Ov-ArAll" mp-mode="modal" onreturn="onreturn()">Pagar</a>
                            </div>
                            <div hidden="" id="deporvida">
                                <a href="<?php echo preferenciaDePorVida($pagos->getId(), $usuario->getEmail()); ?>" name="MP-Checkout" class="lightblue-L-Ov-ArAll" mp-mode="modal" onreturn="onreturn()">Pagar</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    </div>
                </div>
            </section>
        </div>
        <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
        <script type="text/javascript" src="js/PUserPago.js"></script><!-- MercadoPago -->
        <script type="text/javascript"><!-- MercadoPago -->
            (function () {
                function $MPC_load() {
                    window.$MPC_loaded !== true && (function () {
                        var s = document.createElement("script");
                        s.type = "text/javascript";
                        s.async = true;
                        s.src = document.location.protocol + "//secure.mlstatic.com/mptools/render.js";
                        var x = document.getElementsByTagName('script')[0];
                        x.parentNode.insertBefore(s, x);
                        window.$MPC_loaded = true;
                    })();
                }
                window.$MPC_loaded !== true ? (window.attachEvent ? window.attachEvent('onload', $MPC_load) : window.addEventListener('load', $MPC_load, false)) : null;
            })();
        </script>
    </body>
</html>