$(document ).ready( function ()  {
    const dataTable = $('#example').DataTable({
        ajax: {
            url: '/get-data',
            type: 'post',
            dataType: 'json',
            dataSrc: "data"
        }
    });
    $('body').on('click', '#create-user', function(e)  {
        e.preventDefault();
        $.ajax({
            url: '/create-user',
            method: 'post',
            success: function() {
                dataTable.ajax.reload();
            }
        })
    })


})