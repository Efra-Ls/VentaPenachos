$(document).ready(function() {

    function loadProducts() {
        var btn_action = 'cargarProductos';
        $.ajax({
            url: "adm/action.php",
            method: "POST",
            data: { btn_action: btn_action },
            success: function(data) {
                $('#viewproductList').html(data);
            }
        });
    }
    loadProducts();    
    
});