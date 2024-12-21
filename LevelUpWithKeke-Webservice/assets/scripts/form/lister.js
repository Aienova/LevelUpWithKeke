


$(document).ready(function () {



    $(".lister").click(function(){

       console.log("List options");

       var row = $(this).closest(".lister").data("row");
       var action = $(this).closest(".lister").data("action");
       console.log(action);



        $(".optionlister").addClass("hidden");

       if(action=="add"){

        var newrow = row + 1
        
        $("#option"+newrow).removeClass("hidden");
        $("#optionlister"+newrow).removeClass("hidden");
        $("#totaloptions").val(newrow);
        $("#countoptions").html(newrow);

       }

       if(action=="remove"){

        var newrow = row - 1

        $("#option"+row).addClass("hidden");
        $("#optionlister"+newrow).removeClass("hidden");
        $("#option"+row+" input").val('');
        $("#totaloptions").val(newrow);
        $("#countoptions").html(newrow);
        
       }






   });


   
   $(".multisearcher").click(function(){

    console.log("open side");

    var search = $(this).closest(".multisearcher").val();
    var id = $(this).closest(".multisearcher").data("id");
    console.log(search);
    var choice = "#"+id+"-"+search;
    
    console.log(choice);
    $("."+id).addClass("hidden");
    $(choice).removeClass("hidden");



});

});

