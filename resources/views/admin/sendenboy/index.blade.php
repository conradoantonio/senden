@extends('layouts.admin')

@section('main-body')
<link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('js/plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
/*table#example3 th {
    text-align: center!important;
}*/
</style>
<div class="text-center" style="margin: 20px;">
    @if(isset($_GET['valido']) && $_GET['valido'] == md5('false'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <strong>¡Error guardando el sendenboy!</strong> El correo o nombre de usuario especificado no es válido ya que se encuentra ocupado, trate con uno distinto.
        </div>
    @endif
    <h2>Lista de sendenboys</h2>
    {{ csrf_field() }}
    <div class="row-fluid " style="display: none;" id="table_containter">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <h4>Opciones <span class="semi-bold">adicionales</span></h4>
                    <div>
                        <a href="{{url('')}}/admin/sendenboys/form_sendenboy"><button type="button" class="btn btn-primary" id="nuevo_sendenboy"><i class="fa fa-plus" aria-hidden="true"></i> Registrar sendenboy</button></a>
                    </div>
                    <div class="grid-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="example3">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">Sendenboy</th>
                                        <th style="text-align: center;">Email</th>
                                        {{-- <th style="text-align: center;">Vehiculo</th>
                                        <th style="text-align: center;">Placas</th> --}}
                                        <th style="text-align: center;">Banco</th>
                                        <th style="text-align: center;">Clabe</th>
                                        <th style="text-align: center;">Foto</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($sendenboys) > 0)
                                        @foreach($sendenboys as $sendenboy)
                                            <tr class="" id="{{$sendenboy->user_id}}">
                                                <td>{{$sendenboy->sendenboy_id}}</td>
                                                <td>{{$sendenboy->name}}</td>
                                                <td>{{$sendenboy->email}}</td>
                                                {{-- <td>{{$sendenboy->vehicle}}</td>
                                                <td>{{$sendenboy->plate_number}}</td> --}}
                                                <td>{{$sendenboy->bank}}</td>
                                                <td>{{$sendenboy->clabe}}</td>
                                                <td><img style="max-width: 60px;" src="{{url('')}}/{{$sendenboy->driver_photo}}"></td>
                                                <td>
                                                    <a href="{{url('')}}/admin/sendenboys/form_sendenboy/{{$sendenboy->sendenboy_id}}"><button type="button" class="btn btn-info editar_sendenboy"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</button></a>
                                                    <button type="button" class="btn btn-danger eliminar_sendenboy"><i class="fa fa-times" aria-hidden="true"></i> Borrar</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td colspan="7">No hay sendenboys registrados en el sistema</td>
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
{{-- <script type="text/javascript" charset="utf8" src="//code.jquery.com/jquery-1.10.2.min.js"></script> --}}

<script type="text/javascript">
$(function(){
    setTimeout(function(){
        $('div#table_containter').fadeIn('low');
    }, 500)
})

$('body').delegate('.eliminar_sendenboy','click', function() {
    var nombre = $(this).parent().siblings("td:nth-child(2)").text();
    var token = $('meta[name="csrf-token"]').attr('content')
    var user_id = $(this).parent().parent().attr('id');

    swal({
        title: "¿Realmente desea eliminar al sendenboy <span style='color:#F8BB86'>" + nombre + "</span>?",
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
        eliminarSendenboy(user_id,token);
    });
});

function eliminarSendenboy(user_id,token) {
    base_url = "{{url('')}}";
    url = base_url.concat('/admin/sendenboys/change_status');
    $.ajax({
        method: "POST",
        type:"POST",
        url: url,
        data:{
            "user_id":user_id,
            "_token":token
        },
        success: function(response) {
            console.info(response);
            swal({
                title: "Sendenboy dado de baja correctamente, esta página se recargará ahora.",
                type: "success",
                showConfirmButton: false,
            }, 
            function() {
                location.reload();
            });
            setTimeout("location.reload()",1200);
            
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un problema dando de baja este usuario, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}
</script>
@endsection