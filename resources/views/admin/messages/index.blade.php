@extends('layouts.admin')
@section('main-body')
	<link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
	<link rel="stylesheet" href="{{ asset('js/plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
	<style>
		.table td.text {
		    max-width: 177px;
		}
		.table td.text span {
		    white-space: nowrap;
		    overflow: hidden;
		    text-overflow: ellipsis;
		    display: inline-block;
		    max-width: 100%;
		}
	</style>
	<div class="modal fade" id="modal_new_message" tabindex="-1" role="dialog" aria-labelledby="modal_new_messageLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modal_new_messageLabel">Mensaje</h4>
				</div>
				<div class="modal-body">
					<div id="response">
						<h6>Mensaje</h6>
						<p id="men_body"></p>
					</div>
					<form action="{{URL::to('/admin/mensajes/save')}}" id="respuesta_form">
						@if(auth()->user()->user_type_id == 1)
							<div class="row">
								<input type="hidden" name="business_id" value="0">
								<div class="form-group col-md-12">
									<label for="negocios">Destinatario</label>
									<select name="to_id" id="negocios" class="not-empty col-md-12" data-name="Destinatario">
										<option value="">Seleccione un destinatario</option>
										@foreach($businesses as $business)
											<option value="{{$business->id}}">{{$business->name}}</option>
										@endforeach
									</select>
								</div>
								<input type="hidden" name="from" id="from" value="Admin">
								<input type="hidden" name="to" id="to" value="Admin">
							</div>
						@else
							<input type="hidden" name="to_id" value="0">
							<input type="hidden" name="business_id" value="{{auth()->user()->business_id}}">
							<input type="hidden" name="from" value="{{$datos_negocio->name}}">
							<div class="form-group">
								<label for="to">Destinatario</label>
								<input type="text" value="Administrador" disabled class="col-md-12">
								<input type="text" readonly="true" id="to" value="Administrador" class="col-md-12 hide">
							</div>
						@endif
						<div class="row">
							<div class="form-group col-md-12">
								<label for="subject">Asunto</label>
								<input type="text" name="subject" id="subject" class="not-empty col-md-12" data-name="Asunto">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<label for="body">Contenido</label>
								<textarea class="form-control not-empty col-md-12" rows="3" id="body" name="body" data-name="Contenido"></textarea>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary" id="guardar_respuesta">Guardar</button>	
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>

	<h2 class="text-center">Lista de mensajes</h2>
	<div class="table-responsive mt5">
		<div class="row-fluid">
			<div class="span12">
				<div class="grid simple ">
					<div class="grid-title">
						<h4>Opciones <span class="semi-bold">adicionales</span></h4>
						<div class="text-center" style="margin-bottom: 10px;"> 
							<button type="button" id="nuevo_mensaje" class="btn btn-primary"><i aria-hidden="true" class="fa fa-plus"></i> Nueva</button>
						</div>
						<!--<h4>Opciones <span class="semi-bold">adicionales</span></h4> -->
						<div class="grid-body ">
							<div id="incidences_table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
								<div class="row">
									<div class="col-sm-12">
										<table class="table table-condensed text-center table-hover dataTable no-footer" id="messages_table" role="grid" aria-describedby="messages_table_info">
											<thead>
												<tr role="row">
													<th class="sorting hide" style="text-align: center;">
														<strong>ID</strong>
													</th>
													<th class="sorting <?php echo (auth()->user()->user_type_id == 3)?'hide':'';?>" style="text-align: center;">
														<strong>Negocio ID</strong>
													</th>
													<th class="sorting <?php echo (auth()->user()->user_type_id == 3)?'hide':''?>" style="text-align: center;">
														<strong>Remitente</strong>
													</th>
													<th class="sorting" style="text-align: center;">
														<strong>Asunto</strong>
													</th>
													<th class="sorting" style="text-align: center;">
														<strong>Contenido</strong>
													</th>
													<th class="sorting hide" style="text-align: center;">
														<strong>Check</strong>
													</th>
													<th class="sorting" style="text-align: center;">
														<strong>Acciones</strong>
													</th>
												</tr>
											</thead> 
											<tbody>
												@if(count($messages))
													@foreach($messages as $mensaje)
														<tr role="row" class="<?php echo ($mensaje->check)?'success':''?>">
															<td class="hide">{{$mensaje->id}}</td>
															<td class="<?php echo (auth()->user()->user_type_id == 3)?'hide':''?>">{{$mensaje->business_id}}</td>
															<td class="<?php echo (auth()->user()->user_type_id == 3)?'hide':''?>"><?php echo ($mensaje->to_id != 0)?'Administrador':$mensaje->from;?></td>
															<td class="text"><span>{{$mensaje->subject}}</span></td>
															<td class="text"><span>{{$mensaje->body}}</span></td>
															<td class="hide">{{$mensaje->check}}</td>
															<td>
																<button type="button" class="btn btn-sm btn-info btn_detalles">Responder</button> 
															</td>
														</tr>
													@endforeach
												@else
													<tr role="row" class="odd text-center">
														<td class="hide"></td>
														<td class="<?php echo (auth()->user()->user_type_id == 3)?'hide':''?>"></td>
														<td class="<?php echo (auth()->user()->user_type_id == 3)?'hide':''?>"></td>
														<td><?php echo (auth()->user()->user_type_id == 1)?'Bandeja vacia':''?></td>
														<td><?php echo (auth()->user()->user_type_id == 3)?'Bandeja vacia':''?></td>
														<td class="hide"></td>
														<td>
														</td>
													</tr>
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
		</div>
	</div>
