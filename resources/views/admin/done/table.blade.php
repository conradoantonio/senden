<table class="table table-condensed table-hover dataTable no-footer" id="DataTables_Table_0" role="grid">
	<thead>
		<tr role="row">
		<th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 120px;">
				<strong>Id</strong>
			</th>
			<th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 120px;">
				<strong>Número de orden</strong>
			</th>
			<th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 120px;">
				<strong>SendenBoy</strong>
			</th>
			<th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 120px;">
				<strong>CLIENTE</strong>
			</th>
			<th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 120px;">
				<strong>ID NEGOCIO</strong>
			</th>
			<th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 120px;">
				<strong>NEGOCIO</strong>
			</th>
			<th class="sorting" tabindex="0" rowspan="1" colspan="1" style="width: 120px;">
				<strong>Creado</strong>
			</th>
		</tr>
	</thead> 
	<tbody>
		@if(count($orders))
			@foreach($orders as $orden)
				<tr role="row" class="odd" data-id={{$orden->id}}>
					<td>{{$orden->order_number}}</td> 
					<td>{{$orden->order_number}}</td> 
					<td>{{$orden->name}}</td> 
					<td>{{$orden->cliente}}</td>
					<td>{{$orden->bus_id}}</td>
					<td>{{$orden->bus_name}}</td>
					<td><?php echo $orden->created_at;?></td> 
					<td>
						<button type="button" class="btn btn-sm btn-info btn_detalles" data-url="{{ URL::to('/admin/orders-done/show/' . $orden->id) }}" data-toggle="modal" data-target="#modal_detalles">Ver detalles</button> 
					</td>
				</tr>
			@endforeach
		@else
			<tr role="row" class="odd text-center">
				<td colspan="7">No hay pedidos finalizados</td>
			</tr>
		@endif
	</tbody>
</table>