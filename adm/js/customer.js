$(document).ready(function() {
    
    

            const nombreInput = document.getElementById('cnombre');
            const domicilioInput = document.getElementById('domicilio');
            const telefonoInput = document.getElementById('telefono');
            const correoInput = document.getElementById('correo');
            const contraInput = document.getElementById('passwordR');
            const ccontraInput = document.getElementById('confirmPassword');

            const nombreError = document.getElementById('nombreError');
            const domicilioError = document.getElementById('domicilioError');
            const telefonoError = document.getElementById('telefonoError');
            const correoError = document.getElementById('correoError');
            const contraError = document.getElementById('contraError');
            const ccontraError = document.getElementById('ccontraError');

                // Verificar los inputs al cargar la página
            verificarInputs();
            //
            // Agregar un listener al evento 'input' en cada input para verificar los campos
            nombreInput.addEventListener('change', verificarInputs);
            domicilioInput.addEventListener('change', verificarInputs);
            telefonoInput.addEventListener('change', verificarInputs);
            correoInput.addEventListener('change', verificarInputs);
            contraInput.addEventListener('change', verificarInputs);
            ccontraInput.addEventListener('change', verificarInputs);   
            // Función para verificar y desactivar los inputs según el estado del anterior
                            function verificarInputs() {
                                domicilioInput.disabled = nombreInput.value.trim() === '';
                                telefonoInput.disabled = domicilioInput.value.trim() === ''; 
								correoInput.disabled = telefonoInput.value.trim() === ''; 
								contraInput.disabled = correoInput.value.trim() === ''; 
								ccontraInput.disabled = contraInput.value.trim() === ''; 	
								                               

                                // Mostrar mensaje de error y establecer el foco en el campo anterior
                                if (nombreInput.value.trim() === '') {
                                    nombreError.style.display = 'block';
                                    nombreInput.focus();
                                } else {
                                    nombreError.style.display = 'none';
                                }

                                if (domicilioInput.value.trim() === '') {
                                    domicilioError.style.display = 'block';
                                    domicilioInput.focus();
                                } else {
                                    domicilioError.style.display = 'none';
                                }

                                if (telefonoInput.value.trim() === '') {
                                    telefonoError.style.display = 'block';
                                    telefonoInput.focus();
                                } else {
                                    telefonoError.style.display = 'none';
                                }

                                if (correoInput.value.trim() === '') {
                                    correoError.style.display = 'block';
                                    correoInput.focus();
                                } else {
                                    correoError.style.display = 'none';
                                }
								if (contraInput.value.trim() === '') {
                                    contraError.style.display = 'block';
                                    contraInput.focus();
                                } else {
                                    contraError.style.display = 'none';
                                }

								if (ccontraInput.value.trim() === '') {
                                    ccontraError.style.display = 'block';
                                    ccontraInput.focus();
                                } else {
                                    ccontraError.style.display = 'none';
                                }

                            }

                               


// Función de validación de contraseñas
function validatePasswords() {
    var password = $('input[name="passwordR"]').val();
    var confirmPassword = $('input[name="confirmPassword"]').val();

    if (password !== confirmPassword) {
        alert("Las contraseñas no coinciden");
        $('input[name="confirmPassword"]').focus(); // Establece el enfoque en el campo de confirmar contraseña
        return false; // No permite enviar el formulario
    }

    return true; // Permite enviar el formulario
}


// Función para validar la seguridad de la contraseña
function validarSeguridadContrasena(contrasena) {
    // Expresión regular para verificar las características de seguridad
    var regex = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    
    // Verificar si la contraseña cumple con los requisitos de seguridad
    if (regex.test(contrasena)) {
        return "Fuerte";
    } else {
        return "Débil";
    }
}
var seguridadElement = document.getElementById("contraSeguridad");
// Función para verificar la seguridad de la contraseña al escribir en el campo
document.getElementById("passwordR").addEventListener("input", function() {
    var contrasena = this.value;
    var seguridad = validarSeguridadContrasena(contrasena);
    var seguridadElement = document.getElementById("contraSeguridad");
    
    seguridadElement.innerHTML = "Seguridad: " + seguridad;
    
    if (seguridad === "Fuerte") {
        seguridadElement.style.color = "green";
    } else {
        seguridadElement.style.color = "red";
    }
    
    seguridadElement.style.display = "block";
});

    $('#addCustomer').click(function() {
        $('#customerModal').modal('show');
        $('#customerForm')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Agregar Cliente");        
        verificarInputs();
        //$('#passwordContainer').removeClass('hidden2');
          //  $('#passwordContainerConf').removeClass('hidden2');

    });
    var userdataTable = $('#customerList').DataTable({
        "lengthChange": false,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "action.php",
            type: "POST",
            data: { action: 'customerList' },
            dataType: "json"
        },
        "columnDefs": [{
            "target": [0, 5],
            "orderable": false
        }],
        "pageLength": 50,
        'rowCallback': function(row, data, index) {
            $(row).find('td').addClass('align-middle')
            $(row).find('td:eq(0), td:eq(5)').addClass('text-center')
            $(row).find('td:eq(4)').addClass('text-end')
        },
    });

    $(document).on('submit', '#customerForm', function(event) {
        event.preventDefault();
        var formData = $(this).serialize();

        if(validarSeguridadContrasena(contraInput.value)==='Fuerte') {
            if (validatePasswords()) {
                console.log('testt')
                $('#action').attr('disabled', 'disabled');
                
                $.ajax({
                    url: "action.php",
                    method: "POST",
                    data: formData,
                    success: function(data) {
                        $('#customerForm')[0].reset();
                        $('#customerModal').modal('hide');
                        $('#alert_action').fadeIn().html('<div class="alert alert-success">' + data + '</div>');
                        $('#action').attr('disabled', false);
                        verificarInputs();
                        userdataTable.ajax.reload();    
                        // Mostrar mensaje "Registrado correctamente"
                        //$('#successMessage').fadeIn().html('Registrado correctamente');
                        setTimeout(function() {                                                
                            //$('#successMessage').fadeOut('slow');
                            $('#successMessage').modal('show');
                            seguridadElement.style.display = "none";
                        });   
                    }
                });
                
        }
    }else{
        alert("La seguridad de la contraseña es debil");
        $('input[name="passwordR"]').focus(); // Establece el enfoque en el campo de confirmar contraseña
    }
    });

        $(document).on('click', '.update', function() {
            var userid = $(this).attr("id_cliente");
            var btn_action = 'getCustomer';
            //$('#passwordContainer').addClass('hidden2');
            //$('#passwordContainerConf').addClass('hidden2');
            
            $.ajax({
                url: "action.php",
                method: "POST",
                data: { userid: userid, btn_action: btn_action },
                dataType: "json",
                success: function(data) {
                    $('#customerModal').modal('show');
                    $('#cnombre').val(data.nombre);
                    $('#domicilio').val(data.domicilio);
                    $('#telefono').val(data.telefono);
                    $('#correo').val(data.correo);
                    
                    
                    $('.modal-title').html("<i class='fa fa-edit'></i> Editar Cliente");
                    $('#userid').val(userid);
                    $('#btn_action').val('customerUpdate');
                    verificarInputs();
                    
                }
            }) 
            validarSeguridadContrasena($('#passwordR').value);
                
        });

    $(document).on('click', '.delete', function() {
        var correo = $(this).attr("correo");
        var btn_action = "customerDelete";
        if (confirm("¿Está seguro de que desea eliminar este cliente?")) {
            $.ajax({
                url: "action.php",
                method: "POST",
                data: { correo: correo, btn_action: btn_action },
                success: function(data) {
                    $('#alert_action').fadeIn().html('<div class="alert alert-info">' + data + '</div>');
                    userdataTable.ajax.reload();
                }
            })
        } else {
            return false;
        }
    });
    $(document).on('input', '#cnombre', function(event) {
        const cnombreInput =  event.target;
        const valor=cnombreInput.value.replace(/[0-9]/g, '');
        cnombreInput.value=valor;
    });
    $(document).on('input', '#telefono', function(event) {
        const telefonoInput =  event.target;
        const valor=telefonoInput.value.replace(/[^\d]/g, '');
        telefonoInput.value=valor;
    }); 
    $(document).on('input', '#correo', function(event) {
        const correoInput =  event.target;
            
            if (/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(correoInput.value)) {
                // Si se ingresó solo números, cambia el color del texto a rojo
                correoInput.style.color = 'black';
            } else {
                // Si se ingresó texto, cambia el color del texto a negro
                correoInput.style.color = 'red';
            }
    });
});