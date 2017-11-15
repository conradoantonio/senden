@extends('layouts.admin')
@section('main-body')
	<style>
th {
    text-align: center!important;
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
</style>
<div class="content" style="padding-top: 20px;">
    <div class="page-title text-center">
        <h3>Panel administrativo </h3>
    </div>

    @if(auth()->user()->user_type_id == 1)
        <div class="row" id="data_user_admin">
        	<div class="row">
        		<div class="col-md-12 col-vlg-3 col-sm-12">
		        	<div class="tiles green m-b-10">
				        <div class="tiles-body">
							<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
							<div class="tiles-title text-black">Información pedidos </div>
							<div class="widget-stats">
								<div class="wrapper transparent"> 
									<span class="item-title">Pendientes</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->orders_in_progress}}" data-animation-duration="700">0</span>
								</div>
							</div>
							<div class="widget-stats">
								<div class="wrapper transparent">
									<span class="item-title">Finalizados</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->orders_done}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="widget-stats">
								<div class="wrapper transparent">
									<span class="item-title">Cancelados</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->orders_rejected}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="widget-stats ">
								<div class="wrapper last"> 
									<span class="item-title">Total</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->orders_in_progress + $dashboard->orders_done + $dashboard->orders_rejected}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
								<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%" ></div>
							</div>
						</div>			
					</div>	
				</div>
        		<div class="col-md-4 col-vlg-3 col-sm-6">
					<div class="tiles blue m-b-10">
				        <div class="tiles-body">
							<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
							<div class="tiles-title text-black">Información productos </div>
							<div class="widget-stats">
								<div class="wrapper transparent"> 
									<span class="item-title">Activos</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->products_active}}" data-animation-duration="700">0</span>
								</div>
							</div>
							<div class="widget-stats">
								<div class="wrapper transparent">
									<span class="item-title">Rechazados</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->products_rejected}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="widget-stats ">
								<div class="wrapper last"> 
									<span class="item-title">Pendientes</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->products_pending}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
								<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%" ></div>
							</div>
						</div>			
					</div>
				</div>
				<div class="col-md-4 col-vlg-3 col-sm-6">
					<div class="tiles red m-b-10">
				        <div class="tiles-body">
							<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
							<div class="tiles-title text-black">Información usuarios</div>
							<div class="widget-stats">
								<div class="wrapper transparent"> 
									<span class="item-title">Cliente</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->users_app_sendenshop}}" data-animation-duration="700">0</span>
								</div>
							</div>
							<div class="widget-stats">
								<div class="wrapper transparent">
									<span class="item-title">Sendenboy</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->users_app_sendenboy}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="widget-stats ">
								<div class="wrapper last"> 
									<span class="item-title">Negocio</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->users_sys_businesses}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
								<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%" ></div>
							</div>
						</div>			
					</div>
				</div>
				<div class="col-md-4 col-vlg-3 col-sm-6">
					<div class="tiles purple m-b-10">
				        <div class="tiles-body">
							<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
							<div class="tiles-title text-black">Total de negocios</div>
							<div class="widget-stats ">
								<div class="wrapper lasttransparent"> 
									<span class="item-title">Negocios</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->total_bussinesses}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="widget-stats">
								<div class="wrapper last">
									<span class="item-title">Ventas (MXN)</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->total_sales}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
								<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%" ></div>
							</div>
						</div>			
					</div>
				</div>
			</div>{{-- row --}}
        </div>      
    @elseif(auth()->user()->user_type_id == 3 || auth()->user()->user_type_id == 4)
    	<div class="row" id="data_user_business">
        	<div class="row">
        		<div class="col-md-12 col-vlg-3 col-sm-12">
		        	<div class="tiles green m-b-10">
				        <div class="tiles-body">
							<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
							<div class="tiles-title text-black">Información pedidos </div>
							<div class="widget-stats">
								<div class="wrapper transparent"> 
									<span class="item-title">Pendientes</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->orders_in_progress}}" data-animation-duration="700">0</span>
								</div>
							</div>
							<div class="widget-stats">
								<div class="wrapper transparent">
									<span class="item-title">Finalizados</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->orders_done}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="widget-stats">
								<div class="wrapper transparent">
									<span class="item-title">Cancelados</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->orders_rejected}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="widget-stats ">
								<div class="wrapper last"> 
									<span class="item-title">Total</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->orders_in_progress + $dashboard->orders_done + $dashboard->orders_rejected}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
								<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%" ></div>
							</div>
						</div>			
					</div>	
				</div>
        		<div class="col-md-4 col-vlg-3 col-sm-6">
					<div class="tiles blue m-b-10">
				        <div class="tiles-body">
							<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
							<div class="tiles-title text-black">Información productos </div>
							<div class="widget-stats">
								<div class="wrapper transparent"> 
									<span class="item-title">Activos</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->products_active}}" data-animation-duration="700">0</span>
								</div>
							</div>
							<div class="widget-stats">
								<div class="wrapper transparent">
									<span class="item-title">Rechazados</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->products_rejected}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="widget-stats ">
								<div class="wrapper last"> 
									<span class="item-title">Pendientes</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->products_pending}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
								<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%" ></div>
							</div>
						</div>			
					</div>
				</div>
				<div class="col-md-4 col-vlg-3 col-sm-6">
					<div class="tiles red m-b-10">
				        <div class="tiles-body">
							<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
							<div class="tiles-title text-black">Información usuarios (Tipos)</div>
							<div class="widget-stats">
								<div class="wrapper transparent"> 
									<span class="item-title">Admin. Negocio</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->my_users_business}}" data-animation-duration="700">0</span>
								</div>
							</div>
							<div class="widget-stats ">
								<div class="wrapper last"> 
									<span class="item-title">Ventas</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->my_users_sales}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="widget-stats ">
								<div class="wrapper last"> 
									<span class="item-title">Total</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->my_users_business + $dashboard->my_users_sales}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
								<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%" ></div>
							</div>
						</div>			
					</div>
				</div>
				<div class="col-md-4 col-vlg-3 col-sm-6">
					<div class="tiles purple m-b-10">
				        <div class="tiles-body">
							<div class="controller"> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
							<div class="tiles-title text-black">Total de negocios</div>
							<div class="widget-stats">
								<div class="wrapper last">
									<span class="item-title">Ventas (MXN)</span> <span class="item-count animate-number semi-bold" data-value="{{$dashboard->total_sales_business}}" data-animation-duration="700">0</span> 
								</div>
							</div>
							<div class="progress transparent progress-small no-radius m-t-20" style="width:90%">
								<div class="progress-bar progress-bar-white animate-progress-bar" data-percentage="100%" ></div>
							</div>
						</div>			
					</div>
				</div>
			</div>{{-- row --}}
        </div>
    @endif    

    <div class="row">
        <div class="text-center col-sm-12 col-xs-12"><!-- Se imprime con todo el ancho de la página -->
            <canvas id="myChart" height="200" width="700"></canvas>  
        </div>
    </div>
