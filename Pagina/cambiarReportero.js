function cambioReportero() {
  jQuery(document).on("click", ".formCambio", function (event) {
    event.preventDefault();

    jQuery.ajax({
      url: "Php/cambioReportero.php",
      type: "POST",
      dataType: "json",
      data: $(this).serialize(),
      beforeSend: function () {
        $(".reportero").slideDown("slow");
        setTimeout(function () {
          $(".reportero").slideUp("slow");
          location = 'cambiarUsuario.php';
        }, 3000);
      },
    });
  });
  this.onclick = function() {return true;};
  return true;
};
