$(document).ready(function() {
        // Obtener el elemento select y los campos específicos
       
        const nombreInput = document.getElementById('nombre');
        const descripcionInput = document.getElementById('descripcion');
        const tipoSelect = document.getElementById('tipo');
        const umbral_cantidad_descuentoInput = document.getElementById('umbral_cantidad_descuento');
        const porcentaje_descuentoInput = document.getElementById('porcentaje_descuento');
        const cantidad_compra_regaloInput = document.getElementById('cantidad_compra_regalo');
        const cantidad_regaloInput = document.getElementById('cantidad_regalo');
        const fecha_inicio_limitadoInput = document.getElementById('fecha_inicio_limitado');
        const fecha_fin_limitadoInput = document.getElementById('fecha_fin_limitado');
        const porcentaje_descuento_limitadoInput = document.getElementById('porcentaje_descuento_limitado');
 

        const nombreError = document.getElementById('nombreError');
        const descripcionError = document.getElementById('descripcionError');
        const tipoError = document.getElementById('tipoError');
        const cantMinError = document.getElementById('cantMinError');
        const porcentajeDescError = document.getElementById('porcentajeDescError');
        const cantMin2Error = document.getElementById('cantMin2Error');
        const cantRegError = document.getElementById('cantRegError');
        const fechaIniError = document.getElementById('fechaIniError');
        const fechaFinError = document.getElementById('fechaFinError');
        const porcentajeLimError = document.getElementById('porcentajeLimError');

        
        nombreInput.addEventListener('change', verificarInputs);
        descripcionInput.addEventListener('change', verificarInputs);
        tipoSelect.addEventListener('change', verificarInputs);
        umbral_cantidad_descuentoInput.addEventListener('change', verificarInputs);
        porcentaje_descuentoInput.addEventListener('change', verificarInputs);
        cantidad_compra_regaloInput.addEventListener('change', verificarInputs);
        cantidad_regaloInput.addEventListener('change', verificarInputs);
        fecha_inicio_limitadoInput.addEventListener('change', verificarInputs);
        fecha_fin_limitadoInput.addEventListener('change', verificarInputs);
        porcentaje_descuento_limitadoInput.addEventListener('change', verificarInputs);

        // Función para verificar y desactivar los inputs según el estado del anterior
        function verificarInputs() {
            descripcionInput.disabled = nombreInput.value.trim() === '';
            tipoSelect.disabled = descripcionInput.value.trim() === '';

            porcentaje_descuentoInput.disabled = !umbral_cantidad_descuentoInput.value;

            cantidad_regaloInput.disabled = !cantidad_compra_regaloInput.value;

            fecha_fin_limitadoInput.disabled = !fecha_inicio_limitadoInput.value;
            porcentaje_descuento_limitadoInput.disabled = !fecha_fin_limitadoInput.value;

            

            // Mostrar mensaje de error y establecer el foco en el campo anterior
            if (nombreInput.value.trim() === '') {
                nombreError.style.display = 'block';
                nombreInput.focus();
            } else {
                nombreError.style.display = 'none';
            }

            if (descripcionInput.value.trim() === '') {
                descripcionError.style.display = 'block';
                descripcionInput.focus();
            } else {
                descripcionError.style.display = 'none';
            }

            if (tipoSelect.value.trim() === '') {
                tipoError.style.display = 'block';
                tipoSelect.focus();
            } else {
                tipoError.style.display = 'none';
            }
            // Mostrar mensaje de error y establecer el foco en el campo anterior
            if (umbral_cantidad_descuentoInput.value.trim() === '') {
                porcentaje_descuentoInput.disabled = true;
                cantMinError.style.display = 'block';
                umbral_cantidad_descuentoInput.focus();
            } else {
                porcentaje_descuentoInput.disabled = false;
                cantMinError.style.display = 'none';
            }

            if (porcentaje_descuentoInput.value.trim() === '') {
                porcentajeDescError.style.display = 'block';
                porcentaje_descuentoInput.focus();
            } else {
                porcentajeDescError.style.display = 'none';
            }

            if (cantidad_compra_regaloInput.value.trim() === '') {
                cantMin2Error.style.display = 'block';
                cantidad_compra_regaloInput.focus();
            } else {
                cantMin2Error.style.display = 'none';
            }

            if (cantidad_regaloInput.value.trim() === '') {
                cantRegError.style.display = 'block';
                cantidad_regaloInput.focus();
            } else {
                cantRegError.style.display = 'none';
            }

            if (fecha_inicio_limitadoInput.value.trim() === '') {
                fechaIniError.style.display = 'block';
                fecha_inicio_limitadoInput.focus();
            } else {
                fechaIniError.style.display = 'none';
            }

            if (fecha_fin_limitadoInput.value.trim() === '') {
                fechaFinError.style.display = 'block';
                fecha_fin_limitadoInput.focus();
            } else {
                fechaFinError.style.display = 'none';
            }

            if (porcentaje_descuento_limitadoInput.value.trim() === '') {
                porcentajeLimError.style.display = 'block';
                porcentaje_descuento_limitadoInput.focus();
            } else {
                porcentajeLimError.style.display = 'none';
            }
            


        }


        const selectPromocion = document.getElementById('tipo');
                        const descuentoCantidadCampos = document.getElementById('descuentoCantidadCampos');
                        const regaloCompraCampos = document.getElementById('regaloCompraCampos');
                        const descuentoTiempoCampos = document.getElementById('descuentoTiempoCampos');
                        descuentoCantidadCampos.classList.add('hidden2');
                        regaloCompraCampos.classList.add('hidden2');
                        descuentoTiempoCampos.classList.add('hidden2');

                        const umbral_cantidad_descuentoInput2 = document.getElementById('umbral_cantidad_descuento');
                        const porcentaje_descuentoInput2 = document.getElementById('porcentaje_descuento');
                        const cantidad_compra_regaloInput2 = document.getElementById('cantidad_compra_regalo');
                        const cantidad_regaloInput2 = document.getElementById('cantidad_regalo');
                        const fecha_inicio_limitadoInput2 = document.getElementById('fecha_inicio_limitado');
                        const fecha_fin_limitadoInput2 = document.getElementById('fecha_fin_limitado');
                        const porcentaje_descuento_limitadoInput2 = document.getElementById('porcentaje_descuento_limitado');
                        function verificarSelecciontipo() {            
                                // Ocultar todos los campos específicos
                            descuentoCantidadCampos.classList.add('hidden2');
                            regaloCompraCampos.classList.add('hidden2');
                            descuentoTiempoCampos.classList.add('hidden2');

                            // Obtener el valor seleccionado del select
                            const seleccion = selectPromocion.value;

                            // Mostrar los campos específicos según la opción seleccionada
                            if (seleccion === 'Descuento por cantidad') {
                                descuentoCantidadCampos.classList.remove('hidden2');
                                

                                umbral_cantidad_descuentoInput2.setAttribute('required', 'required');
                                porcentaje_descuentoInput2.setAttribute('required', 'required');

                                cantidad_compra_regaloInput2.removeAttribute('required');
                                cantidad_regaloInput2.removeAttribute('required');
                                fecha_inicio_limitadoInput2.removeAttribute('required');
                                fecha_fin_limitadoInput2.removeAttribute('required');
                                porcentaje_descuento_limitadoInput2.removeAttribute('required');

                            } else if (seleccion === 'Regalo con compra') {
                                regaloCompraCampos.classList.remove('hidden2');
                            

                                umbral_cantidad_descuentoInput2.removeAttribute('required');
                                porcentaje_descuentoInput2.removeAttribute('required');

                                cantidad_compra_regaloInput2.setAttribute('required', 'required');
                                cantidad_regaloInput2.setAttribute('required', 'required');

                                fecha_inicio_limitadoInput2.removeAttribute('required');
                                fecha_fin_limitadoInput2.removeAttribute('required');
                                porcentaje_descuento_limitadoInput2.removeAttribute('required');

                            } else if (seleccion === 'Descuento por tiempo limitado') {
                                descuentoTiempoCampos.classList.remove('hidden2');

                                umbral_cantidad_descuentoInput2.removeAttribute('required');
                                porcentaje_descuentoInput2.removeAttribute('required');
                                cantidad_compra_regaloInput2.removeAttribute('required');
                                cantidad_regaloInput2.removeAttribute('required');
                                
                                fecha_inicio_limitadoInput2.setAttribute('required', 'required');
                                fecha_fin_limitadoInput2.setAttribute('required', 'required');
                                porcentaje_descuento_limitadoInput2.setAttribute('required', 'required');
                            }
                        }
                        // Escuchar el evento change del select
                        selectPromocion.addEventListener('change', verificarSelecciontipo);
                        
                    




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
        "pageLength": 100,
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
        $('#successMessage').find('.mb-3').html('<label class="control-label"><h3>Registrado corectamente</h3></label>');
        verificarInputs();
        verificarSelecciontipo();
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
                verificarInputs();
                verificarSelecciontipo();
                productData.ajax.reload();
                setTimeout(function() {                                                
                    //$('#successMessage').fadeOut('slow');                                        
                    $('#successMessage').modal('show');                    
            }); 
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
        var id_promocion = $(this).attr("id_promocion");
        var btn_action = 'getPromocionDetails';
        $('#successMessage').find('.mb-3').html('<label class="control-label"><h3>Actualizado correctamente</h3></label>');
        $.ajax({
            url: "action.php",
            method: "POST",
            data: { id_promocion: id_promocion, btn_action: btn_action },
            dataType: "json",
            success: function(data) {
                $('#promocionModal').modal('show');
                $('#id_promocion').val(data.id_promocion);
                $('#nombre').val(data.nombre);
                $('#descripcion').val(data.descripcion);
                $('#tipo').val(data.tipo);
                $('#umbral_cantidad_descuento').val(data.umbral_cantidad_descuento);
                $('#porcentaje_descuento').val(data.porcentaje_descuento);
                $('#cantidad_compra_regalo').val(data.cantidad_compra_regalo);

                $('#cantidad_regalo').val(data.cantidad_regalo);
                $('#fecha_inicio_limitado').val(data.fecha_inicio_limitado);
                $('#fecha_fin_limitado').val(data.fecha_fin_limitado);
                $('#porcentaje_descuento_limitado').val(data.porcentaje_descuento_limitado);
                //$('#foto').val(data.foto);
                $('.modal-title').html("<i class='fa fa-edit'></i> Editar Producto");
                $('#id_promocion').val(id_promocion);
                $('#action').val("Editar");
                $('#btn_action').val("updatePromocion");
                verificarInputs();
                verificarSelecciontipo();
            }
        })
    });

    $(document).on('click', '.delete', function() {
        var id_promocion = $(this).attr("id_promocion");
        var btn_action = 'deletePromocion';
        $('#successMessage').find('.mb-3').html('<label class="control-label camposRojos"><h3>Eliminado correctamente</h3></label>');
        if (confirm("¿Está seguro de que desea eliminar este producto?")) {
            $.ajax({
                url: "action.php",
                method: "POST",
                data: { id_promocion: id_promocion, btn_action: btn_action },
                success: function(data) {
                    setTimeout(function() {                                                
                        //$('#successMessage').fadeOut('slow');                                        
                        $('#successMessage').modal('show');                    
                    });
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