@extends('layouts.admin')

@section('main-body')
<link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('js/plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
    span.label_show{
        display: block;
        font-weight: bold;
    }
    span.label_show span{
        font-weight: normal;
    }
</style>
<div class="text-center" style="margin: 20px;">
    <div class="modal fade" id="modal_detalles" tabindex="-1" role="dialog" aria-labelledby="modal_detallesLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="modal_detallesLabel">Detalles de la orden</h4>
                </div>
                <div class="modal-body">
                    
                    <div class="row hide" id="load_bar">
                        <span><i class="fa fa-cloud-download fa-7x" aria-hidden="true"></i></span><br>
                        <h3>Cargando información, espere.</h3>
                        <div class="col-xs-12 col-sm-8 col-sm-push-2 col-sm-pull-2 col col-md-6 col-md-push-3 col-md-pull-3">
                            <div class="progress transparent progress-large progress-striped active no-radius no-margin">
                                <div data-percentage="100%" class="progress-bar progress-bar-success animate-progress-bar"></div>       
                            </div>
                        </div>
                    </div>

                    <div id="main_data" class="text-left">
                        <ul class="list-group">
                            <li class="list-group-item active">Datos generales de la orden</li>
                            <li class="list-group-item"><span class="label_show">Número de orden: <span id="order_number"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Estatus: <span id="order-status">Finalizado</span></span></li>
                            <li class="list-group-item"><span class="label_show">Fecha de orden: <span id="order_date"></span></span></li>
                            {{-- <li class="list-group-item"><span class="label_show">Total: <span id="order_total"></span></span></li> --}}
                            {{-- <li class="list-group-item"><span class="label_show">Dirección: <span id="order_addres"></span></span></li> --}}
                            <li class="list-group-item"><span class="label_show">Cliente: <span id="order_client"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Número de sendenboy: <span id="order_sendenboy_id"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Comentarios: <span id="order_comment"></span></span></li>
                        </ul>

                        <ul class="list-group">
                            <li class="list-group-item active">Productos</li>
                            <li class="list-group-item">
                                <div class="table-responsive">
                                    <table id="productos" class="table table-responsive">
                                        <thead>
                                            {{-- <th>ID</th> --}}
                                            <th style="text-align: center;">Producto</th>
                                            <th style="text-align: center;">Precio unitario</th>
                                            <th style="text-align: center;">Cantidad</th>
                                            <th style="text-align: center;">Subtotal</th>
                                            <th style="text-align: center;">Descripción</th>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </li>
                        </ul>

                        {{-- <ul class="list-group">
                            <li class="list-group-item active">Datos del negocio</li>
                            <li class="list-group-item"><span class="label_show">Id del negocio: <span id="business_id"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Negocio de orden: <span id="business_name"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Estado: <span id="business_state"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Ciudad: <span id="business_city"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Domicilio: <span id="business_address"></span></span></li>
                            <li class="list-group-item"><span class="label_show">RFC: <span id="business_rfc"></span></span></li>
                        </ul> --}}

                        <ul class="list-group">
                            <li class="list-group-item active">Datos generales del sendenboy</li>
                            <li class="list-group-item"><span class="label_show">Número de sendenboy: <span id="sendenboy_id"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Nombre: <span id="sendenboy_name"></span></span></li>
                            {{-- <li class="list-group-item"><span class="label_show">Email: <span id="sendenboy_email"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Teléfono: <span id="sendenboy_phone"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Username: <span id="sendenboy_username"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Estado: <span id="sendenboy_state"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Ciudad: <span id="sendeboy_municipality"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Dirección: <span id="sendenboy_address"></span></span></li> --}}
                            <li class="list-group-item">
                                <span class="label_show">Foto: </span>
                                <img width="300px;" src="" id="sendenboy_photo">
                            </li>
                        </ul>

                        {{-- <ul class="list-group">
                            <li class="list-group-item active">Datos del cliente</li>
                            <li class="list-group-item"><span class="label_show">Nombre: <span id="customer_name"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Email: <span id="customer_email"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Teléfono: <span id="customer_phone"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Ciudad: <span id="customer_municipality"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Estado: <span id="customer_state"></span></span></li>
                            <li class="list-group-item"><span class="label_show">Domicilio: <span id="customer_address"></span></span></li>
                        </ul> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <h2>Órdenes pagadas a mi negocio</h2>
    <div class="row-fluid " style="display: none;" id="table_containter">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    {{-- <h4>Opciones</h4>
                    <div>
                        <button type="button" class="btn btn-primary" id="filtrar_busqueda"><i class="fa fa-download" aria-hidden="true"></i> Exportar a excel</button>
                    </div> --}}
                    <div class="grid-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="example3">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">Fecha (Orden)</th>
                                        <th style="text-align: center;">Subtotal productos</th>
                                        <th style="text-align: center;">Comisión</th>
                                        <th style="text-align: center;">Total a pagar</th>
                                        <th style="text-align: center;">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($orders) > 0)
                                        @foreach($orders as $order)
                                            <tr class="" id="{{$order->id}}">
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->created_at}}</td>
                                                <td>${{$order->subtotal}}</td>
                                                <td>${{$order->comision}}</td>
                                                <td>${{$order->total_to_pay}}</td>
                                                <td>
                                                    <button type="button" class="btn btn-info order_details"><i class="fa fa-info" aria-hidden="true"></i> Detalles</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <td colspan="6">No hay órdenes pagadas</td>
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
<script src="{{ asset('js/plugins/jquery-1.8.3.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('js/pagosNegociosAjax.js') }}" type="text/javascript"></script>

<script type="text/javascript">
$(function() {
    setTimeout(function() {
        $('div#table_containter').fadeIn('low');
    }, 500)
})

$('body').delegate('button.order_details','click', function() {
    $('div#load_bar').removeClass('hide');
    $('div#main_data').addClass('hide');
    $('#modal_detalles').modal({
        backdrop: false
    })

    var order_id = $(this).parent().siblings("td:nth-child(1)").text();
    var token = $('meta[name="csrf-token"]').attr('content');
    
    buscarDetalleOrden("{{url('')}}", order_id, 5, token);
});

</script>
@endsection