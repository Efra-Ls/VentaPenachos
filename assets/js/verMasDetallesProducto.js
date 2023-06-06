$(document).ready(function() {
 
    function loadProducts() {
        var urlParams = new URLSearchParams(window.location.search);
        var pid = urlParams.get('id_producto');
        var btn_action = 'verMasImagenesProductos';
        $.ajax({
            url: "adm/action.php",
            method: "POST",
            data: { id_producto: pid,btn_action: btn_action },
            success: function(data) {
                $('#verMasImagenes').html(data);
            }
        });
    }
    loadProducts();
    function loadDetallesProducts() {
        var urlParams = new URLSearchParams(window.location.search);
        var pid = urlParams.get('id_producto');
        var btn_action = 'verMasDetalleProductos';
        $.ajax({
            url: "adm/action.php",
            method: "POST",
            data: { id_producto: pid,btn_action: btn_action },
            success: function(data) {
                $('#verMasDetalleProductos').html(data);
                  $('#btn_action').val("agregaralCarrito");
            }
        });
         btn_action = 'cargarIdCarrito';
        $.ajax({
            url: "adm/action.php",
            method: "POST",
            dataType: "json",
            data: { id_cliente: userid,btn_action: btn_action },
            success: function(data) {
                $('#id_carrito').val(data.id_carrito);   
            }
        });
    }
    loadDetallesProducts();
    function loadexistencia() {
        var urlParams = new URLSearchParams(window.location.search);
        var pid = urlParams.get('id_producto');
        var btn_action = 'cargarExistencia';
        $.ajax({
            url: "adm/action.php",
            method: "POST",
            dataType: "json",
            data: { id_producto: pid,btn_action: btn_action },
            success: function(data) {
                $('#id_producto').val(data.id_producto);                          
                var existencia = data.existencia;
                $('#cantidad').attr('max', existencia);
            }
        });
    }
    loadexistencia();

    $(document).on('submit', '#datosProductoForm', function(event) {
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var formData = $(this).serialize();
        $.ajax({
            url: "adm/action.php",
            method: "POST",
            data: formData,
            success: function(data) {               
                window.location.href = 'carrito.php';
            }
        })
    });

    
    
});