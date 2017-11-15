@extends('layouts.admin')

@section('main-body')
<style>
textarea {
	resize: none;
}
input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0px 1000px white inset !important;
}
</style>
<div class="" style="padding: 20px;">
	<div class="row">
		<div class="contactForm text-center">
			<h2 class='form-tittle'>{{isset($sendenboy) ? 'Editar ' : 'Registrar '}} sendenboy</h2>
		</div>
		<div class="loading text-center">
			<i class="fa fa-spinner fa-spin fa-5x" aria-hidden="true"></i>
		</div>
		<div class="col-sm-12 formulariosendenboy" style="display: none;">
			<form id="form_sendenboy" autocomplete="off" action="{{url('admin/sendenboys')}}/{{isset($sendenboy) ? 'update' : 'store'}}" enctype="multipart/form-data" method="POST">

				<div class="row">
					<div class="col-md-12 hide">
						<div class="form-group">
							<label for="">Id usuario</label>
							<input type="" value="{{ isset($sendenboy) ? $sendenboy->user_id : "" }}" name="user_id" class='form-control' id='user_id'>
						</div>
					</div>

					<div class="col-md-12 hide">
						<div class="form-group">
							<label for="">Id sendenboy</label>
							<input type="" value="{{ isset($sendenboy) ? $sendenboy->sendenboy_id : "" }}" name="sendenboy_id" class='form-control' id='sendenboy_id'>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="">Nombre</label>
							<input type="" maxlength="255" class="form-control" name="nombre_sendenboy" id="nombre_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->name : "" }}}">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="">Apellido</label>
							<input type="" maxlength="255" class="form-control" name="apellido_sendenboy" id="apellido_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->surname : "" }}}">
						</div>
					</div>

					<div class="col-md-6 hide">
						<div class="form-group">
							<label for="">Email viejo, no tocar si lo ves</label>
							<input type="" maxlength="190" class="form-control" name="email_sendenboy_old" id="email_sendenboy_old" value="{{{ isset($sendenboy) ? $sendenboy->email : "" }}}">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="">Email</label>
							<input type="" maxlength="190" class="form-control" name="email_sendenboy" id="email_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->email : "" }}}">
						</div>
					</div>

					<div class="col-md-6 hide">
						<div class="form-group">
							<label for="">Username viejo, no tocar si lo ves</label>
							<input type="" maxlength="190" class="form-control" name="username_sendenboy_old" id="username_sendenboy_old" {{-- {{isset($sendenboy) ? 'readonly' : ''}} --}} value="{{{ isset($sendenboy) ? $sendenboy->username : "" }}}">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="">Username</label>
							<input type="" maxlength="190" class="form-control" name="username_sendenboy" id="username_sendenboy" {{-- {{isset($sendenboy) ? 'readonly' : ''}} --}} value="{{{ isset($sendenboy) ? $sendenboy->username : "" }}}">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="">Contraseña</label>
							<input type="" maxlength="191" class="form-control" reference-data="pass" name="password_sendenboy" id="password_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->user_password : ""}}}">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="">Teléfono</label>
							<input type="" maxlength="190" class="form-control" name="telefono_sendenboy" id="telefono_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->phoneNumber : "" }}}">
						</div>
					</div>

					<div class="col-md-8">
						<div class="form-group">
							<label for="">Calle</label>
							<input type="" maxlength="190" class="form-control" name="calle_sendenboy" id="calle_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->street : "" }}}">
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="">Num. Ext.</label>
							<input type="" maxlength="10" class="form-control" name="ext_number_sendenboy" id="ext_number_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->ext_number : "" }}}">
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label for="">Num. Int.</label>
							<input type="" maxlength="10" class="form-control" name="int_number_sendenboy" id="int_number_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->int_number : "" }}}">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="">Municipio</label>
							<input type="" maxlength="100" class="form-control" name="municipio_sendenboy" id="municipio_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->municipality : "" }}}">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="">Estado</label>
							<input type="" maxlength="100" class="form-control" name="estado_sendenboy" id="estado_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->state : "" }}}">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="">Código Postal</label>
							<input type="" maxlength="6" class="form-control" name="codigo_postal_sendenboy" id="codigo_postal_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->postal_code : "" }}}">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="">Colonia</label>
							<input type="" maxlength="190" class="form-control" name="colonia_sendenboy" id="colonia_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->colony : "" }}}">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="">Banco</label>
							<input type="" maxlength="100" class="form-control" name="banco_sendenboy" id="banco_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->bank : "" }}}">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="">Clabe</label>
							<input type="" maxlength="18" class="form-control" name="clabe_sendenboy" id="clabe_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->clabe : "" }}}">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label>Vehiculo</label>
							<select class="form-control" name="vehiculo_id" id="vehiculo_id">
								<option value="0">Seleccione un vehiculo</option>
								@if(isset($sendenboy))
									@foreach($vehicles as $vehicle)
										@if($sendenboy->vehicle_id==$vehicle->id)
											<option selected="selected" value="{{$vehicle->id}}">{{ $vehicle->name }}</option>
										@else
											<option value="{{$vehicle->id}}">{{$vehicle->name}}</option>
										@endif
									@endforeach
								@else
									@foreach($vehicles as $vehicle)
										<option value="{{$vehicle->id}}">{{$vehicle->name}}</option>
		                        	@endforeach 
								@endif
							</select>
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="">Placa del vehículo</label>
							<input type="" maxlength="10" class="form-control" name="placa_vehiculo_sendenboy" id="placa_vehiculo_sendenboy" value="{{{ isset($sendenboy) ? $sendenboy->plate_number : "" }}}">
						</div>
					</div>

				</div>		

				<div class="alert alert-info alert-dismissible" role="alert">
			        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
			        <strong>Nota: </strong>Los archivos relacionados al sendenboy deben de ser formato jpg, jpeg, png o pdf y pesar menos de 5mb, solo la foto del conductor y del vehículo deben de ser imágenes y no archivos.<br>
			    </div>
	            <div class="row">
	            	<div class="col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>
                            	Cargar poliza de seguro <i class="fa fa-file-text" aria-hidden="true"></i>
                        		@if (isset($sendenboy))
	                            	@if (strpos($sendenboy->insurance_policy, 'pdf'))
	                            		<a href="{{url('')}}/{{$sendenboy->insurance_policy}}" target="_blank">(Ver archivo pdf)</a>
	                            	@elseif (strpos($sendenboy->insurance_policy, 'jpg') || strpos($sendenboy->insurance_policy, 'jpeg') || strpos($sendenboy->insurance_policy, 'png'))
										<a id="1" href="{{url('')}}/{{$sendenboy->insurance_policy}}" data-lightbox='roadtrip' data-title='Poliza de seguro'>
											(Ver imagen)
										</a>
	                            	@endif
                            	@endif
                            </label>
                            <input type="file" class="form-control" name="insurance_policy" id="insurance_policy">
                        </div>
                    </div>

                    <div class="col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>
                            	Cargar tarjeta de circulación <i class="fa fa-credit-card" aria-hidden="true"></i>
                        		@if (isset($sendenboy))
	                            	@if (strpos($sendenboy->circulation_card, 'pdf'))
	                            		<a href="{{url('')}}/{{$sendenboy->circulation_card}}" target="_blank">(Ver archivo pdf)</a>
	                            	@elseif (strpos($sendenboy->circulation_card, 'jpg') || strpos($sendenboy->circulation_card, 'jpeg') || strpos($sendenboy->circulation_card, 'png'))
										<a id="2" href="{{url('')}}/{{$sendenboy->circulation_card}}" data-lightbox='roadtrip' data-title='Tarjeta de circulación'>
											(Ver imagen)
										</a>
	                            	@endif
                            	@endif
                            </label>
                            <input type="file" class="form-control" name="circulation_card" id="circulation_card">
                        </div>
                    </div>

                    <div class="col-sm-4 col-xs-12">
                        <div class="form-group">
                            <label>
                            	Cargar licencia <i class="fa fa-credit-card" aria-hidden="true"></i>
                            	@if (isset($sendenboy))
	                            	@if (strpos($sendenboy->license, 'pdf'))
	                            		<a href="{{url('')}}/{{$sendenboy->license}}" target="_blank">(Ver archivo pdf)</a>
	                            	@elseif (strpos($sendenboy->license, 'jpg') || strpos($sendenboy->license, 'jpeg') || strpos($sendenboy->license, 'png'))
										<a id="1" href="{{url('')}}/{{$sendenboy->license}}" data-lightbox='roadtrip' data-title='Licencia'>
											(Ver imagen)
										</a>
	                            	@endif
                            	@endif
                            </label>
                            <input type="file" class="form-control" name="license" id="license">
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>
                            	Cargar foto del conductor. <i class="fa fa-picture-o" aria-hidden="true"></i>
                        		@if (isset($sendenboy))
	                            	@if (strpos($sendenboy->driver_photo, 'jpg') || strpos($sendenboy->driver_photo, 'jpeg') || strpos($sendenboy->driver_photo, 'png'))
										<a id="1" href="{{url('')}}/{{$sendenboy->driver_photo}}" data-lightbox='roadtrip' data-title='Foto del conductor'>
											(Ver imagen)
										</a>
	                            	@endif
                            	@endif
                            </label>
                            <input type="file" class="form-control" name="driver_photo" id="driver_photo">
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <label>
                            	Cargar foto del vehículo. <i class="fa fa-car" aria-hidden="true"></i>
                        		@if (isset($sendenboy))
	                            	@if (strpos($sendenboy->vehicle_photo, 'jpg') || strpos($sendenboy->vehicle_photo, 'jpeg') || strpos($sendenboy->vehicle_photo, 'png'))
										<a id="1" href="{{url('')}}/{{$sendenboy->vehicle_photo}}" data-lightbox='roadtrip' data-title='Foto del vehículo'>
											(Ver imagen)
										</a>
	                            	@endif
                            	@endif
                            </label>
                            <input type="file" class="form-control" name="vehicle_photo" id="vehicle_photo">
                        </div>
                    </div>

                </div>

				<input type="hidden" id="token" name="_token" value="{{csrf_token()}}">

				<button class="btn btn-primary" type="submit" name="guardar-sendenboy" value="submit" id="guardar-sendenboy">Guardar</button>
				<a href="{{url('admin/sendenboys')}}"><button class="btn btn-default" type="button" id="">Regresar</button></a>
			</form>
		</div>
	</div>
