$(document).ready(function () {

 
    $('#subscribe-form').submit(function(e){


        var route = $('#subscribe-form').data("route");

        e.preventDefault();
        $.ajax({
            url: route,
            type: 'post',
            data:$('#subscribe-form').serialize(),
            success: function(data) {
                $('#message-form').html(data);
    
               },
               error: function() {
                $('#message-form').text("Erreur au niveau du système d'inscription");
               }
        });

        $(this).trigger('reset');
    
    });
    



        

});

    /*----HOVER MENU -----*/
        


