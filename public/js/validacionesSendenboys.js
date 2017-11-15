/*
* Scrip de validaciones de un formulario
* Luis Castañeda
* v 1.6.0
*/
$('.numeric').keypress(function(e) {
    if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        return false;
    }
});
 
$('.character').keypress(function(e) {
    if (e.which > 48 && e.which < 57) {
        return false;
    }
});
 
$(".not-empty").blur(function() {
    if ( $(this).is('select') ){
        if ( $(this).val() != 0 ){
            $(this).parent().removeClass('has-error')
        } else {
            $(this).parent().addClass('has-error')
        }
    } else {
        if ( $(this).val() != "" ){
            $(this).parent().removeClass('has-error')
        } else {
            $(this).parent().addClass('has-error')
        }
    }
});

$(".date").blur(function() {
    var regEx = /^\d{4}-\d{2}-\d{2}$/;
    if (!$(this).val().match(regEx)) {
        $(this).parent().addClass('has-error')
    }
        
    var d;
    if(!((d = new Date($(this).val()))|0)){
        $(this).parent().addClass('has-error')
        //return false; // Invalid date (or this could be epoch)
    } else {
        $(this).parent().removeClass('has-error')
    }
    //return d.toISOString().slice(0,10) == dateString;
});
 
/*
* En este evento se checa cada input dependiendo a la clase que tenga
* not-empty: El campo no puede estar vacio
* image: El campo sera una imagen
* document: El campo sera un documento
* check: El campo es un checkbox
*/
$("#guardar").on('click',function(e){
    e.preventDefault();
    var errors_count = 0;
    var msg = "";
    var fileExtension = ['jpg','jpeg','png','gif'];
    var documentExtension = ['pdf'];
    var mb = 0;
    var kilobyte = 0;
    var mb_doc = 0;
    $('form.valid input, form.valid select, form.valid textarea').each(function(i,e){
        if ( $(this).hasClass('not-empty') ) {
            if ( $(this).val() == "" || $(this).val() == 0 ){
                $(this).parent().addClass('has-error')
                errors_count += 1;
                msg = msg +"<li>"+$(this).data('name')+": Campo vacio</li>";
            } else {
                $(this).parent().removeClass('has-error')
            }
        }

        if ( $(this).hasClass('date') ){
            var regEx = /^\d{4}-\d{2}-\d{2}$/;
            if ( !$(this).hasClass('has-error') ) {
                if (!$(this).val().match(regEx)) {
                    $(this).parent().addClass('has-error');
                    errors_count += 1;
                    msg = msg +"<li>"+$(this).data('name')+": Fecha inválida</li>";
                    //return false;
                }
                /*    
                var d;
                if(!((d = new Date($(this).val()))|0)){
                    $(this).parent().addClass('has-error');
                    errors_count += 1;
                    msg = msg +"<li>"+$(this).data('name')+": Fecha inválida</li>";
                } */else {
                    $(this).parent().removeClass('has-error')
                }
            }
        }
 
        if ( $(this).hasClass('image') ){
            archivo = $(this).val();
            extension = archivo.split('.').pop().toLowerCase();
 
            if ($(this).val() != '' && $(this).val() != null) {
                kilobyte = ($(this)[0].files[0].size / 1024);
                mb = kilobyte / 1024;
                if ( !$(this).hasClass('document') ) {
                    if ($.inArray(extension, fileExtension) == -1 || mb > 2) {
                        if ( !$(this).parent().hasClass("has-error") ){
                            if ( $.inArray(extension, fileExtension) == -1 ) {
                                type_error = "Debe ser una imagen"; 
                            } else {
                                type_error = "El arhivo debe ser menor a 2 mb";
                            }
                            $(this).parent().addClass("has-error");
                            errors_count += 1;
                            msg = msg +"<li>"+$(this).data('name')+": "+type_error+"</li>";
                        }
                    } else {
                        $(this).parent().removeClass("has-error");
                    }
                } else {
                    if ( ($.inArray(extension, fileExtension) == -1 && $.inArray(extension, documentExtension) == -1) || mb > 2){
                        if ( !$(this).parent().hasClass("has-error") ){
                            if ( $.inArray(extension, fileExtension) == -1 && $.inArray(extension, documentExtension) == -1 ) {
                                type_error = "Debe ser una imagen o pdf"; 
                            } else {
                                type_error = "El arhivo debe ser menor a 2 mb";
                            }
                            $(this).parent().addClass("has-error");
                            errors_count += 1;
                            msg = msg +"<li>"+$(this).data('name')+": "+type_error+"</li>";
                        }
                    }
                }
            } 
        }
 
        if ( $(this).hasClass('document') ){
            archivo_doc = $(this).val();
            extension_doc = archivo_doc.split('.').pop().toLowerCase();
 
            if ($(this).val() != '' && $(this).val() != null) {
                kilobyte = ($(this)[0].files[0].size / 1024);
                mb = kilobyte / 1024;
                if ( !$(this).hasClass('image') ) {
                    if ($.inArray(extension_doc, documentExtension) == -1 || mb > 2) {
                        if ( !$(this).parent().hasClass("has-error") ){
                            if ( $.inArray(extension, fileExtension) == -1 ) {
                                type_error = "Debe ser un pdf"; 
                            } else {
                                type_error = "El arhivo debe ser menor a 2 mb";
                            }
                            $(this).parent().addClass("has-error");
                            errors_count += 1;
                            msg = msg +"<li>"+$(this).data('name')+": "+type_error+"</li>";
                        }
                    } else {
                        $(this).parent().removeClass("has-error");
                    }
                } else {
                    if ( ($.inArray(extension_doc, fileExtension) == -1 && $.inArray(extension_doc, documentExtension) == -1) || mb > 2){
                        if ( !$(this).parent().hasClass("has-error") ){
                            if ( $.inArray(extension_doc, fileExtension) == -1 && $.inArray(extension_doc, documentExtension) == -1 ) {
                                type_error = "Debe ser una imagen o pdf"; 
                            } else {
                                type_error = "El arhivo debe ser menor a 2 mb";
                            }
                            $(this).parent().addClass("has-error");
                            errors_count += 1;
                            msg = msg +"<li>"+$(this).data('name')+": "+type_error+"</li>";
                        }
                    }
                }
            } 
        }

        if ( $(this).hasClass('check') ){
            if ( $(this).hasClass('not-empty') ) {
                if ( !$(this).prop('checked') ) {
                    $(this).parent().addClass("has-error");
                    errors_count += 1;
                    msg = msg +"<li>"+$(this).data('name')+": No está marcado</li>";
                } else {
                    $(this).parent().removeClass("has-error");
                }
            }
        }
    })

    if ( errors_count > 0 ) {
        swal({
            title: 'Corrija los siguientes campos para continuar: ',
            type: 'error',
            text: "<ul id='errores_list'>"+msg+"</ul>",
            html:true,
            showCloseButton: true,
            confirmButtonText: 'Aceptar',
        });
    } else {
        swal({
            title: "Formulario enviado",
            text: "Los datos han sido guardados",
            type: "success",
            showCancelButton: false,
            confirmButtonColor: "#337ab7",
            confirmButtonText: "Ok",
            closeOnConfirm: true
        },
        function(){
            $('form.valid').submit();
            return true;
        });
    }
})

/*
* En este evento se limpia la información del formulario
*/
$("#limpiar").on('click',function(){
    $('form.valid input, form.valid textarea').each(function(i,e){
        if($(this).attr('name') != '_token'){
            $(this).val("");
            $(this).parent().removeClass('has-error')
        }
    })
    $('form.valid select').val(0);
    $('form.valid select').parent().removeClass('has-error');
})