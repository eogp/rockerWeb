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
                <div class="col-lg-9">
                    <p> 
                    <h1>ROCKEP APP</h1>
                    La guia del musico
                    </p>
                </div>
        </header>
        <br>
        <br>
        <div class="container center-block">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-8 " >
                    <h3 >Completa tus datos.</h3>
                </div>
            </div>
            <div class="row">

                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-8 "> 
                    <form  id="register" name="formulario" action="controlador.php" method="post" >

                        <div class="row">
                            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-8 form-group">

                                <br/>
                                <label>Email:</label>

                                <div >
                                    <input id="email" class="form-control " type="email" name="email" placeholder="tu@email.com" >
                                </div>

                                <label>Repite email:</label>

                                <div >
                                    <input id="retryEmail" class="form-control " type="email" name="retryEmail" placeholder="tu@email.com">
                                </div>

                                <label>Contraseña:</label>

                                <div >
                                    <input id="pass" class="form-control" type="password" name="pass" placeholder="entre 8 y 20 caracteres...">
                                </div>

                                <label>Repite contraseña:</label>

                                <div >
                                    <input id="retryPass" class="form-control " type="password" name="retryPass" placeholder="entre 8 y 20 caracteres...">

                                </div>
                                <br>
                                <div class="g-recaptcha" data-sitekey="6Ld8qkkUAAAAAFy9Ykq2DUIGYRGKqHR8Rb4C_-_D"></div>

                            </div>
                        </div>
                        <div class="row checkbox-row text-center">
                            <div class="col-xs-12 col-sm-10 col-md-8 col-lg-8">
                                <div class="checkbox-inline" >    
                                    <input class="checkbox-inline  " id="condiciones"  type="checkbox" name="condiciones" ><label >Acepto los terminos y condiciones</label>
                                </div>
                                <div>   
                                    <input id="sumate" class="btn btn-default btn-sm btn-block" type="submit" value="Sumate" name="sumate" >
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>

        <script src="js/jquery-2.1.1.js" type="text/javascript" ></script><!-- JQuery -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js" type="text/javascript"></script><!-- Validar Campos -->
        <script src="js/validarJQuery.js" type="text/javascript" ></script><!-- Validar Campos -->
        <script  src="js/bootstrap.min.js" type="text/javascript"></script><!-- Bootstrap -->

    </body>
</html>
