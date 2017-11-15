@extends('layouts.admin')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6e-eCv9TpL7WdvCuNh0wbSUSR3m61WFo&libraries=places"></script>
@push('scripts')
	{{-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6e-eCv9TpL7WdvCuNh0wbSUSR3m61WFo&libraries=places"></script> --}}
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
		})

		initMap();
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
	<h2 class="text-center">Crear negocio</h2>
	<form class="col-md-12 valid" method='post' action="{{URL::to('/admin/businesses/store')}}" enctype="multipart/form-data">
		{{ csrf_field() }}
		<div class="form-group">
			<label class="col-md-12 control-label">Nombre comercial 
			<span class="text-danger">*</span></label> 
			<div class="col-md-12">
				<input type="text" class="form-control not-empty character prevent" data-name="Nombre Comercial" name="NombreComercial"> <span class="help-block" ><span>
				</span></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-12 control-label">Razon social <span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-12">
				<input type="text" class="form-control not-empty prevent" data-name="Razon Social" name="RazonSocial"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div>
		<div class="form-group p">
			<label class="col-md-12 control-label">Categoria <span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-12">
				<select class="form-control not-empty prevent" data-name="Categoria" name="categoria">
					<option value="0"> Escoge una categoria</option> 
					@foreach($categories as $categoria)
						<option value="{{$categoria->id}}">{{$categoria->name}}</option>
					@endforeach
				</select> 
				<span class="help-block" ><span></span></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-12 control-label">RFC <span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-12">
				<input type="text" class="form-control not-empty prevent" maxlength="13" data-name="RFC" name="rfc"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12 col-xs-12">
	            <div class="form-group">
	                <label for="descripcion">Descripción</label>
	                <textarea class="form-control" id="descripcion" name="descripcion" placeholder="Da una breve descripción del negocio..."></textarea>
	            </div>
	        </div>
        </div>
		<div class="form-group">
			<label class="col-md-2 control-label">Calle <span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-4">
				<input type="text" class="form-control not-empty prevent" data-name="Calle"  name="calle"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div>
		<div class="form-group"><label class="col-md-2 control-label">Ciudad <span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-4">
				<input type="text" class="form-control not-empty prevent" data-name="Ciudad" name="ciudad"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Estado <span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-4">
				<input type="text" class="form-control not-empty character prevent" data-name="Estado" name="estado"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-2 control-label">Colonia <span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-4">
				<input type="text" class="form-control not-empty prevent" data-name="Colonia" name="colonia"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div> 
		<div class="form-group">
			<label class="col-md-2 control-label">Numero exterior <span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-4">
				<input type="text" class="form-control not-empty prevent" maxlength="10" data-name="Número exterior" name="NumeroExterior"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div> 
		<div class="form-group">
			<label class="col-md-2 control-label">Numero Interior</label> 
			<div class="pb-5 col-md-4">
				<input type="text" class="form-control prevent" maxlength="10" name="NumeroInterior"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div> 
		<div class="form-group">
			<label class="col-md-2 control-label">Código Postal <span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-4">
				<input type="text" class="form-control not-empty numeric prevent" data-name="Código Postal" maxlength="5"  name="cp"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div> 
		<div class="form-group">
			<label class="col-md-2 control-label">Telefono <span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-4">
				<input type="text" class="form-control not-empty numeric prevent" maxlength="18" data-name="Teléfono" name="telefono"> 
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
							<input type="text" class="form-control not-empty prevent" name="semana_inicio" data-name="Hora de apertura (Semana)"> 
							
						</div>

						<label for="" style="display:inline-block;">A</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input class="form-control not-empty prevent" name="semana_fin" data-name="Hora de terminación (Semana)">
						</div>
					</div>
					<div>
						<h5>Hora de comida</h5>
						<label for="" style="display:inline-block;">De</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="semana_com_inicio">
							
						</div>
						
						<label for="" style="display:inline-block;">A</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="semana_com_fin">
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
							<input type="text" class="form-control prevent" name="sabado_inicio"> 
						</div>
						
						<label for="" style="display:inline-block;">A</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="sabado_fin">
						</div>
					</div>
					<div>
						<h5>Hora de comida</h5>
						<label for="" style="display:inline-block;">De</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="sabado_com_inicio">
							
						</div>
						
						<label for="" style="display:inline-block;">A</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="sabado_com_fin">
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
							<input type="text" class="form-control prevent" name="domingo_inicio"> 
							
						</div>
						
						<label for="" style="display:inline-block;">A</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="domingo_fin">
							
						</div>
					</div>

					<div>
						<h5>Hora de comida</h5>
						<label for="" style="display:inline-block;">De</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="domingo_com_inicio">
							
						</div>
						
						<label for="" style="display:inline-block;">A</label>
						<div class="input-group transparent clockpicker col-md-5">
							<input type="text" class="form-control prevent" name="domingo_com_fin">
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-12 control-label">Nombre del banco 
			<span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-12">
				<input type="text" class="form-control not-empty prevent" data-name="Nombre del banco" name="bank_name"> <span class="help-block" ><span>
				</span></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-12 control-label">Clabe bancaria 
			<span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-12">
				<input type="text" class="form-control numeric not-empty prevent" maxlength="18" data-name="Cable bancaria" name="clabe"> <span class="help-block" ><span>
				</span></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-md-12 control-label">Número de contrato 
			<span class="text-danger">*</span></label> 
			<div class="col-md-12">
				<input type="text" class="form-control numeric not-empty prevent" data-name="Número de contrato" name="contract_number"> <span class="help-block" ><span>
				</span></span>
			</div>
		</div>
		<div id="mapa_detalles" class="row">
			<div class="col-sm-12 col-xs-12">
				<div class="form-group"><label>Dirección<span class="text-danger">*</span></label> 
					<input type="" name="buscarMapa" id="buscarMapa" placeholder="Buscar en mapa" class="form-control prevent" autocomplete="off"> 
					<input name="latitud" id="latitud" type="hidden"> 
					<input name="longitud" id="longitud" type="hidden"> 
					<div id="map" ></div>
				</div>
			</div> 
		</div> 
		<div class="form-group">
			<label class="col-md-12 control-label">Contrato <span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-12">
				<input type="file" id="contract" class="form-control not-empty image document" data-name="Contrato" name="contract"> 
			</div>
		</div> 
		<div class="form-group">
			<label class="col-md-12 control-label">Logo <span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-12">
				<input type="file" id="logo" class="form-control not-empty image" data-name="Logo" name="logo"> 
			</div>
		</div> 
		<div class="form-group">
			<label class="col-md-12 control-label">Foto 1 <span class="text-danger">*</span></label> 
			<div class="pb-5 col-md-12">
				<input type="file" id="photo1" class="form-control not-empty image" data-name="Foto 1" name="photo1"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div> 
		<div class="form-group">
			<label class="col-md-12 control-label">Foto 2</label> 
			<div class="pb-5 col-md-12">
				<input type="file" id="photo2" class="form-control image" data-name="Foto 2" name="photo2"> 
				<span class="help-block" ><span></span></span>
			</div>
		</div> 
		
		<div class="col-md-12" style="margin-top:20px;">
			<button type="submit" id="guardar" class="btn btn-primary">Enviar</button>
			<a href="{{URL::to('/admin/businesses')}}">
				<button type="button" data-dismiss="modal" class="btn btn-default"> Regresar </button>
			</a>
		</div>
	</form>
@endsection