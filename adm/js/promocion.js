$(document).ready(function() {
        // Obtener el elemento select y los campos específicos
        const selectPromocion = document.getElementById('tipo');
        const descuentoCantidadCampos = document.getElementById('descuentoCantidadCampos');
        const regaloCompraCampos = document.getElementById('regaloCompraCampos');
        const descuentoTiempoCampos = document.getElementById('descuentoTiempoCampos');
        descuentoCantidadCampos.classList.add('hidden2');
        regaloCompraCampos.classList.add('hidden2');
        descuentoTiempoCampos.classList.add('hidden2');

        const umbral_cantidad_descuentoInput = document.getElementById('umbral_cantidad_descuento');
        const porcentaje_descuentoInput = document.getElementById('porcentaje_descuento');
        const cantidad_compra_regaloInput = document.getElementById('cantidad_compra_regalo');
        const cantidad_regaloInput = document.getElementById('cantidad_regalo');
        const fecha_inicio_limitadoInput = document.getElementById('fecha_inicio_limitado');
        const fecha_fin_limitadoInput = document.getElementById('fecha_fin_limitado');
        const porcentaje_descuento_limitadoInput = document.getElementById('porcentaje_descuento_limitado');

        descuentoCantidadCampos.classList.add('hidden2');
            regaloCompraCampos.classList.add('hidden2');
            descuentoTiempoCampos.classList.add('hidden2');
        // Escuchar el evento change del select
        selectPromocion.addEventListener('change', function() {
            // Ocultar todos los campos específicos
            descuentoCantidadCampos.classList.add('hidden2');
            regaloCompraCampos.classList.add('hidden2');
            descuentoTiempoCampos.classList.add('hidden2');

            // Obtener el valor seleccionado del select
            const seleccion = this.value;

            // Mostrar los campos específicos según la opción seleccionada
            if (seleccion === 'Descuento por cantidad') {
                descuentoCantidadCampos.classList.remove('hidden2');
                

                umbral_cantidad_descuentoInput.setAttribute('required', 'required');
                porcentaje_descuentoInput.setAttribute('required', 'required');

                cantidad_compra_regaloInput.removeAttribute('required');
                cantidad_regaloInput.removeAttribute('required');
                fecha_inicio_limitadoInput.removeAttribute('required');
                fecha_fin_limitadoInput.removeAttribute('required');
                porcentaje_descuento_limitadoInput.removeAttribute('required');

            } else if (seleccion === 'Regalo con compra') {
                regaloCompraCampos.classList.remove('hidden2');
               

                umbral_cantidad_descuentoInput.removeAttribute('required');
                porcentaje_descuentoInput.removeAttribute('required');

                cantidad_compra_regaloInput.setAttribute('required', 'required');
                cantidad_regaloInput.setAttribute('required', 'required');

                fecha_inicio_limitadoInput.removeAttribute('required');
                fecha_fin_limitadoInput.removeAttribute('required');
                porcentaje_descuento_limitadoInput.removeAttribute('required');

            } else if (seleccion === 'Descuento por tiempo limitado') {
                descuentoTiempoCampos.classList.remove('hidden2');

                umbral_cantidad_descuentoInput.removeAttribute('required');
                porcentaje_descuentoInput.removeAttribute('required');
                cantidad_compra_regaloInput.removeAttribute('required');
                cantidad_regaloInput.removeAttribute('required');
                
                fecha_inicio_limitadoInput.setAttribute('required', 'required');
                fecha_fin_limitadoInput.setAttribute('required', 'required');
                porcentaje_descuento_limitadoInput.setAttribute('required', 'required');
            }
        });
    var productData = $('#promocionList').DataTable({
        "lengthChange": false,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "action.php",
            type: "POST",
            data: { action: 'listPromocion' },
            dataType: "json"
        },
        "columnDefs": [{
            "targets": [0, 4],
            "orderable": false,
        }, ],
        "pageLength": 20,
        'rowCallback': function(row, data, index) {
            $(row).find('td').addClass('align-middle')
            $(row).find('td:eq(0), td:eq(3)').addClass('text-center')
        },
    });

    $('#addPromocion').click(function() {
        $('#promocionModal').modal('show');
        $('#promocionForm')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Agregar promocion");
        $('#action').val("Agregar");
        $('#btn_action').val("addPromocion");
    });


    $(document).on('submit', '#promocionForm', function(event) {
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var formData = $(this).serialize();

        $.ajax({
            url: "action.php",
            method: "POST",
            data: formData,
            success: function(data) {
                $('#promocionForm')[0].reset();
                $('#promocionModal').modal('hide');
                $('#action').attr('disabled', false);
                productData.ajax.reload();
            }
        })
    });

    $(document).on('click', '.view', function() {
        var pid = $(this).attr("id_promocion");
        var btn_action = 'viewPromocion';
        $.ajax({
            url: "action.php",
            method: "POST",
            data: { id_promocion: pid, btn_action: btn_action },
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
                $('#promocionModal').modal('show');
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
        const valor = precioInput.value.replace(/[^0-9]/g, '');
        existenciaInput.value = valor;
            if (/^\d+$/.test(existenciaInput.value)) {
                // Si se ingresó solo números, cambia el color del texto a rojo
                existenciaInput.style.color = 'black';
            } else {
                // Si se ingresó texto, cambia el color del texto a negro
                existenciaInput.style.color = 'red';
            }
    });     
    $(document).on('input', '#precio', function(event) {
        const precioInput = event.target;
        const cursorInicio = precioInput.selectionStart; // Guarda la posición del cursor al principio
    
        // Elimina cualquier caracter que no sea un dígito o un punto decimal
        const valor = precioInput.value.replace(/[^0-9]/g, '');
    
        // Convierte el valor a número y formatea con el signo de pesos y comas
        const valorFormateado = '$' + Number(valor).toLocaleString();
        // Calcula la nueva posición del cursor
        const nuevaPosicionCursor = cursorInicio + 1;
    
        // Actualiza el valor del campo de texto
        precioInput.value = valorFormateado;
    
        // Restaura la posición del cursor
        precioInput.setSelectionRange(nuevaPosicionCursor, nuevaPosicionCursor);
    });
    
});