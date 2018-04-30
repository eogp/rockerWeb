/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {

    var caract = new RegExp(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
    var espacio = new RegExp(/^[a-z\d_]{4,8}$/i);
    var nombreflag = false;
    var apellidoflag = false;
    var ciudadflag = false;
    var emailflag = false;
    var retryemailflag = false;
    var passflag = false;
    var retrypassflasg = false;

    var valNombre = function validarNombre() {

        if ($("#name").val() == '') {
            $("#name").css("border-color", "#ff0000");
            return false;
        } else {
            $("#name").css("border-color", "#428bca");
            console.log("nombre ");
            nombreflag = true;
        }

    };
    var valApellido = function validarApellido() {

        if ($("#apellido").val() == '') {
            $("#apellido").css("border-color", "#ff0000");
            apellidoflag = false;
        } else {
            $("#apellido").css("border-color", "#428bca");
            console.log("apellido");
            apellidoflag = true;
        }

    };
    var valCiudad = function validarCiudad() {

        if ($("#ciudad").val() == '') {
            $("#ciudad").css("border-color", "#ff0000");
            ciudadflag = false;
        } else {
            $("#ciudad").css("border-color", "#428bca");
            console.log("ciudad");
            ciudadflag = true;
        }

    };
    var valEmail = function validarEmail() {

        if ($("#email").val() == '' || caract.test($("#email").val()) == false) {
            $("#email").css("border-color", "#ff0000");
            emailflag = false;
        } else {
            $("#email").css("border-color", "#428bca");
            console.log("email");
            emailflag = true;
        }
    };
    var valRetryEmail = function validarRetryEmail() {

        if ($("#retryEmail").val() == '' || caract.test($("#retryEmail").val()) == false) {
            $("#retryEmail").css("border-color", "#ff0000");
           retryemailflag = false;
        } else if ($("#retryEmail").val() != $("#email").val()) {
            $("#retryEmail").css("border-color", "#ff0000");
            $("#email").css("border-color", "#ff0000");
            retryemailflag = false;
        } else {
            $("#retryEmail").css("border-color", "#428bca");
            console.log("retryemail");
            retryemailflag = true;
        }

    };
    var valPass = function validarPass() {

        if ($("#pass").val() == '' || espacio.test($("#pass").val()) == false) {
            $("#pass").css("border-color", "#ff0000");
            passflag = false;
        } else {
            $("#pass").css("border-color", "#428bca");
            console.log("pass");
            passflag= true;
        }

    };
    var valRetryPass = function validarRetryPass() {

        if ($("#retryPass").val() == '' || espacio.test($("#pass").val()) == false) {
            $("#retryPass").css("border-color", "#ff0000");
            retrypassflasg = false;
        } else if ($("#retryPass").val() != $("#pass").val()) {
            $("#retryPass").css("border-color", "#ff0000");
            $("#pass").css("border-color", "#ff0000");
            retrypassflasg = false;
        } else {
            $("#retryPass").css("border-color", "#428bca");
            console.log("retrypass");
            retrypassflasg= true;
        }
    };



    var valTodo = function validarTodo(e) {

        if (nombreflag && apellidoflag && ciudadflag && emailflag
                && retryemailflag && passflag && retrypassflasg) {
            if ($("#condiciones").is(':checked')) {
                //sumit
            } else {
                alert("Debes aceptar los terminos y condiciones.");
                e.preventDefault();
            }
        } else {
            alert("Verifica los campos ingresados.");
            e.preventDefault();
        }
    };



    document.getElementById("name").addEventListener("focusout", valNombre);
    document.getElementById("apellido").addEventListener("focusout", valApellido);
    document.getElementById("ciudad").addEventListener("focusout", valCiudad);
    document.getElementById("email").addEventListener("focusout", valEmail);
    document.getElementById("retryEmail").addEventListener("focusout", valRetryEmail);
    document.getElementById("pass").addEventListener("focusout", valPass);
    document.getElementById("retryPass").addEventListener("focusout", valRetryPass);
    document.getElementById("submit").addEventListener("click", valTodo);





});

