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
        <link rel="stylesheet" href="css/RegistroUsuario.css" type="text/css" /><!-- Estilos -->
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
<!--                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                        <br>
                        <br>

                        <a href="https://www.rockerapp.com" style="color: black; font-size: 16px;"> 

                            Volver al inicio >
                        </a>
                    </div>-->
                </div>
            </div>
        </header>
        <br>
        <br>
        <div class="container center-block">

            <div class="col-md-3 col-lg-3 "></div>
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 ">
                <form  id="register" name="formulario" action="controlador.php" method="post" >

                    <div class="row  margin-gral">
                        <div class="text-center width-btn-blue">
                            <h3 >Bienvenido a Rocker App!</h3>
                            Registrate en 1 minuto y publica gratis.
                        </div>
                        <br>
                       

                        <label class="margin-left2 margin-gral">Email:</label>

                        <div >
                            <input id="email" class="form-control text-center width-btn-blue input-roundable" type="email" name="email" placeholder="tu@email.com" >
                        </div>

                        <label class="margin-left2 margin-gral">Repite email:</label>

                        <div >
                            <input id="retryEmail" class="form-control text-center width-btn-blue input-roundable" type="email" name="retryEmail" placeholder="tu@email.com">
                        </div>

                        <label class="margin-left2 margin-gral">Contraseña:</label>

                        <div >
                            <input id="pass" class="form-control text-center width-btn-blue input-roundable" type="password" name="pass" placeholder="entre 8 y 20 caracteres...">
                        </div>

                        <label class="margin-left2 margin-gral">Repite contraseña:</label>

                        <div >
                            <input id="retryPass" class="form-control text-center width-btn-blue input-roundable" type="password" name="retryPass" placeholder="entre 8 y 20 caracteres...">

                        </div>
                        <br>
                        <div class="g-recaptcha" data-sitekey="6Ld8qkkUAAAAAFy9Ykq2DUIGYRGKqHR8Rb4C_-_D"></div>


                    </div>
                    <div class="row margin-gral width-btn-blue ">

                        <div class="margon-cero ">
                            <div class="checkbox-inline" >    
                                <input class="checkbox-inline" id="condiciones"  type="checkbox" name="condiciones" ><label >Acepto los terminos y condiciones</label>
                            </div>
                            <div>   
                                <input id="sumate" class="btn-blue " type="submit" value="Sumate" name="sumate" >
                            </div>
                        </div>
                    </div>
                </form>
            </div>

        </div>



        <script src="js/jquery-2.1.1.js" type="text/javascript" ></script><!-- JQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" type="text/javascript"></script><!-- Validar Campos -->
        <script src="js/validarJQuery.js" type="text/javascript" ></script><!-- Validar Campos -->
        <script  src="js/bootstrap.min.js" type="text/javascript"></script><!-- Bootstrap -->

    </body>
</html>
