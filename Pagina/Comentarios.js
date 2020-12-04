$(document).ready(function () {
    var noticiaId = $("#noticiaID").val();
    //console.log(noticiaId);

    $.ajax({
        url: 'Php/muestraComentarios.php',
        type: 'post',
        data: ({noticiaID: noticiaId}),
        //dataType: 'json',
        success: function(response) {
            if(response != ''){
                //console.log(response);
                $("#seccionComentarios").append(response);

            }
        }
    });
});

$("form.addComment").on("submit", function(event){
    console.log('jQuery ta jalanding');
    var that = $(this),
        url = that.attr('action'),
        type = that.attr('method'),
        data = {};

    that.find('[name]').each(function(index, e) {
        //console.log(value);
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
        
        data[name] = value;
    });


    //console.log(data);
    $.ajax({
        url : url,
        type: type,
        data: data,
        success: function(response){
            console.log(response);
        },
    });
    
    return false;
});

function toggleDisable() {
    document.getElementById('textoComentario').disabled = true;
}