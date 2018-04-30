<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/mercadopago/dx-php/src/MercadoPago/Sdk.php';



MercadoPago\SDK::setAccessToken("TEST-3066631672394764-020719-000e9ac1ef4d8c77e041f99068ba2bcb__LD_LC__-33922682");

$body = array(
    "json_data" => array(
        "site_id" => "MLA"
    )
);

$result = MercadoPago\SDK::post('/users/test_user', $body);

var_dump($result);
/*
VENDEDOR
array(2) { 
    ["code"]=> int(201) 
    ["body"]=> array(5) { 
        ["id"]=> int(303746347) 
        ["nickname"]=> string(12) "TESTLSEXLZHE" 
        ["password"]=> string(10) "qatest8563" 
        ["site_status"]=> string(6) "active" 
        ["email"]=> string(31) "test_user_51417165@testuser.com" } }
//------------------------------------------------------------------
COMPRADOR
Nombre y apellido:  Test Test
Documento:  DNI 1111111
Teléfono:  01 1111-1111

array(2) { 
    ["code"]=> int(201) 
    ["body"]=> array(5) { 
        ["id"]=> int(303763877) 
        ["nickname"]=> string(8) "TT789583" 
        ["password"]=> string(10) "qatest4329" 
        ["site_status"]=> string(6) "active" 
        ["email"]=> string(31) "test_user_75602677@testuser.com" } }

 */
?>