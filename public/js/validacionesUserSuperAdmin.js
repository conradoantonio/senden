$(function(){
    /*Código para validar el formulario de datos del usuario*/
    var inputs = [];
    var msgError = '';
    var regExprTexto = /^[a-z ñ # , : ; ¿ ? ! ¡ ' " _ @ ( ) áéíóúäëïöüâêîôûàèìòùç\d_\s \-.]{2,}$/i;
    var regExprUser = /^[a-z ñ áéíóúäëïöüâêîôûàèìòùç\d_ .]{5,20}$/i;
    var regExprEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
    var btn_enviar_producto = $("#guardar_superusuario");
    $("#guardar_superusuario").on('click', function() {
        inputs = [];
        msgError = '';

        validarInput($('input#name'), regExprTexto) == false ? inputs.push('Nombre superusuario') : ''
        validarInput($('input#email'), regExprEmail) == false ? inputs.push('Email') : ''
        validarInput($('input#password'), regExprTexto) == false ? inputs.push('Contraseña') : ''

        if (inputs.length == 0) {
            $('#guardar_superusuario').hide();
            saveSuperUser();
        } else {
            $('#guardar_superusuario').show();
            swal("Corrija los siguientes campos para continuar: ", msgError);
            return false;
        }
    });

    $( "input#name" ).blur(function() {
        validarInput($(this), regExprTexto);
    });
    $( "input#email" ).blur(function() {
        validarInput($(this), regExprEmail);
    });
    $( "input#password" ).blur(function() {
        validarInput($(this), regExprTexto);
    });

    function validarInput (campo,regExpr) {
        if($('form#form_superusuario input#id').val() != '' && $(campo).attr('name') == 'password' && $(campo).val() == '') {
            return true;
        }
        else if (!$(campo).val().match(regExpr)) {
            $(campo).parent().addClass("has-error");
            msgError = msgError + $(campo).parent().children('label').text() + '\n';
            return false;
        } else {
            $(campo).parent().removeClass("has-error");
            return true;
        }
    }


})
