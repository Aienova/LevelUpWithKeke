


$(document).ready(function () {



    $(".sider").click(function(){

       console.log("open side");

       var side = $(this).closest(".sider").data("side");
       var sidopened = "#"+side;
       
       console.log(sidopened);
       $(".side").addClass("hidden");
       $(sidopened).removeClass("hidden");



   });


   $(".clearsider").click(function(){

    console.log("clear side");

    $(".side").addClass("hidden");




});




});

