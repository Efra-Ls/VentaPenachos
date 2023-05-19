
$(document).ready(function() {
    $('#addCustomer').click(function() {
        $('#customerModal').modal('show');
        $('#customerForm')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Agregar Cliente");
    });
// Función de validación de contraseñas
function validatePasswords() {
    var password = $('input[name="password"]').val();
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

                // Obtener el nombre de usuario y contraseña del formulario
                //var username = $('input[name="username"]').val();
                //var password = $('input[name="pwd"]').val();

                // Iniciar sesión automáticamente después del registro
                //loginAfterRegistration(username, password);
            }
        });
    }
});
});