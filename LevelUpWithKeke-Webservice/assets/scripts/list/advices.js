$(document).ready(function () {


    var route = $('#advices').data( "route" );
    var id = $('#advices').data( "id" );
    
    console.log("advices.js - route : "+route);
    console.log("advices.js - id : "+id);
    $.ajax({
        url: '/'+route+'/'+id,
        type : 'post',
        success: function(data) {
         $('#advices').html(data);
        },
        error: function() {
         $('#advices').text('Erreur au niveau du advices');
        }
             });

});

    /*----HOVER MENU -----*/
        


