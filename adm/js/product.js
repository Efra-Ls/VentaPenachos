$(document).ready(function() {

    var productData = $('#productList').DataTable({
        "lengthChange": false,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "action.php",
            type: "POST",
            data: { action: 'listProduct' },
            dataType: "json"
        },
        "columnDefs": [{
            "targets": [0, 7],
            "orderable": false,
        }, ],
        "pageLength": 10,
        'rowCallback': function(row, data, index) {
            $(row).find('td').addClass('align-middle')
            $(row).find('td:eq(0), td:eq(3)').addClass('text-center')
        },
    });

    $('#addProduct').click(function() {
        $('#productModal').modal('show');
        $('#productForm')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Agregar Producto");
        $('#action').val("Agregar");
        $('#btn_action').val("addProduct");
    });

    $(document).on('change', '#categoryid', function() {
        var categoryid = $('#categoryid').val();
        var btn_action = 'getCategoryBrand';
        $.ajax({
            url: "action.php",
            method: "POST",
            data: { categoryid: categoryid, btn_action: btn_action },
            success: function(data) {
                $('#brandid').html(data);
            }
        });
    });

    $(document).on('submit', '#productForm', function(event) {
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        //var formData = $(this).serialize();
        var formData = new FormData($('#productForm')[0]);
        formData.append('foto', $('#foto')[0].files[0]);
        $.ajax({
            url: "action.php",
            method: "POST",
            data: formData,
            processData: false,//<----
            contentType: false,//<----
            success: function(data) {
                $('#productForm')[0].reset();
                $('#productModal').modal('hide');
                $('#action').attr('disabled', false);
                productData.ajax.reload();
            }
        })
    });

    $(document).on('click', '.view', function() {
        var pid = $(this).attr("id_producto");
        var btn_action = 'viewProduct';
        $.ajax({
            url: "action.php",
            method: "POST",
            data: { id_producto: pid, btn_action: btn_action },
            success: function(data) {
                $('#productViewModal').modal('show');
                $('#productDetails').html(data);
                $('.modal-title').html("<i class='fa fa-th-list'></i> Información Producto");
            }
        })
    });


    $(document).on('click', '.update', function() {
        var id_producto = $(this).attr("id_producto");
        var btn_action = 'getProductDetails';
        $.ajax({
            url: "action.php",
            method: "POST",
            data: { id_producto: id_producto, btn_action: btn_action },
            dataType: "json",
            success: function(data) {
                $('#productModal').modal('show');
                $('#id_producto').val(data.id_producto);
                $('#nombre').val(data.nombre);
                $('#descripcion').val(data.descripcion);
                $('#categoria').val(data.categoria);
                $('#precio').val(data.precio);
                $('#existencia').val(data.existencia);
                $('#unidad').val(data.unidad);
                //$('#foto').val(data.foto);
                $('.modal-title').html("<i class='fa fa-edit'></i> Editar Producto");
                $('#id_producto').val(id_producto);
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
    $(document).on('input', '#existencia', function(event) {
        const existenciaInput =  event.target;
            
            if (/^\d+$/.test(existenciaInput.value)) {
                // Si se ingresó solo números, cambia el color del texto a rojo
                existenciaInput.style.color = 'black';
            } else {
                // Si se ingresó texto, cambia el color del texto a negro
                existenciaInput.style.color = 'red';
            }
    });     
    $(document).on('input', '#precio', function(event) {
        //const precioInput = event.target;
          //const valor = precioInput.value.replace(/[A-Z][a-z]/g, '');
          //const valorConComas = Number(valor).toLocaleString();
          //precioInput.value = valorConComas;
      });
});