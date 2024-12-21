


$(document).ready(function () {



    $(".searcher").click(function(){

       console.log("open side");

       var search = $(this).closest(".searcher").val();
       console.log(search);
       var choice = "#result-"+search;
       
       console.log(choice);
       $(".result").addClass("hidden");
       $(choice).removeClass("hidden");



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

