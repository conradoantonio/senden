$(function(){ $('#orders-table').dataTable(); });
var orders = {
    getOrderDetails: function(orderId, obj){
        obj.find('i').show(); obj.attr('disabled', true);
        $.ajax({
            url: 'getOrderDetails',
            type: 'GET',
            data: {orderId: orderId},
            success: function(res){
                obj.find('i').hide(); obj.attr('disabled', false);
                if(res.success){
                    if(res.orderDetails.length > 0){
                        console.info(res);
                        orders.setModalData(res.orderDetails, res.orderProducts);
                        $("#order_modal").modal();
                    } else {
                        swal('¡El pedido ya no se encuentra activo!','El pedido a sido cancelado o ha sido finalizado y ya no se encuentran disponibles sus detalles en este módulo, espere a que se refresque la tabla o recargue la página directamente.','warning');
                    }
                    
                }else{
                    swal('¡Atencion!',res.msg,'warning');
                }
            },
            error: function(res){
                obj.find('i').hide(); obj.attr('disabled', false);
                //swal('¡Alerta!','No se pueden mostrar los detalles de este pedido porque ya no existe o ha sido cancelado, espere a que la tabla se recargue automáticamente o pulse F5 para recargar ahora.','warning');
                swal('¡Atencion!','Ocurrió un problema, favor de volver a intentarlo.','warning');
            }
        });
    },

    setModalData: function(orderDetails, orderProducts){
        /**general order data */
        if (orderDetails[0].sendenboy_id == null) {
            $('ul#group_sendenboy_data').addClass('hide');
            $('li#item_sendenboy_id').addClass('hide');
        } else {
            $("img#sendenboy-photo").attr("src", baseUrl+'/'+orderDetails[0].sendenboy_photo);
            $('ul#group_sendenboy_data').removeClass('hide');
            $('li#item_sendenboy_id').removeClass('hide');
        }
        if (orderDetails[0].order_number != null) {
            $("#order-number").text(this.returnBlank(orderDetails[0].order_number));
        } else {
            $("#order-number").text('No asignado');
        }

        //$("#order-number").text(this.returnBlank(orderDetails[0].order_number != null ? orderDetails[0].order_number : 'No asignado'));
        $("#order-status").text(this.returnBlank(orderDetails[0].status_name));
        $("#order-date").text(this.returnBlank(orderDetails[0].order_date));
        $("#order-address").text(this.returnBlank(orderDetails[0].order_address));
        /*$("#order-place").text(this.returnBlank(orderDetails[0].city)+', '+this.returnBlank(orderDetails[0].state));*/
        $("#order-client").text(this.returnBlank(orderDetails[0].client_name));
        $("#order-sendenboy-id").text(this.returnBlank(orderDetails[0].sendenboy_id));
        $("#order-comments").text(this.returnBlank(orderDetails[0].comment));
        /*$("#order-flag").text(this.returnBlank(orderDetails[0].flag) == '' ? '' : '$'+this.returnBlank(orderDetails[0].flag));
        $("#order-comission").text(this.returnBlank(orderDetails[0].comission) == '' ? '' : '$'+this.returnBlank(orderDetails[0].comission));
        $("#order-shipping-price").text(this.returnBlank(orderDetails[0].shipping_price) == '' ? '' : '$'+this.returnBlank(orderDetails[0].shipping_price));*/
        $("#order-total").text('$'+this.returnBlank(orderDetails[0].total) == '' ? '' : '$'+this.returnBlank(orderDetails[0].total));
        /**general business data */
        $("#business-name").text(this.returnBlank(orderDetails[0].business_name));
        $("#business-categorie").text(this.returnBlank(orderDetails[0].categorie_name));
        $("#business-rfc").text(this.returnBlank(orderDetails[0].business_rfc));
        $("#business-phone").text(this.returnBlank(orderDetails[0].business_phone));
        $("#business-address").text(this.returnBlank(orderDetails[0].business_address));
        $("#business-place").text(this.returnBlank(orderDetails[0].business_place));
        /**general client data */
        $("#client-id").text(this.returnBlank(orderDetails[0].client_id));
        $("#client-name").text(this.returnBlank(orderDetails[0].client_name));
        $("#client-email").text(this.returnBlank(orderDetails[0].client_email));
        $("#client-phone").text(this.returnBlank(orderDetails[0].client_phone));
        $("#client-address").text(this.returnBlank(orderDetails[0].client_address));
        $("#client-municipality").text(this.returnBlank(orderDetails[0].client_municipality));
        /**general sendenboy data */
        $("#sendenboy-id").text(this.returnBlank(orderDetails[0].sendenboy_id));
        $("#sendenboy-name").text(this.returnBlank(orderDetails[0].sendenboy_name));
        $("#sendenboy-email").text(this.returnBlank(orderDetails[0].sendenboy_email));
        $("#sendenboy-phone").text(this.returnBlank(orderDetails[0].sendenboy_phone));
        
        $("#sendenboy-address").text(this.returnBlank(orderDetails[0].sendenboy_address));
        $("#sendenboy-municipality").text(this.returnBlank(orderDetails[0].sendenboy_municipality));
        /*$("#sendenboy-circulation-card").text(this.returnBlank(orderDetails[0].sendenboy_circulation_card));
        $("#sendenboy-license").text(this.returnBlank(orderDetails[0].sendenboy_license));*/

        var tbody = '';
        for(var i=0; i<orderProducts.length; i++){
            tbody += '<tr>'+
                        '<td>'+this.returnBlank(orderProducts[i].product.name)+'</td>'+
                        '<td>$'+this.returnBlank(orderProducts[i].price)+'</td>'+
                        '<td>'+this.returnBlank(orderProducts[i].quantity)+'</td>'+
                        '<td>$'+this.returnBlank(orderProducts[i].price * orderProducts[i].quantity)+'</td>'+
                        '<td>'+this.returnBlank(orderProducts[i].product.description)+'</td>'+
                     '</tr>';
        }
        $("#products>tbody").empty().append(tbody);
    },

    returnBlank: function(value){
        return (value == null) ? "" : value;
    }
}