<?php use App\Http\Controllers\MessagesController; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', isset($title) ? $title .' | Senden' : 'Senden')</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/pace-theme-flash.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/jquery.scrollbar.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/bootstrap-theme.min.css')}}"  type="text/css" media="screen"/>
    {{-- <link rel="stylesheet" href="{{ asset('css/font-awesome.css')}}"  type="text/css" media="screen"/> --}}
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-select2/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/style.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('js/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/responsive.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/custom-icon-set.css')}}"  type="text/css" media="screen"/>
    {{-- <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-default/index.css"> --}}{{-- conri --}}
    <link rel="stylesheet" href="{{ asset('css/sweetalert.css')}}"  type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{ asset('css/element-ui.css')}}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-switch.min.css')}}">    
    <link rel="stylesheet" href="{{ asset('js/plugins/lightbox/lightbox.min.css')}}">    
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/datepicker.css')}}"  type="text/css"/>
    <link rel="stylesheet" href="{{ asset('js/plugins/dropzone-master/dist/min/dropzone.min.css')}}">    
    <style type="text/css">
    	input:-webkit-autofill {
    		-webkit-box-shadow: 0 0 0px 1000px white inset !important;
		}
		textarea {
			resize: none;
		}
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
		span.label_show{
			display: block;
		    font-weight: bold;
		}
		span.label_show span{
			font-weight: normal;
		}
    </style>
    <!-- Scripts -->
    <script>
    var baseUrl = "{{url('')}}";
    window.b_url = "{{url('')}}";
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
            //'baseUrl' => url(''),
        ]) !!};
    </script>
</head>
<body class="">
<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse"> 
	<!-- BEGIN TOP NAVIGATION BAR -->
	<div class="navbar-inner">
		<!-- BEGIN NAVIGATION HEADER -->
		<div class="header-seperation"> 
			<!-- BEGIN MOBILE HEADER -->
                <ul class="nav pull-left notifcation-center" id="main-menu-toggle-wrapper" style="display:none">    
                    <li class="dropdown">
                        <a id="main-menu-toggle" href="#main-menu" class="">
                            <div class="iconset top-menu-toggle-white"></div>
                        </a>
                    </li>        
                </ul>
                <!-- END MOBILE HEADER -->
			<!-- BEGIN LOGO -->	
			<a href="#">
				<img src="{{url('img/plantilla/logo.png')}}" class="logo" alt="" data-src="{{url('img/plantilla/logo.png')}}" data-src-retina="{{url('img/plantilla/logo.png')}}" width="106" height="21"/>
			</a>
			<!-- END LOGO -->
			<!-- BEGIN LOGO NAV BUTTONS -->
	            <ul class="nav pull-right notifcation-center">  
	                <li class="dropdown" id="header_task_bar">
	                    <a href="{{url('admin')}}" class="dropdown-toggle active" data-toggle="">
	                        <span><i class="fa fa-home" aria-hidden="true"></i></div></span>
	                    </a>
	                </li>               
	            </ul>
            <!-- END LOGO NAV BUTTONS -->
		</div>
		<!-- END NAVIGATION HEADER -->
		<!-- BEGIN CONTENT HEADER -->
		<div class="header-quick-nav" style="background: white;"> 
			<!-- BEGIN HEADER LEFT SIDE SECTION -->
			<div class="pull-left"> 
				<!-- BEGIN SLIM NAVIGATION TOGGLE -->
				<ul class="nav quick-section">
					<li class="quicklinks">
						<a href="#" class="" id="layout-condensed-toggle">
							<div class="iconset top-menu-toggle-dark"></div>
						</a>
					</li>
				</ul>
				<!-- END SLIM NAVIGATION TOGGLE -->				
				<!-- BEGIN HEADER QUICK LINKS -->
				{{-- <ul class="nav quick-section">
					<li class="quicklinks"><a href="#" class=""><div class="iconset top-reload"></div></a></li>
				</ul> --}}
				<!-- BEGIN HEADER QUICK LINKS -->				
			</div>
			<!-- END HEADER LEFT SIDE SECTION -->
			<!-- BEGIN HEADER RIGHT SIDE SECTION -->
			<div class="pull-right"> 
				<div class="chat-toggler">	
					<!-- BEGIN NOTIFICATION CENTER -->
						<div class="user-details"> 
							<div class="username">
								<span class="bold">{{auth()->user()->name}}</span>									
							</div>						
						</div> 
						<div class="iconset"></div>
					</a>	
					<!-- END NOTIFICATION CENTER -->
					<!-- BEGIN PROFILE PICTURE -->
					<div class="profile-pic"> 
						<img src="{{url(auth()->user()->photo)}}" alt="" data-src="{{url(auth()->user()->photo)}}" data-src-retina="{{url(auth()->user()->photo)}}" width="35" height="35" /> 
					</div>  
					<!-- END PROFILE PICTURE -->     			
				</div>
			</div>
			<!-- END HEADER RIGHT SIDE SECTION -->
		</div> 
		<!-- END CONTENT HEADER --> 
	</div>
	<!-- END TOP NAVIGATION BAR --> 
