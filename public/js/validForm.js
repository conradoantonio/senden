/*
* Scrip de validaciones de un formulario
* Luis Castañeda
* v 1.4
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
  
$("#guardar").on('click',function(e) {
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
  
        if ( $(this).hasClass('image') ){
            archivo = $(this).val();
            extension = archivo.split('.').pop().toLowerCase();
  
  
            if ($(this).val() != '' && $(this).val() != null) {
                kilobyte = ($(this)[0].files[0].size / 1024);
                mb = kilobyte / 1024;
                if ( !$(this).hasClass('document') ) {
                    if ($.inArray(extension, fileExtension) == -1 || mb > 5) {
                        if ( !$(this).parent().hasClass("has-error") ){
                            if ( $.inArray(extension, fileExtension) == -1 ) {
                                type_error = "Debe ser una imagen"; 
                            } else {
                                type_error = "El arhivo debe ser menor a 5 mb";
                            }
                            $(this).parent().addClass("has-error");
                            errors_count += 1;
                            msg = msg +"<li>"+$(this).data('name')+": "+type_error+"</li>";
                        }
                    } else {
                        $(this).parent().removeClass("has-error");
                    }
                } else {
                    if ( ($.inArray(extension, fileExtension) == -1 && $.inArray(extension, documentExtension) == -1) || mb > 5){
                        if ( !$(this).parent().hasClass("has-error") ){
                            if ( $.inArray(extension, fileExtension) == -1 && $.inArray(extension, documentExtension) == -1 ) {
                                type_error = "Debe ser una imagen o pdf"; 
                            } else {
                                type_error = "El arhivo debe ser menor a 5 mb";
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
                    if ($.inArray(extension_doc, documentExtension) == -1 || mb > 5) {
                        if ( !$(this).parent().hasClass("has-error") ){
                            if ( $.inArray(extension, fileExtension) == -1 ) {
                                type_error = "Debe ser un pdf"; 
                            } else {
                                type_error = "El arhivo debe ser menor a 5 mb";
                            }
                            $(this).parent().addClass("has-error");
                            errors_count += 1;
                            msg = msg +"<li>"+$(this).data('name')+": "+type_error+"</li>";
                        }
                    } else {
                        $(this).parent().removeClass("has-error");
                    }
                } else {
                    if ( ($.inArray(extension_doc, fileExtension) == -1 && $.inArray(extension_doc, documentExtension) == -1) || mb > 5){
                        if ( !$(this).parent().hasClass("has-error") ){
                            if ( $.inArray(extension_doc, fileExtension) == -1 && $.inArray(extension_doc, documentExtension) == -1 ) {
                                type_error = "Debe ser una imagen o pdf"; 
                            } else {
                                type_error = "El arhivo debe ser menor a 5 mb";
                            }
                            $(this).parent().addClass("has-error");
                            errors_count += 1;
                            msg = msg +"<li>"+$(this).data('name')+": "+type_error+"</li>";
                        }
                    }
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
        $('form.valid').submit();
        return true;
    }
})