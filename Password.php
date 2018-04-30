<?php

class Password {
    public static function hash($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
    public static function verify($password, $hash) {
        return password_verify($password, $hash);
    }
}/*
if(isset($_POST['pass'])){
    if(Password::verify($_POST['pass'], '$2y$10$l78jBpn1mm1rJeTwRC7kaerRl79dxVRij3mq6KM55Y/2RmIys08Ha')){
        print_r("coinciden");
    }
    $hash1= Password::hash($_POST['pass']);
    $hash2= Password::hash($_POST['pass']);
    print_r($_POST['pass']);
    print_r("</br>");
    print_r($hash1);
    print_r("</br>");
    print_r($hash2);

}
?>*/
