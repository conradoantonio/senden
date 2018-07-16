@extends('layouts.admin')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDSoqC5Ns8sZkKPDKKC9rwJdzdpUDjOGOg&libraries=places"></script>
@push('scripts')
	<script src="{{ asset('js/validForm.js') }}" type="text/javascript"></script> 
	<script>
		$(function(){
			var map;
			var marker;
			var center;

			$('.prevent').keydown(function(event){
		        if(event.keyCode == 13) {
		            event.preventDefault();
		            return false;
		        }
		    });
		    initMap();
		})
	</script>

@endpush
<style>
	.form-group{
		height: auto;
	}
	#map {
        height: 400px;
        width: 100%;
    }
</style>
@section('main-body')
	<h2 class="text-center">Editar negocio</h2>
	<form class="col-md-12 valid" method='post' action="{{URL::to('/admin/businesses/update')}}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="id" value="{{ isset($business) ? $business->id : '' }}">
		<div class="form-group">
			<label class="col-md-12 control-label">Nombre comercial
			<span class="text-danger">*</span></label>
			<div class="col-md-12">
				<input type="text" value="{{ isset($business) ? $business->name : '' }}" class="form-control not-empty prevent" name="NombreComercial" data-name="Nombre Comercial"> <span class="help-block" ><span>
				</span></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-12 control-label">Razon social <span class="text-danger">*</span></label>
			<div class="col-md-12">
				<input type="text" value="{{ isset($business) ? $business->tradename : '' }}" class="form-control not-empty prevent" name="RazonSocial" data-name="Razon social"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div>
		<div class="form-group p">
			<label class="col-md-12 control-label">Categoria <span class="text-danger">*</span></label>
			<div class="col-md-12">
				<select class="form-control not-empty prevent" data-name="Categoria" name="categoria">
					<option value="0" disabled> Escoge una categoria</option> 
					@foreach($categories as $categoria)
						<option value="{{$categoria->id}}" <?php echo ($categoria->id == $business->category_id)?'selected':''; ?> >{{$categoria->name}}</option>
					@endforeach
				</select> 
				<span class="help-block" ><span></span></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-12 control-label">RFC <span class="text-danger">*</span></label>
			<div class="col-md-12">
				<input type="text" class="form-control not-empty prevent" maxlength="13" data-name="RFC" name="rfc" value="{{ isset($business) ? $business->rfc : '' }}"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12 col-xs-12">
	            <div class="form-group">
	                <label for="descripcion">Descripción</label>
	                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Da una breve descripción del negocio...">{{ isset($business) ? $business->description : '' }}</textarea>
	            </div>
	        </div>
        </div>
		<div class="form-group">
			<label class="col-md-2 control-label">Calle <span class="text-danger">*</span></label>
			<div class="pb-5 col-md-4">
				<input type="text" value="{{ isset($business) ? $business->street : '' }}" class="form-control not-empty prevent" data-name="Calle" name="calle"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div>
		<div class="form-group"><label class="col-md-2 control-label">Ciudad <span class="text-danger">*</span></label>
			<div class="pb-5 col-md-4">
				<input type="text" value="{{ isset($business) ? $business->city : '' }}" class="form-control not-empty prevent" data-name="Ciudad" name="ciudad"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Estado <span class="text-danger">*</span></label>
			<div class="pb-5 col-md-4">
				<input type="text" value="{{ isset($business) ? $business->state : '' }}" class="form-control not-empty prevent" data-name="Estado" name="estado"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Colonia <span class="text-danger">*</span></label>
			<div class="pb-5 col-md-4">
				<input type="text" value="{{ isset($business) ? $business->colony : '' }}" class="form-control not-empty prevent" data-name="Colonia" name="colonia"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div> 
		<div class="form-group">
			<label class="col-md-2 control-label">Numero exterior <span class="text-danger">*</span></label>
			<div class="pb-5 col-md-4">
				<input type="text" value="{{ isset($business) ? $business->ext_number : '' }}" class="form-control not-empty prevent" data-name="Número Exterior" name="NumeroExterior"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div> 
		<div class="form-group">
			<label class="col-md-2 control-label">Numero Interior</label>
			<div class="pb-5 col-md-4">
				<input type="text" value="{{ isset($business) ? $business->int_number : '' }}" maxlength="10" class="form-control prevent" data-name="Número Interior" name="NumeroInterior"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div> 
		<div class="form-group">
			<label class="col-md-2 control-label">Código Postal <span class="text-danger">*</span></label>
			<div class="pb-5 col-md-4">
				<input type="text" value="{{ isset($business->postal_code) ? $business->postal_code : '' }}" maxlength="10" class="form-control not-empty numeric prevent" data-name="Código Postal" name="cp" maxlength="5"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div> 
		<div class="form-group">
			<label class="col-md-2 control-label">Telefono <span class="text-danger">*</span></label>
			<div class="pb-5 col-md-4">
				<input type="text" value="{{ isset($business->phone) ? $business->phone : '' }}" maxlength="18" class="form-control not-empty numeric prevent" data-name="Teléfono" name="telefono"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div> 
		<div class="horario">
			<div class="form-group form-inline col-md-4">
				<label class="col-md-12 control-label">Lunes a Viernes<span class="text-danger">*</span></label> 
				<div class="pb-5 col-md-12">
					<div>
						<h5>Abierto</h5>
						<label for="" style="display:inline-block;">De</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control not-empty prevent" name="semana_inicio" value="{{$business->semana_inicio}}" data-name="Hora de apertura (Semana)"> 
							
						</div>

						<label for="" style="display:inline-block;">A</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input class="form-control not-empty prevent" name="semana_fin" value="{{$business->semana_fin}}" data-name="Hora de terminación (Semana)">
							
						</div>
					</div>
					<div>
						<h5>Hora de comida</h5>
						<label for="" style="display:inline-block;">De</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="semana_com_inicio" value="{{$business->semana_com_inicio}}">
							
						</div>
						
						<label for="" style="display:inline-block;">A</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="semana_com_fin" value="{{$business->semana_com_fin}}">
							
						</div>
					</div>
				</div>
			</div> 
			<div class="form-group form-inline col-md-4">
				<label class="col-md-12 control-label">Sabado<span class="text-danger">*</span></label> 
				<div class="pb-5 col-md-12">
					<div>
						<h5>Abierto</h5>
						<label for="" style="display:inline-block;">De</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="sabado_inicio" value="{{$business->sabado_inicio}}"> 
							
						</div>
						
						<label for="" style="display:inline-block;">A</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="sabado_fin" value="{{$business->sabado_fin}}">
							
						</div>
					</div>
					<div>
						<h5>Hora de comida</h5>
						<label for="" style="display:inline-block;">De</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="sabado_com_inicio" value="{{$business->sabado_com_inicio}}">
							
						</div>
						
						<label for="" style="display:inline-block;">A</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="sabado_com_fin" value="{{$business->sabado_com_fin}}">
							
						</div>
					</div>
				</div>
			</div>
			<div class="form-group form-inline col-md-4 col-md-offset-4 col-md-pull-4">
				<label class="col-md-12 control-label">Domingo<span class="text-danger">*</span></label> 
				<div class="pb-5 col-md-12">
					<div>
						<h5>Abierto</h5>
						<label for="" style="display:inline-block;">De</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="domingo_inicio" value="{{$business->domingo_inicio}}"> 
							
						</div>
						
						<label for="" style="display:inline-block;">A</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="domingo_fin" value="{{$business->domingo_fin}}">
							
						</div>
					</div>

					<div>
						<h5>Hora de comida</h5>
						<label for="" style="display:inline-block;">De</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="domingo_com_inicio" value="{{$business->domingo_com_inicio}}">
							
						</div>
						
						<label for="" style="display:inline-block;">A</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="domingo_com_fin" value="{{$business->domingo_com_fin}}">
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-12 control-label">Nombre del banco 
			<span class="text-danger">*</span></label>
			<div class="col-md-12">
				<input type="text" value="{{ !empty($business->bank_name) ? $business->bank_name : '' }}" class="form-control not-empty" data-name="Nombre del banco" name="bank_name"> <span class="help-block" ><span>
				</span></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-12 control-label">Clabe bancaria 
			<span class="text-danger">*</span></label>
			<div class="col-md-12">
				<input type="text" value="{{ !empty($business->clabe) ? $business->clabe : '' }}" maxlength="18" class="form-control not-empty numeric" data-name="Clabe bancaria" name="clabe"> <span class="help-block" ><span>
				</span></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-12 control-label">Numer de contrato 
			<span class="text-danger">*</span></label>
			<div class="col-md-12">
				<input type="text" value="{{ !empty($business->contract_number) ? $business->contract_number : '' }}" class="form-control not-empty numeric" data-name="Número de contrato" name="contract_number"> <span class="help-block" ><span>
				</span></span>
			</div>
		</div>
		<div id="mapa_detalles" class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-group"><label>Dirección<span class="text-danger">*</span></label>
					<input type="" name="buscarMapa" id="buscarMapa" placeholder="Buscar en mapa" class="form-control prevent" data-name="Dirección" autocomplete="off"> 
					<input name="latitud" value="{{ isset($business) ? $business->latitude : 0 }}" id="latitud" type="hidden">
					<input name="longitud" value="{{ isset($business) ? $business->longitude : 0 }}" id="longitud" type="hidden"> 
					<div id="map" ></div>
				</div>
			</div> 
		</div>
		<div class="form-group">
			<label class="col-md-12 control-label">Contrato</label>
			<div class="col-md-12">
				<input type="file" id="contract" class="form-control image document" data-name="Contrato" name="contract"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div> 
		<div class="form-group">
			<label class="col-md-12 control-label">Logo</label>
			<div class="col-md-12">
				<input type="file" id="logo" class="form-control image" data-name="Logo" name="logo"> 
			</div>
		</div> 
		<div class="form-group">
			<label class="col-md-12 control-label">Foto 1</label>
			<div class="col-md-12">
				<input type="file" id="photo1" class="form-control image" data-name="Foto 1" name="photo1"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div> 
		<div class="form-group">
			<label class="col-md-12 control-label">Foto 2</label>
			<div class="col-md-12">
				<input type="file" id="photo2" class="form-control image" data-name="Foto 2" name="photo2"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div> 
		{{-- <div class="form-group">
			<label class="col-md-12 control-label">Contrato<span class="text-danger">*</span></label>
			<div class="col-md-12">
				<img src="{{ url(isset($business->contract) ? $business->contract : '/') }}" style="width: 100%">
				<span class="help-block" ><span></span></span>
			</div>
		</div> --}}
		@if(!empty($business->logo))
			<div class="form-group col-md-4">
				<label class="col-md-12 control-label">Logo</label>
				<div class="col-md-12"> 
					<img src="{{ url(isset($business->logo) ? $business->logo : '/') }}" style="width: 100%">
					<span class="help-block" ><span></span></span>
				</div>
			</div> 
		@endif
		@if(!empty($business->photo1))
			<div class="form-group col-md-4">
				<label class="col-md-12 control-label">Foto 1</label>
				<div class="col-md-12">
					<img src="{{ url(isset($business->photo1) ? $business->photo1 : '/') }}" style="width: 100%">
					<span class="help-block" ><span></span></span>
				</div>
			</div> 
		@endif
		@if(!empty($business->photo2))
			<div class="form-group col-md-4">
				<label class="col-md-12 control-label">Foto 2</label>
				<div class="col-md-12"><img src="{{ url(isset($business->photo2) ? $business->photo2 : '/') }}" style="width: 100%"> 
					<span class="help-block" ><span></span></span>
				</div>
			</div>
		@endif
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary" id="guardar">Enviar</button>
			<a href="{{URL::to('/admin/businesses')}}">
				<button type="button" data-dismiss="modal" class="btn btn-default"> Regresar </button> 
			</a>
		</div>
	</form>
@endsection