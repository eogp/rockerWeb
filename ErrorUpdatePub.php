<?php
require_once 'entidades/usuarioWeb.php';

/* Empezamos la sesión */
$usuario;
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
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                    <br/>
                    <br/>
                    <br/>
                    <div class="panel panel-default"> 
                        <div class="panel-heading"> 
                            Error! 
                        </div> 
                        <div class="panel-body">
                            <p>  Ocurrio un error al actualizar los datos de la publicacion. <br>Por favor verifique que los datos ingresados sean correctos.</p>
                        </div> 
                    </div>                                
                    <a href="PUserUPub.php" class="btn btn-default form-control">Volver</a>  


                </div>
            </section>
        </div>
        <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
    </body>
</html>
