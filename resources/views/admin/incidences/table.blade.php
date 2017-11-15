<table class="table table-condensed table-hover dataTable no-footer" id="incidences_table" role="grid" aria-describedby="incidences_table_info">
	<thead>
		<tr role="row">
			<th class="sorting" tabindex="0" aria-controls="incidences_table" rowspan="1" colspan="1" aria-label="Nombre: Activar para ordenar la columna de manera ascendente" style="width: 120px;">
				<strong>ID</strong>
			</th>
			<th class="sorting" tabindex="0" aria-controls="incidences_table" rowspan="1" colspan="1" aria-label="Nombre: Activar para ordenar la columna de manera ascendente" style="width: 120px;">
				<strong>Descripción</strong>
			</th>
			<th class="sorting" tabindex="0" aria-controls="incidences_table" rowspan="1" colspan="1" aria-label="Nombre: Activar para ordenar la columna de manera ascendente" style="width: 120px;">
				<strong>Solución</strong>
			</th>
			<th class="sorting" tabindex="0" aria-controls="incidences_table" rowspan="1" colspan="1" aria-label="Nombre: Activar para ordenar la columna de manera ascendente" style="width: 120px;">
				<strong>Acciones</strong>
			</th>
		</tr>
	</thead> 
	<tbody>
		@if(count($incidences))
			@foreach($incidences as $incidencia)
				<tr role="row" class="odd" data-id={{$incidencia->id}}>
					<td>{{$incidencia->id}}</td>
					<td><?php echo substr($incidencia->description, 0, 20);?></td> 
					<td><?php echo (!empty($incidencia->name))?substr($incidencia->name, 0, 25):'Solución no especificada';?></td> 
					<td>
						<button type="button" class="btn btn-sm btn-info btn_detalles" data-url="{{ URL::to('/admin/incidencias/show/' . $incidencia->id) }}" data-toggle="modal" data-target="#modal_detalles">Ver detalles</button> 
						<button type="button" class="btn btn-sm btn-info btn_soluciones" data-solution="{{$incidencia->solution_id}}" data-id="{{$incidencia->id}}" data-url="{{ URL::to('/admin/incidencias/update')}}" data-toggle="modal" data-target="#modal_solucion">Añadir solución</button>
					</td>
				</tr>
			@endforeach
		@else
			<tr role="row" class="odd text-center">
				<td colspan="4">No hay incidencias por revisar</td>
			</tr>
		@endif
	</tbody>
</table>