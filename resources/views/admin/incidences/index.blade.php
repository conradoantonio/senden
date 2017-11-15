@extends('layouts.admin')
<script type="text/javascript">
	window.onload = function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).delegate('.btn_detalles','click',function(){
			$.ajax({
				url:$(this).data('url'),
				type:'GET',
				success:function(response){
					response = $.parseJSON(response);
					$('#productos tbody tr').remove();
					$.each(response,function(i,e){
						$('#productos tbody').append(
							"<tr>"+
						    	"<td>"+e.product_id+"</td>"+
						    	"<td>"+e.product+"</td>"+
						    	"<td>"+e.quantity+"</td>"+
						    	"<td>"+e.price+"</td>"+
						    "</tr>")
					})

					$('.modal-body').find('span#negocio').text(response[0]['tradename']);
					$('.modal-body').find('span#fecha_creacion').text(response[0]['fecha_creacion']);
					$('.modal-body').find('span#tipo_incidencia').text(response[0]['tipo']);
					$('.modal-body').find('span#numero_orden').text(response[0]['order_number']);
					$('.modal-body').find('p').text(response[0]['description']);
					$('.modal-body').find('span#span2').text(response[0]['sendenboy']);
					$('.modal-body').find('span#span3').text(response[0]['order_number']);
					
					var domicilio = response[0]['street']+" "+response[0]['int_number']+" "+response[0]['colony']+", "+response[0]['city']+", "+response[0]['state'];
					var domicilio_bus = response[0]['bus_calle']+" "+response[0]['bus_numext']+" "+response[0]['bus_colonia']+", "+response[0]['bus_ciudad']+", "+response[0]['bus_estado'];
					
					$('.modal-body').find('span#span4').text(domicilio);
					$('.modal-body').find('span#span13').text(response[0]['cliente']);
					$('.modal-body').find('span#span14').text(response[0]['sb_email']);

					$('.modal-body').find('span#span15').text(response[0]['negocio']);
					$('.modal-body').find('span#span16').text(domicilio_bus);
				}
			})
		})

		var url_save = '';
		var id = '';
		$('.btn_soluciones').on('click',function(){
			if ( $(this).data('solution') === null || parseInt($(this).data('solution')) == 0 || $(this).data('solution') == '' ){
				$("#soluciones").val(0);
			} else{
				$("#soluciones").val($(this).data('solution'));
			} 	
			url_save = $(this).data('url');
			id = $(this).data('id');
		})

		$('#modal_solucion, #modal_new, #modal_detalles').on('hidden.bs.modal', function (e) {
			console.log('entro');
			$('body').removeClass('modal-open');
			$('.modal-backdrop').remove();
		})

		$(document).delegate('#guardar_solucion','click',function(){
			if ( validForm($(this).parent().parent().find('form').attr('id')) ) {
				url_save = url_save.split('?')[0];
				$.ajax({
					url:url_save,
					type: "POST",
					data:{
						'id' : id,
						'solution_id' : $("#soluciones").val(),
						'observation' : $("#observation").val(),
					},
					success:function(response){
						refreshTable();
						$("#modal_solucion").modal('hide')
						$('body').removeClass('modal-open');
						$('.modal-backdrop').remove();
					}
				})
			}
		})

		$(document).delegate('#guardar_incidencia','click',function(){
			if ( validForm($(this).parent().parent().find('form').attr('id')) ) {
				$.ajax({
					url:"{{URL::to('/admin/incidencias/store')}}",
					type: "POST",
					data:{
						'order_number': $("#order_number").val(),
						'incidence_type_id' : $("#incidence_type").val(),
						'description' : $("#description").val(),
					},
					success:function(response){
						$("form input").each(function(){
								$(this).val("");
							});
							refreshTable();
						$("#modal_new").modal('hide')
						$('body').removeClass('modal-open');
						$('.modal-backdrop').remove();
					}
				})
			}
		})
	}

	function validForm(id){
		var errors_count = 0;
		var msg = "";
		$("form#"+id+" input, form#"+id+" select, form#"+id+" textarea").each(function(i,e){
			if ( $(this).hasClass('not-empty') ) {
				if ( $(this).val() == "" || $(this).val() == 0 ){
					$(this).parent().addClass('has-error')
					errors_count += 1;
					msg = msg +"<li>"+$(this).data('name')+"</li>";
				} else {
					$(this).parent().removeClass('has-error')
				}
			}
		})

		if ( errors_count > 0 ) {
			swal({
				title: 'Corrija los siguientes campos para continuar: ',
				type: 'error',
				text: "<ul id='errores_list'>"+msg+"</ul>",
				html:true,
				timer: 4500,
				showCloseButton: true,
				confirmButtonText: 'Aceptar',
			});
	        return false;
		} else {
			return true;
		}
	}

	function refreshTable(){
		$('#incidences_table').fadeOut();
		$('#incidences_table').load("{{ URL::to('/admin/incidencias') }}", function() {
			$('#incidences_table').fadeIn();
		});
	}