</div>
<!-- END HEADER -->
	
<!-- BEGIN CONTENT -->
<div class="page-container row-fluid">
	<!-- BEGIN SIDEBAR -->
	<!-- BEGIN MENU -->
	<div class="page-sidebar" id="main-menu"> 
		  <div class="page-sidebar-wrapper scrollbar-dynamic" id="main-menu-wrapper">
		<!-- BEGIN MINI-PROFILE -->
		<div class="user-info-wrapper">	
			<div class="profile-wrapper">
				<img src="{{url(auth()->user()->photo)}}" alt="" data-src="{{url(auth()->user()->photo)}}" data-src-retina="{{url(auth()->user()->photo)}}" width="69" height="69" />
			</div>
			<div class="user-info">
				<div class="username"><span class="semi-bold">{{auth()->user()->isBusinessAdmin() ? auth()->user()->business->name : auth()->user()->name}}</span></div>
				@if(auth()->user()->isSendenAdmin())
					<div class="status">Status<a href="#"><div class="status-icon green"></div>Abierto</a></div>
				@endif
				@if(auth()->user()->isBusinessAdmin())
					<div class="status">Status<a data-toggle="tooltip" data-placement="bottom" title="Pulse aquí para cambiar el status de su negocio" id="change_is_open" href="#"><div class="status-icon {{auth()->user()->isOpenBusiness() ? 'green' : 'red'}}"></div><span id="p-status">{{auth()->user()->isOpenBusiness() ? 'Abierto' : 'Cerrado'}}</span></a></div>
				@endif
				@if(auth()->user()->isBusinessSalesman())
					<div class="status">Status<a href="#"><div class="status-icon {{auth()->user()->isOpenBusiness() ? 'green' : 'red'}}"></div><span id="p-status">{{auth()->user()->isOpenBusiness() ? 'Abierto' : 'Cerrado'}}</span></a></div>
				@endif
			</div>
		</div>
		<!-- END MINI-PROFILE -->
		<!-- BEGIN SIDEBAR MENU -->	
		{{-- <p class="menu-title">BROWSE<span class="pull-right"><a href="javascript:;"><i class="fa fa-refresh"></i></a></span></p> --}}
		<ul>	
			<!-- BEGIN SELECTED LINK -->
            <li class="{{(isset($menu) ? ($menu == 'Inicio' ? 'active' : '') : '')}}">
				<a href="{{url('admin')}}">
					<i class="icon-custom-home"></i>
					<span class="title">Inicio</span>
				</a>
			</li>

			@if(auth()->user()->isBusinessAdmin())
	            <li class="{{(isset($menu) ? ($menu == 'Mi perfil' ? 'active' : '') : '')}}">
					<a href="{{url('admin/profile')}}">
						<i class="fa fa-user"></i>
						<span class="title">Mi Perfil</span>
					</a>
				</li>
			@endif

			@if(auth()->user()->isSendenAdmin())
                <li class="{{(isset($menu) ? ($menu == 'Pedidos Activos' ? 'active' : '') : '')}}">
					<a href="{{url('admin/orders')}}">
						<i class="fa fa-cubes"></i>
						<span class="title">Monitoreo de pedidos</span>
					</a>
				</li>
			@elseif(auth()->user()->isBusinessAdmin() || auth()->user()->isBusinessSalesman())
                <li class="{{(isset($menu) ? ($menu == 'Pedidos Activos' ? 'active' : '') : '')}}">
					<a href="{{url('admin/orders')}}">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						<span class="title">Mis Pedidos Activos</span>
					</a>
				</li>
			@endif
			
			@if(auth()->user()->isBusinessSalesman())
                <li class="{{(isset($menu) ? ($menu == 'Liberar Pedidos' ? 'active' : '') : '')}}">
					<a href="{{url('admin/liberarOrdenes')}}">
						<i class="fa fa-check-circle-o" aria-hidden="true"></i>
						<span class="title">Liberar Pedidos</span>
					</a>
				</li>
			@endif

			<!-- BEGIN SINGLE LINK -->
			@if(auth()->user()->isSendenAdmin())
                <li class="{{(isset($menu) ? ($menu == 'Negocios' ? 'active' : '') : '')}}">
					<a href="{{url('admin/businesses')}}">
						<i class="fa fa-building-o "></i>
						<span class="title">Negocios</span>
					</a>
				</li>
			@endif

			@if(auth()->user()->isBusinessAdmin() || auth()->user()->isSendenAdmin())
				<li class="{{(isset($menu) ? ($menu == 'Usuarios' ? 'open start' : '') : '')}}">
	                <a href="javascript:;">
	                   	<i class="fa fa-users "></i>
	                    <span class="title">Usuarios (Sistema)</span>
	                    <span class="{{(isset($menu) ? ($menu == 'Usuarios' ? 'arrow open' : 'arrow') : '')}}"></span>
	                </a>
	                <ul class="sub-menu" style="{{(isset($menu) ? ($menu == 'Usuarios' ? 'display: block;' : '') : '')}}">
						@if(auth()->user()->isSendenAdmin())
	                    	<li class="{{(isset($title) ? ($title == 'Usuarios Administradores' ? 'active' : '') : '')}}"><a href="{{url('admin/users/senden')}}">Administradores senden</a></li> 
	                    	<li class="{{(isset($title) ? ($title == 'Usuarios de Negocios' ? 'active' : '') : '')}}"><a href="{{url('admin/users/business')}}">Administradores negocios</a></li> 
	                    	<li class="{{(isset($title) ? ($title == 'Usuarios sendenshop' ? 'active' : '') : '')}}"><a href="{{url('admin/users/sendenshop')}}">Usuarios sendenshop</a></li> 
			            @endif
	                	@if(auth()->user()->isBusinessAdmin())
		                    <li class="{{(isset($title) ? ($title == 'Usuarios de mi negocio' ? 'active' : '') : '')}}"><a href="{{url('admin/users/mybusiness')}}">Usuarios de mi negocio</a></li> 
			            @endif
	                </ul>
	            </li>
			@endif

			@if(auth()->user()->isSendenAdmin())
                <li class="{{(isset($menu) ? ($menu == 'Sendenboys' ? 'open start' : '') : '')}}">
	                <a href="javascript:;">
	                    <i class="fa fa-bicycle"></i>
	                    <span class="title">Sendenboys</span>
	                    <span class="{{(isset($menu) ? ($menu == 'Sendenboys' ? 'arrow open' : 'arrow') : '')}}"></span>
	                </a>
	                <ul class="sub-menu" style="{{(isset($menu) ? ($menu == 'Sendenboys' ? 'display: block;' : '') : '')}}">
	                    <li class="{{(isset($title) ? ($title == 'Sendenboys' ? 'active' : '') : '')}}"><a href="{{url('admin/sendenboys')}}">Lista de sendenboys</a></li> 
	                    <li class="{{(isset($title) ? ($title == 'Registrar sendenboy' ? 'active' : '') : '')}}"><a href="{{url('admin/sendenboys/form_sendenboy')}}">Registrar Sendenboy</a></li> 
	                </ul>
	            </li>
			@endif

			@if(auth()->user()->isSendenAdmin())
				<li class="{{(isset($menu) ? ($menu == 'Notificaciones App' ? 'active' : '') : '')}}">
					<a href="{{url('admin/notificaciones_app')}}">
						<i class="fa fa-bell" aria-hidden="true"></i>
						<span class="title">Notificaciones App</span>
					</a>
				</li>

				<li class="{{(isset($menu) ? ($menu == 'Pagos' ? 'open start' : '') : '')}}">
	                <a href="javascript:;">
						<i class="fa fa-money" aria-hidden="true"></i>
	                    <span class="title">Pagos</span>
	                    <span class="{{(isset($menu) ? ($menu == 'Pagos' ? 'arrow open' : 'arrow') : '')}}"></span>
	                </a>
	                <ul class="sub-menu" style="{{(isset($menu) ? ($menu == 'Pagos' ? 'display: block;' : '') : '')}}">
	                    <li class="{{(isset($title) ? ($title == 'Pago a negocio' ? 'active' : '') : '')}}"><a href="{{url('admin/pagar/negocios')}}">Pagar a negocios</a></li> 
	                    <li class="{{(isset($title) ? ($title == 'Historial pago a negocios' ? 'active' : '') : '')}}"><a href="{{url('admin/pagar/negocios/historial')}}">Historial pago negocios</a></li> 
	                    <li class="{{(isset($title) ? ($title == 'Pago a sendenboy' ? 'active' : '') : '')}}"><a href="{{url('admin/pagar/sendenboys')}}">Pagar a sendenboys</a></li>
	                    <li class="{{(isset($title) ? ($title == 'Historial pago a sendenboys' ? 'active' : '') : '')}}"><a href="{{url('admin/pagar/sendenboys/historial')}}">Historial pago sendenboys</a></li>	
	                </ul>
	            </li>
			@endif

			@if(auth()->user()->isBusinessAdmin())
                <li class="{{(isset($menu) ? ($menu == 'Mis pagos' ? 'active' : '') : '')}}">
					<a href="{{url('admin/my_earnings')}}">
						<i class="fa fa-money" aria-hidden="true"></i>
						<span class="title">Mis pagos</span>
					</a>
				</li>
			@endif

			@if(auth()->user()->isBusinessAdmin())
                <li class="{{(isset($menu) ? ($menu == 'Productos' ? 'active' : '') : '')}}">
					<a href="{{url('admin/products')}}">
						<i class="fa fa-cubes"></i>
						<span class="title">Mis productos</span>
					</a>
				</li>
			@endif

			@if(auth()->user()->isBusinessAdmin())
				<li class="{{$menu == 'Imágenes' ? 'active' : ''}}">
	                <a href="{{url('admin/cargar_imagenes')}}">
	                    <i class="fa fa-upload" aria-hidden="true"></i>
	                    <span class="title">Cargar imágenes (Productos)</span>
	                </a>
	            </li>
			@endif

			@if(auth()->user()->isBusinessAdmin() || auth()->user()->isSendenAdmin())
                <li class="{{(isset($menu) ? ($menu == 'Incidencias' ? 'active' : '') : '')}}">
					<a href="{{url('admin/incidencias')}}">
						<i class="fa fa-exclamation-circle" aria-hidden="true"></i>
						<span class="title">{{auth()->user()->isBusinessAdmin() ? 'Mis incidencias' : 'Incidencias'}}</span>
					</a>
				</li>
			@endif

			@if(auth()->user()->isBusinessAdmin() || auth()->user()->isSendenAdmin())
                <li class="{{(isset($menu) ? ($menu == 'Pedidos finalizados' ? 'active' : '') : '')}}">
					<a href="{{url('admin/orders-done')}}">
						<i class="fa fa-truck" aria-hidden="true"></i>
						<span class="title">Pedidos finalizados</span>
					</a>
				</li>
			@endif
			
			@if(auth()->user()->isSendenAdmin())
                <li class="{{(isset($menu) ? ($menu == 'Validar productos' ? 'active' : '') : '')}}">
					<a href="{{url('admin/products/approve')}}">
						<i class="fa fa-cubes"></i>
						<span class="title">Validar Productos</span>
					</a>
				</li>
			@endif
			<!-- END SINGLE LINK -->

			@if(auth()->user()->isSendenAdmin() || auth()->user()->isBusinessAdmin())
				<li class="{{(isset($menu) ? ($menu == 'Mensajeria' ? 'active' : '') : '')}}">
					<a href="{{url('admin/mensajes')}}">
						<i class="fa fa-comments" aria-hidden="true"></i>
						<span class="title">Mensajería</span> <span class="badge badge-success">{{MessagesController::count_messages()}}</span>
					</a>
				</li>
	        @endif

			@if(auth()->user()->isSendenAdmin())
				<li class="{{(isset($menu) ? ($menu == 'Configuraciones' ? 'open start' : '') : '')}}">
	                <a href="javascript:;">
	                    <i class="fa fa-cogs"></i>
	                    <span class="title">Configuración</span>
	                    <span class="{{(isset($menu) ? ($menu == 'Configuraciones' ? 'arrow open' : 'arrow') : '')}}"></span>
	                </a>
	                <ul class="sub-menu" style="{{(isset($menu) ? ($menu == 'Configuraciones' ? 'display: block;' : '') : '')}}">
	                    <li class="{{(isset($title) ? ($title == 'Faqs' ? 'active' : '') : '')}}"><a href="{{url('admin/faqs')}}">Preguntas Frecuentes</a></li> 
	                    <li class="{{(isset($title) ? ($title == 'Información senden' ? 'active' : '') : '')}}"><a href="{{url('admin/senden/information')}}">Información Empresa</a></li> 
	                </ul>
	            </li>
	        @endif
			
			<!-- END TWO LEVEL MENU -->	

			<!-- BEGIN SINGLE LINK -->
                <li class="loggingOut">
                    <a href="#">
                        <i class="fa fa-power-off" aria-hidden="true"></i>
                        <span class="title">Cerrar sesión</span>
                    </a>
                </li>
                <!-- END SINGLE LINK -->

			<li class="">
				<a href="#">
					<span class="title"></span>
				</a>
			</li>		
		</ul>
		<!-- END SIDEBAR MENU -->
	</div>
	</div>
	<!-- BEGIN SCROLL UP HOVER -->
	<a href="#" class="scrollup">Scroll</a>
	<!-- END SCROLL UP HOVER -->
	<!-- END MENU -->
	<!-- BEGIN SIDEBAR FOOTER WIDGET -->
	<div class="footer-widget">		
		<div class="progress transparent progress-small no-radius no-margin">
			<div data-percentage="100%" class="progress-bar progress-bar-success animate-progress-bar"></div>		
		</div>
		<div class="pull-right">
			<div class="details-status">
				<span data-animation-duration="560" data-value="100" class="animate-number"></span>%
			</div>	
			<a href="#" class="loggingOut"><i class="fa fa-power-off"></i></a>
		</div>
	</div>
	<!-- END SIDEBAR FOOTER WIDGET -->
	<!-- END SIDEBAR --> 
	<!-- BEGIN PAGE CONTAINER-->
	<div class="page-content"> 
		<div class="content">  
			<!-- BEGIN PAGE TITLE -->
			<div id="app">
				@yield('main-body')
			</div>
			<!-- END PAGE TITLE -->
			<!-- BEGIN PlACE PAGE CONTENT HERE -->
			
			<!-- END PLACE PAGE CONTENT HERE -->
		</div>
	</div>
	<!-- END PAGE CONTAINER -->
