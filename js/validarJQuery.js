/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function () {

    $("#register").validate({

        rules: {
            email: {
                required: true,
                email: true
            },
            retryEmail: {
                required: true,
                email: true,
                equalTo: "#email"
            },
            pass: {
                required: true,
                minlength: 8,
                maxlength: 20

            },
            retryPass: {
                required: true,
                minlength: 8,
                maxlength: 20,
                equalTo: "#pass"
            },
            condiciones: "required"
        },
        messages: {
            email: {
                required: 'Este campo es obligatorio.<br>',
                email: 'Ingresa un email valido.<br>'
            },
            retryEmail: {
                required: 'Este campo es obligatorio.<br>',
                email: 'Ingresa un email valido.<br>',
                equalTo: 'Ambos email deben coincidir.<br>'
            },
            pass: {
                required: 'Este campo es obligatorio.<br>',
                minlength: 'La contraseña debe tener 8 caracteres como mínimo.<br>',
                maxlength: 'La contraseña debe tener 20 caracteres como maximo.<br>'
            },
            retryPass: {
                required: 'Este campo es obligatorio.<br>',
                minlength: 'La contraseña debe tener 8 caracteres como mínimo.<br>',
                maxlength: 'La contraseña debe tener 20 caracteres como maximo.<br>',
                equalTo: 'Ambas contraseñas deben coincidir.<br>'
            },
            condiciones: {required: 'Debes aceptar los terminos y condicines.<br>'}
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");

            if (element.prop("type") === "checkbox") {
                error.insertBefore(element);
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).parents(0).addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents(0).addClass("has-success").removeClass("has-error");
        },
        submitHandler: function (form) {
            form.submit();
        }
    });

    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    }, "Letters only please");

    $("#updateUser").validate({

        rules: {
            nombre: {
                required: true,
                lettersonly: true
            },
            apellido: {
                required: true,
                lettersonly: true
            },
            calle: {
                required: true

            },
            altura: {
                required: true,
                number: true

            },
            ciudad: {
                required: true,
                lettersonly: true

            },
            codarea: {
                number: true

            },
            telefono: {
                number: true

            }
        },
        messages: {
            nombre: {
                required: 'Este campo es obligatorio.<br>',
                lettersonly: 'Este campo solo admite letras.<br> '
            },
            apellido: {
                required: 'Este campo es obligatorio.<br>',
                lettersonly: 'Este campo solo admite letras.<br> '
            },
            calle: {
                required: 'Este campo es obligatorio.<br>'
            },
            ciudad: {
                required: 'Este campo es obligatorio.<br>',
                lettersonly: 'Este campo solo admite letras.<br> '
            },
            telefono: {
                number: 'Este campo solo admite números.<br>'

            },
            codarea: {
                number: 'Este campo solo admite números.<br>'

            },
            altura: {
                required: 'Este campo es obligatorio.<br>',
                number: 'Este campo solo admite números.<br>'

            }
        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");

            if (element.prop("type") === "checkbox") {
                error.insertBefore(element);
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).parent().addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parent().addClass("has-success").removeClass("has-error");
        },
        submitHandler: function (form) {
            form.submit();
        }



    });

    $("#updateAcceso").validate({

        rules: {
            email: {
                required: true,
                email: true
            },
            retryEmail: {
                required: true,
                email: true,
                equalTo: "#email"
            },
            pass: {
                required: true,
                minlength: 8,
                maxlength: 20

            },
            retryPass: {
                required: true,
                minlength: 8,
                maxlength: 20,
                equalTo: "#pass"
            },
            condiciones: "required"
        },
        messages: {
            email: {
                required: 'Este campo es obligatorio.<br>',
                email: 'Ingresa un email valido.<br>'
            },
            retryEmail: {
                required: 'Este campo es obligatorio.<br>',
                email: 'Ingresa un email valido.<br>',
                equalTo: 'Ambos email deben coincidir.<br>'
            },
            pass: {
                required: 'Este campo es obligatorio.<br>',
                minlength: 'La contraseña debe tener 8 caracteres como mínimo.<br>',
                maxlength: 'La contraseña debe tener 20 caracteres como maximo.<br>'
            },
            retryPass: {
                required: 'Este campo es obligatorio.<br>',
                minlength: 'La contraseña debe tener 8 caracteres como mínimo.<br>',
                maxlength: 'La contraseña debe tener 20 caracteres como maximo.<br>',
                equalTo: 'Ambas contraseñas deben coincidir.<br>'
            }

        },
        errorElement: "em",
        errorPlacement: function (error, element) {
            // Add the `help-block` class to the error element
            error.addClass("help-block");


            error.insertAfter(element);

        },
        highlight: function (element, errorClass, validClass) {
            $(element).parent().addClass("has-error").removeClass("has-success");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parent().addClass("has-success").removeClass("has-error");
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
    //alert("fin");
});

