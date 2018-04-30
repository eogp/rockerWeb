//VALIDACION DE CONTENIDOS-----------------------------------
function validar() {
    jQuery.validator.addMethod("check", function (value, element, param) {
        var count = 0;
        $("#" + param + " input").each(function () {
            if ($(this).prop('checked')) {
                count++;
            }
        });
        return count > 0;
    }, "Debe seleccionar al menos una casilla.");

    jQuery.validator.addMethod("fechas", function (value, element) {
        var count = 0;
        $("#fechasAgregadas div").each(function () {
            count++;
        });
        return count > 0;
    }, "Debe agregar al menos una fecha.");

    jQuery.validator.addMethod("horarios", function (value, element) {
        var count = 0;
        $("#horariosAgregados div").each(function () {
            count++;
        });
        return count > 0;
    }, "Debe agregar al menos un horario.");

    jQuery.validator.addMethod("coordenadas", function (value, element) { 
        return $("#long").val() !== "" && $("#lat").val() !== "";
    }, "Faltan coordenadas");

    jQuery.validator.addMethod("lettersonly", function (value, element) {
        return this.optional(element) || /^[a-z]+$/i.test(value);
    }, "Letters only please");

    jQuery.validator.addMethod('onecheck', function (value, ele) {
        return $("input:checked").length >= 1;
    }, 'Please Select Atleast One CheckBox');

    jQuery.validator.addMethod('img_size', function (value, ele, param) {
        var uploadField = document.getElementById(param);
        if (uploadField.value !== '') {
            if (uploadField.files[0].size > 3000000) {
                alert("La imagen no puede superar los 3 Mbytes!");
                uploadField.value = "";
                return false;
            }
            ;
        }
        return true;
    }, 'Imagen muy grande.');

    $('#altaPublicacion').validate({
        rules: {
            titulo: {
                required: true
            },
            codarea: {
                required: true,
                number: true
            },
            telefono: {
                required: true,
                number: true
            },
            email: {
                required: true,
                email: true
            },
            direccion: {
                required: true,
                coordenadas: true
            },
            imagen1: {
                img_size: 'image-upload'
            },
            imagen2: {
                img_size: 'image-upload2'
            },
            imagen3: {
                img_size: 'image-upload3'
            },
            tipoPub: {
                required: true
            },
            //SALAS Y ESTUDIOS
            valhora: {
                required: true,
                number: true
            },
            cantidadSalas: {
                required: true,
                number: true
            },
            //VENTA DE INSTRUMENTOS
            instrumento: {
                required: true
            },
            marcaInstrimento: {
                required: true
            },
            otroInstrumento: {
                required: true,
                maxlength: 45
            },
            anioInstrimento: {
                required: true
            },
            paisInstrimento: {
                required: true
            },
            estadoInstrimento: {
                required: true
            },
            valorInstrimento: {
                required: true,
                number: true
            },
            //ESTILO DE VIDA
            estilovida: {
                required: true
            },
            addHorario: {
                horarios: true
            },
            producto: {
                check: "productos"
            },
            //SERVICIOS PROFESIONALES
            servProf: {
                required: true
            },
            experiencia: {
                number: true
            },
            //SHOW Y EVENTOS
            showEventos: {
                required: true
            },
            banda: {
                required: true,
                maxlength: 45
            },
            valor: {
                required: true,
                number: true
            },
            agregarFech: {
                fechas: true
            }
        },
        messages: {
            titulo: {
                required: 'Este campo es obligatorio.<br />'
            },
            codarea: {
                required: 'Obligatorio.<br />',
                number: 'Solo numeros.<br />'
            },
            telefono: {
                required: 'Este campo es obligatorio.<br />',
                number: 'Este campo solo admite números.<br />'
            },
            email: {
                required: 'Este campo es obligatorio.<br />',
                email: 'Este campo solo admite email validos.<br />'
            },
            direccion: {
                required: 'Este campo es obligatorio.<br />',
                coordenadas: "Debe aparecer el marcador en el mapa.<br />"
            },
            tipoPub: {
                required: 'Seleccione una categoria.<br />'
            },
            valhora: {
                required: 'Este campo es obligatorio.<br />',
                number: 'Este campo solo admite números.<br />'
            },
            cantidadSalas: {
                required: 'Este campo es obligatorio.<br />',
                number: 'Este campo solo admite números.<br />'
            },
            instrumento: {
                required: 'Seleccione un tipo de instrumento.<br />'
            },
            marcaInstrimento: {
                required: 'Seleccione una marca.<br />'
            },
            otroInstrumento: {
                required: 'Describa el instrumento.<br />',
                maxlength: 'Este campo solo admite hasta 45 caracteres.<br />'
            },
            anioInstrimento: {
                required: 'Seleccione un año.<br />'
            },
            paisInstrimento: {
                required: 'Seleccione el pais de origen.<br />'
            },
            estadoInstrimento: {
                required: 'Indique el estado del instrumento.<br />'
            },
            valorInstrimento: {
                required: 'Ingrese el valor del instrumento.<br />',
                number: 'Este campo solo admite números.<br />'
            },
            estilovida: {
                required: 'Este campo es obligatorio.<br />'
            },
            servProf: {
                required: 'Este campo es obligatorio.<br />'
            },
            experiencia: {
                number: 'Este campo solo admite números.<br />'
            },
            showEventos: {
                required: 'Este campo es obligatorio.<br />'
            },
            banda: {
                required: 'Este campo es obligatorio.<br />',
                maxlength: 'Este campo solo admite hasta 45 caracteres.<br />'
            },
            valor: {
                required: 'Este campo es obligatorio.<br />',
                number: 'Este campo solo admite números.<br />'
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

}
//------------------------------------------------------------

//CONTENIDOS POR CATEGORIA DE PUBLICACION--------------------
$(document).ready(function () {
    document.getElementById('tipoPub').addEventListener('change', function () {
        $('#contenido').empty();
        $.ajax({
            data: $("#tipoPub"),
            url: 'contenido.php',
            type: 'POST',
            success: function (response) {
                //alert(response.toString());
                $('#contenido').html(response);
            },
            error: function () {
                alert("error");
            }
        });
    });
    //VALIDACION DE CONTENIDOS
    validar();

});
//------------------------------------------------------------

//GENERAL-----------------------------------------------------
function validarInputs(idpadre, tipo) {

    $(idpadre + " " + tipo).each(function () {
        //alert($(this).val());

        if ($(this).val() === null || $(this).val() === '') {
            $(this).css('border-color', '#C80000');

        } else {
            $(this).css('border-color', '#BDC7BC');

        }

    });
}
//------------------------------------------------------------

//CONTENIDOS PARA SALAS Y ESTUDIOS DE GRABACION--------------
function mostrar_marcas(elemento) {
    if ($(elemento).is(':checked')) {
        //alert("checked");
        $.ajax({
            data: {marcasequipos: $(elemento).val()},
            url: 'contenido.php',
            type: 'POST',
            success: function (response) {
                $(elemento).parent().after(response);
                //alert(response.toString());
            },
            error: function () {
                alert("error");
            }
        });
    } else {
        //alert("UNchecked");
        $(elemento).parent().next().remove();
    }
}
//------------------------------------------------------------

//CONTENIDOS PARA VENTA DE INSTRUMENTOS-----------------------
function mostrarMarcasInstrumentos(elemento) {
    $('#marcas').empty();
    $.ajax({
        data: {marcasInstrumentos: $(elemento).val()},
        url: 'contenido.php',
        type: 'POST',
        success: function (response) {
            $(elemento).after(response);
            //alert(response.toString());
        },
        error: function () {
            alert("error");
        }


    });
}
//------------------------------------------------------------

// CONTENIDOS PARA ESTILO DE VIDA----------------------------
// PRODUCTOS PARA TODAS LAS SUBCATEGORIAS
function mostrarProductos(elemento) {

    $(elemento).next().remove();
    $.ajax({
        data: {productos: $(elemento).val()},
        url: 'contenido.php',
        type: 'POST',
        success: function (response) {
            $(elemento).after(response);
            //alert(response.toString());
        },
        error: function () {
            alert("error");
        }


    });
}
//-----------------------------------------------------------

// VALIDACION Y MANEJO DE HORARIOS---------------------------
function agregarHorario(elemento) {
    if ($('#diaDesde').val() !== null && $('#diaHasta').val() !== null && $('#horaDesde').val() !== null && $('#horaHasta').val() !== null) {
        validarInputs('#desde', 'select');
        validarInputs('#hasta', 'select');

        var horario = '<div><div class="input-group">' +
                      '<input type="text" class="form-control" id="horario" name="horario[]"';
        if ($('#diaDesde').val() != $('#diaHasta').val()) {
            horario += ' value="De ' + $('#diaDesde').val() + ' a ' + $('#diaHasta').val() + ' de ';
        } else {
            horario += ' value="' + $('#diaDesde').val() + ' de ';
        }
        horario += $('#horaDesde').val() + ' hs. a ' + $('#horaHasta').val() + ' hs." readonly/>' +
                   '<span class="input-group-btn">' +
                   '<button class="btn btn-secondary" type="button" onClick="quitarHorario(this)">Quitar</button>' +
                   '</span></div><br/></div>';
        $('#horariosAgregados').append(horario);


    } else {

        validarInputs('#desde', 'select');
        validarInputs('#hasta', 'select');
    }
    //alert("anda");
}
function quitarHorario(elemento) {
    $(elemento).parent().parent().parent().remove();
}
//------------------------------------------------------------

// VALIDACION Y MANEJO DE FECHAS ---------------------------
function agregarFecha(elemento) {
    if ($('#date').val() !== '' && $('#hora').val() !== '') {
        validarInputs('#fechaHora', 'input');

        var date = $('#date').val().split('-');
        var day = date[0];
        var month = date[1];
        var year = date[2];

        var fecha = '<div><div class="input-group">' +
                '<input type="text" class="form-control" id="fecha" name="fecha[]" value="El ' +
                year + '-' + month + '-' + day + ' a las ' + $('#hora').val() + ' hs." readonly/>' +
                '<span class="input-group-btn">' +
                '<button class="btn btn-secondary" type="button" onClick="quitarHorario(this)">Quitar</button>' +
                '</span></div><br/></div>';
        $('#fechasAgregadas').append(fecha);


    } else {
        validarInputs('#fechaHora', 'input');


    }

}
//------------------------------------------------------------