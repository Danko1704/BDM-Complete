jQuery(document).ready("#categoBox", function() {
    //$("#categoBox").load("Php/cargaCatego.php");

    $.ajax({
        url: "Php/cargaCatego.php",
        type: "GET",
        dataType: "json",
        data: $(this).serialize(),
        beforeSend: function () {
        
        }
    });
});

/*jQuery(document).on("submit", "#aceptar", function (event) {
    event.preventDefault();

    jQuery
        .ajax({
            url: "Php/createNews.php",
            type: "POST",
            dataType: "json",
            data: $(this).serialize(),
            beforeSend: function () {
                $('.btn').val('Validando...');
            },
        })
});*/
//window.location.href = "perfilReportero.html";