base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista
function banBusinessAdmin(id,token) {
    url = base_url.concat('/admin/users/ban_business_user');
    $.ajax({
        method: "POST",
        type:"POST",
        url: url,
        data:{
            "id":id,
            "_token":token
        },
        success: function(response) {
            console.info(response);
            swal({
                title: "Usuario baneado correctamente.",
                type: "success",
                showConfirmButton: true,
            });
            var buttons_table = "<button type='button' class='btn btn-info editar_business_user'>Editar</button> " +
                                "<button type='button' class='btn btn-danger eliminar_business_user'>Borrar</button>";
            var oTable = $('#example3').dataTable();
            oTable.fnClearTable();
            $.each(response,function(i,e) {
                if ( response.length > 0 ) {
                    oTable.dataTable().fnAddData( 
                    [
                        e.id,
                        e.name,
                        e.email,
                        e.business,
                        e.business_id,
                        e.status,
                        buttons_table
                    ] );      
                }
            })
            $("table tbody tr td:nth-child(5), table tbody tr td:nth-child(6)").addClass("hide");
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema eliminando este usuario, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function saveBusinessAdmin() {
    $.ajax({
        url:$("form#form_business_user").attr('action'),
        type:"POST",
        data:$("form#form_business_user").serialize(),
        success:function(response) {
            $('div#formulario_business_user').modal('hide');
            if (response.msg == 'Email repetido') {
                $('div#alerta_email_repetido').removeClass('hide');
            }
            else {
                $('div#alerta_email_repetido').addClass('hide');
                var buttons_table = "<button type='button' class='btn btn-info editar_business_user'>Editar</button> " +
                                "<button type='button' class='btn btn-danger eliminar_business_user'>Borrar</button>";
                var oTable = $('#example3').dataTable();
                oTable.fnClearTable();
                $.each(response,function(i,e) {
                    if ( response.length > 0 ) {
                        oTable.dataTable().fnAddData( 
                        [
                            e.id,
                            e.name,
                            e.email,
                            e.business,
                            e.business_id,
                            e.status,
                            buttons_table
                        ] );      
                    }
                })
                $("table tbody tr td:nth-child(5), table tbody tr td:nth-child(6)").addClass("hide");
                clean();
            }
        },
        error: function(xhr, status, error) {
            $('div#formulario_business_user').modal('hide');
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema comunicándose con el servidor, por favor, trate nuevamente o recargue la página.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }

    })
}
