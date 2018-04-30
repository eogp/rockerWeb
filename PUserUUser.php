<?php
require_once 'entidades/usuarioWeb.php';
require_once 'entidades/telefono.php';
require_once 'entidades/usuarioweb_telefono.php';
require_once 'entidades/direccion.php';
require_once 'entidades/usuarioweb_direccion.php';
require_once 'entidades/provincia.php';
require_once 'entidades/pais.php';

require_once 'models/TelefonoModel.php';
require_once 'models/Usuarioweb_telefonoModel.php';
require_once 'models/DireccionModel.php';
require_once 'models/Usuarioweb_direccionModel.php';
require_once 'models/ProvinciaModel.php';
require_once 'models/PaisModel.php';


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

$usuarioweb_direccionModel = new Usuarioweb_direccionModel();
$usuarioweb_direccion = $usuarioweb_direccionModel->ObtenerUsuarioweb_direccionByUserID($usuario->getId());
if ($usuarioweb_direccion !== null) {
    $direccionModel = new DireccionModel();
    $direccion = $direccionModel->ObtenerDireccionById($usuarioweb_direccion->getDireccion_id());
}

$usuarioewb_telefonoModel = new Usuarioweb_telefonoModel();
$usuarioweb_telefono = $usuarioewb_telefonoModel->ObtenerUsuarioweb_telefonoByUserID($usuario->getId());
if ($usuarioweb_telefono !== null) {
    $telefonoModel = new TelefonoModel();
    $telefono = $telefonoModel->ObtenerTelefonoById($usuarioweb_telefono->getTelefono_id());
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
            </div>
        </header>
        <div class="container">       
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                    <br/>

                    <h3>Tus datos</h3>

                    <br/>
                    Recorda tener tus datos actualizados para no  perderte ninguna novedad y/o promoción.
                    <br/>
                    <br/>
                    <form id="updateUser" class="form-group" action="controlador.php" method="POST">
                        <label>Nombre:</label>
                        <div>
                            <input name="nombre" class="form-control " type="text" placeholder="Ingrese su nombre." value="<?php
                            if (null !== $usuario->getPnombre()) {
                                echo $usuario->getPnombre();
                            }
                            ?>"/>
                        </div>
                        <label>Apellido:</label>
                        <div>
                            <input name="apellido" class="form-control " type="text" placeholder="Ingrese su apellido." value="<?php
                            if (null !== $usuario->getPapellido()) {
                                echo $usuario->getPapellido();
                            }
                            ?>"/>
                        </div>
                        <label>Calle:</label>
                        <div>
                            <input name="calle" class="form-control" type="text" placeholder="Ingrese su calle." value="<?php
                            if (isset($direccion)) {
                                echo $direccion->getCalle();
                            }
                            ?>"/>
                        </div>
                        <label>Altura:</label>
                        <div>
                            <input id="altura" name="altura" class="form-control" type="text" placeholder="Ingrese su altura." value="<?php
                            if (isset($direccion)) {
                                echo $direccion->getAltura();
                            }
                            ?>"/>
                        </div>
                        <label>Ciudad:</label>
                        <div>
                            <input name="ciudad" class="form-control" type="text" placeholder="Ingrese su ciudad." value="<?php
                            if (isset($direccion)) {
                                echo $direccion->getCiudad();
                            }
                            ?>"/>
                        </div>
                        <label>Provincia:</label>
                        <div>
                            <select class="form-control" id="provincia" name="provincia">
                                <?php
                                $provinciaModel = new ProvinciaModel();
                                $provincias = $provinciaModel->listar();
                                foreach ($provincias as $provincia) {
                                    $select = "";
                                    if (isset($direccion) && $direccion->getProvincia() == $provincia->getNombre()) {
                                        $select = 'selected';
                                    }
                                    echo '<option value="' . $provincia->getNombre() . '" ' . $select . ' >' . $provincia->getNombre() . '</option>';
                                }
                                ?>
                            </select>

                        </div>
                        <label>Pais:</label>
                        <div>
                            <select class="form-control" id="pais" name="pais">
                                <?php
                                /*
                                  $paisModel = new PaisModel();
                                  $paises = $paisModel->listar();
                                  foreach ($paises as $paisAux) {
                                  $select = "";
                                  if (isset($direccion) && $direccion->getPais() == $paisAux->getNombre()) {
                                  $select = 'selected';
                                  }
                                  echo '<option value="' . $paisAux->getNombre() . '"' . $select . '>' . $paisAux->getNombre() . '</option>';
                                  } */
                                echo '<option value="Argentina" selected>Argentina</option>';
                                ?>
                            </select>
                        </div>
                        <label>Teléfono:</label>
                        <div class="form-horizontal">
                            <div >
                                <input id="codarea" name="codarea" class="col-xs-3 col-sm-3 col-md-3 col-lg-3" type="tel" placeholder="Cód. area." value="<?php
                                if (isset($telefono)) {
                                    echo $telefono->getCodarea();
                                }
                                ?>"/>
                            </div>
                            <div >
                                <input id="telefono" name="telefono" class="col-xs-4 col-sm-4 col-md-4 col-lg-4"  type="tel" placeholder="Teléfono" value="<?php
                                if (isset($telefono)) {
                                    echo $telefono->getNumero();
                                }
                                ?>"/>
                            </div>


                        </div>
                        <div class="checkbox-inline"  > 
                            <input  type="checkbox" name="celular"<?php
                            if (isset($telefono)) {
                                if ('1' == $telefono->getCelular()) {
                                    echo 'checked';
                                }
                            }
                            ?>><label>¿Este teléfono es un celular?</label>
                        </div>
                        <div>
                            <br/>
                            <input type="submit" class="btn btn-default btn-sm btn-block" value="Guardar" name="actualizar"/>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                    <br/>
                    <h3>Acceso</h3>
                    <br/>
                    Aqui podes modificar tus datos de acceso.

                    <form class="form-group" name="actualizarAcceso" id="updateAcceso" action="controlador.php" method="POST">

                        <br/>
                        <label>Ingresa tu email:</label>
                        <div>
                            <input class="form-control" id="email" name="email" type="text" placeholder="tu@email.com" value="<?php echo $usuario->getEmail(); ?>"/>

                        </div>
                        <label>Repite tu email:</label>
                        <div>
                            <input class="form-control" id="retryEmail" name="retryEmail" type="text" placeholder="tu@email.com" value="<?php echo $usuario->getEmail(); ?>"/>

                        </div>
                        <label>Ingresa tu nueva contraseña:</label>
                        <div>
                            <input class="form-control" id="pass"name="pass" type="password" placeholder="Entre 8 y 20 carateres" />

                        </div>
                        <label>Repite tu nueva contraseña:</label>
                        <div>
                            <input class="form-control" id="retryPass" name="retryPass" type="password" placeholder="Entre 8 y 20 carateres" />
                            <br/>
                        </div>
                        <input type="submit" class="btn btn-default btn-sm btn-block" value="Actualizar" name="actualizarAcceso"/>

                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" type="text/javascript"></script><!-- Validar Campos -->
        <script src="js/validarJQuery.js" type="text/javascript" ></script><!-- Validar Campos -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
    </body>
</html>