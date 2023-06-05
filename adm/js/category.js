$(document).ready(function() {
    $('#categoryAdd').click(function() {
        $('#categoryModal').modal('show');
        $('#categoryForm')[0].reset();
        $('.modal-title').html("<i class='fa fa-plus'></i> Agregar Categoría");
        $('#action').val('Agregar');
        $('#btn_action').val('categoryAdd');
        $('#successMessage').find('.mb-3').html('<label class="control-label"><h3>Registrado corectamente</h3></label>');
    });
    var categoryData = $('#categoryList').DataTable({
        "lengthChange": false,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "action.php",
            type: "POST",
            data: { action: 'categoryList' },
            dataType: "json"
        },
        "columnDefs": [{
            "targets": [0, 2],
            "orderable": false,
        }, ],
        "pageLength": 100,
        'rowCallback': function(row, data, index) {
            $(row).find('td').addClass('align-middle')
            $(row).find('td:eq(0), td:eq(1)').addClass('text-center')
        }
    });
    $(document).on('submit', '#categoryForm', function(event) {
        event.preventDefault();
        $('#action').attr('disabled', 'disabled');
        var formData = $(this).serialize();
        $.ajax({
            url: "action.php",
            method: "POST",
            data: formData,
            success: function(data) {
                $('#categoryForm')[0].reset();
                $('#categoryModal').modal('hide');               
                $('#action').attr('disabled', false);
                setTimeout(function() {                                                
                    //$('#successMessage').fadeOut('slow');                                        
                    $('#successMessage').modal('show');                    
            }); 
                categoryData.ajax.reload();
            }
        })
    });
    $(document).on('click', '.update', function() {
        var categoryId = $(this).attr("id_categoria");
        var btnAction = 'getCategory';
        $('#successMessage').find('.mb-3').html('<label class="control-label"><h3>Actualizado correctamente</h3></label>');
        $.ajax({
            url: "action.php",
            method: "POST",
            data: { id_categoria: categoryId, btn_action: btnAction },
            dataType: "json",
            success: function(data) {
                $('#categoryModal').modal('show');
                $('#categoria').val(data.nombre);
                $('.modal-title').html("<i class='fa fa-edit'></i> Editar Categoría");
                $('#id_categoria').val(categoryId);
                $('#action').val('Editar');
                $('#btn_action').val("updateCategory");
            }
        })
    });
    $(document).on('click', '.delete', function() {
        var categoryId = $(this).attr('id_categoria');
        var btn_action = 'deleteCategory';
        $('#successMessage').find('.mb-3').html('<label class="control-label camposRojos"><h3>Eliminado correctamente</h3></label>');
        if (confirm("¿Está seguro de que desea eliminar esta categoría?")) {
            $.ajax({
                url: "action.php", 
                method: "POST",
                data: { id_categoria: categoryId,btn_action: btn_action },
                success: function(data) {
                    setTimeout(function() {                                                
                        //$('#successMessage').fadeOut('slow');                                        
                        $('#successMessage').modal('show');                    
                    });
                    categoryData.ajax.reload();
                }
            })
        } else {
            return false;
        }
    });
});