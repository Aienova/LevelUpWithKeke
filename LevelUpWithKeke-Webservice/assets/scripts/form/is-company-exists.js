$(document).ready(function () {

             $("#inputField").mouseout(function(){

                route = $("#inputField").val();

                console.log(route);

                $.ajax({
                    url: '/if-company-exist/'+route,
                    type : 'POST',
                    success: function(data) {
                     $('#company-details').html(data);
                    },
                    error: function() {
                     $('#company-details').text('Erreur au niveau du Is company exist');
                    }
                         });



             });


        

});