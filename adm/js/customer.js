$(document).ready(function() {
    $('#addCustomer').click(function() {
        $('#customerModal').modal('show');
        $('#customerForm')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Agregar Cliente");
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
        "pageLength": 25,
        'rowCallback': function(row, data, index) {
            $(row).find('td').addClass('align-middle')
            $(row).find('td:eq(0), td:eq(5)').addClass('text-center')
            $(row).find('td:eq(4)').addClass('text-end')
        },
    });

    $(document).on('submit', '#customerForm', function(event) {
        event.preventDefault();
        console.log('testt')
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
                userdataTable.ajax.reload();
            }
        })
    });

    $(document).on('click', '.update', function() {
        var userid = $(this).attr("id_cliente");
        var btn_action = 'getCustomer';
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
            }
        })
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