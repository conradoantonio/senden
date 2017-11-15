function loadSource(base_url, token) {
    url = base_url.concat('/admin/pagar/negocios/source');
    $.ajax({
        method: "POST",
        type:"POST",
        url: url,
        data:{
            "is_paid_business":0,
            "_token":token
        },
        success:function(data) {
            $("table#source tbody").children().remove();
            if (data.length > 0) {
                var total_debt = 0;
                data.forEach(function(res) {
                    if (res != "") {
                        total_debt += res.total_to_pay;
                        var checkboxid = 'checkbox';
                        var checkboxid = checkboxid.concat(res.id);
                        $("table#source tbody").append(
                            "<tr class='' id="+res.id+">" +
                                "<td class='small-cell v-align-middle'>" +
                                    "<div class='checkbox check-success'>" +
                                        "<input id="+checkboxid+" type='checkbox' class='checkDelete' value='1'>"+
                                        "<label for="+checkboxid+"></label>"+
                                    "</div>"+
                                "</td>"+
                                "<td>"+res.id+"</td>" +
                                "<td>"+res.created_at+"</td>" +
                                "<td>"+res.conekta_order_id+"</td>" +
                                "<td>"+res.business+"</td>" +
                                "<td>"+res.bank_name+"</td>" +
                                "<td>"+res.clabe+"</td>" +
                                "<td>$<span>"+res.subtotal+"</span></td>" +
                                "<td>$<span>"+res.comision+"</span></td>" +
                                "<td>$<span>"+res.total_to_pay+"</span></td>" +
                            "</tr>"
                        );
                    }
                })
                $("table#source tbody").append(
                    "<tr>" +
                        "<td colspan='8'></td>" +
                        "<td><span class='bold'>Total:</span></td>" +
                        "<td><span class='bold'>$"+total_debt.toFixed(2)+"</span></td>" +
                    "</tr>"
                );

                
            }
            else {
                $("table#source tbody").append(
                    "<td colspan='10'>No hay órdenes por pagar.</td>"
                );
            }
            $('table#search').addClass('hide');
            $('table#source').removeClass('hide');
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un error limpiando la tabla, por favor trate de nuevo o recargue la página.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function loadPaidSource(base_url, token) {
    url = base_url.concat('/admin/pagar/negocios/source');
    $.ajax({
        method: "POST",
        type:"POST",
        url: url,
        data:{
            "is_paid_business":1,
            "_token":token
        },
        success:function(data) {
            $("table#source tbody").children().remove();
            if (data.length > 0) {
                var total_debt = 0;
                data.forEach(function(res) {
                    if (res != "") {
                        total_debt += res.total_to_pay;
                        var checkboxid = 'checkbox';
                        var checkboxid = checkboxid.concat(res.id);
                        $("table#source tbody").append(
                            "<tr class='' id="+res.id+">" +
                                "<td>"+res.id+"</td>" +
                                "<td>"+res.created_at+"</td>" +
                                "<td>"+res.conekta_order_id+"</td>" +
                                "<td>"+res.business+"</td>" +
                                "<td>"+res.bank_name+"</td>" +
                                "<td>"+res.clabe+"</td>" +
                                "<td>$<span>"+res.subtotal+"</span></td>" +
                                "<td>$<span>"+res.comision+"</span></td>" +
                                "<td>$<span>"+res.total_to_pay+"</span></td>" +
                            "</tr>"
                        );
                    }
                })
                $("table#source tbody").append(
                    "<tr>" +
                        "<td colspan='7'></td>" +
                        "<td><span class='bold'>Total:</span></td>" +
                        "<td><span class='bold'>$"+total_debt.toFixed(2)+"</span></td>" +
                    "</tr>"
                );

                
            }
            else {
                $("table#source tbody").append(
                    "<td colspan='9'>No hay órdenes por pagar.</td>"
                );
            }
            $('table#search').addClass('hide');
            $('table#source').removeClass('hide');
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Se encontró un error limpiando la tabla, por favor trate de nuevo o recargue la página.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}

function buscarOrdenes(base_url, is_paid_business, business_id, start_date, end_date, token) {
    url = base_url.concat('/admin/pagar/negocios/filter');
    $.ajax({
        method: "POST",
        type: "POST",
        url: url,
        data:{
            "is_paid_business":is_paid_business,
            "business_id":business_id,
            "start_date":start_date,
            "end_date":end_date,
            "_token":token
        },
        success:function(data) {

            $('table#source').addClass('hide');
            $('table#search').removeClass('hide');

            $('#load-bar').addClass('hide');
            $("table#search tbody").children().remove();
            if (data.length > 0) {
                var total_debt = 0;
                data.forEach(function(res) {
                    if (res != "") {
                        total_debt += res.total_to_pay;
                        var checkboxid = 'checkboxSearch';
                        var checkboxid = checkboxid.concat(res.id);
                        $("table#search tbody").append(
                            "<tr class='' id="+res.id+">" +
                                "<td class='small-cell v-align-middle'>" +
                                    "<div class='checkbox check-success'>" +
                                        "<input id="+checkboxid+" type='checkbox' class='checkDeleteSearch' value='1'>"+
                                        "<label for="+checkboxid+"></label>"+
                                    "</div>"+
                                "</td>"+
                                "<td>"+res.id+"</td>" +
                                "<td>"+res.created_at+"</td>" +
                                "<td>"+res.conekta_order_id+"</td>" +
                                "<td>"+res.business+"</td>" +
                                "<td>"+res.bank_name+"</td>" +
                                "<td>"+res.clabe+"</td>" +
                                "<td>$<span>"+res.subtotal+"</span></td>" +
                                "<td>$<span>"+res.comision+"</span></td>" +
                                "<td>$<span>"+res.total_to_pay+"</span></td>" +
                            "</tr>"
                        );
                    }
                })
                $("table#search tbody").append(
                    "<tr>" +
                        "<td colspan='8'></td>" +
                        "<td><span class='bold'>Total:</span></td>" +
                        "<td><span class='bold'>$"+total_debt.toFixed(2)+"</span></td>" +
                    "</tr>"
                );
            }
            else {
                $("table#search tbody").append(
                    "<td colspan='10'>No se encontraron órdenes con ese criterio de búsqueda.</td>"
                );
            }
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Ocurrió un error mientras se filtraban las órdenes, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
            //$('#load-bar').addClass('hide');
            $("table#search tbody").children().remove();
            $("table#search tbody").append(
                "<td colspan='9'>Ocurrió un error mientras se filtraban las órdenes, por favor, trate nuevamente.</td>"
            );
            $('table#source').addClass('hide');
            $('table#search').removeClass('hide');
        }
    });
}

function buscarOrdenesPagadas(base_url, is_paid_business, business_id, start_date, end_date, token) {
    url = base_url.concat('/admin/pagar/negocios/filter');
    $.ajax({
        method: "POST",
        type: "POST",
        url: url,
        data:{
            "is_paid_business":is_paid_business,
            "business_id":business_id,
            "start_date":start_date,
            "end_date":end_date,
            "_token":token
        },
        success:function(data) {

            $('table#source').addClass('hide');
            $('table#search').removeClass('hide');

            $('#load-bar').addClass('hide');
            $("table#search tbody").children().remove();
            if (data.length > 0) {
                var total_debt = 0;
                data.forEach(function(res) {
                    if (res != "") {
                        total_debt += res.total_to_pay;
                        var checkboxid = 'checkboxSearch';
                        var checkboxid = checkboxid.concat(res.id);
                        $("table#search tbody").append(
                            "<tr class='' id="+res.id+">" +
                                "<td>"+res.id+"</td>" +
                                "<td>"+res.created_at+"</td>" +
                                "<td>"+res.conekta_order_id+"</td>" +
                                "<td>"+res.business+"</td>" +
                                "<td>"+res.bank_name+"</td>" +
                                "<td>"+res.clabe+"</td>" +
                                "<td>$<span>"+res.subtotal+"</span></td>" +
                                "<td>$<span>"+res.comision+"</span></td>" +
                                "<td>$<span>"+res.total_to_pay+"</span></td>" +
                            "</tr>"
                        );
                    }
                })
                $("table#search tbody").append(
                    "<tr>" +
                        "<td colspan='7'></td>" +
                        "<td><span class='bold'>Total:</span></td>" +
                        "<td><span class='bold'>$"+total_debt.toFixed(2)+"</span></td>" +
                    "</tr>"
                );
            }
            else {
                $("table#search tbody").append(
                    "<td colspan='9'>No se encontraron órdenes con ese criterio de búsqueda.</td>"
                );
            }
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Ocurrió un error mientras se filtraban las órdenes, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
            //$('#load-bar').addClass('hide');
            $("table#search tbody").children().remove();
            $("table#search tbody").append(
                "<td colspan='10'>Ocurrió un error mientras se filtraban las órdenes, por favor, trate nuevamente.</td>"
            );
            $('table#source').addClass('hide');
            $('table#search').removeClass('hide');
        }
    });
}

function marcarPagos(base_url, checking, business_id, start_date, end_date, token) {
    url = base_url.concat('/admin/pagar/negocios/mark_as_paid');
    $.ajax({
        method: "POST",
        type: "POST",
        url: url,
        data:{
            "ids":checking,
            "business_id":business_id,
            "start_date":start_date,
            "end_date":end_date,
            "_token":token
        },
        success:function(data) {
            swal({
                title: "<small>Éxito</small>",
                type: "success",
                timer: 2000,
                text: "Se han marcado como pagados las órdenes seleccionadas correctamente.",
                html: true
            });
   
            //console.log(data);
            $('table#source').addClass('hide');
            $('table#search').removeClass('hide');

            $('#load-bar').addClass('hide');
            $("table#search tbody").children().remove();
            if (data.length > 0) {
                var total_debt = 0;
                data.forEach(function(res) {
                    if (res != "") {
                        total_debt += res.total_to_pay;
                        var checkboxid = 'checkboxSearch';
                        var checkboxid = checkboxid.concat(res.id);
                        $("table#search tbody").append(
                            "<tr class='' id="+res.id+">" +
                                "<td class='small-cell v-align-middle'>" +
                                    "<div class='checkbox check-success'>" +
                                        "<input id="+checkboxid+" type='checkbox' class='checkDeleteSearch' value='1'>"+
                                        "<label for="+checkboxid+"></label>"+
                                    "</div>"+
                                "</td>"+
                                "<td>"+res.id+"</td>" +
                                "<td>"+res.created_at+"</td>" +
                                "<td>"+res.conekta_order_id+"</td>" +
                                "<td>"+res.business+"</td>" +
                                "<td>"+res.bank_name+"</td>" +
                                "<td>"+res.clabe+"</td>" +
                                "<td>$<span>"+res.subtotal+"</span></td>" +
                                "<td>$<span>"+res.comision+"</span></td>" +
                                "<td>$<span>"+res.total_to_pay+"</span></td>" +
                            "</tr>"
                        );
                    }
                })
                $("table#search tbody").append(
                    "<tr>" +
                        "<td colspan='8'></td>" +
                        "<td><span class='bold'>Total:</span></td>" +
                        "<td><span class='bold'>$"+total_debt.toFixed(2)+"</span></td>" +
                    "</tr>"
                );
            }
            else {
                $("table#search tbody").append(
                    "<td colspan='10'>No se encontraron órdenes con ese criterio de búsqueda.</td>"
                );
            }
        },
        error: function(xhr, status, error) {
            swal({
                title: "<small>¡Error!</small>",
                text: "Ocurrió un error mientras se filtraban las órdenes, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
            //$('#load-bar').addClass('hide');
            $("table#search tbody").children().remove();
            $("table#search tbody").append(
                "<td colspan='9'>Ocurrió un error mientras se filtraban las órdenes, por favor, trate nuevamente.</td>"
            );
            $('table#source').addClass('hide');
            $('table#search').removeClass('hide');
        }
    });
}

/*Función para la pestaña de mis pagos para el usuario de negocio*/
function buscarDetalleOrden(base_url, orden_id, status, token) {
    url = base_url.concat('/admin/my_earnings/order/details');
    $.ajax({
        method: "POST",
        type: "POST",
        url: url,
        data:{
            "orden_id":orden_id,
            "status":status,
            "_token":token
        },
        success:function(data) {
            console.info(data)
            var items = data[0].products;
            $("table#productos tbody").children().remove();
            
            $('div#main_data').removeClass('hide');
            $('#load_bar').addClass('hide');

            /*Order data*/
            $('span#order_number').text(data[0].order_number);
            /*$('span#order_total').text('$'+data[0].order_total);*/
            $('span#order_date').text(data[0].created_at);
            $('span#order_client').text(data[0].customer_name);
            $('span#order_sendenboy_id').text(data[0].idSendenboy);
            $('span#order_addres').text(data[0].order_addres);
            $('span#order_comment').text(data[0].order_comment ? data[0].order_comment : '');

            /*business data*/
            /*$('span#business_id').text(data[0].idBussiness);
            $('span#business_name').text(data[0].businesses_name);
            $('span#business_address').text(data[0].business_address);
            $('span#business_state').text(data[0].businesses_state);
            $('span#business_city').text(data[0].businesses_city);
            $('span#business_rfc').text(data[0].businesses_rfc);*/
            
            /*Sendenboy data*/
            $('span#sendenboy_id').text(data[0].idSendenboy);
            $('span#sendenboy_name').text(data[0].sendenboy_name);
            /*$('span#sendenboy_email').text(data[0].sendenboy_email);
            $('span#sendenboy_phone').text(data[0].sendenboy_phone);
            $('span#sendenboy_username').text(data[0].sendenboy_username);
            $('span#sendenboy_state').text(data[0].sendenboy_state);
            $('span#sendeboy_municipality').text(data[0].sendeboy_municipality);
            $('span#sendenboy_address').text(data[0].sendenboy_address);*/
            $("img#sendenboy_photo").attr("src", baseUrl+'/'+data[0].sendenboy_photo);


            /*Customer data*/
            /*$('span#customer_name').text(data[0].customer_name);
            $('span#customer_email').text(data[0].customer_email);
            $('span#customer_phone').text(data[0].customer_phone);
            $('span#customer_municipality').text(data[0].customer_municipality);
            $('span#customer_state').text(data[0].customer_state);
            $('span#customer_address').text(data[0].customer_address);*/

            
            /*Detalles de pedido (Productos)*/
            for (var key in items) {
                if (items.hasOwnProperty(key)) {
                    $("table#productos tbody").append(
                        '<tr class="" id="">'+
                            '<td style="text-align: center;">'+items[key].product_name+'</td>'+
                            '<td style="text-align: center;">$'+(items[key].product_price)+'</td>'+
                            '<td style="text-align: center;">'+(items[key].product_quantity)+'</td>'+
                            '<td style="text-align: center;">$'+(items[key].product_subtotal)+'</td>'+
                            '<td style="text-align: center;">'+(items[key].product_description)+'</td>'+
                        '</tr>'
                    );
                }
            }
        },
        error: function(xhr, status, error) {
            $('#modal_detalles').modal('hide')
            $('div#main_data').removeClass('hide');
            swal({
                title: "<small>¡Error!</small>",
                text: "Ocurrió un error mientras se buscaba el detalle de esta órden, por favor, trate nuevamente.<br><span style='color:#F8BB86'>\nError: " + xhr.status + " (" + error + ") "+"</span>",
                html: true
            });
        }
    });
}
