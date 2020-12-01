$("form.deleteSeccion").on("submit", function(event){
    //console.log('jQuery esta jalando');
    
    var that = $(this),
        url = that.attr('action'),
        type = that.attr('method'),
        data = {};

    that.find('[name]').each(function(index, e) {
        //console.log(e);
        var that = $(this),
            name = that.attr('name'),
            value = that.val();
      
        data[name] = value;
        //debugger;
     });

     //console.log(data);

     //console.log(data);
            //var selectCat = $("#categoBox").children("option:selected").text();
    
            //data[name] = selectCat;

            //debugger;
    
    $.ajax({
        url : url,
        type: type,
        data: data,
        success: function(response){
            console.log(response);
        }
    });

    return false;
});