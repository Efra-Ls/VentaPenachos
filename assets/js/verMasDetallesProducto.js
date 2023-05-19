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
    
});