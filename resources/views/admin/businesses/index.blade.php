@extends('layouts.admin')
@push('checkbox')
<script type="text/javascript">
	$(function(){
		setTimeout(function(){
	        $('div#business_table_list').fadeIn('low');
	    }, 300)
		$('table').dataTable();
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		$('#eliminar_varios').on('click',function(){
			/*validar que haya una selección*/
			var ids_array = [];
			$('tbody tr').each(function(){
				if ( $(this).find('input.checkDelete').is(':checked') ) {
					ids_array.push($(this).data('id'));
				}
			})
			if ( ids_array.length ) {
				swal({
					title: "¿Realmente quieres eliminar la seleccion?",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "rgb(140, 212, 245)",
					confirmButtonText: "Confirmar",
					cancelButtonText: "Cancelar",
					closeOnConfirm: true
				},function(isConfirm){
					if (isConfirm) {
						$.ajax({
							url:"{{URL::to('/admin/businesses/delete-multiple')}}",
							type:'POST',
							data:{
								ids:ids_array,
							},
							success:function(response){
								if (response > 0) {
									refreshTable();
									swal("Eliminado", "Los negocios han sido eliminados", "success");
								}
							}
						})
					} else {
						swal("Cancelacion", "No se han efectado cambios", "error");
					}
				});
			} else {
				swal({
					title: "No ha selecionado ningun negocio",
					type: "warning",
					showCancelButton: false,
					confirmButtonColor: "rgb(140, 212, 245)",
					confirmButtonText: "Confirmar",
					closeOnConfirm: true
				})
			}
		})

		$(document).delegate('.delete','click',function(){
			var id = $(this).parent().parent().data('id')
			var ids_array = [id];

			swal({
				title: "¿Realmente quieres eliminar este negocio?",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "rgb(140, 212, 245)",
				confirmButtonText: "Confirmar",
				cancelButtonText: "Cancelar",
				closeOnConfirm: true
			},function(isConfirm){
				if (isConfirm) {
					$.ajax({
						url:"{{URL::to('/admin/businesses/delete-multiple')}}",
						type:'POST',
						data:{
							ids:ids_array,
						},
						success:function(response){
							if (response) {
								refreshTable();
								swal("Eliminado", "El negocio ha sido eliminado", "success");
							}
						}
					})
				} else {
					swal("Cancelacion", "No se han efectado cambios", "error");
				}
			});
		})
		
		/*$(".change_status").bootstrapSwitch();*/

		$(document).delegate('.checkIsOpen', 'change', function (event) {
			state = $(this).is(':checked') ? 1 : 0;
			$.ajax({
				url:"{{URL::to('/admin/businesses/status')}}",
				type:'POST',
				data:{
					id:$(this).data('id'),
					status:state
				},
				success:function(){
					console.info('se actualizó si está abierto o no');
				}
			})
		}); 
	})

	function refreshTable(){
		var table = $("#table").dataTable();
        var container = $('div.table_container');

        table.fnDestroy();
        container.fadeOut();
        container.empty();

        container.load("{{ URL::to('/admin/businesses') }}", function() {
            container.fadeIn();
            $('#table').dataTable();
        });
	}
</script>
@endpush
@section('main-body')
	<link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
	<link rel="stylesheet" href="{{ asset('js/plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
	<!--<app-businesses-index :businesses="{{ $businesses }}"></app-businesses-index>-->
	<div class="text-center">
		<h2>Lista de negocios</h2>
		<div id="business_table_list" style="display: none;" class="table-responsive mt5">
			<div class="row-fluid">
				<div class="span12">
					<div class="grid simple ">
						<div class="grid-title">
							<h4>Opciones <span class="semi-bold">adicionales</span></h4>
							<div class="text-center" style="margin-bottom: 10px;">
								<button type="button" id="exportar_excel" class="btn btn-info" style="display: none;"><i aria-hidden="true" class="fa fa-download"></i> Exportar</button> 
								<button type="button" data-toggle="modal" data-target="#importar-excel" class="btn btn-success" style="display: none;"><i aria-hidden="true" class="fa fa-file-excel-o"></i> Importar</button> 
								<a href="{{URL::to('/admin/businesses/create')}}">
									<button type="button" data-toggle="modal" data-target="#formulario_producto" id="nuevo_producto" class="btn btn-primary"><i aria-hidden="true" class="fa fa-plus"></i> Nuevo</button>
								</a>
								<button class="btn btn-danger" id="eliminar_varios">
									<span><i aria-hidden="true" class="fa fa-trash-o"></i> Eliminar seleccion</span>
								</button>
	    					</div>
							<div class="grid-body ">
								<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
									<div class="row"> 
										<div class="col-sm-12 table_container">
											@include('admin.businesses.table')
										</div>
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