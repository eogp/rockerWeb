/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function pausarReaudarPub(elemento) {

    $.ajax({
        data: {pausarReanudarPub: $(elemento).val()},
        url: 'publicaciones.php',
        type: 'POST',
        success: function (response) {
            $("#estadoPub").text(response);
            
            if(response.toString().indexOf("Inactiva") >= 0){
                $("#pausarReanudarPub").val("Reanudar");
            }else{
                $("#pausarReanudarPub").val("Pausar");

            }

        },
        error: function () {
            alert("error");
        }


    });
    
    
}

function pagarPublicacion(){

    $("#pagoForm").submit();
}