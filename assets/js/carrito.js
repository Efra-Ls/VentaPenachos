$(document).ready(function() {

    var misComprasdataTable = $('#misComprasList').DataTable({
        "lengthChange": false,
        "processing": true, 
        "serverSide": true,
        "order": [],
        "ajax": {
            url: "adm/action.php",
            type: "POST",
            data: { action: 'misComprasList',id_cliente:userid },
            dataType: "json"
        },
        "columnDefs": [{
            "target": [0, 5],
            "orderable": false
        }],
        "pageLength": 100,
        'rowCallback': function(row, data, index) {
            $(row).find('td').addClass('align-middle')
            $(row).find('td:eq(0), td:eq(5)').addClass('text-center')
            $(row).find('td:eq(4)').addClass('text-end')
        }
});

});