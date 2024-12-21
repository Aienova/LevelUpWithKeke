


$(document).ready(function () {



             $("#details").click(function(){


    
                var detailid = $("#details").find(":selected").val();

                console.log("details :"+detailid);

                $(".details").addClass("hidden");
                $("#details-"+detailid).removeClass("hidden");
        
    
            });

});






