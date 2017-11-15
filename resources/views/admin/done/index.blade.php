
@extends('layouts.admin')
@push('scripts_normal')
<script src="{{ asset('js/plugins/jquery-datatable/js/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/datatables.js') }}"></script>		
<script type="text/javascript">
	$(function(){
		$( "#start_date" ).datepicker({
			autoclose: true,
			todayHighlight: true,
			format: "yyyy-mm-dd",
		}).on( "changeDate", function(e) {
			$( "#end_date" ).datepicker('setStartDate',e.date);
		});

		$( "#end_date" ).datepicker({
			autoclose: true,
			todayHighlight: true,
			format: "yyyy-mm-dd",
		}).on( "changeDate", function(e) {
			$( "#start_date" ).datepicker('setEndDate',e.date);
		});

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$(document).delegate('#export_data','click',function(){
			business_id = $('select#business_id').val() ? $('#business_id').val() : false
			sendenboy_id = false;
			start_date = $('input#start_date').val() ? $('input#start_date').val() : false
			end_date = $('input#end_date').val() ? $('input#end_date').val() : false
			is_paid_business = false;
    		is_paid_sendenboy = false;

		    window.location.href = "{{url('admin/orders-done/export')}}/"+business_id+"/"+sendenboy_id+"/"+start_date+"/"+end_date+"/"+is_paid_business+"/"+is_paid_sendenboy;
		});

		$(document).delegate('.btn_detalles','click',function(){
			var button = $(this);
			button.children('i').show();
			button.attr('disabled', true);
			
			$.ajax({
				url:$(this).data('url'),
				type:'GET',
				success:function(response) {
					button.children('i').hide();
					button.attr('disabled', false);
					$('#modal_detalles').modal({
						backdrop: false
					})
					var items = response[0].products;
					console.info(response[0]);

					/*Order data*/
			        $("#order-number").text(response[0].order_number);
			        $("#order-status").text(response[0].status_name);
			        $("#order-date").text(response[0].created_at);
			        $("#order-address").text(response[0].order_addres);
			        $("#order-client").text(response[0].customer_name);
			        $("#order-sendenboy-id").text(response[0].idSendenboy);
			        $("#order-comments").text(response[0].order_comment);
			        $("#order-total").text('$'+response[0].order_total);

			        /**general client data */
			        $("#client-id").text(response[0].customer_id);
			        $("#client-name").text(response[0].customer_name);
			        $("#client-email").text(response[0].customer_email);
			        $("#client-phone").text(response[0].customer_phone);
			        $("#client-address").text(response[0].customer_address);
			        $("#client-municipality").text(response[0].customer_municipality);
			       
			        /**general business data */
			        $("#business-name").text(response[0].businesses_name);
			        $("#business-category").text(response[0].businesses_category);
			        $("#business-rfc").text(response[0].businesses_rfc);
			        $("#business-phone").text(response[0].businesses_phone);
			        $("#business-address").text(response[0].business_address);
			        $("#business-place").text(response[0].businesses_city);
			        
			        /**general sendenboy data */
			        $("#sendenboy-id").text(response[0].idSendenboy);
			        $("#sendenboy-name").text(response[0].sendenboy_name);
			        $("#sendenboy-email").text(response[0].sendenboy_email);
			        $("#sendenboy-phone").text(response[0].sendenboy_phone);
			        $("#sendenboy-address").text(response[0].sendenboy_address);
			        $("#sendenboy-municipality").text(response[0].sendeboy_municipality);
            		$("img#sendenboy-photo").attr("src", baseUrl+'/'+response[0].sendenboy_photo);

            		$("table#productos tbody").children().remove();
			        for (var key in items) {
		                if (items.hasOwnProperty(key)) {
		                    $("table#productos tbody").append(
		                        '<tr class="" id="">'+
		                            '<td style="text-align: center;">'+items[key].product_name+'</td>'+
		                            '<td style="text-align: center;">$'+(items[key].product_price)+'</td>'+
		                            '<td style="text-align: center;">'+(items[key].product_quantity)+'</td>'+
		                            '<td style="text-align: center;">$'+(items[key].product_subtotal)+'</td>'+
		                            '<td style="text-align: center;">'+(items[key].product_description)+'</td>'+
		                        '</tr>'
		                    );
		                }
		            }
				},
				error: function(){
					button.children('i').hide();
					button.attr('disabled', false);
				}
			})
		})
	});

	function refreshTable() {
		$('#DataTables_Table_0').fadeOut();
		$('#DataTables_Table_0').load("{{ URL::to('/admin/incidencias') }}", function() {
			$('#DataTables_Table_0').fadeIn();
		});
	}
