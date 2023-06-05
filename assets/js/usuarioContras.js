
$(document).ready(function() {
    const antcontraInput = document.getElementById('passwordAnt');
    const contraInput = document.getElementById('passwordR');
    const ccontraInput = document.getElementById('confirmPassword');
    
    const antcontraError = document.getElementById('antcontraError');
    const contraError = document.getElementById('contraError');
    const ccontraError = document.getElementById('ccontraError');
        // Verificar los inputs al cargar la página
    //verificarInputs();
    antcontraInput.addEventListener('change', verificarInputs); 
     contraInput.addEventListener('change', verificarInputs);
    ccontraInput.addEventListener('change', verificarInputs);   
    // Función para verificar y desactivar los inputs según el estado del anterior
    
    verificarInputs();
    function cargarinfContrasenas() {
        //var userid = $_SESSION['id_cliente'];       
        var btn_action = 'getContraInicio';
        $('#successMessage').find('.mb-3').html('<label class="control-label"><h3>Actualizado correctamente</h3></label>');
        $.ajax({
            url: "adm/action.php",
            method: "POST",
            data: { correo: correoU, btn_action: btn_action },
            dataType: "json",
            success: function(data) {                        
                $('#contrasenia').val(data.contrasenia);
                $('#correoU').val(data.correo);
                $('#btn_actionC').val('updateContraPerfil');

                verificarInputs();
                
            }
        }) 
    }
    cargarinfContrasenas();
             function verificarInputs() {
                contraInput.disabled = antcontraInput.value.trim() === ''; 
				ccontraInput.disabled = contraInput.value.trim() === ''; 							                               
                // Mostrar mensaje de error y establecer el foco en el campo anterior                    

                    if (antcontraInput.value.trim() === '') {
                        antcontraError.style.display = 'block';
                        antcontraInput.focus();
                    } else {
                        antcontraError.style.display = 'none';
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
                var seguridadElement= document.getElementById("contraSeguridad");
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
        $(document).on('submit', '#datosContrasenaForm', function(event) {
            event.preventDefault();
                $('#action').attr('disabled', 'disabled');
                var formData = $(this).serialize();
                if(validatePasswordAnte()){
                        if(validarSeguridadContrasena(contraInput.value)==='Fuerte') {
                            if (validatePasswords()) {
                                    $.ajax({
                                        url: "adm/action.php",
                                        method: "POST",
                                        data: formData,
                                        success: function(data) {
                                            $('#datosContrasenaForm')[0].reset();
                                            $('#action').attr('disabled', false);
                                            cargarinfContrasenas();
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
                 }   
        });
                     

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
// Función de validación de contraseñas
function validatePasswordAnte() {
    var passwordEscr = $('input[name="passwordAnt"]').val();
    var passwordAnte = $('input[name="contrasenia"]').val();

    if (passwordEscr !== passwordAnte) {
        alert("La contraseña anterior no es correcta");
        $('input[name="passwordAnt"]').focus(); // Establece el enfoque en el campo de confirmar contraseña
        return false; // No permite enviar el formulario
    }

    return true; // Permite enviar el formulario
}

});