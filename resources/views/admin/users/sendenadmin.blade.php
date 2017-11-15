@extends('layouts.admin')

@section('main-body')
<link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('js/plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
/*table#example3 th {
    text-align: center!important;
}*/
/* Change the white to any color ;) */
input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0px 1000px white inset !important;
}
</style>
<div class="text-center" style="margin: 20px;">
	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_form_superusuario" id="formulario_superusuario">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="titulo_form_superusuario">Nuevo Superusuario</h4>
                </div>
                <form id="form_superusuario" action="" onsubmit="return false;" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="{{url('')}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID</label>
                                    <input type="text" class="form-control" id="id" name="id">
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nombre del usuario">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input type="password" min="0" class="form-control" id="password" name="password" placeholder="Contraseña">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar_superusuario">Guardar</button>
                        <button type="button" class="btn btn-default" id="close_modal" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
    <div class="alert alert-danger alert-dismissible hide" role="alert" id="alerta_email_repetido">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <strong>¡Error guardando el usuario!</strong> El correo especificado no es válido ya que se encuentra ocupado, trate con uno distinto.
    </div>

    <h2>Lista de usuarios administradores (Senden)</h2>
    <div class="row-fluid " style="display: none;" id="table_containter">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <h4>Opciones <span class="semi-bold">adicionales</span></h4>
                    <div>
                        <button type="button" class="btn btn-primary agregar_superuser"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
                    </div>
                    <div class="grid-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="example3">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">Name</th>
                                        <th style="text-align: center;">Email</th>
                                        <th class="hide" style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($users) > 0)
                                        @foreach($users as $user)
                                            <tr class="" id="{{$user->id}}">
                                                <td>{{$user->id}}</td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td class="hide">{{$user->status}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info editar_superadmin">Editar</button>
                                                    <button type="button" class="btn btn-danger eliminar_superadmin">Borrar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    {{-- @else
                                        <td colspan="4">No hay más usuarios administradores autorizados a usar el sistema.</td> --}}
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/plugins/jquery-1.8.3.min.js') }}" type="text/javascript"></script> 
<script src="{{ asset('js/userSuperAdminAjax.js') }}" type="text/javascript"></script> 
<script src="{{ asset('js/validacionesUserSuperAdmin.js') }}" type="text/javascript"></script> 

<script type="text/javascript">
$(function(){
    setTimeout(function(){
        $('div#table_containter').fadeIn('low');
    }, 500);
})

$('#formulario_superusuario').on('hidden.bs.modal', function (e) {
    $('#formulario_superusuario div.form-group').removeClass('has-error');
    $('input.form-control, textarea.form-control').val('');
    $('body').removeClass('modal-open');
	$('.modal-backdrop').remove();
});

$('#formulario_superusuario').on('shown.bs.modal', function () {
    
});

$('body').delegate('.agregar_superuser','click', function() {
	$('#formulario_superusuario div.form-group').removeClass('has-error');
	$("#formulario_superusuario input#email").attr("disabled", false);

	$('#formulario_superusuario').modal({
		backdrop: false
	});

	$('button#guardar_superusuario').show();
    $("form#form_superusuario").get(0).setAttribute('action', "{{url('')}}"+'/admin/users/save_super_user');
    $('input.form-control').val('');
    $("h4#titulo_form_superusuario").text('Agregar superusuario');
});

$('body').delegate('.editar_superadmin','click', function() {
	$('#formulario_superusuario div.form-group').removeClass('has-error');
	$("#formulario_superusuario input#email").attr("disabled", true);

	$('button#guardar_superusuario').show();
    $('input.form-control').val('');
    id = $(this).parent().siblings("td:nth-child(1)").text(),
    name = $(this).parent().siblings("td:nth-child(2)").text(),
    email = $(this).parent().siblings("td:nth-child(3)").text();

    $("form#form_superusuario").get(0).setAttribute('action', "{{url('')}}"+'/admin/users/edit_super_user');
    $("h4#titulo_form_superusuario").text('Editar superusuario');
    $("#formulario_superusuario input#id").val(id);
    $("#formulario_superusuario input#name").val(name);
    $("#formulario_superusuario input#email").val(email);

    $('#formulario_superusuario').modal({
		backdrop: false
	});
});

$('body').delegate('.eliminar_superadmin','click', function() {
    var codigo = $(this).parent().siblings("td:nth-child(2)").text();
    var token = $("#token").val();
    var id = $(this).parent().siblings("td:nth-child(1)").text();

    swal({
        title: "¿Realmente desea eliminar al usuario <span style='color:#F8BB86'>" + codigo + "</span>?",
        text: "Este usuario ya no será capaz de loguearse al sistema, ¡Cuidado!",
        html: true,
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Si, continuar",
        showLoaderOnConfirm: true,
        allowEscapeKey: true,
        allowOutsideClick: true,
        closeOnConfirm: false
    },
    function() {
        banSuperAdmin(id,token);
    });
});

function clean() {
    $('form input, form select, form textarea').each(function() {
        if($(this).attr('name') != '_token') {
            $(this).val("");
        }
    })
}
</script>
@endsection