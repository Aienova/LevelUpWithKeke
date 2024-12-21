$(document).ready(function () {

    var route = $('#uploader-unique').data("route");

    console.log("upload-unique.js - route :"+route);

    if(route !=undefined){
    $.ajax({
        url: '/'+route,
        type : 'post',
        success: function(data) {
         $('#uploader-unique').html(data);
        },
        error: function() {
            $('#uploader-unqiue').text('Erreur au niveau du search engine');
        }
             });

            }

});


    /*----HOVER MENU -----*/
        


