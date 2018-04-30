
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // put your code here
        require_once 'models/UsuarioWebModel.php';
        require_once 'entidades/usuarioWeb.php';
        try {
            $usuarioWebModel=new UsuarioWebModel();
            $usuarioWeb=$usuarioWebModel->ObtenerUsuarioWebByEmail("caca.com");
            if(isset($usuarioWeb)){
            print_r($usuarioWeb);}
        } catch (Exception $exc) {
                echo $exc->getTraceAsString();
        }

        
        
        ?>
        <form action="Password.php" method="POST">
            <input type="text" name="pass">
            <input type="submit" value="Enviar">
        </form>
    </body>
</html>
