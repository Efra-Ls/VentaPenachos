$(document).ready(function() {

    var pedidoData = $('#pedidoListNoenviados').DataTable({
        "lengthChange": false,
        "processing": true,
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "action.php",
            type: "POST",
            data: { action: 'listPedidoNoenviados' },
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
   
    $(document).on('submit', '#pedidoForm', function(event) {        
        pedidoData.ajax.reload();
    });
});