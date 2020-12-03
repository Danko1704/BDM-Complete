$("form.Busqueda").on("submit", function(event){

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

    $.ajax({
        url : url,
        type: type,
        data: data,
        success: function(response){

            if(response != ''){

                $(".misNoticias").append(response);

            }
        },
    });
    
    return false;
});

$(document).ready(function(){
    $("#clear").click(function(){
        //console.log('hice click prro');
      $("div").remove(".remove");
      $("h2").remove(".remove");
      $("p").remove(".remove");
      $("a").remove(".remove");
    });
  });