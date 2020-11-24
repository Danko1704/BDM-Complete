jQuery(document).on("submit", "#formlg", function (event) {
  event.preventDefault();

  jQuery
    .ajax({
      url: "Php/login.php",
      type: "POST",
      dataType: "json",
      data: $(this).serialize(),
      beforeSend: function () {
        
      }
    })
    .done(function (respuesta) {
      console.log(respuesta);
      if (!respuesta.error) {
        if (respuesta.tipo == "Admin") {
          location.href = "index.php";
        } else if (respuesta.tipo == "Reportero") {
          location.href = "index.php";
        } else if (respuesta.tipo == "Usuario") {
          location.href = "index.php";
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
