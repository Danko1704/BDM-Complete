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
                let noticias = JSON.parse(response);
                console.log(noticias);
                //let temp = '.color';

                /*colores.forEach(color => {

                    temp += `${color.id}`;
                    $(temp).css('color', color.color);
                    //console.log(temp);
                    temp = '.color';

                });*/
            }
        },
    });
    
    return false;
});