


$(document).ready(function () {



             $(".movestep").click(function(){

                console.log("movestep");

                $(".movestep").removeClass("selected");
    
                var step = $(this).closest(".movestep").data("step");
                var nextsetp = "#step"+step;
                
    
                console.log(nextsetp);
                $(".step").addClass("hidden");
                $(nextsetp).removeClass("hidden");

                $(this).closest(".movestep").addClass("selected");
    

            });

});