</div>
<!-- END CONTENT --> 
<!-- Scripts -->
    @stack('before-scripts')
    <script src="{{ asset('js/app.js') }}"></script>
    
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.js"></script> --}}
	{{-- <script src="https://unpkg.com/element-ui@1.3.1/lib/index.js"></script> --}}
    <script src="{{ asset('js/plugins/jquery-1.8.3.min.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('js/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('js/plugins/boostrapv3/js/bootstrap.min.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('js/plugins/breakpoints.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('js/plugins/jquery-unveil/jquery.unveil.min.js') }}" type="text/javascript"></script> 
    <script src="{{ asset('js/plugins/jquery-block-ui/jqueryblockui.js') }}" type="text/javascript"></script> 

    <script src="{{ asset('js/plugins/jquery-scrollbar/jquery.scrollbar.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}" type="text/javascript"></script>  
    <script src="{{ asset('js/plugins/jquery-numberAnimate/jquery.animateNumbers.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/Chartjs/Chart.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/jquery-datatable/js/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/jquery-datatable/extra/js/dataTables.tableTools.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/datatables-responsive/js/datatables.responsive.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/datatables-responsive/js/lodash.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/plugins/boostrap-clockpicker/bootstrap-clockpicker.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/bootstrap-switch.js') }}"></script>
	<script src="{{ asset('js/datatables.js') }}"></script>
	<script src="{{ asset('js/plugins/lightbox/lightbox.min.js')}}"></script>
    <script src="{{ asset('js/plugins/bootstrap-select2/select2.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/chart.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type='text/javascript'></script>



	@stack('scripts_normal')
	@stack('checkbox')
    <!-- END PAGE LEVEL PLUGINS -->     

    <!-- BEGIN CORE TEMPLATE JS --> 
    <script src="{{ asset('js/core.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
	    $(function(){
		    $('table#example3, table#incidences_table').dataTable();
		    $('.clockpicker ').clockpicker({
		        autoclose: true
		    });
		    $('[data-toggle="tooltip"]').tooltip()
		})

    	$('body').delegate('.loggingOut','click', function() {
	        swal({
	            title: "¿Desea cerrar la sesión?",
	            type: "warning",
	            showCancelButton: true,
	            confirmButtonText: "Salir",
	            cancelButtonText: "Cancelar",
	            closeOnConfirm: false
	        },
	        function() {
	            window.location.href = "{{ url('logout')}}";
	        });
	    });

	    $('body').delegate('#change_is_open','click', function() {
	    	if ($('#change_is_open div').hasClass('green')) {
        		var is_open = "cerrado";
        	} else if ($('#change_is_open div').hasClass('red')) {
        		var is_open = "abierto";
        	}
	        swal({
	            title: "¿Desea marcar su negocio como "+ is_open +"?",
	            type: "warning",
	            showCancelButton: true,
	            confirmButtonText: "Aceptar",
	            cancelButtonText: "Cancelar",
	            closeOnConfirm: false
	        },
	        function() {
	        	var url = baseUrl+'/admin/users/mybusiness/change';
	        	var id = "{{auth()->user()->business_id}}";
	        	var token = "{{csrf_token()}}";
	        	if ($('#change_is_open div').hasClass('green')) {
	        		var status = 0;
	        	} else if ($('#change_is_open div').hasClass('red')) {
	        		var status = 1;
	        	}
	            $.ajax({
			        method: "POST",
			        type:"POST",
			        url: url,
			        data:{
			            "id":id,
			            "status":status,
			            "_token":token
			        },
			        success: function(response) {
			        	swal.close();
			            console.info(response);
	        			if ($('#change_is_open div').hasClass('green')) {
	        				$('#change_is_open div').removeClass('green').addClass('red');
	        				$('span#p-status').text('Cerrado');
	        			} else if ($('#change_is_open div').hasClass('red')) {
	        				$('#change_is_open div').removeClass('red').addClass('green');
	        				$('span#p-status').text('Abierto');
	        			}
			        },
			        error: function(xhr, status, error) {
			            swal({
			                title: "<small>¡Error!</small>",
			                text: "Se encontró un error tratando de cambiar el status de su negocio, por favor trate de nuevo o recargue la página.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
			                html: true
			            });
			        }
			    });
	        });
	    });

	    function initMap() {
		    center = getPosicion();
		    var elem = document.getElementById("map");
		    if (center == null) {
		        center = {lat: 20.676580, lng: -103.34785};
		        if (navigator.geolocation) {
		            navigator.geolocation.getCurrentPosition(function (pos) {
		                center = {lat: pos.coords.latitude, lng: pos.coords.longitude};
		                drawMap(elem, center);
		                setPosicion(center);
		            }, function () {
		                drawMap(elem, center);
		            });
		        } else {
		            drawMap(elem, center);
		        }
		    } else {
		        drawMap(elem, center);
		    }
		}

		function drawMap(elem, center) {
		    map = new google.maps.Map(elem, {
		        center: center,
		        zoom: 14,
		        scrollwheel: false
		    });
		    marker = new google.maps.Marker({
		        position: center,
		        map: map,
		        animation: google.maps.Animation.DROP,
		        title: 'Mueve el mapa'
		    });
		    var searchBox = new google.maps.places.SearchBox(document.getElementById('buscarMapa'));

		    google.maps.event.addListener(searchBox, 'places_changed', function(){
		        var places = searchBox.getPlaces();
		        var bounds = new google.maps.LatLngBounds();
		        var i, place;

		        for (i=0; place=places[i]; i++) {
		            bounds.extend(place.geometry.location);
		            marker.setPosition(place.geometry.location);
		        }

		        map.fitBounds(bounds);
		        map.setZoom(14);
		    })
		    map.addListener('center_changed', function () {
		        var p = map.getCenter();
		        marker.setPosition({lat: p.lat(), lng: p.lng()});
		        setPosicion({lat: p.lat(), lng: p.lng()});
		    });
		}
		    

		function setPosicion(center) {
		    $("#latitud").val(center.lat);
		    $("#longitud").val(center.lng);
		}

		function getPosicion() {
		    if ($("#latitud").val() != "") {
		        return {lat: parseFloat($("#latitud").val()), lng: parseFloat($("#longitud").val())};
		    }
		    return null;
		}
    </script>
    @stack('scripts')

</body>
</html>