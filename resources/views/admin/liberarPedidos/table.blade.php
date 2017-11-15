<table class="table" id="table_aux">
    <thead>
        <tr>
            <th># Pedido</th>
            {{-- <th>Negocio</th>
            <th>Categoría</th> --}}
            <th>Sendenboy (Nombre)</th>
            <th>No. Sendenboy</th>
            <th>Fecha</th>
            <th style="text-align: center">Detalles</th>
        </tr>
    </thead>
    <tbody>
        @if(count($orders))
            @foreach($orders as $order)
                <tr>
                    <td>{{$order->order_number}}</td>
                    {{-- <td>{{$order->business_name}}</td>
                    <td>{{$order->categorie_name}}</td> --}}
                    <td>{{$order->sendenboy}}</td>
                    <td>{{$order->sendenboy_id}}</td>
                    <td>{{$order->order_date}}</td>
                    <td align="center">
                        <button type="button" class="btn btn-sm btn-info" onclick="orders.getOrderDetails({{$order->order_id}}, $(this));">
                            <i class="fa fa-spinner fa-spin" style="display: none"></i>
                            Ver
                        </button>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="6" align="center">
                    <h4>No hay pedidos disponibles</h4>
                </td>
            </tr>
        @endif
    </tbody>
</table>