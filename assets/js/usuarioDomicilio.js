
$(document).ready(function() {


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
                
            }
        }) 
    }
    document.getElementById("btnGoogleMaps").addEventListener("click", function() {
        var direccion = "Dirección que deseas abrir en Google Maps";
        var url = "https://www.google.com/maps/search/" + encodeURIComponent(direccion);
        window.open(url);
      });

    const direccion = document.getElementById('direccion');
   
        $(document).on('submit', '#domicilioForm', function(event) {
            event.preventDefault();
                $('#action').attr('disabled', 'disabled');
                var formData = $(this).serialize();
                    $.ajax({
                        url: "adm/action.php",
                        method: "POST",
                        data: formData,
                        success: function(data) {
                            $('#domicilioForm')[0].reset();
                            $('#action').attr('disabled', false);
                            
                            setTimeout(function() {                                                
                                //$('#successMessage').fadeOut('slow');
                                $('#successMessage').modal('show');
                            }); 
                            cargarinfCliente();
                        }
                    }); 
        });
                     

});