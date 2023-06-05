$(document).ready(function() {


    const nombreInput = document.getElementById('nombre');
                            const descripcionInput = document.getElementById('descripcion');
                            const categoriaSelect = document.getElementById('categoria');
                            const precioInput = document.getElementById('precio');
                            const existenciaInput = document.getElementById('existencia');
                            const unidadSelect = document.getElementById('unidad');
                            const promocionSelect = document.getElementById('promocion');
                            const fotoPrincipalInput = document.getElementById('fotoprincipal');
                            const foto1Input = document.getElementById('foto1');
                            const foto2Input = document.getElementById('foto2');
                            const foto3Input = document.getElementById('foto3');
                            const foto4Input = document.getElementById('foto4');
                            const foto5Input = document.getElementById('foto5');

                            const nombreError = document.getElementById('nombreError');
                            const descripcionError = document.getElementById('descripcionError');
                            const categoriaError = document.getElementById('categoriaError');
                            const precioError = document.getElementById('precioError');
                            const existenciaError = document.getElementById('existenciaError');
                            const unidadError = document.getElementById('unidadError');
                            const promocionError = document.getElementById('promocionError');
                            const fotoPError = document.getElementById('fotoPError');
                            const foto1Error = document.getElementById('foto1Error');
                            const foto2Error = document.getElementById('foto2Error');
                            const foto3Error = document.getElementById('foto3Error');
                            const foto4Error = document.getElementById('foto4Error');
                            const foto5Error = document.getElementById('foto5Error');

                            // Función para verificar y desactivar los inputs según el estado del anterior
                            function verificarInputs() {
                                descripcionInput.disabled = nombreInput.value.trim() === '';
                                categoriaSelect.disabled = descripcionInput.value.trim() === '';
                                precioInput.disabled = categoriaSelect.value.trim() === '';
                                existenciaInput.disabled =  !precioInput.value;
                                unidadSelect.disabled = !existenciaInput.value;
                                promocionSelect.disabled = unidadSelect.value.trim() === '';
                                fotoPrincipalInput.disabled = promocionSelect.value.trim() === '';
                                foto1Input.disabled = fotoPrincipalInput.value.trim() === '';
                                foto2Input.disabled = foto1Input.value.trim() === '';
                                foto3Input.disabled = foto2Input.value.trim() === '';
                                foto4Input.disabled = foto3Input.value.trim() === '';
                                foto5Input.disabled = foto4Input.value.trim() === '';

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

                                if (categoriaSelect.value.trim() === '') {
                                    categoriaError.style.display = 'block';
                                    categoriaSelect.focus();
                                } else {
                                    categoriaError.style.display = 'none';
                                }

                                if (precioInput.value.trim() === '') {
                                    precioError.style.display = 'block';
                                    precioInput.focus();
                                } else {
                                    precioError.style.display = 'none';
                                }

                                if (existenciaInput.value.trim() === '') {
                                    existenciaError.style.display = 'block';
                                    existenciaInput.focus();
                                } else {
                                    existenciaError.style.display = 'none';
                                }

                                if (unidadSelect.value.trim() === '') {
                                    unidadError.style.display = 'block';
                                    unidadSelect.focus();
                                } else {
                                    unidadError.style.display = 'none';
                                }

                                
                                if (promocionSelect.value.trim() === '') {
                                    promocionError.style.display = 'block';
                                    promocionSelect.focus();
                                } else {
                                    promocionError.style.display = 'none';
                                }

                                if (fotoPrincipalInput.value.trim() === '') {
                                    fotoPError.style.display = 'block';
                                    fotoPrincipalInput.focus();
                                } else {
                                    fotoPError.style.display = 'none';
                                }

                                if (foto1Input.value.trim() === '') {
                                    foto1Error.style.display = 'block';
                                    foto1Input.focus();
                                } else {
                                    foto1Error.style.display = 'none';
                                }

                                if (foto2Input.value.trim() === '') {
                                    foto2Error.style.display = 'block';
                                    foto2Input.focus();
                                } else {
                                    foto2Error.style.display = 'none';
                                }

                                if (foto3Input.value.trim() === '') {
                                    foto3Error.style.display = 'block';
                                    foto3Input.focus();
                                } else {
                                    foto3Error.style.display = 'none';
                                }

                                if (foto4Input.value.trim() === '') {
                                    foto4Error.style.display = 'block';
                                    foto4Input.focus();
                                } else {
                                    foto4Error.style.display = 'none';
                                }

                                if (foto5Input.value.trim() === '') {
                                    foto5Error.style.display = 'block';
                                    foto5Input.focus();
                                } else {
                                    foto5Error.style.display = 'none';
                                }
                            }

                            // Verificar los inputs al cargar la página
                            verificarInputs();
                            //
                            // Agregar un listener al evento 'input' en cada input para verificar los campos
                            nombreInput.addEventListener('change', verificarInputs);
                            descripcionInput.addEventListener('change', verificarInputs);
                            categoriaSelect.addEventListener('change', verificarInputs);                            
                            precioInput.addEventListener('change', verificarInputs);
                            existenciaInput.addEventListener('change', verificarInputs);
                            unidadSelect.addEventListener('change', verificarInputs);
                            promocionSelect.addEventListener('change', verificarInputs);
                            fotoPrincipalInput.addEventListener('change', verificarInputs);
                            foto1Input.addEventListener('change', verificarInputs);
                            foto2Input.addEventListener('change', verificarInputs);
                            foto3Input.addEventListener('change', verificarInputs);
                            foto4Input.addEventListener('change', verificarInputs);
                            foto5Input.addEventListener('change', verificarInputs);
                            




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
            "targets": [0, 8],
            "orderable": false,
        }, ],
        "pageLength": 100,
        'rowCallback': function(row, data, index) {
            $(row).find('td').addClass('align-middle')
            $(row).find('td:eq(0), td:eq(3),td:eq(4),td:eq(5),td:eq(6)').addClass('text-center')
        },
    });

  

    $('#addProduct').click(function() {
        $('#productModal').modal('show');
        $('#productForm')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Agregar Producto");
        $('#action').val("Agregar");
        $('#btn_action').val("addProduct");
        $('#successMessage').find('.mb-3').html('<label class="control-label"><h3>Registrado corectamente</h3></label>');
        verificarInputs();
    });


    $(document).on('submit', '#productForm', function(event) {
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        //var formData = $(this).serialize();
        var formData = new FormData($('#productForm')[0]);
        formData.append('fotoprincipal', $('#fotoprincipal')[0].files[0]);
        formData.append('foto1', $('#foto1')[0].files[0]);
        formData.append('foto2', $('#foto2')[0].files[0]);
        formData.append('foto3', $('#foto3')[0].files[0]);
        formData.append('foto4', $('#foto4')[0].files[0]);
        formData.append('foto5', $('#foto5')[0].files[0]);
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
                verificarInputs();
                productData.ajax.reload();
               // if (data.success) {
                    setTimeout(function() {                                                
                        //$('#successMessage').fadeOut('slow');                    
                        $('#successMessage').modal('show');                    
                }); 
             //}
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
        $('#successMessage').find('.mb-3').html('<label class="control-label"><h3>Actualizado correctamente</h3></label>');
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
                $('#promocion').val(data.promocion);
                $('#precio').val(data.precio);
                $('#existencia').val(data.existencia);
                $('#unidad').val(data.unidad);
                //$('#foto').val(data.foto);
                $('.modal-title').html("<i class='fa fa-edit'></i> Editar Producto");
                $('#id_producto').val(id_producto);
                $('#action').val("Editar");
                $('#btn_action').val("updateProduct");
                verificarInputs();
            }
        })        
    });

    $(document).on('click', '.delete', function() {
        var id_producto = $(this).attr("id_producto");
        var btn_action = 'deleteProduct';
        $('#successMessage').find('.mb-3').html('<label class="control-label camposRojos"><h3>Eliminado correctamente</h3></label>');
        if (confirm("¿Está seguro de que desea eliminar este producto?")) {
            $.ajax({
                url: "action.php",
                method: "POST",
                data: { id_producto: id_producto, btn_action: btn_action },
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
        const valor = existenciaInput.value.replace(/[^0-9]/g, '');
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