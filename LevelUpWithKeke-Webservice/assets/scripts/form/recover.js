$(document).ready(function () {

 
    $.ajax({
        url: '/recover-customer',
        type : 'post',
        success: function(data) {
         $('#recover').html(data);
        },
        error: function() {
         $('#recover').text('Erreur au niveau du subscribe form');
        }
             });


             $( "#recover-form" ).on( "submit", function() {


                route = $(this).closest(".usertype2").data("route");

                console.log(route);

                $.ajax({
                    url: '/'+route,
                    type : 'post',
                    success: function(data) {
                     $('#recover').html(data);
                    },
                    error: function() {
                     $('#recover').text('Erreur au niveau du subscribe form');
                    }
                         });



             });


        

});

    /*----HOVER MENU -----*/
        


