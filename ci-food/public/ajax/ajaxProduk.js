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
    $('.modal-title').text('Tambah Produk');

    $('.img-preview').attr('src', urlImgDefault);
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

function imgPreview(){
    const gambar = document.querySelector('#gambar');
    const imgPreview = document.querySelector('.img-preview');

    const fileImg = new FileReader();
    fileImg.readAsDataURL(gambar.files[0]);

    fileImg.onload = function(e){
        imgPreview.src = e.target.result;
    }
}