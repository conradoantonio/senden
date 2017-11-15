@extends('layouts.admin')
<style>
    span.label_show{display: block;font-weight: bold;}
    span.label_show span{font-weight: normal;}
    table{ text-align: center; }
</style>
@section('main-body')
<link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('js/plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>

<div class="row-fluid">
    <div class="grid simple">
        <div class="grid-title">
            <h4><span class="semi-bold">@if(auth()->user()->isSendenAdmin()) Monitoreo de pedidos @else Pedidos @endif</span></h4>
            <div class="grid-body">
                <div class="table-responsive">
                    @if(auth()->user()->isSendenAdmin())
                    <table class="table" id="orders-table">
                        <thead>
                            <tr>
                                <th style="text-align: center">ID</th>
                                <th style="text-align: center"># Pedido</th>
                                <th style="text-align: center">Negocio</th>
                                {{-- <th>Categoría</th> --}}
                                <th style="text-align: center">Sendenboy</th>
                                {{-- <th style="text-align: center"># Sendenboy</th> --}}
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center">Fecha</th>
                                <th style="text-align: center">Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($orders))
                                @foreach($orders as $order)
                                    <tr>
                                        <td align="center">{{$order->order_id}}</td>
                                        <td align="center">{{$order->order_number ? $order->order_number : 'No asignado'}}</td>
                                        <td align="center">{{$order->business_name}}</td>
                                        {{-- <td>{{$order->categorie_name}}</td> --}}
                                        <td align="center">{{$order->sendenboy ? $order->sendenboy : 'No asignado'}}</td>
                                        {{-- <td align="center">{{$order->sendenboy_id ? $order->sendenboy_id : 'No asignado'}}</td> --}}
                                        <td align="center">
                                            {!! 
                                                ($order->status == 1 ? "<span class='label'>Localizando</span>" : 
                                                    ($order->status == 2 ? "<span class='label label-info'>Localizado</span>" : 
                                                        ($order->status == 3 ? "<span class='label label-warning'>Pagado</span>" : 
                                                            ($order->status == 4 ? "<span class='label label-success'>Recogido</span>" : "<span class='label label-important'>Desconocido</span>"
                                                            )
                                                        )
                                                    )
                                                )
                                            !!}
                                        </td>
                                        <td align="center">{{$order->order_date}}</td>
                                        <td align="center">
                                            <button type="button" class="btn btn-sm btn-info details_test" order_id="{{$order->order_id}}">
                                                <i class="fa fa-spinner fa-spin" style="display: none"></i>
                                                Ver
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger cancelar_pedido" order_id="{{$order->order_id}}">Cancelar</button>
                                        </td>
                                    </tr>
                                @endforeach                                
                            @endif
                        </tbody>
                    </table>
                    @else
                    <table class="table" id="orders-table">
                        <thead>
                            <tr>
                                <th style="text-align: center">ID</th>
                                <th style="text-align: center"># Pedido</th>
                                {{-- <th>Negocio</th>
                                <th>Categoría</th> --}}
                                <th style="text-align: center">Sendenboy</th>
                                {{-- <th style="text-align: center"># Sendenboy</th> --}}
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center">Fecha</th>
                                <th style="text-align: center">Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($orders))
                                @foreach($orders as $order)
                                    <tr>
                                        <td align="center">{{$order->order_id}}</td>
                                        <td align="center">{{$order->order_number}}</td>
                                        {{-- <td>{{$order->business_name}}</td>
                                        <td>{{$order->categorie_name}}</td> --}}
                                        <td align="center">{{$order->sendenboy ? $order->sendenboy : 'No asignado'}}</td>
                                        {{-- <td align="center">{{$order->sendenboy_id ? $order->sendenboy_id : 'No asignado'}}</td> --}}
                                        <td align="center">
                                            {!! 
                                                ($order->status == 1 ? "<span class='label'>Localizando</span>" : 
                                                    ($order->status == 2 ? "<span class='label label-info'>Localizado</span>" : 
                                                        ($order->status == 3 ? "<span class='label label-warning'>Pagado</span>" : 
                                                            ($order->status == 4 ? "<span class='label label-success'>Recogido</span>" : "<span class='label label-important'>Desconocido</span>"
                                                            )
                                                        )
                                                    )
                                                )
                                            !!}
                                        </td>
                                        <td align="center">{{$order->order_date}}</td>
                                        <td align="center">
                                            <button type="button" class="btn btn-sm btn-info details_test" order_id="{{$order->order_id}}">
                                                <i class="fa fa-spinner fa-spin" style="display: none"></i>
                                                Ver
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@if(auth()->user()->isSendenAdmin())
<!-- /.modal sendenAdmin -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="order_modal_title" id="order_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="order_modal_title">Detalles de pedido</h4>
            </div>
            <div class="modal-body">
                <!-- general order data -->
                <ul class="list-group">
                    <li class="list-group-item active">Datos generales de la orden</li>
                    <li class="list-group-item">
                        <span class="label_show">Número de orden: <span id="order-number"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Estatus: <span id="order-status"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Fecha de orden: <span id="order-date"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Domicilio de entrega: <span id="order-address"></span></span>
                    </li>
                    {{-- <li class="list-group-item">
                        <span class="label_show">Lugar: <span id="order-place"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Banderazo: <span id="order-flag"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Comisión: <span id="order-comission"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Precio envio: <span id="order-shipping-price"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Total: <span id="order-total"></span></span>
                    </li> --}}
                    <li class="list-group-item">
                        <span class="label_show">Cliente: <span id="order-client"></span></span>
                    </li>
                    <li class="list-group-item hide" id="item_sendenboy_id">
                        <span class="label_show">Número de sendenboy: <span id="order-sendenboy-id"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Comentarios: <span id="order-comments"></span></span>
                    </li>
                </ul>
                <!-- <div class="row">
                    <div class="text-left">
                        <label class="control-label">Datos generales de la orden</label>
                    </div>
                    <hr style="margin-top:0">
                    <div class="col-md-12">
                        <label class="control-label col-md-3">Número de Orden</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-number"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Status</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-status"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Fecha de Orden</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-date"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Domicilio de entrega</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-address"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Lugar</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-place"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Banderazo</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-flag"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Comisión</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-comission"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Precio envio</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-shipping-price"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Total</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-total"><span></label>
                    </div>
                    
                    <div class="col-md-12">
                        <label class="control-label col-md-3">Cliente</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-client"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Número de sendenboy</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-sendenboy-id"><span></label>
                    </div>
                </div> -->
                <!-- products -->
                <ul class="list-group">
                    <li class="list-group-item active">Productos</li>
                    <li class="list-group-item">
                        <div class="table-responsive">
                            <table class="table table-responsive" id="products">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">producto</th>
                                        <th style="text-align: center;">precio unitario</th>
                                        <th style="text-align: center;">cantidad</th>
                                        <th style="text-align: center;">subtotal</th>
                                        <th style="text-align: center;">Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
                <!-- <div class="row" style="margin-top:15px">
                    <div class="text-left">
                        <label class="control-label">Productos</label>
                    </div>
                    <hr style="margin-top:0">
                    <div class="table-responsive">
                        <table class="table table-responsive" id="products">
                            <thead>
                                <tr>
                                    <th>producto</th>
                                    <th>precio unitario</th>
                                    <th>cantidad</th>
                                    <th>subtotal</th>
                                    <th>total</th>
                                    <th>comentarios</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div> -->
                <!-- general client data -->
                <ul class="list-group">
                    <li class="list-group-item active">Datos generales del cliente</li>
                    <li class="list-group-item">
                        <span class="label_show">Número de cliente: <span id="client-id"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Nombre: <span id="client-name"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Email: <span id="client-email"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Teléfono: <span id="client-phone"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Dirección: <span id="client-address"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Municipio: <span id="client-municipality"></span></span>
                    </li>
                </ul>
                <!-- <div class="row" style="margin-top:15px">
                    <div class="text-left">
                        <label class="control-label">Datos generales del cliente</label>
                    </div>
                    <hr style="margin-top:0">
                    <div class="col-md-12">
                        <label class="control-label col-md-3">Número de cliente</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="client-id"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Nombre</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="client-name"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Dirección</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="client-address"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Municipio</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="client-municipality"><span></label>
                    </div>
                </div> -->
                <!-- general business data -->
                <ul class="list-group">
                    <li class="list-group-item active">Datos generales del negocio</li>
                    <li class="list-group-item">
                        <span class="label_show">Negocio: <span id="business-name"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Categoría: <span id="business-categorie"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Rfc: <span id="business-rfc"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Teléfono: <span id="business-phone"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Dirección: <span id="business-address"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Lugar: <span id="business-place"></span></span>
                    </li>
                </ul>
                <!-- <div class="row" style="margin-top:15px">
                    <div class="text-left">
                        <label class="control-label">Datos generales del negocio</label>
                    </div>
                    <hr style="margin-top:0">
                    <div class="col-md-12">
                        <label class="control-label col-md-3">Negocio</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="business-name"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Categoría</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="business-categorie"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Rfc</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="business-rfc"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Teléfono</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="business-phone"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Dirección</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="business-address"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Lugar</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="business-place"><span></label>
                    </div>
                </div> -->
                <!-- general sendenboy data -->
                <ul class="list-group hide" id="group_sendenboy_data">
                    <li class="list-group-item active">Datos generales del sendenboy</li>
                    <li class="list-group-item">
                        <span class="label_show">Número de sendenboy: <span id="sendenboy-id"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Nombre: <span id="sendenboy-name"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Email: <span id="sendenboy-email"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Teléfono: <span id="sendenboy-phone"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Dirección: <span id="sendenboy-address"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Municipio: <span id="sendenboy-municipality"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Foto: </span>
                        <img width="300px;" src="" id="sendenboy-photo">
                    </li>

                    {{-- <li class="list-group-item">
                        <span class="label_show">Tarjeta de circulación: <span id="sendenboy-circulation-card"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Licencia: <span id="sendenboy-license"></span></span>
                    </li> --}}
                </ul>
                <!-- <div class="row" style="margin-top:15px">
                    <div class="text-left">
                        <label class="control-label">Datos generales del sendenboy</label>
                    </div>
                    <hr style="margin-top:0">
                    <div class="col-md-12">
                        <label class="control-label col-md-3">Número de sendenboy</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="sendenboy-id"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Nombre</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="sendenboy-name"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Dirección</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="sendenboy-address"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Municipio</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="sendenboy-municipality"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Tarjeta de circulación</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="sendenboy-circulation-card"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Licencia</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="sendenboy-license"><span></label>
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@else
<!-- /.modal businessAdmin -->
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="order_modal_title" id="order_modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="order_modal_title">Detalles de pedido</h4>
            </div>
            <div class="modal-body">
                <!-- general order data -->
                <ul class="list-group">
                    <li class="list-group-item active">Datos generales de la orden</li>
                    <li class="list-group-item">
                        <span class="label_show">Número de orden: <span id="order-number"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Estatus: <span id="order-status"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Fecha de orden: <span id="order-date"></span></span>
                    </li>
                    {{-- <li class="list-group-item">
                        <span class="label_show">Domicilio de entrega: <span id="order-address"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Lugar: <span id="order-place"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Banderazo: <span id="order-flag"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Comisión: <span id="order-comission"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Precio envio: <span id="order-shipping-price"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Total: <span id="order-total"></span></span>
                    </li> --}}
                    <li class="list-group-item hide" id="item_sendenboy_id">
                        <span class="label_show">Número de sendenboy: <span id="order-sendenboy-id"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Cliente: <span id="order-client"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Comentarios: <span id="order-comments"></span></span>
                    </li>
                </ul>

                <ul class="list-group">
                    <li class="list-group-item active">Productos</li>
                    <li class="list-group-item">
                        <div class="table-responsive">
                            <table class="table table-responsive" id="products">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">producto</th>
                                        <th style="text-align: center;">precio unitario</th>
                                        <th style="text-align: center;">cantidad</th>
                                        <th style="text-align: center;">subtotal</th>
                                        <th style="text-align: center;">Descripción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </li>
                </ul>
                
                <!-- <div class="row">
                    <div class="text-left">
                        <label class="control-label">Datos generales de la orden</label>
                    </div>
                    <hr style="margin-top:0">
                    <div class="col-md-12">
                        <label class="control-label col-md-3">Número de Orden</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-number"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Status</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-status"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Fecha de Orden</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-date"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Domicilio de entrega</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-address"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Lugar</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-place"><span></label>
                    </div>

                   <div class="col-md-12">
                        <label class="control-label col-md-3">Banderazo</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-flag"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Comisión</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-comission"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Precio envio</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-shipping-price"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Total</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-total"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Cliente</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="order-client"><span></label>
                    </div>
                </div> -->
                <!-- general sendenboy data -->
                {{-- <ul class="list-group">
                    <li class="list-group-item active">Datos generales del cliente</li>
                    <li class="list-group-item">
                        <span class="label_show">Número de cliente: <span id="client-id"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Nombre: <span id="client-name"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Email: <span id="client-email"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Teléfono: <span id="client-phone"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Dirección: <span id="client-address"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Municipio: <span id="client-municipality"></span></span>
                    </li>
                </ul> --}}

                <ul class="list-group hide" id="group_sendenboy_data">
                    <li class="list-group-item active">Datos generales del sendenboy</li>
                    <li class="list-group-item">
                        <span class="label_show">Número de sendenboy: <span id="sendenboy-id"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Nombre: <span id="sendenboy-name"></span></span>
                    </li>
                    {{-- <li class="list-group-item">
                        <span class="label_show">Email: <span id="sendenboy-email"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Teléfono: <span id="sendenboy-phone"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Dirección: <span id="sendenboy-address"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Municipio: <span id="sendenboy-municipality"></span></span>
                    </li> --}}
                    <li class="list-group-item">
                        <span class="label_show">Foto: </span>
                        <img width="300px;" src="" id="sendenboy-photo">
                    </li>
                    {{-- <li class="list-group-item">
                        <span class="label_show">Tarjeta de circulación: <span id="sendenboy-circulation-card"></span></span>
                    </li>
                    <li class="list-group-item">
                        <span class="label_show">Licencia: <span id="sendenboy-license"></span></span>
                    </li> --}}
                </ul>
                <!-- <div class="row" style="margin-top:15px">
                    <div class="text-left">
                        <label class="control-label">Datos generales del sendenboy</label>
                    </div>
                    <hr style="margin-top:0">
                    <div class="col-md-12">
                        <label class="control-label col-md-3">Número de sendenboy</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="sendenboy-id"><span></label>
                    </div>

                    <div class="col-md-12">
                        <label class="control-label col-md-3">Nombre</label>
                        <label class="control-label col-md-9"><span class="semi-bold" id="sendenboy-name"><span></label>
                    </div>
                </div> -->
                <!-- products -->
                
                <!-- <div class="row" style="margin-top:15px">
                    <div class="text-left">
                        <label class="control-label">Productos</label>
                    </div>
                    <hr style="margin-top:0">
                    <div class="table-responsive">
                        <table class="table table-responsive" id="products">
                            <thead>
                                <tr>
                                    <th>producto</th>
                                    <th>precio unitario</th>
                                    <th>cantidad</th>
                                    <th>subtotal</th>
                                    <th>total</th>
                                    <th>comentarios</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endif

<script src="{{ asset('js/plugins/jquery-1.8.3.min.js') }}" type="text/javascript"></script> 
<script src="{{ asset('js/orders.js') }}"></script>
<script type="text/javascript">
    $(function(){
        var url = "{{url('')}}";
        var privilege = "{{auth()->user()->user_type_id}}";
        var token = "{{csrf_token()}}";
        setInterval(function(){
            refreshTable(url,privilege,token);
        }, 10000);
    });

    $('body').delegate('.details_test','click', function() {
        var order_id = $(this).attr('order_id');
        orders.getOrderDetails(order_id, $(this));
    });

    $('body').delegate('.cancelar_pedido','click', function() {
        var order_id = $(this).parent().siblings("td:nth-child(1)").text();
        var url = "{{url('')}}";
        var token = "{{csrf_token()}}";

        swal({
            title: "¿Realmente desea cancelar el pedido con el id <span style='color:#F8BB86'>" + order_id + "</span> ?",
            text: "¡Esta acción no podrá deshacerse!",
            html: true,
            type: "warning",
            showCancelButton: true,
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si, continuar",
            showLoaderOnConfirm: true,
            allowEscapeKey: true,
            allowOutsideClick: true,
            closeOnConfirm: false
        },
        function() {
            cancelarPedido(url, order_id, token);
        });
    });

    function refreshTable(url,privilege,token) {
        url = url.concat('/admin/orders/reload_table');
        $.ajax({
            method: "POST",
            type:"POST",
            url: url,
            data:{
                "_token":token
            },
            success:function(data) {
                //console.log(data);
                $("table#orders-table tbody").children().remove();             
                var oTable = $('#orders-table').dataTable();
                oTable.fnClearTable();
                $.each(data,function(i,e) {
                    if ( data.length > 0 ) {

                        var status = (e.status == 1 ? " <span class='label'>Localizando</span> " : 
                            (e.status == 2 ? " <span class='label label-info'>Localizado</span> " : 
                                (e.status == 3 ? " <span class='label label-warning'>Pagado</span> " : 
                                    (e.status == 4 ? " <span class='label label-success'>Recogido</span> " : "<span class='label label-important'>Desconocido</span>"
                                    )
                                )
                            )
                        );
                         var buttons_table = " <button type='button' class='btn btn-sm btn-info details_test' order_id="+e.order_id+"> "+
                                                    "<i class='fa fa-spinner fa-spin' style='display: none'></i>"+
                                                    "Ver"+
                                                "</button> "+
                                                "<button type='button' class='btn btn-sm btn-danger cancelar_pedido' order_id="+e.order_id+">Cancelar</button>";

                        if (privilege == 3) {
                            oTable.dataTable().fnAddData( 
                                [
                                    e.order_id,
                                    e.order_number != null ? e.order_number : 'No asignado',
                                    e.sendenboy != null ? e.sendenboy : 'No asignado',
                                    status,
                                    e.order_date,
                                    buttons_table
                                ]
                            );

                        }

                        else if (privilege == 1) {
                            oTable.dataTable().fnAddData( 
                                [
                                    e.order_id,
                                    e.order_number != null ? e.order_number : 'No asignado',
                                    e.business_name,
                                    e.sendenboy != null ? e.sendenboy : 'No asignado',
                                    status,
                                    e.order_date,
                                    buttons_table
                                ]
                            );
                        }
                        
                    }
                })
                //$("table tbody tr td:nth-child(5), table tbody tr td:nth-child(6)").addClass("hide");
            },
            error: function(xhr, status, error) {
                console.error('Ocurrió un error al tratar de refrescar la tabla automáticamente');
            }
        });
    }

    function cancelarPedido(url,order_id,token) {
        url = url.concat('/admin/orders/cancel_order');
        $.ajax({
            method: "POST",
            type:"POST",
            url: url,
            data:{
                "order_id":order_id,
                "_token":token
            },
            success:function(data) {
                swal({
                    title: "Pedido cancelado.",
                    type: "success",
                    timer: 1000,
                    showConfirmButton: true,
                });
                var url = "{{url('')}}";
                var privilege = "{{auth()->user()->user_type_id}}";
                var token = "{{csrf_token()}}";
                refreshTable(url,privilege,token);
            },
            error: function(xhr, status, error) {
                swal({
                    title: "Error cancelando pedido.",
                    text: "Porfavor, trate de nuevo o espere a que se actualice la tabla.",
                    type: "warning",
                    showConfirmButton: true,
                });
            }
        });
    }

</script>
@endsection