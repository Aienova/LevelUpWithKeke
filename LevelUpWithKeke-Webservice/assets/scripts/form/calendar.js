

$(document).ready(function () {


    function today(){

                    
            var today = new Date();
            var dd = today.getDate();

            var mm = today.getMonth()+1; 
            var yyyy = today.getFullYear();
            if(dd<10) 
            {
                dd='0'+dd;
            } 

            if(mm<10) 
            {
                mm='0'+mm;
            } 
  
            today = yyyy+'-'+mm+'-'+dd;

            return today;

    }


$.ajax({
    url: '/calendar/'+today(),
    success: function(data) {
     $('#calendar').html(data);
    },
    error: function() {
     $('#calendar').text('Erreur au niveau du calendar');
    }
         });


         $("#bookingDate").mouseout(function(){
            var date = $("#bookingDate").val();

            let objdate = new Date(date);

            console.log(date);

            $.ajax({
                url: '/calendar/'+date,
                type : 'POST',
                success: function(data) {
                 $('#calendar').html(data);

                },
                error: function() {
                 $('#calendar').text('Erreur au niveau du Is company exist');
                }
                     });


                     
                     $.ajax({
                        url: '/calendar-check-event/'+date,
                        type : 'POST',
                        success: function(data) {
                         var isEvent = data["event"];
        
                         console.log(isEvent);
        
                         if(isEvent == true ){
        
                            $('#submitBooking').addClass("forbidden");
                            $('#bookingAlert').html("<h3 class='red-text'>Un évènement est prévu a cette date ou l'ambassade est exceptionnellement fermée, veuillez en choisir une autre</h3>");
                            $('#subject').addClass("hidden");    
                            $('#hours').addClass("hidden");       
                            $('#comment').addClass("hidden");       
            
                         }else{

                            
                            if(objdate.getDay() == 6 || objdate.getDay() == 0){

                                $('#submitBooking').addClass("forbidden");
                                $('#bookingAlert').html('<h3 class="red-text">Cette date est un weekend veuillez en choisir une autre</h3>');
                                $('#subject').addClass("hidden");    
                                $('#hours').addClass("hidden");       
                                $('#comment').addClass("hidden");                     
                            }else{

                                $('#submitBooking').removeClass("forbidden");
                                $('#bookingAlert').html('<h3 class="green-text">Cette date est disponible vous pouvez la réservez</h3>');
                                $('#subject').removeClass("hidden");    
                                $('#hours').removeClass("hidden"); 
                                $('#comment').removeClass("hidden");      
                            }


                         }
                         
                        },
                        error: function() {
                         $('#calendar').text('Erreur au niveau du Is company exist');
                        }
                             });












                     

         });


});