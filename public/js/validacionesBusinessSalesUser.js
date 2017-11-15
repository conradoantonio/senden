$(function(){
    /*Código para validar el formulario de datos del usuario*/
    var inputs = [];
    mb = 0;
    fileExtension = ['jpg', 'jpeg', 'png'];
    var msgError = '';
    var regExprTexto = /^[a-z ñ # , : ; ¿ ? ! ¡ ' " _ @ ( ) áéíóúäëïöüâêîôûàèìòùç\d_\s \-.]{2,}$/i;
    var regExprUser = /^[a-z ñ áéíóúäëïöüâêîôûàèìòùç\d_ .]{5,20}$/i;
    var regExprEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
    var regExprNum = /^[\d .]{1,}$/i;
    var regExprNumNotReq = /^[\d .]{0,}$/i;
    $("#guardar_business_sales_user").on('click', function() {
        inputs = [];
        msgError = '';

        validarInput($('input#name'), regExprTexto) == false ? inputs.push('Nombre usuario') : ''
        validarInput($('input#email'), regExprEmail) == false ? inputs.push('Email') : ''
        validarInput($('input#password'), regExprTexto) == false ? inputs.push('Contraseña') : ''
        validarSelect($('select#user_type_id')) == false ? inputs.push('Tipo usuario') : ''


        if (inputs.length == 0) {
            $('#guardar_business_sales_user').hide();
            saveUserForMyBusiness();
        } else {
            $('#guardar_business_sales_user').show();
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
    $( "select#user_type_id" ).change(function() {
        validarSelect($(this));
    });

    function validarInput (campo,regExpr) {
        if($('form#form_business_sales_user input#id').val() != '' && $(campo).attr('name') == 'password' && $(campo).val() == '') {
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

    function validarSelect (select) {
        if ($(select).val() == '0' || $(select).val() == '' || $(select).val() == null) {
            $(select).parent().addClass("has-error");
            msgError = msgError + $(select).parent().children('label').text() + '\n';
            return false;
        } else {
            $(select).parent().removeClass("has-error");
            return true;
        }
    }
});
