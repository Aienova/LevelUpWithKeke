$(document).ready(function () {

    var route = $('#new-job-offer').data( "route" );
    console.log("job-offer.js - route :"+route);

    $.ajax({
        url: '/'+route,
        type : 'post',
        success: function(data) {
         $('#new-job-offer').html(data);
        },
        
        error: function() {
         $('#new-job-offer').text('Erreur au niveau de new job-offer');
        }
             });
             
});

    /*----HOVER MENU -----*/
        


