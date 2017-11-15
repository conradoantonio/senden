window.onload = function() {
    var inputs = [];
    mb = 0;
    var fileExtensionImg = ['jpg', 'jpeg', 'png'];//Only Images
    var msgError = '';
    var regExprTexto = /^[a-z ñ # , : ; ¿ ? ! ¡ ' " _ @ ( ) áéíóúäëïöüâêîôûàèìòùç\d_\s \-.]{2,}$/i;
    var regExprTel = /^[( ) + \d_\s \-]{6,20}$/i;
    var regExprUser = /^[a-z ñ áéíóúäëïöüâêîôûàèìòùç\d_ .]{5,20}$/i;
    var regExprEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
    $("#guardar_usuario").on('click', function() {
        inputs = [];
        msgError = '';

        validarInput($('input#name'), regExprTexto) == false ? inputs.push('Nombre') : ''
        validarInput($('input#email'), regExprEmail) == false ? inputs.push('\n Correo') : ''
        validarInput($('input#password'), regExprTexto) == false ? inputs.push('\n Contraseña') : ''
        validarArchivo($('input#photo')) == false ? inputs.push('\nFotografía') : ''
        
        if (inputs.length == 0) {
            $('#guardar_usuario').hide();
            $('#guardar_usuario').submit();
        } else {
            $('#guardar_usuario').show();
            swal("Corrija los siguientes campos para continuar: ", inputs);
            return false;
        }
    });

    function validarInput (campo,regExpr) {
        if($('form#form_usuario input#id').val() != '' && $(campo).attr('name') == 'password' && $(campo).val() == '') {
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


    function validarArchivo (campo) {
        /*Si el campo está vacío y es un edit entonces está correcto*/
        if ($('form#form_usuario input#id').val() != '' && ($(campo).val() == '' || $(campo).val() == null)) {
            return true;
        }
        else if ($('form#form_usuario input#id').val() == '' && ($(campo).val() == '' || $(campo).val() == null)) {
            $(campo).parent().addClass("has-error");
            msgError = msgError + $(campo).parent().children('label').text() + '\n';
            return false;
        }
        else if (($('form#form_usuario input#id').val() == '' || $('form#form_usuario input#id').val() != '') && $(campo).val() != '') {
            console.info(campo[0].files[0].size);
            var archivo = $(campo).val();
            var extension = archivo.split('.').pop().toLowerCase();
            var kilobyte = (campo[0].files[0].size / 1024);
            var mb = kilobyte / 1024;
            if ($.inArray(extension, fileExtensionImg) == -1 || mb >= 5) {
                $(campo).parent().addClass("has-error");
                msgError = msgError + $(campo).parent().children('label').text() + '\n';
            }
            else {
                $(campo).parent().removeClass("has-error")
            }
            return $.inArray(extension, fileExtensionImg) == -1 || mb >= 5 ? false : true;
        }
        console.warn('no debió llegar hasta aquí');
        return false;
    }
}