</script>
<style>
	span#label_fecha, span#label_tipo, span#label_numero_orden, #label_negocio{
		display: block;
	}
	textarea {
		resize: none;
	}
</style>
@section('main-body')
	<link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
	<link rel="stylesheet" href="{{ asset('js/plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
	
	<div class="modal fade" id="modal_solucion" tabindex="-1" role="dialog" aria-labelledby="modal_solucionLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal_solucionLabel">Agregar solución a la incidencia</h4>
				</div>
				<div class="modal-body">
					<form onsubmit="false" id="save_solution">
						<div class="form-group">
							<select name="solution_id" id="soluciones" class="not-empty" data-name="Solución">
								<option value="">Seleccione una solución</option>
								@foreach($solutions as $solution)
									<option value="{{$solution->id}}">{{$solution->name}}</option>
								@endforeach
							</select>
						</div>
						<textarea class="form-control not-empty" rows="3" id="observation" data-name="Observación"></textarea>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="guardar_solucion">Guardar</button>	
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>

	
	<div class="modal fade" id="modal_new" tabindex="-1" role="dialog" aria-labelledby="modal_newLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal_newnLabel">Agregar nueva incidencia</h4>
				</div>
				<div class="modal-body">
					<form onsubmit="false" id="save_incidence">
						<div class="form-group">
							<label>Número de orden</label>
							<input type="text" name="numero_orden" id="order_number" class="not-empty" data-name="Número de orden">
						</div>
						<div class="form-group">
							<label>Tipo de incidencia</label>
							<select name='tipo' id='incidence_type' class="not-empty" data-name="Tipo incidencia">
								<option value="0">Seleccione un tipo</option>
								@foreach($tipo_incidencia as $type)
									<option value="{{$type->id}}">{{$type->name}}</option>
								@endforeach
							</select>
						</div>
						<label>Descripcion</label>
						<textarea class="form-control not-empty" rows="3" id="description" data-name="Observaciones"></textarea>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="guardar_incidencia">Guardar</button>	
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>

	<h2 class="text-center">Lista de incidencias</h2>
	
	<div class="modal fade" id="modal_detalles" tabindex="-1" role="dialog" aria-labelledby="modal_detallesLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal_detallesLabel">Detalles de la incidencia</h4>
				</div>
				<div class="modal-body">
					<ul class="list-group">
						<li class="list-group-item active">Datos de la incidencia</li>
						<li class="list-group-item"><span id="label_tipo">Tipo incidencia: <span id="tipo_incidencia"></span></span></li>
						<li class="list-group-item"><span id="label_numero_orden">Número de orden: <span id="numero_orden"></span></span></li>
						<li class="list-group-item"><span id="label_fecha">Creada el: <span id='fecha_creacion'></span></span></li>
					</ul>

					<ul class="list-group">
						<li class="list-group-item active">Detalles de la compra</li>
						<li class="list-group-item">
							<table id="productos" class="table table-condensed centered">
								<thead>
									<th>ID</th>
									<th>Producto</th>
									<th>Precio</th>
									<th>Cantidad</th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</li>
					</ul>

					<ul class="list-group">
						<li class="list-group-item active">Datos del negocio</li>
						<li class="list-group-item"><span class="label_show">Negocio: <span id="span15"></span></span></li>
						<li class="list-group-item"><span class="label_show">Domicilio: <span id="span16"></span></span></li>
					</ul>

					<ul class="list-group">
						<li class="list-group-item active">Datos del sendenboy</li>
						<li class="list-group-item"><span class="label_show">SendenBoy: <span id="span2"></span></span></li>
						<li class="list-group-item"><span class="label_show">Email: <span id="span14"></span></span></li>
					</ul>

					<ul class="list-group">
						<li class="list-group-item active">Datos del cliente</li>
						<li class="list-group-item"><span class="label_show">Cliente: <span id="span13"></span></span></li>
						<li class="list-group-item"><span class="label_show">Domicilio: <span id="span4"></span></span></li>
					</ul>

					<ul class="list-group">
						<li class="list-group-item active">Descripción</li>
						<li class="list-group-item"><p id="descripcion"></p></li>
					</ul>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>

	<div class="table-responsive mt5">
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple ">
				<div class="grid-title">
					@if(auth()->user()->isBusinessAdmin())
						<h4>Opciones <span class="semi-bold">adicionales</span></h4>
						<div class="text-center" style="margin-bottom: 10px;"> 
							<button type="button" data-toggle="modal" data-target="#modal_new" id="nueva_incidencia" class="btn btn-primary"><i aria-hidden="true" class="fa fa-plus"></i> Nueva</button>
						</div>
					@endif
					<!--<h4>Opciones <span class="semi-bold">adicionales</span></h4> -->
					<div class="grid-body ">
						<div id="incidences_table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
							<div class="row">
								<div class="col-sm-12">
									@include('admin.incidences.table')
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection