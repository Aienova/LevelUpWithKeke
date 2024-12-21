$(document).ready(function () {

    var route = $('#search-engine').data( "route" );


    /*-----FOR WEBSITE ----------*/

    var title = $('#search-engine').data( "title" );

    var location = $('#search-engine').data( "location" );

     /*-----FOR WEBSITE ----------*/

     console.log("search-engine.js - route :"+route);


     if(route !=undefined){

    $.ajax({
        url: '/'+route,
        type : 'post',
        data: { title: title, location: location },
        success: function(data) {
         $('#search-engine').html(data);
        },
        error: function() {
         $('#search-engine').text('Erreur au niveau du search engine');
        }
             });

            }

});

        


