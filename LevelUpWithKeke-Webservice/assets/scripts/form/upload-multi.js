

$(document).ready(function () {

    var route = $('#uploader-multi').data("route");

    console.log("upload-multi.js - route :"+route);

    if(route !=undefined){
    $.ajax({
        url: '/'+route,
        type : 'post',
        success: function(data) {
         $('#uploader-multi').html(data);
        },
        error: function() {
            $('#uploader-multi').text('Erreur au niveau du search engine');
        }
             });
            }

});

    /*----HOVER MENU -----*/
        


