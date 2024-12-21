$(document).ready(function () {

    var id = $("#job-offer").attr("data-id");
 
    $.ajax({
        url: '/job-offer-validation',
        type : 'post',
        data : { 
            

            id: id 
            
        },
        success: function(data) {
         $('#job-offer').html(data);
        },
        error: function() {
         $('#job-offer').text('Erreur au niveau du job offer');
        }
             });    
});

    /*----HOVER MENU -----*/
        


