jQuery(document).on("submit", "#formlg", function (event) {
  event.preventDefault();

  jQuery
    .ajax({
      url: "Php/login.php",
      type: "POST",
      dataType: "json",
      data: $(this).serialize(),
      beforeSend: function () {
        $('.btn').val('Validando...');
      },
    })
    .done(function (respuesta) {
      console.log(respuesta);
      if (!respuesta.error) {
        if (respuesta.tipo == "Admin") {
          location.href = "index.html";
        } else if (respuesta.tipo == "Usuario") {
          location.href = "index.html";
        }
      } else {
        $('.error').slideDown ('slow');
        setTimeout(function(){
          $('.error').slideUp ('slow')
        },3000);
        $('.btn').val('INGRESAR');
      }
    })

    .fail(function (resp) {
      console.log(resp.responseText);
    })
    .always(function () {
      console.log("complete");
    });
});
