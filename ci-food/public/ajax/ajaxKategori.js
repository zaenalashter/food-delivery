var table;

$(document).ready(function() {
    table = $('#mytable').DataTable({
        "pageLength": 10,
        "autoWidth": true,
        "lengthChange": false,
        "ordering": false,
        "processing": true,
        "searching": true,
        "serverSide": true,
        "deferRender": true,
        "ajax": {
            "url": urlList,
            "type": "GET"
        },
        "columnDefs": [
            {
                "targets": [1],
                "visible": false,
            },
        ],
    
    });
});

function reload_table(){
    table.ajax.reload(null,false);
}