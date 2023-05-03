$(document).ready(function() {

    var pedidoData = $('#pedidoList').DataTable({
        "lengthChange": false,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "action.php",
            type: "POST",
            data: { action: 'listPedido' },
            dataType: "json"
        },
        "columnDefs": [{
            "targets": [0, 6],
            "orderable": false,
        }, ],
        "pageLength": 20,
        'rowCallback': function(row, data, index) {
            $(row).find('td').addClass('align-middle')
            $(row).find('td:eq(0), td:eq(3)').addClass('text-center')
        },
    });
   
    $(document).on('submit', '#pedidoForm', function(event) {
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var formData = $(this).serialize();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: formData,
            success: function(data) {
                $('#pedidoForm')[0].reset();
                $('#pedidoModal').modal('hide');
                $('#action').attr('disabled', false);
                pedidoData.ajax.reload();
            }
        })
    });

    $(document).on('click', '.view', function() {
        var id_pedido = $(this).attr("id_pedido");
        var btn_action = 'viewPedido';
        $.ajax({
            url: "action.php",
            method: "POST",
            data: { id_pedido: id_pedido, btn_action: btn_action },
            success: function(data) {
                $('#pedidoViewModal').modal('show');
                $('#pedidoDetails').html(data);
            }
        })
    });

    $(document).on('click', '.update', function() {
        var id_pedido = $(this).attr("id_pedido");
        var btn_action = 'getPedidoDetails';
        $.ajax({
            url: "action.php",
            method: "POST",
            data: { id_pedido: id_pedido, btn_action: btn_action },
            dataType: "json",
            success: function(data) {
                $('#pedidoModal').modal('show');
                $('#id_pedido').val(data.id_pedido);
                $('#nombrec').val(data.nombrec);
                $('#fecha').val(data.fecha);
                $('#hora').val(data.hora);
                $('#direccion').val(data.direccion);
                $('#estado').val(data.estado);
                $('.modal-title').html("<i class='fa fa-edit'></i> Editar Producto");
                $('#id_pedido').val(id_pedido);
                $('#action').val("Editar");
                $('#btn_action').val("updateProduct");
            }
        })
    });

    $(document).on('click', '.delete', function() {
        var id_producto = $(this).attr("id_producto");
        var btn_action = 'deleteProduct';
        if (confirm("¿Está seguro de que desea eliminar este producto?")) {
            $.ajax({
                url: "action.php",
                method: "POST",
                data: { id_producto: id_producto, btn_action: btn_action },
                success: function(data) {
                    $('#alert_action').fadeIn().html('<div class="alert alert-info">' + data + '</div>');
                    productData.ajax.reload();
                }
            });
        } else {
            return false;
        }
    });

});