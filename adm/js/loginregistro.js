
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

$(document).on('submit', '#customerForm', function(event) {
    event.preventDefault();

    if(validarSeguridadContrasena(contraInput.value)==='Fuerte') {
        if (validatePasswords()) {
        $('#action').attr('disabled', 'disabled');
        var formData = $(this).serialize();
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
                setTimeout(function() {                                                
                    //$('#successMessage').fadeOut('slow');
                    $('#successMessage').modal('show');
                    seguridadElement.style.display = "none";
                }); 
                // Obtener el nombre de usuario y contraseña del formulario
                //var username = $('input[name="username"]').val();
                //var password = $('input[name="pwd"]').val();

                // Iniciar sesión automáticamente después del registro
                //loginAfterRegistration(username, password);
            }
        });
    }
}else{
    alert("La seguridad de la contraseña es debil");
    $('input[name="passwordR"]').focus(); // Establece el enfoque en el campo de confirmar contraseña
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