<script src="{{ asset('js/plugins/jquery-1.8.3.min.js') }}" type="text/javascript"></script> 
<script type="text/javascript">
	$(function(){
		var flag = "{{auth()->user()->user_type_id == 3}}"?true:false;

		$('#messages_table').dataTable();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$("#negocios").on('click',function(){
			$("#to").val($("#negocios option:selected").text());
		})

		$("#nuevo_mensaje").on('click',function(){
    		$('input#to, input#subject, textarea#body').val('');
    		$('select#negocios').val(0);
			$("#response").addClass('response_hide').removeClass('response_show');
			$('#modal_new_message').modal({
				backdrop: false
			});
		})

		$('#guardar_respuesta').on('click',function(){
			if ( validForm($(this).parent().parent().find('form').attr('id')) ) {
				$.ajax({
					url:"{{URL::to('/admin/mensajes/store')}}",
					type:'POST',
					data:$("#respuesta_form").serialize(),
					success:function(response){
						swal({
							title: 'Mensaje enviado',
							type: 'success',
							timer: 1400,
							showCloseButton: false,
							confirmButtonText: 'Aceptar',
						});
						/*var buttons_table = "<button type='button' class='btn btn-sm btn-info btn_detalles'>Responder</button>";
                        var oTable = $('#messages_table').dataTable();
                        oTable.fnClearTable();
                        $.each(response,function(i,e){
                            if ( response.length > 0 ){
                            	var destino = "";
                            	if ( e.to_id == 0 ){
                            		destino = "Administrador";
                            	} else {
                            		destino = e.name;
                            	}
                                oTable.dataTable().fnAddData( 
                                [
                                	e.id,
                                    e.business_id,
                                    destino,
                                    e.subject,
                                    e.body,
                                    e.check,
                                    buttons_table
                                ] );      
                            }
                            if ( e.check == 1 ){
                            	$("table tbody tr").last().addClass('success');
                            }
                        })
                        if ( flag ){
                        	$("table tbody tr td:nth-child(1), table tbody tr td:nth-child(2), table tbody tr td:nth-child(3)").addClass("hide");
                        }
                        $("table tbody tr td:nth-child(6)").addClass("hide");*/
                        $("#modal_new_message").modal('hide');
                        $('body').removeClass('modal-open');
						$('.modal-backdrop').remove();
					}
				})
			}
		})

		$(".btn_detalles").on('click',function(){
			$("#response").removeClass('response_hide').addClass('response_show');
			$('#modal_new_message').modal({
				backdrop: false
			});
			$("#negocios").val($(this).parent().parent().find("td:nth-child(2)").text()).attr('disabled');
			$("#subject").val("Re: "+$(this).parent().parent().find("td:nth-child(4)").text()).attr('readonly');
			$("#men_body").text($(this).parent().parent().find("td:nth-child(5)").text());

			$.ajax({
				url:"{{URL::to('/admin/mensajes/status')}}",
				type:"POST",
				data:{
					id:$(this).parent().parent().find("td:nth-child(1)").text(),
				},
				success:function(response){
					$(".badge-success").text(response);
				}
			})
			$(".btn_detalles").parent().parent().removeClass("success");
		})
	})

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
</script>
@endsection