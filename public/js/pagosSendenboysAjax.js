function loadSource(base_url, token) {
    url = base_url.concat('/admin/pagar/sendenboys/source');
    $.ajax({
        method: "POST",
        type:"POST",
        url: url,
        data:{
            "is_paid_sendenboy":0,
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
                                "<td>"+res.sendenboy_name+"</td>" +
                                "<td>"+res.bank+"</td>" +
                                "<td>"+res.clabe+"</td>" +
                                "<td>$<span>"+res.total+"</span></td>" +
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
    url = base_url.concat('/admin/pagar/sendenboys/source');
    $.ajax({
        method: "POST",
        type:"POST",
        url: url,
        data:{
            "is_paid_sendenboy":1,
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
                                "<td>"+res.sendenboy_name+"</td>" +
                                "<td>"+res.bank+"</td>" +
                                "<td>"+res.clabe+"</td>" +
                                "<td>$<span>"+res.total+"</span></td>" +
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
                    "<td colspan='9'>No hay órdenes pagadas.</td>"
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

function buscarOrdenes(base_url, is_paid_sendenboy, sendenboy_id, start_date, end_date, token) {
    url = base_url.concat('/admin/pagar/sendenboys/filter');
    $.ajax({
        method: "POST",
        type: "POST",
        url: url,
        data:{
            "is_paid_sendenboy":is_paid_sendenboy,
            "sendenboy_id":sendenboy_id,
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
                                "<td>"+res.sendenboy_name+"</td>" +
                                "<td>"+res.bank+"</td>" +
                                "<td>"+res.clabe+"</td>" +
                                "<td>$<span>"+res.total+"</span></td>" +
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

function buscarOrdenesPagadas(base_url, is_paid_sendenboy, sendenboy_id, start_date, end_date, token) {
    url = base_url.concat('/admin/pagar/sendenboys/filter');
    $.ajax({
        method: "POST",
        type: "POST",
        url: url,
        data:{
            "is_paid_sendenboy":is_paid_sendenboy,
            "sendenboy_id":sendenboy_id,
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
                                "<td>"+res.sendenboy_name+"</td>" +
                                "<td>"+res.bank+"</td>" +
                                "<td>"+res.clabe+"</td>" +
                                "<td>$<span>"+res.total+"</span></td>" +
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

function marcarPagos(base_url, checking, sendenboy_id, start_date, end_date, token) {
    url = base_url.concat('/admin/pagar/sendenboys/mark_as_paid');
    $.ajax({
        method: "POST",
        type: "POST",
        url: url,
        data:{
            "ids":checking,
            "sendenboy_id":sendenboy_id,
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
                                "<td>"+res.sendenboy_name+"</td>" +
                                "<td>"+res.bank+"</td>" +
                                "<td>"+res.clabe+"</td>" +
                                "<td>$<span>"+res.total+"</span></td>" +
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
                "<td colspan='7'>Ocurrió un error mientras se filtraban las órdenes, por favor, trate nuevamente.</td>"
            );
            $('table#source').addClass('hide');
            $('table#search').removeClass('hide');
        }
    });
}
