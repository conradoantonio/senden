function cambiarStatusSendenshop(id,status,token,url) {
    url = url.concat('/admin/users/sendenshop/change_status');
    $.ajax({
        method: "POST",
        type:"POST",
        url: url,
        data:{
            "id":id,
            "status":status,
            "_token":token
        },
        success: function(response) {
            console.info(response);
            swal({
                title: "Cambios realizados exitosamente, esta página necesita recargarse ahora mismo.",
                type: "success",
                showConfirmButton: false,
            }, 
                function() {
                    location.reload();
                }
            );
            setTimeout("location.reload()",1200);

            /*var buttons_table = "<button type='button' class='btn btn-info editar_business_user'>Editar</button> " +
                                "<button type='button' class='btn btn-danger eliminar_business_user'>Borrar</button>";
            var oTable = $('#example3').dataTable();
            oTable.fnClearTable();
            $.each(response,function(i,e) {
                if ( response.length > 0 ) {
                    var user_type = (e.user_type_id == 4 ? "<span class='badge badge-info'>"+ e.tipo_usuario +"</span>" :
                                    (e.user_type_id == 3 ? "<span class='badge badge-success'>Administrador de negocio</span>" : 
                                                           "<span class='badge'>"+e.tipo_usuario+"</span>"));

                    oTable.dataTable().fnAddData( 
                    [
                        e.id,
                        e.name,
                        e.email,
                        e.user_type_id,
                        user_type,
                        e.status,
                        buttons_table
                    ] );   
                }
            })
            $("table tbody tr td:nth-child(5), table tbody tr td:nth-child(6)").addClass("hide");*/
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema realizando cambios al usuario, porfavor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}
