$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: 'Php/cargaSeccion.php',

        success:function(data){
            
            $('#categoBox').append(data);

        }
    });
});