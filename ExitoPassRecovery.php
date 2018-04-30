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
                <div class="col-lg-9">
                    <p> 
                    <h1>ROCKEP APP</h1>
                    La guia del musico
                    </p>
                </div>

            </div>
        </header>

        <div class="container">       
            <div class="row">

                <div class="col-xs-12 col-sm-10 col-md-4 col-lg-4">
                    <br/>
                    <br/>
                    <br/>
                    <form  action="controlador.php" method="POST">
                        <div class="form-group">
                            <label>Recibiras un correo con tu nueva contraseña.</label>

                            <a href="LoginUsuarioWeb.php" class="btn btn-default btn-sm btn-block">Login</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>


        <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
    </body