</script>
	@endpush
<style>
	span.label_show{
		display: block;
	    font-weight: bold;
	}
	span.label_show span{
		font-weight: normal;
	}
</style>
@section('main-body')
	<!--Modal para ver información de la incidencia-->
	<div class="modal fade" id="modal_detalles" tabindex="-1" role="dialog" aria-labelledby="modal_detallesLabel">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal_detallesLabel">Detalles de pedido</h4>
				</div>
				<div class="modal-body">
					<ul class="list-group">
						<li class="list-group-item active">Datos generales de la orden</li>
						<li class="list-group-item"><span class="label_show">Número de orden: <span id="order-number"></span></span></li>
						<li class="list-group-item"><span class="label_show">Estatus: <span id="order-status">Finalizado</span></span></li>
						<li class="list-group-item"><span class="label_show">Fecha de orden: <span id="order-date"></span></span></li>
						@if(auth()->user()->isSendenAdmin())
							<li class="list-group-item"><span class="label_show">Domicilio de entrega: <span id="order-address"></span></span></li>
						@endif
						<li class="list-group-item"><span class="label_show">Cliente: <span id="order-client"></span></span></li>
						<li class="list-group-item"><span class="label_show">Número de sendenboy: <span id="order-sendenboy-id"></span></span></li>
						<li class="list-group-item"><span class="label_show">Comentarios: <span id="order-comments"></span></span></li>
						{{-- <li class="list-group-item"><span class="label_show">Total: <span id="order-total"></span></span></li> --}}
					</ul>

					<ul class="list-group">
						<li class="list-group-item active">Productos</li>
						<li class="list-group-item">
                        	<div class="table-responsive">
								<table id="productos" class="table table-responsive">
									<thead>
										{{-- <th>ID</th> --}}
										<th style="text-align: center;">Producto</th>
										<th style="text-align: center;">Precio unitario</th>
										<th style="text-align: center;">Cantidad</th>
										<th style="text-align: center;">Subtotal</th>
										<th style="text-align: center;">Descripción</th>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</li>
					</ul>

					@if(auth()->user()->isSendenAdmin())
						<ul class="list-group">
							<li class="list-group-item active">Datos generales del cliente</li>
							<li class="list-group-item"><span class="label_show">Número de cliente: <span id="client-id"></span></span></li>
							<li class="list-group-item"><span class="label_show">Nombre: <span id="client-name"></span></span></li>
							<li class="list-group-item"><span class="label_show">Email: <span id="client-email"></span></span></li>
		                    <li class="list-group-item"><span class="label_show">Teléfono: <span id="client-phone"></span></span></li>
							<li class="list-group-item"><span class="label_show">Dirección: <span id="client-address"></span></span></li>
							<li class="list-group-item"><span class="label_show">Municipio: <span id="client-municipality"></span></span></li>
						</ul>
					@endif
					
					@if(auth()->user()->isSendenAdmin())
						<ul class="list-group">
							<li class="list-group-item active">Datos generales del negocio</li>
							<li class="list-group-item"><span class="label_show">Negocio: <span id="business-name"></span></span></li>
							<li class="list-group-item"><span class="label_show">Categoria: <span id="business-category"></span></span></li>
							<li class="list-group-item"><span class="label_show">RFC: <span id="business-rfc"></span></span></li>
							<li class="list-group-item"><span class="label_show">Teléfono: <span id="business-phone"></span></span></li>
							<li class="list-group-item"><span class="label_show">Dirección: <span id="business-address"></span></span></li>
							<li class="list-group-item"><span class="label_show">Lugar: <span id="business-place"></span></span></li>
						</ul>
					@endif

					<ul class="list-group">
						<li class="list-group-item active">Datos generales del sendenboy</li>
						<li class="list-group-item"><span class="label_show">Número de sendenboy: <span id="sendenboy-id"></span></span></li>
						<li class="list-group-item"><span class="label_show">Nombre: <span id="sendenboy-name"></span></span></li>
						@if(auth()->user()->isSendenAdmin())
							<li class="list-group-item"><span class="label_show">Email: <span id="sendenboy-email"></span></span></li>
							<li class="list-group-item"><span class="label_show">Teléfono: <span id="sendenboy-phone"></span></span></li>
							<li class="list-group-item"><span class="label_show">Direccion: <span id="sendenboy-address"></span></span></li>
							<li class="list-group-item"><span class="label_show">Municipio: <span id="sendenboy-municipality"></span></span></li>
						@endif
						<li class="list-group-item">
	                        <span class="label_show">Foto: </span>
	                        <img width="300px;" src="" id="sendenboy-photo">
	                    </li>
					</ul>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal_export" tabindex="-1" role="dialog" aria-labelledby="modal_exportLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal_exportLabel">Exportar pedidos finalizados</h4>
				</div>
				<div class="modal-body">
					<form onsubmit="false" id="export_form">
						<div class="row">
                        	<div class="col-md-12">
                        		<label>Negocios</label>
								<select class="form-control" id="business_id" name='business_id'>
									<option value="">Seleccione una opcion</option>
									@foreach($businesses as $negocio)
										<option value="{{$negocio->id}}">{{$negocio->name}}</option>
									@endforeach
								</select>
                        	</div>
                        	<div class="col-md-6 col-sm-12">
                        		<label>Fecha inicio</label>
								<input class="form-control" type="" id="start_date" name="start_date">
                        	</div>
                        	<div class="col-md-6 col-sm-12">
                        		<label>Fecha fin</label>
								<input class="form-control" type="" id="end_date" name="end_date">
                        	</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="export_data" data-dismiss="modal">Aceptar</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				</div>
			</div>
		</div>
	</div>

	<div class="table-responsive mt5">
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple">
				<div class="grid-title">
					<h4>Opciones <span class="semi-bold">adicionales</span></h4>
					<div class="text-center" style="margin-bottom: 10px;">
						<button type="button" id="exportar_excel" class="btn btn-info" data-toggle="modal" data-target="#modal_export"><i aria-hidden="true" class="fa fa-download"></i> Exportar</button> 
					</div>
					<div class="grid-body">
                        <div class="table-responsive">
                    		<table class="table datatable" id="example3">
								<thead>
									<tr>
										<th style="text-align: center;">ID</th>
										<th style="text-align: center;">Número de orden</th>
										<th style="text-align: center;">SendenBoy</th>
										<th style="text-align: center;">CLIENTE</th>
										<th style="text-align: center;">ID NEGOCIO</th>
										<th style="text-align: center;">NEGOCIO</th>
										<th style="text-align: center;">Creado</th>
                                		<th style="text-align: center;">Acciones</th>
									</tr>
								</thead> 
								<tbody>
									@if(count($orders))
										@foreach($orders as $orden)
											<tr data-id={{$orden->idOrder}} class="text-center">
												<td>{{$orden->idOrder}}</td> 
												<td>{{$orden->order_number}}</td> 
												<td>{{$orden->sendenboy_name}}</td> 
												<td>{{$orden->customer_name}}</td>
												<td>{{$orden->idBussiness}}</td>
												<td>{{$orden->businesses_name}}</td>
												<td>{{$orden->created_at}}</td> 
												<td>
													<button type="button" class="btn btn-sm btn-info btn_detalles" data-url="{{ URL::to('/admin/orders-done/show/'.$orden->idOrder) }}">
														<i class="fa fa-spinner fa-spin" style="display: none"></i>
                                                		Ver
													</button> 
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
@endsection