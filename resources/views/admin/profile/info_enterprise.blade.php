@extends('layouts.admin')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6e-eCv9TpL7WdvCuNh0wbSUSR3m61WFo&libraries=places"></script>
@push('scripts')
<style>

</style>
@section('main-body')

<h2 class='form-tittle text-center'>{{isset($header) ? $header : 'Guardar '}} Información</h2>

<div class="" style="padding: 20px;">
	<div class="row">
	    <form id="form_info_senden" action="{{url('admin/senden/information')}}/{{isset($datos) ? 'update' : 'store'}}" enctype="multipart/form-data" method="POST" autocomplete="off">
	        <input type="hidden" name="_token" id="token" value="{!! csrf_token() !!}" base-url="{{url('')}}">
            @if(isset($datos))
            	@if($datos->logotype != null || $datos->logotype != "")
		            <div class="row text-center" id="logo_contenedor">
		                <div class="col-sm-12 col-xs-12">
		                    <div class="form-group">
		                        <label>Logo actual</label>
		                        <img style="width: 150px;" src='{{url('')}}/{{$datos->logotype}}' class='img-responsive img-thumbnail' alt='Responsive image' id='logo'>
		                    </div>
		                </div>
		            </div>
	        	@endif
	        @endif
            <div class="row">
                <div class="col-sm-6 col-xs-12 hidden">
                    <div class="form-group">
                        <label for="id">ID usuario</label>
                        <input type="text" class="form-control" id="id" name="id" value="{{{ isset($datos) ? $datos->id : "" }}}">
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label for="name">Nombre empresa</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{{ isset($datos) ? $datos->name : "" }}}" placeholder="Nombre del usuario">
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{{ isset($datos) ? $datos->email : "" }}}" placeholder="Correo">
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group">
                        <label for="phoneNumber">Teléfono</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="{{{ isset($datos) ? $datos->phoneNumber : "" }}}" placeholder="Teléfono de la empresa">
                    </div>
                </div>
                <div class="form-group">
					<div class="col-sm-12 col-xs-12">
			            <div class="form-group">
			                <label for="description">Descripción</label>
			                <textarea class="form-control" id="description" name="description" rows="2" placeholder="Da una breve descripción del negocio...">{{{ isset($datos) ? $datos->description : "" }}}</textarea>
			            </div>
			        </div>
		        </div>
		        <div id="mapa_detalles" class="col-sm-12 col-xs-12">
					<div class="form-group"><label>Dirección<span class="text-danger">*</span></label>
						<input type="" name="buscarMapa" id="buscarMapa" placeholder="Buscar en mapa" class="form-control prevent" data-name="Dirección" autocomplete="off"> 
						<input name="latitude" value="{{ isset($datos) ? $datos->latitude : 20.659698799999997 }}" id="latitud" type="hidden">
						<input name="longitude" value="{{ isset($datos) ? $datos->longitude : -103.34960920000003 }}" id="longitud" type="hidden"> 
						<div id="map" style="height: 70%;"></div>
					</div>
				</div>
                <div class="form-group">
					<div class="col-sm-12 col-xs-12">
			            <div class="form-group">
			                <label for="address">Dirección</label>
			                <textarea class="form-control" id="address" name="address" rows="2" placeholder="Escribe la dirección y/o cómo llegar a senden">{{{ isset($datos) ? $datos->address : "" }}}</textarea>
			            </div>
			        </div>
		        </div>
                	                
                <div class="col-sm-12 col-xs-12">
	                <div class="alert alert-info alert-dismissible" role="alert">
				        <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
				        <strong>Nota: </strong>El logo de la empresa debe de ser formato jpg, jpeg o png y pesar menos de 5mb. <br>
				    </div>
				</div>

                <div class="col-sm-6 col-xs-12">
                    <div class="form-group">
                        <label for="logotype">Logotipo</label>
                        <input type="file" class="form-control" id="logotype" name="logotype" placeholder="">
                    </div>
                </div>
            </div>
        	<button type="submit" class="btn btn-primary" id="save_info">Guardar</button>
	    </form>
	</div>
</div>
<script src="{{ asset('js/plugins/jquery-1.8.3.min.js') }}" type="text/javascript"></script> 
<script src="{{ asset('js/validacionesSendenEnterprise.js') }}" type="text/javascript"></script> 

<script type="text/javascript">
	$(function(){
		var map;
		var marker;
		var center;
		$('input#buscarMapa').keydown(function(event){
	        if(event.keyCode == 13) {
	            event.preventDefault();
	            return false;
	        }
	    });
	    initMap();
	})
</script>

@endsection