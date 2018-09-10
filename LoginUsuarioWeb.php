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
        <link rel="stylesheet" href="css/LoginUsuarioWeb.css" type="text/css" /><!-- Estilos -->
        <script src='https://www.google.com/recaptcha/api.js'></script><!-- recapcha-->
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
                <div class="row">
                    <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                        <p> 
                        <h1>ROCKEP APP</h1>
                        La guia del musico
                        </p>
                    </div>
                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <br>
                        <br>

                        <a href="https://www.rockerapp.com" style="color: black; font-size: 16px;"> 

                            Volver al inicio >
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <div class="container">       
            <div class="row">
                <div class="col-md-3 col-lg-3 "></div>
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 ">
                    <br/>
                    <br/>
                    <br/>
                    <form  action="controlador.php" method="POST">
                        <div class="form-group margin-gral" >
                            <div class="row text-center">
                                <h3 class="width-btn-blue">Bienvenido a Rocker!</h3>
                                <br>
                            </div>
                            <div class="row ">
                                <label class="text-center">e-mail<input class="form-control text-center width-btn-blue input-roundable" type="text" name="email"></label>
                            </div>
                            <div class="row ">
                                <label class="text-center">contraseña<input class="form-control  text-center width-btn-blue input-roundable" type="password" name="pass"></label>
                            </div>
                            <br>
                            <div class="row ">
                                <div class="g-recaptcha " data-sitekey="6Ld8qkkUAAAAAFy9Ykq2DUIGYRGKqHR8Rb4C_-_D"></div>
                                <br>
                            </div>
                            <div class="row">
                                <div>
                                    <input class="btn-blue" type="submit" name="login" value="Ingresar">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="txt-gray" >
                                    <a href="PassRecovery.php" >Olvido su contraseña?</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
      

        <script type="text/javascript" src="js/jquery-2.1.1.js"></script><!-- Jquery -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script><!-- Bootstrap -->
    </body>
</html>
