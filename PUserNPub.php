<?php
require_once 'entidades/usuarioWeb.php';
require_once 'entidades/tipoPub.php';

require_once 'models/TipoPubModel.php';

session_start();
/* Si no hay una sesión creada, redireccionar al login. */
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
} else {
    session_destroy();
    header('Location: /LoginUsuarioWeb.php');
    exit();
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
        </header>
        <div class="container">
            <br/>
            <h3>Crea tu publicación</h3>
            <br/>
            <div class="col-xs-12 col-sm-8 col-md-6 col-lg-6">
                <div class="center-block">
                    <form id="altaPublicacion" name="altaPublicacion" enctype="multipart/form-data" class="form-group" action="publicaciones.php" method="POST">
                        <div >
                            <div class=" row">
                                <label>Selecciona la categoria de tu publicación:</label>
                            <div>
                                <select class="form-control" id="tipoPub" name="tipoPub">
                                    <?php
                                    $tipoPubModel = new TipoPubModel();
                                    $tiposPub = $tipoPubModel->listar();
                                    echo '<option selected="true" disabled="disabled">Seleccione una categoria</option>';
                                    foreach ($tiposPub as $tipoPub) {
                                        echo '<option value="' . $tipoPub->getId() . '">' . $tipoPub->getDescripcion() . '</option>';
                                    }
                                    ?>
                                </select>
                                </div>
                            </div>
                            
                            <!--datos basicos publicación--------------------------------------->
                            <div class="row">
                                
                                <div >
                                    <label>Nombre de la Publicación:</label>
                                    <div >
                                        <input class="form-control" type="text" id="titulo" name="titulo" placeholder="Mi publicación"/>
                                    </div>
                                    <label>Teléfono:</label>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-2 col-md-2 col-lg-2">
                                            <input class="form-control" type="tel" name="codarea" placeholder="Area"/>
                                        </div>
                                        <div class="col-xs-12 col-sm-10 col-md-10 col-lg-10">
                                            <input class="form-control" type="tel" name="telefono" placeholder="Numero"/>
                                        </div>
                                    </div>
                                    <label>Email:</label>
                                    <div >
                                        <input class="form-control" type="text" name="email" placeholder="nombre@dominio.com"/>
                                    </div>
                                    <label>Sitio Web:</label>
                                    <div >
                                        <input class="form-control" type="text" name="web" placeholder="www.tusitio.com"/>
                                    </div>
                                </div>

                                <div >
                                    <!--Google Maps y Autocomplete--------------------------------------->
                                    <label>Dirección:</label>
                                    <div >
                                        <input class="form-control" type="text" name="direccion" placeholder="Calle y altura, localidad" id="search" disabled="true"/>
                                    </div>
                                    <br />
                                    <div id="map" >
                                    </div>
                                </div>
                            </div >
                            <div>
                                <!--------------RECUPERO DE INFORMACION DE DIRECCION-------------------------------------->
                                <input type="text" id="lat" name="lat" hidden="true">
                                <input type="text" id="long" name="long" hidden="true">
                                <table id="address" hidden="true">
                                    <tr>
                                        <td class="label">Street address</td>
                                        <td class="slimField"><input class="field" id="street_number" name="street_number" disabled="true"></input></td>
                                        <td class="wideField" colspan="2"><input class="field" id="route" name="route" disabled="true"></input></td>
                                    </tr>
                                    <tr>
                                        <td class="label">City</td>
                                        <td class="wideField" colspan="3"><input class="field" id="locality" name="locality"  disabled="true"></input></td>
                                    </tr>
                                    <tr>
                                        <td class="label">State</td>
                                        <td class="slimField"><input class="field" id="administrative_area_level_1" name="administrative_area_level_1" disabled="true"></input></td>
                                        <td class="label">Zip code</td>
                                        <td class="wideField"><input class="field" id="postal_code" name="postal_code" disabled="true"></input></td>
                                    </tr>
                                    <tr>
                                        <td class="label">Country</td>
                                        <td class="wideField" colspan="3"><input class="field" id="country" name="country" disabled="true"></input></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="row">
                                <div >
                                    <br />
                                    <label>Sube imagenes de tu publicación:</label>
                                    <br />
                                    <!-- Preview1 -->
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" id="image-preview" style="margin: 5px;">
                                        <label for="image-upload" id="image-label">Click aquí</label>
                                        <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                                        <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                                        <input type="file" name="imagen1" id="image-upload" />
                                    </div>
                                    <!-- Preview2 -->
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" id="image-preview2" style="margin: 5px;">
                                        <label for="image-upload2" id="image-label2">Click aquí</label>
                                        <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                                        <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                                        <input type="file" name="imagen2" id="image-upload2" />
                                    </div>
                                    <!-- Preview3 -->
                                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" id="image-preview3" style="margin: 5px;">
                                        <!-- Preview -->
                                        <label for="image-upload3" id="image-label3">Click aquí</label>
                                        <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
                                        <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                                        <!-- El nombre del elemento de entrada determina el nombre en el array $_FILES -->
                                        <input type="file" name="imagen3" id="image-upload3" />
                                    </div>
                                </div>
                            </div>
                            <div class="row" >

                                <br />
                                <label>Subi tu video de youtube:</label>

                                <input class="form-control" id="urlYouTube" name="video" type="text" placeholder="Copia la dirección de tu video y clickea fuera del cuadro."/>
                                <br />
                                <div id="player"></div>
                            </div>
                        </div>


                        <div class="main row " >

                            <br />

                            
                            <div id="contenido" name="contenido">
                            </div>
                        </div>
                        <br />
                        <br />
                        <input class="form-control" type="submit" name="altaPub" value="Publicar" />
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
        <script type="text/javascript" src="js/PUserNPub.js"></script><!-- Contenido ajax y validaciones-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" type="text/javascript"></script><!-- Validar Campos -->

    </body>
</html>
