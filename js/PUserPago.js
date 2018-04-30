/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function radioChecked(btn, tipo, valor){
    //alert(valor);
    var str= "Elegiste la publicacion " + tipo + ". <br/> Precio $" + valor + ",-";
    $("#pagoSeleccionado").html(str);
    $("#mensual").hide();
    $("#anual").hide();
    $("#deporvida").hide();

    $("#"+btn).show();


}


function onreturn (retorno){
    alert (retorno.toString());
}