</div>
<script src="{{ asset('js/plugins/jquery-1.8.3.min.js') }}" type="text/javascript"></script> 
{{-- <script src="{{ asset('js/validacionesSendenboys.js') }}"></script> --}}
<script type="text/javascript">
	window.onload = function() {

		setTimeout(function(){
			//$("input[reference-data='pass']").get(0).type = 'password';
			//$('#password').replaceWith($('#password').clone().attr('type', 'text'));
	        $('div.loading').fadeOut('low');
	        $('div.formulariosendenboy').fadeIn('low');
	    }, 300)
		
		 /*Código para validar el formulario de datos del usuario*/
		var inputs = [];
		mb = 0;
		fileExtension = ['jpg', 'jpeg', 'png', 'pdf'];//Mix
		fileExtensionImg = ['jpg', 'jpeg', 'png'];//Only Images
		var msgError = '';
		var regExprTexto = /^[a-z ñ # , : ; ¿ ? ! ¡ ' " _ @ ( ) áéíóúäëïöüâêîôûàèìòùç\d_\s \-.]{2,}$/i;
		var regExprTel = /^[( ) + \d_\s \-]{6,20}$/i;
		var regExprUser = /^[a-z ñ áéíóúäëïöüâêîôûàèìòùç\d_ .]{5,20}$/i;
		var regExprEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
		var regExprNum = /^[\d .]{1,}$/i;
		var regExprNumNotReq = /^[\d .]{0,}$/i;
		var btn_enviar_producto = $("#guardar-sendenboy");
		$("#guardar-sendenboy").on('click', function() {
		    inputs = [];
		    msgError = '';

		    validarInput($('input#nombre_sendenboy'), regExprTexto) == false ? inputs.push('Nombre sendenboy') : ''
		    validarInput($('input#apellido_sendenboy'), regExprTexto) == false ? inputs.push('\nApellido sendenboy') : ''
		    validarInput($('input#username_sendenboy'), regExprTexto) == false ? inputs.push('\nUsername') : ''
		    validarInput($('input#email_sendenboy'), regExprEmail) == false ? inputs.push('\nCorreo') : ''
		    validarInput($('input#password_sendenboy'), regExprTexto) == false ? inputs.push('\nContraseña') : ''
		    validarInput($('input#calle_sendenboy'), regExprTexto) == false ? inputs.push('\nCalle') : ''
		    validarInput($('input#telefono_sendenboy'), regExprTel) == false ? inputs.push('\nTeléfono') : ''
		    validarInput($('input#ext_number_sendenboy'), regExprNum) == false ? inputs.push('\nNúmero Exterior') : ''
		    validarInput($('input#int_number_sendenboy'), regExprNumNotReq) == false ? inputs.push('\nNúmero Interior') : ''
		    validarInput($('input#municipio_sendenboy'), regExprTexto) == false ? inputs.push('\nMunicipio') : ''
		    validarInput($('input#estado_sendenboy'), regExprTexto) == false ? inputs.push('\nEstado') : ''
		    validarInput($('input#codigo_postal_sendenboy'), regExprNum) == false ? inputs.push('\nCódigo Postal') : ''
		    validarInput($('input#colonia_sendenboy'), regExprTexto) == false ? inputs.push('\nColonia') : ''
		    validarInput($('input#banco_sendenboy'), regExprTexto) == false ? inputs.push('\nBanco') : ''
		    validarInput($('input#clabe_sendenboy'), regExprNum) == false ? inputs.push('\nClabe') : ''
		    validarSelect($('select#vehiculo_id')) == false ? inputs.push('\nVehículo') : ''
		    validarInput($('input#placa_vehiculo_sendenboy'), regExprTexto) == false ? inputs.push('\nPlaca') : ''
		    validarArchivo($('input#insurance_policy')) == false ? inputs.push('\nPoliza de seguro') : ''
		    /*validarArchivo($('input#insurance_policy'));*/
		    validarArchivo($('input#circulation_card')) == false ? inputs.push('\nTarjeta de circulación') : ''
		    validarArchivo($('input#license')) == false ? inputs.push('\nLicencia') : ''
		    validarArchivo2($('input#driver_photo')) == false ? inputs.push('\nFoto del conductor') : ''
		    validarArchivo2($('input#vehicle_photo')) == false ? inputs.push('\nFoto del vehículo') : ''
		    
		    if (inputs.length == 0) {
		        $('#guardar-sendenboy').hide();
		        $('#guardar-sendenboy').submit();
		    } else {
		        $('#guardar-sendenboy').show();
		        swal("Corrija los siguientes campos para continuar: ", inputs);
		        return false;
		    }
		});


		$( "input#nombre_sendenboy" ).blur(function() {
		    validarInput($(this), regExprTexto);
		});
		$( "input#apellido_sendenboy" ).blur(function() {
		    validarInput($(this), regExprTexto);
		});
		$( "input#email_sendenboy" ).blur(function() {
		    validarInput($(this), regExprEmail);
		});
		$( "input#username_sendenboy" ).blur(function() {
		    validarInput($(this), regExprTexto);
		});
		$( "input#password_sendenboy" ).blur(function() {
		    validarInput($(this), regExprTexto);
		});
		$( "input#calle_sendenboy" ).blur(function() {
		    validarInput($(this), regExprTexto);
		});
		$( "input#telefono_sendenboy" ).blur(function() {
		    validarInput($(this), regExprTel);
		});
		$( "input#ext_number_sendenboy" ).blur(function() {
		    validarInput($(this), regExprNum);
		});
		$( "input#int_number_sendenboy" ).blur(function() {
		    validarInput($(this), regExprNumNotReq);
		});
		$( "input#municipio_sendenboy" ).blur(function() {
		    validarInput($(this), regExprTexto);
		});
		$( "input#estado_sendenboy" ).blur(function() {
		    validarInput($(this), regExprTexto);
		});
		$( "input#codigo_postal_sendenboy" ).blur(function() {
		    validarInput($(this), regExprNum);
		});
		$( "input#colonia_sendenboy" ).blur(function() {
		    validarInput($(this), regExprTexto);
		});
		$( "input#banco_sendenboy" ).blur(function() {
		    validarInput($(this), regExprTexto);
		});
		$( "input#clabe_sendenboy" ).blur(function() {
		    validarInput($(this), regExprNum);
		});
		$( "select#vehiculo_id" ).change(function() {
		    validarSelect($(this));
		});
		$( "input#placa_vehiculo_sendenboy" ).blur(function() {
		    validarInput($(this), regExprTexto);
		});


		function validarInput (campo,regExpr) {
			if (!$(campo).val().match(regExpr)) {
		        $(campo).parent().addClass("has-error");
		        msgError = msgError + $(campo).parent().children('label').text() + '\n';
		        return false;
		    } else {
		        $(campo).parent().removeClass("has-error");
		        return true;
		    }
		}

		function validarSelect (select) {
		    if ($(select).val() == '0' || $(select).val() == '' || $(select).val() == null) {
		        $(select).parent().addClass("has-error");
		        msgError = msgError + $(select).parent().children('label').text() + '\n';
		        return false;
		    } else {
		        $(select).parent().removeClass("has-error");
		        return true;
		    }
		}

		$('input#insurance_policy, input#circulation_card , input#license').bind('change', function() {
		    if ($(this).val() != '') {
		        checkInfoFile($(this), fileExtension, true);
		    }
		});

		$('input#driver_photo, input#vehicle_photo').bind('change', function() {
		    if ($(this).val() != '') {
		        checkInfoFile($(this), fileExtensionImg, false);
		    }
		});

		function validarArchivo(campo) {
			/*Si el campo está vacío y es un edit entonces está correcto*/
			if ($('form#form_sendenboy input#user_id').val() != '' && ($(campo).val() == '' || $(campo).val() == null)) {
		        return true;
		    }
		    else if ($('form#form_sendenboy input#user_id').val() == '' && ($(campo).val() == '' || $(campo).val() == null)) {
		    	$(campo).parent().addClass("has-error");
		        msgError = msgError + $(campo).parent().children('label').text() + '\n';
		        return false;
		    }
			else if (($('form#form_sendenboy input#user_id').val() == '' || $('form#form_sendenboy input#user_id').val() != '') && $(campo).val() != '') {
				console.info(campo[0].files[0].size);
			    var archivo = $(campo).val();
			    var extension = archivo.split('.').pop().toLowerCase();
			    var kilobyte = (campo[0].files[0].size / 1024);
		        var mb = kilobyte / 1024;
	        	if ($.inArray(extension, fileExtension) == -1 || mb >= 5) {
	        		$(campo).parent().addClass("has-error");
			        msgError = msgError + $(campo).parent().children('label').text() + '\n';
			    }
			    else {
					$(campo).parent().removeClass("has-error")
			    }
		        return $.inArray(extension, fileExtension) == -1 || mb >= 5 ? false : true;
			}
			console.warn('no debió llegar hasta aquí');
			return false;
		}

		function validarArchivo2(campo) {
			/*Si el campo está vacío y es un edit entonces está correcto*/
			if ($('form#form_sendenboy input#user_id').val() != '' && ($(campo).val() == '' || $(campo).val() == null)) {
		        return true;
		    }
		    else if ($('form#form_sendenboy input#user_id').val() == '' && ($(campo).val() == '' || $(campo).val() == null)) {
		    	$(campo).parent().addClass("has-error");
		        msgError = msgError + $(campo).parent().children('label').text() + '\n';
		        return false;
		    }
			else if (($('form#form_sendenboy input#user_id').val() == '' || $('form#form_sendenboy input#user_id').val() != '') && $(campo).val() != '') {
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

		function checkInfoFile(campo, extensions_permited, pdf) {
			console.info(campo[0].files[0].size)
			var kilobyte = (campo[0].files[0].size / 1024);
	        var mb = kilobyte / 1024;

	        var archivo = $(campo).val();
	        var extension = archivo.split('.').pop().toLowerCase();

	        if ($.inArray(extension, extensions_permited) == -1 || mb >= 5) {
	            swal({
	                title: "Archivo no válido",
	                text: "Debe seleccionar una imágen con formato jpg, jpeg, png" + (pdf ? " o pdf " : " ") +  "y debe pesar menos de 5MB",
	                type: "error",
	                closeOnConfirm: false
	            });
	            $(campo).parent().addClass("has-error");
			    msgError = msgError + $(campo).parent().children('label').text() + '\n';
	            return false;
	        } else {
				$(campo).parent().removeClass("has-error")
	        	return true;
	        }
		}
		/*Fin de código para validar el formulario de datos del usuario*/
	};
</script>
@endsection