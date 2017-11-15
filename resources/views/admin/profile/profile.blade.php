@extends('layouts.admin')
<style>
    span.label_show{display: block;font-weight: bold;}
    span.label_show span{font-weight: normal;}
</style>
@section('main-body')

<div class="table-responsive" id="profile">

	<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_form_superusuario" id="formulario_usuario">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content text-center">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="titulo_form_superusuario">Editar mi usuario</h4>
                </div>
                <form id="form_usuario" action="{{url('admin/my_info/edit')}}" enctype="multipart/form-data" method="POST" autocomplete="off">
                    <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="{{url('')}}">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID usuario</label>
                                    <input type="text" class="form-control" id="id" name="id">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12 hidden">
                                <div class="form-group">
                                    <label for="id">ID negocio</label>
                                    <input type="text" class="form-control" id="idBusiness" name="idBusiness">
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
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label for="photo">Foto de pérfil</label>
                                    <input type="file" class="form-control" id="photo" name="photo" placeholder="Contraseña">
                                </div>
                            </div>
                            <div class="col-sm-6 col-xs-12">
                            	<label>Abierto</label>
			                    <div class="checkbox check-success">
									<input id="is_open" name="is_open" type="checkbox" class="checkIsOpen"> 
									<label for="is_open"></label>
								</div>
							</div>
                        </div>
                        <div class="row" id="foto_usuario">
                            <div class="col-sm-6 col-xs-12">
                                <div class="form-group">
                                    <label>Foto actual</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="guardar_usuario">Guardar</button>
                        <button type="button" class="btn btn-default" id="close_modal" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	
	<h2 class="text-center">Mi perfil</h2>

	<div class="row-fluid">
		<div class="grid simple">
			<div class="grid-title">
				<div class="text-center">
                	<button type="button" class="btn btn-primary editar_usuario"><i class="fa fa-plus" aria-hidden="true"></i> Editar mi usuario</button>
				</div>

				<div class="grid-body">
					<ul class="list-group">
	                    <li class="list-group-item active">Datos generales del negocio</li>
	                    <li class="list-group-item">
	                        <span class="label_show">Id negocio: <span id="negocio_id">{{$user_data->idBusiness}}</span></span>
	                    </li>
	                    <li class="list-group-item">
	                        <span class="label_show">Abierto: <span id="negocio_is_open">{{$user_data->isOpen == 1 ? "Si" : "No"}}</span></span>
	                    </li>
	                    <li class="list-group-item">
	                        <span class="label_show">Nombre comercial: <span>{{$user_data->business_name}}</span></span>
	                    </li>
	                    <li class="list-group-item">
	                        <span class="label_show">Dirección: <span>{{$user_data->street}} #{{$user_data->ext_number}}, {{$user_data->colony}} C.P. {{$user_data->postal_code}}</span></span>
	                    </li>
	                    <li class="list-group-item">
	                        <span class="label_show">Lugar: <span>{{$user_data->city}}, {{$user_data->state}}.</span></span>
	                    </li>
	                    <li class="list-group-item">
	                        <span class="label_show">Teléfono: <span>{{$user_data->phone}}</span></span>
	                    </li>
	                    <li class="list-group-item">
	                        <span class="label_show">Fecha de ingreso: <span>{{date("d/m/Y", strtotime($user_data->created_at))}}</span></span>
	                    </li>
	                </ul>
	                <ul class="list-group">
	                    <li class="list-group-item active">Información del usuario</li>
	                    <li class="list-group-item">
	                        <span class="label_show">Id usuario: <span id="usuario_id">{{$user_data->idUser}}</span></span>
	                    </li>
	                    <li class="list-group-item">
	                        <span class="label_show">Nombre: <span id="usuario_nombre">{{$user_data->name}}</span></span>
	                    </li>
	                    <li class="list-group-item">
	                        <span class="label_show">Correo: <span id="usuario_email">{{$user_data->email}}</span></span>
	                    </li>
	                    <li class="list-group-item">
	                        <span class="label_show">Tipo de usuario: <span>{{$user_data->type_name}}</span></span>
	                    </li>
	                    <li class="list-group-item hide">
	                        <span class="label_show">Ruta de foto del usuario: <span id="usuario_foto">{{$user_data->photo}}</span></span>
	                    </li>
	                    <li class="list-group-item">
	                        <span class="label_show">Num. Contrato: <span>{{$user_data->contract_number}}</span></span>
	                    </li>
	                </ul>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="{{ asset('js/plugins/jquery-1.8.3.min.js') }}" type="text/javascript"></script> 
<script src="{{ asset('js/validacionesMyInfoBusiness.js') }}" type="text/javascript"></script> 

<script type="text/javascript">
	$('body').delegate('.editar_usuario','click', function() {
	    $('input#is_open').prop('checked', false );

		$('#form_usuario div.form-group').removeClass('has-error');
		$("#form_usuario input#email").attr("disabled", true);

		$('button#guardar_superusuario').show();
	    $('input.form-control').val('');

	    usuario_id = $('span#usuario_id').text(),
	    usuario_nombre = $('span#usuario_nombre').text(),
	    usuario_email = $('span#usuario_email').text(),
	    usuario_foto = $('span#usuario_foto').text(),
	    negocio_id = $('span#negocio_id').text();
	    negocio_is_open = $('span#negocio_is_open').text();
	    console.log(negocio_is_open);
	    if (negocio_is_open == 'No') {
    		$('input#is_open').prop('checked', false );
	    } else if(negocio_is_open == 'Si') {
    		$('input#is_open').prop('checked', 'checked');
	    }

	    $('div#foto_usuario').children().children().children().remove('img#foto_usuario');
	    $('div#foto_usuario').children().children().append(
	        "<img src={{url('')}}/"+usuario_foto+ " class='img-responsive img-thumbnail' alt='Responsive image' id='foto_usuario'>"
	    );
	    $("div#foto_usuario").show();

	    $("#form_usuario input#id").val(usuario_id);
	    $("#form_usuario input#idBusiness").val(negocio_id);
	    $("#form_usuario input#name").val(usuario_nombre);
	    $("#form_usuario input#email").val(usuario_email);

	    $('#formulario_usuario').modal({
			backdrop: false
		});
	});
</script>

@endsection