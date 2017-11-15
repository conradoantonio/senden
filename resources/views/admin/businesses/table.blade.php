<table class="table table-condensed table-hover dataTable no-footer" id="table" role="grid" aria-describedby="table_info">
	<thead>
		<tr role="row">
			<th style="text-align: center;"></th>
			<th style="text-align: center;" class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" aria-label="Nombre: Activar para negocioar la columna de manera ascendente">
				<strong>Código</strong>
			</th>
			<th style="text-align: center;" class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" aria-label="Nombre: Activar para negocioar la columna de manera ascendente">
				<strong>Nombre comercial</strong>
			</th>
			<th style="text-align: center;" class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" aria-label="Nombre: Activar para negocioar la columna de manera ascendente">
				<strong>Abierto</strong>
			</th>
			<th style="text-align: center;" class="sorting" tabindex="0" aria-controls="table" rowspan="1" colspan="1" aria-label="Nombre: Activar para negocioar la columna de manera ascendente">
				<strong>Acciones</strong>
			</th>
		</tr>
	</thead> 
	<tbody>
		@foreach($businesses as $negocio)
			<tr role="row" class="odd" data-id={{$negocio->id}}>
				<td class="small-cell v-align-middle sorting_1">
					<div class="checkbox check-success">
						<input id="checkbox<?php echo $negocio->id;?>" type="checkbox" class="checkDelete"> <label for="checkbox<?php echo $negocio->id;?>"></label>
					</div>
				</td>
				<td><?php echo $negocio->id;?></td>  
				<td><?php echo $negocio->name;?></td>  
				<td>
					<div class="checkbox check-success">
						<input id="checkboxIsOpen{{$negocio->id}}" type="checkbox" data-id="{{$negocio->id}}" {{$negocio->isOpen?"checked":""}} class="checkIsOpen"> 
						<label for="checkboxIsOpen{{$negocio->id}}"></label>
					</div>
				</td>  
				<td>
					<a href="{{ URL::to('/admin/businesses/edit/' . $negocio->id) }}">
						<button type="button" class="btn btn-sm btn-info btn_detalles">Editar</button> 
					</a>
					<button class="btn btn-danger btn-sm delete"><span><i class="fa fa-times"></i></span></button>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>