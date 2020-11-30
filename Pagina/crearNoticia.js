$(document).ready(function(){
    $.ajax({
        type: "POST",
        url: "Php/loadSections.php",

        success: function (response) {

            $('#categoria').append(response);
        }
    });
});

$(document).ready(function(){
    $.ajax({
        type: "POST",
        url: "Php/colorSeccion.php",
        
        success: function (response) {

            let colores = JSON.parse(response);
            let temp = '#color';

            colores.forEach(color => {

                temp += `${color.id}`;
                $(temp).css('color', color.color);
                temp = '#color';

            });
        }
    });
});

$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: 'Php/cargaCatego.php',

        success:function(data){
            
            $('#categoBox').append(data);

        }
    });
});