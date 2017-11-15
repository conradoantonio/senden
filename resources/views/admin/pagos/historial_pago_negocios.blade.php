@extends('layouts.admin')

@section('main-body')
<link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-select2/select2.css')}}"  type="text/css" media="screen"/>
<link rel="stylesheet" href="{{ asset('js/plugins/jquery-datatable/css/jquery.dataTables.css')}}"  type="text/css" media="screen"/>
<style>
    /*table#example3 th {
        text-align: center!important;
    }*/
</style>
<div class="text-center" style="margin: 20px;">
    <h2>Filtro de pedidos para los negocios</h2>
    <div class="row-fluid " style="display: none;" id="table_containter">
        <div class="span12">
            <div class="grid simple ">
                <div class="grid-title">
                    <div class="row">
                        {{ csrf_field() }}
                        <div class="col-md-4">
                            <label>Negocio</label>
                            <select class="form-control" name="business_id" id="business_id">
                                <option value="">Seleccione un negocio</option>
                                @foreach($business_valid as $business)
                                    <option value="{{$business->id}}">{{$business->name}}</option>
                                @endforeach 
                            </select>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Fecha inicio</label>
                                <input type="" name="fecha_inicio" class='form-control' id='fecha_inicio'>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Fecha final</label>
                                <input type="" name="fecha_final" class='form-control' id='fecha_final'>
                            </div>
                        </div>
                    </div>
                    
                    <h4>Opciones</h4>
                    <div>
                        <button type="button" class="btn btn-primary" id="filtrar_busqueda"><i class="fa fa-plus" aria-hidden="true"></i> Filtrar</button>
                        <button type="button" class="btn btn-default" id="limpiar"><i class="fa fa-eraser" aria-hidden="true"></i> Limpiar</button>
                        <button type="button" class="btn btn-info" id="exportar_pedidos"><i class="fa fa-download" aria-hidden="true"></i> Exportar</button>
                    </div>
                    <div class="grid-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="source">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">Fecha</th>
                                        <th style="text-align: center;">Conekta Id</th>
                                        <th style="text-align: center;">Negocio</th>
                                        <th style="text-align: center;">Banco</th>
                                        <th style="text-align: center;">Clabe</th>
                                        <th style="text-align: center;">Subtotal</th>
                                        <th style="text-align: center;">Comisión</th>
                                        <th style="text-align: center;">Total a pagar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($orders) > 0)
                                        @php
                                            $total_debt = 0;
                                        @endphp
                                        @foreach($orders as $order)
                                            <tr class="" id="{{$order->id}}">
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->created_at}}</td>
                                                <td>{{$order->conekta_order_id}}</td>
                                                <td>{{$order->business}}</td>
                                                <td>{{$order->bank_name}}</td>
                                                <td>{{$order->clabe}}</td>
                                                <td>$<span>{{$order->subtotal}}</span></td>
                                                <td>$<span>{{$order->comision}}</span></td>
                                                <td>$<span>{{$order->total_to_pay}}</span></td>
                                                @php
                                                    $total_debt += $order->total_to_pay;
                                                @endphp
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="7"></td>
                                            <td><span class="bold">Total:</span></td>
                                            <td><span class="bold">${{$total_debt}}</span></td>
                                        </tr>
                                    @else
                                        <td colspan="10">No hay órdenes pagadas</td>
                                    @endif
                                </tbody>
                            </table>
                            <table class="table datatable hide" id="search">
                                <thead>
                                    <tr>
                                        <th style="text-align: center;">ID</th>
                                        <th style="text-align: center;">Fecha</th>
                                        <th style="text-align: center;">Conekta Id</th>
                                        <th style="text-align: center;">Negocio</th>
                                        <th style="text-align: center;">Banco</th>
                                        <th style="text-align: center;">Clabe</th>
                                        <th style="text-align: center;">Subtotal</th>
                                        <th style="text-align: center;">Comisión</th>
                                        <th style="text-align: center;">Total a pagar</th>
                                    </tr>
                                </thead>
                                <tbody>
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
    $( "#fecha_inicio" ).datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "yyyy-mm-dd",
    }).on( "changeDate", function(e) {
        $( "#fecha_final" ).datepicker('setStartDate',e.date);
    });

    $( "#fecha_final" ).datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "yyyy-mm-dd",
    }).on( "changeDate", function(e) {
        $( "#fecha_inicio" ).datepicker('setEndDate',e.date);
    });
    
    setTimeout(function() {
        $('div#table_containter').fadeIn('low');
    }, 500)
})

$(document).delegate('#exportar_pedidos','click',function() {
    business_id = $('select#business_id').val() ? $('#business_id').val() : false
    sendenboy_id = false;
    start_date = $('input#fecha_inicio').val() ? $('input#fecha_inicio').val() : false
    end_date = $('input#fecha_final').val() ? $('input#fecha_final').val() : false
    is_paid_business = 1;
    is_paid_sendenboy = false;

    window.location.href = "{{url('admin/orders-done/export')}}/"+business_id+"/"+sendenboy_id+"/"+start_date+"/"+end_date+"/"+is_paid_business+"/"+is_paid_sendenboy;
});

$('body').delegate('button#filtrar_busqueda','click', function() {
    var business_id = $('select#business_id').val();
    var start_date = $('input#fecha_inicio').val();
    var end_date = $('input#fecha_final').val();
    var token = $('meta[name="csrf-token"]').attr('content');
    
    buscarOrdenesPagadas("{{url('')}}", 1, business_id, start_date, end_date, token);
});

$('body').delegate('button#limpiar','click', function() {
    $('input.form-control').val('');
    $('select.form-control').val('');
    $('table#search').addClass('hide');
    $('table#source').removeClass('hide');
    var token = $('meta[name="csrf-token"]').attr('content');
    loadPaidSource("{{url('')}}", token);
});

</script>
@endsection