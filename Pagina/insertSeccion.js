$("form.addSeccion").on("submit", function(event){
    //event.preventDefault();
    //console.log('jQuery esta jalando');
    
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
            console.log(response);
        }
    });    
    //console.log(data);

    return false;
});