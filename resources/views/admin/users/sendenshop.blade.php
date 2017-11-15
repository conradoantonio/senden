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

    
    {{-- <div class="alert alert-danger alert-dismissible hide" role="alert" id="alerta_email_repetido">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        <strong>¡Error guardando el usuario!</strong> El correo especificado no es válido ya que se encuentra ocupado, trate con uno distinto.
    </div> --}}

    <h2>Lista de usuarios sendenshop de la aplicación</h2>
    <div class="row-fluid " style="display: none;" id="table_containter">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    {{-- <h4>Opciones <span class="semi-bold">adicionales</span></h4>
                    <div>
                        <button type="button" class="btn btn-primary agregar_superuser"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>
                    </div> --}}
                    <div class="grid-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="example3">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">Nombre</th>
                                        <th style="text-align: center;">Email</th>
                                        <th style="text-align: center;">Username</th>
                                        <th style="text-align: center;">Status</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($users) > 0)
                                        @foreach($users as $user)
                                            <tr class="" id="{{$user->id}}">
                                                <td>{{$user->id}}</td>
                                                <td>{{$user->name}} {{$user->surname}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->username}}</td>
                                                <td>
                                                    {!!
                                                        ($user->status == 1 ? "<span class='label label-success'>Activo</span>" : 
                                                            ($user->status == 2 ? "<span class='label label-important'>Bloqueado</span>" : "<span class='label label-warning'>Desconocido</span>"
                                                            )
                                                        )
                                                    !!}
                                                </td>
                                                <td>
                                                    {!!
                                                        ($user->status == 1 ? "<button type='button' change-to='2' class='btn btn-warning bloquear_usuario'><i class='fa fa-ban' aria-hidden='true'></i> Bloquear</button>" : 
                                                            ($user->status == 2 ? "<button type='button' change-to='1' class='btn btn-success reactivar_usuario'><i class='fa fa-check' aria-hidden='true'></i> Reactivar</button>" : ""
                                                            )
                                                        )
                                                    !!}
                                                    <button type='button' change-to="0" class='btn btn-danger borrar_usuario'><i class='fa fa-trash' aria-hidden='true'></i> Borrar</button>
                                                </td>
                                            </tr>
                                        @endforeach
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
<script src="{{ asset('js/userSendenshopAjax.js') }}" type="text/javascript"></script> 

<script type="text/javascript">
$(function(){
    setTimeout(function(){
        $('div#table_containter').fadeIn('low');
    }, 500);
})

$('body').delegate('.bloquear_usuario, .reactivar_usuario, .borrar_usuario','click', function() {
    var usuario = $(this).parent().siblings("td:nth-child(2)").text();
    var status = $(this).attr("change-to");
    var token = $("#token").val();
    var id = $(this).parent().siblings("td:nth-child(1)").text();
    var url = "{{url('')}}";
    var mensajeStatus = status == '1' ? 'reactivar' : status == '2' ? 'bloquear' : status == '0' ? 'Eliminar' : 'Desconocido'

    swal({
        title: "¿Realmente desea <span style='color:#AEDEF4'>" + mensajeStatus + "</span> al usuario " + "<span style='color:#F8BB86'>" + usuario + "</span>?",
        text: "¡Cuidado!",
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
        cambiarStatusSendenshop(id,status,token,url);
    });
});
</script>
@endsection