var table;
var save_method;
var url;


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
    
    });
});

function reload_table(){
    table.ajax.reload(null,false);
}

function show(){
    save_method = 'save';

    $('#modal-form form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();
    $('#modal-form').modal('show');
    $('.modal-title').text('Tambah Kategori');
}

function ajaxSave(){
    $('#btn-save').text('proses...');
    $('#btn-save').attr('disabled',true);

    if(save_method == 'save'){
        url = urlSave;
    }else{
        url = urlUpdate;
    }

    $.ajax({
        url : url,
        type: "POST",
        data: new FormData($('#form')[0]),
        contentType: false,
        processData: false,
        dataType: "JSON",
        success: function(data){
            if(data.status){
                $('#modal-form').modal('hide');
                success('Data berhasil disimpan');
                reload_table();
            }else{
                for(var i = 0; i < data.inputerror.length; i++){
                    $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                    $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                }
            }
            $('#btn-save').text('save');
            $('#btn-save').attr('disabled',false);
        },
        error: function(jqXHR, textStatus, errorThrown){
            alert('Error adding / update data');
            $('#btn-save').text('save');
            $('#btn-save').attr('disabled',false);
        }
    });
}

function ajaxEdit(id){
    save_method = 'edit';
    $('#modal-form form')[0].reset();
    $('.form-group').removeClass('has-error');
    $('.help-block').empty();

    $.ajax({
        url : urlEdit + id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
            $('[name="id"]').val(data.id);
            $('[name="nama_kategori"]').val(data.nama_kategori);
            
            $('#modal-form').modal('show');
            $('.modal-title').text('Edit Kategori');
        },
        error: function(jqXHR, textStatus, errorThrown){
        }
    });
}

function ajaxDelete(id){
    if(confirm('Apakah anda yakin akan menghapus data ini?')){
        $.ajax({
            url : urlDelete + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    success('Data berhasil dihapus');
                    reload_table();
                }else{
                    error('Data gagal dihapus');
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
            }
        });
    }
}
function ajaxStatus(id){
    if(confirm('Apakah anda yakin untuk mengubah status?')){
        $.ajax({
            url : urlStatus + id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
                if(data.status){
                    success('Status berhasil diubah');
                    reload_table();
                }else{
                    error('Status gagal diubah');
                }
            },
            error: function(jqXHR, textStatus, errorThrown){
            }
        });
    }
}