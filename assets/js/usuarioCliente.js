
$(document).ready(function() {

    const nombreInput = document.getElementById('cnombre');
    const domicilioInput = document.getElementById('domicilio');
    const telefonoInput = document.getElementById('telefono');
    const correoInput = document.getElementById('correo');
    //const contraInput = document.getElementById('passwordR');
    //const ccontraInput = document.getElementById('confirmPassword');
    const nombreError = document.getElementById('nombreError');
    const domicilioError = document.getElementById('domicilioError');
    const telefonoError = document.getElementById('telefonoError');
    const correoError = document.getElementById('correoError');
    //const contraError = document.getElementById('contraError');
    //const ccontraError = document.getElementById('ccontraError');

        // Verificar los inputs al cargar la página
    //verificarInputs();
   
    // Agregar un listener al evento 'input' en cada input para verificar los campos
    nombreInput.addEventListener('change', verificarInputs);
    domicilioInput.addEventListener('change', verificarInputs);
    telefonoInput.addEventListener('change', verificarInputs);
    correoInput.addEventListener('change', verificarInputs);
    // contraInput.addEventListener('change', verificarInputs);
    //ccontraInput.addEventListener('change', verificarInputs);   
    // Función para verificar y desactivar los inputs según el estado del anterior
    
    verificarInputs();
    function cargarinfCliente() {
        //var userid = $_SESSION['id_cliente'];       
        var btn_action = 'getCustomerInicio';
        $('#successMessage').find('.mb-3').html('<label class="control-label"><h3>Actualizado correctamente</h3></label>');
        $.ajax({
            url: "adm/action.php",
            method: "POST",
            data: { userid: userid, btn_action: btn_action },
            dataType: "json",
            success: function(data) {                        
                $('#cnombre').val(data.nombre);
                $('#domicilio').val(data.domicilio);               
                $('#telefono').val(data.telefono);
                $('#correo').val(data.correo);
                $('#userid').val(userid);
                $('#btn_action').val('updateCustomerPerfil');

                $('#domicilio2').val(data.domicilio);
                $('#id_clienteD').val(userid);
                $('#btn_actionD').val('updateDireccionPerfil');

                verificarInputs();
                
            }
        }) 
    }
    cargarinfCliente();
             function verificarInputs() {
                domicilioInput.disabled = nombreInput.value.trim() === '';
                correoInput.disabled = true; 
                telefonoInput.disabled = domicilioInput.value.trim() === ''; 
                
                //contraInput.disabled = correoInput.value.trim() === ''; 
                //ccontraInput.disabled = contraInput.value.trim() === ''; 									                               
                // Mostrar mensaje de error y establecer el foco en el campo anterior
                    if (nombreInput.value.trim() === '') {
                        nombreError.style.display = 'block';
                       // nombreInput.focus();
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
                }                
                $(document).on('submit', '#datosPersonalesForm', function(event) {
                    event.preventDefault();
                        $('#action').attr('disabled', 'disabled');
                        var formData = $(this).serialize();
                        $.ajax({
                            url: "adm/action.php",
                            method: "POST",
                            data: formData,
                            success: function(data) {
                                $('#datosPersonalesForm')[0].reset();
                                $('#action').attr('disabled', false);
                                cargarinfCliente();
                                setTimeout(function() {                                                
                                    //$('#successMessage').fadeOut('slow');
                                    $('#successMessage').modal('show');
                                }); 
                            }
                        });    
                });
                $(document).on('input', '#cnombre', function(event) {
                    const cnombreInput =  event.target;
                    const valor = cnombreInput.value.replace(/[^a-zA-Z\s]/g, '');
                    cnombreInput.value=valor;
                });
                $(document).on('input', '#telefono', function(event) {
                    const telefonoInput =  event.target;
                        const valor=telefonoInput.value.replace(/[^\d]/g, '');
                        telefonoInput.value=valor;
                
                        var telefonoError = document.getElementById('telefonoErrorCorto');
                        
                        if (telefonoInput.value.length !== 10) {
                            telefonoError.style.display = 'block';
                            telefonoInput.style.color = 'red';
                        } else {
                            telefonoError.style.display = 'none';
                            telefonoInput.style.color = 'black';
                        }
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
 // Función para iniciar sesión automáticamente
 function loginAfterRegistration(username, password) {
    $.ajax({
        url: "login.php", // Ruta al script de inicio de sesión
        method: "POST",
        data: {
            email: username,
            pwd: password
        },
        success: function(data) {
            // Manejar la respuesta del inicio de sesión
            // Redireccionar a la página deseada o realizar otras acciones necesarias
            window.location.href = "../login.php"; // Ejemplo de redireccionamiento a la página del panel de control
        }
    });
}

});