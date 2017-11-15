base_url = $('#token').attr('base-url');//Extrae la base url del input token de la vista
function banSuperAdmin(id,token) {
    url = base_url.concat('/admin/users/ban_admin');
    $.ajax({
        method: "POST",
        type:"POST",
        url: url,
        data:{
            "id":id,
            "_token":token
        },
        success: function(response) {
            swal({
                title: "Usuario baneado correctamente.",
                type: "success",
                showConfirmButton: true,
            });
            var buttons_table = "<button type='button' class='btn btn-info editar_superadmin'>Editar</button> " +
                                "<button type='button' class='btn btn-danger eliminar_superadmin'>Borrar</button>";
            var oTable = $('#example3').dataTable();
            oTable.fnClearTable();
            $.each(response,function(i,e) {
                if ( response.length > 0 ) {
                    oTable.dataTable().fnAddData( 
                    [
                        e.id,
                        e.name,
                        e.email,
                        e.status,
                        buttons_table
                    ] );      
                }
            })
            $("table tbody tr td:nth-child(4)").addClass("hide");
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema eliminando este producto, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function saveSuperUser() {
    $.ajax({
        url:$("form#form_superusuario").attr('action'),
        type:"POST",
        data:$("form#form_superusuario").serialize(),
        success:function(response) {
            $('div#formulario_superusuario').modal('hide');
            if (response.msg == 'Email repetido') {
                $('div#alerta_email_repetido').removeClass('hide');
            }
            else {
                $('div#alerta_email_repetido').addClass('hide');
                var buttons_table = "<button type='button' class='btn btn-info editar_superadmin'>Editar</button> " +
                                "<button type='button' class='btn btn-danger eliminar_superadmin'>Borrar</button>";
                var oTable = $('#example3').dataTable();
                oTable.fnClearTable();
                $.each(response,function(i,e) {
                    if ( response.length > 0 ) {
                        oTable.dataTable().fnAddData( 
                        [
                            e.id,
                            e.name,
                            e.email,
                            e.status,
                            buttons_table
                        ] );      
                    }
                })
                $("table tbody tr td:nth-child(4)").addClass("hide");
                clean();
            }
        },
        error: function(xhr, status, error) {
            $('div#formulario_superusuario').modal('hide');
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema comunicándose con el servidor, por favor, trate nuevamente o recargue la página.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }

    })
}
