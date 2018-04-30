<?php

require_once __DIR__ . '/vendor/mercadopago/lib/mercadopago.php';
require_once 'entidades/pagos.php';

require_once 'models/PagosModel.php';

function logMP($contenido) {
    $nombre_archivo = "logMP.txt";

    if (file_exists($nombre_archivo)) {
        $mensaje = "\n ----------------------------INICIO------------------------- \n"
                . "El Archivo $nombre_archivo se ha modificado";
    } else {
        $mensaje = "El Archivo $nombre_archivo se ha creado";
    }

    if ($archivo = fopen($nombre_archivo, "a+")) {
        if (fwrite($archivo, date("d-m-Y h:i:s") . " " . $mensaje . "\n")) {
            fwrite($archivo, date("d-m-Y h:i:s") . " " . $contenido . "\n");
        } else {
            echo "Ha habido un problema al crear el archivo";
        }

        fclose($archivo);
    }
}

$datos;

$mp = new MP("3066631672394764", "ZQd8G7w8rPa2gTWj1bRYNCDi10zu7j6G");
//$mp = new MP("691777233569033", "qpsv5Sf9yj7Nic6yZKbIxJLO3RoDMEt3");


if (!isset($_GET["id"], $_GET["topic"]) || !ctype_digit($_GET["id"])) {
    http_response_code(400);
    //print_r($mp);
    return;
}


// Get the payment and the corresponding merchant_order reported by the IPN.
if ($_GET["topic"] == 'payment') {
    $payment_info = $mp->get("/collections/notifications/" . $_GET["id"]);
    $merchant_order_info = $mp->get("/merchant_orders/" . $payment_info["response"]["collection"]["merchant_order_id"]);

    $datos = "\n topic = payment \n"
            . "payment id: " . $_GET["id"] . "\n"
            . "payment_info: \n"
            . print_r($payment_info, true)
            . "merchant_orders: \n"
            . print_r($merchant_order_info, true);


// Get the merchant_order reported by the IPN.
} else if ($_GET["topic"] == 'merchant_order') {
    $merchant_order_info = $mp->get("/merchant_orders/" . $_GET["id"]);
}

if ($merchant_order_info["status"] == 200) {
    // If the payment's transaction amount is equal (or bigger) than the merchant_order's amount you can release your items
    $paid_amount = 0;

    foreach ($merchant_order_info["response"]["payments"] as $payment) {
        if ($payment['status'] == 'approved') {
            $paid_amount += $payment['transaction_amount'];

            $datos .= "payment: " . $payment['transaction_amount'] . "\n";
        }
    }

    if ($paid_amount >= $merchant_order_info["response"]["total_amount"]) {
        if (count($merchant_order_info["response"]["shipments"]) > 0) { // The merchant_order has shipments
            if ($merchant_order_info["response"]["shipments"][0]["status"] == "ready_to_ship") {
                //print_r("Totally paid. Print the label and release your item.");
            }
        } else { // The merchant_order don't has any shipments
            //print_r("Totally paid. Release your item.");
            $id = $merchant_order_info["response"]["items"][0]["id"];
            $categoria = $merchant_order_info["response"]["external_reference"];
            $importe = $paid_amount;
            $estado = $merchant_order_info["response"]["payments"][0]["status"];
            $medio = $payment_info["response"]["collection"]["payment_type"];
            $fechaYhora = date("Y-m-d H:i:s");
            $activo=0;
            if($estado == 'approved'){
                $activo=1;
            }
            if(isset($id) && $id != ''){
                $pagos = new Pagos($id, null, $importe, $estado, $activo, $fechaYhora, $medio, null, $categoria);
                $pagoModel = new PagosModel();
                //rejected=rechazado
                //pending=pendiente
                //approved=aprovado
                $pagoModel->actualizaPagos($pagos);
            }else{
                $datos.='********************NO SE ENCONTRO EL ID DEL PAGO************************';
            }
        }
    } else {
        //print_r("Not paid yet. Do not release your item.");
    }
    $datos.= "----------------------------FIN---------------------------";
    logMP($datos);//SAVE LOG
    http_response_code(200);
}
?>