</div>
<script type="text/javascript">
window.onload = function() {
	var ctx = document.getElementById("myChart");
	var ventas = <?php echo $ventas_semanales;?>;

	var data = {
	    labels: ventas.dias_semana,
	    datasets: [
	        {
	            label: "Ventas de última semana en Pesos (MXN)",
	            fill: false,
	            lineTension: 0.1,
	            backgroundColor: "rgba(75,192,192,0.4)",
	            borderColor: "rgba(75,192,192,1)",
	            borderCapStyle: 'butt',
	            borderDash: [],
	            borderDashOffset: 0.0,
	            borderJoinStyle: 'miter',
	            pointBorderColor: "rgba(75,192,192,1)",
	            pointBackgroundColor: "#fff",
	            pointBorderWidth: 1,
	            pointHoverRadius: 5,
	            pointHoverBackgroundColor: "rgba(75,192,192,1)",
	            pointHoverBorderColor: "rgba(220,220,220,1)",
	            pointHoverBorderWidth: 2,
	            pointRadius: 1,
	            pointHitRadius: 10,
	            data: ventas.total_ventas,
	            spanGaps: false,
	        }
	    ]
	};

	var myLineChart = new Chart(ctx, {
	    type: 'bar',
	    data: data,
	    options: {
	        scales: {
	            yAxes: [{
	                ticks: {
	                    beginAtZero:false
	                }
	            }]
	        }
	    }
	});
}
</script>
@endsection