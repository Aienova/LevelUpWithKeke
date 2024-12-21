


$(document).ready(function () {



    $(".fontTitlePreview").click(function(){

       console.log("show fontTitle");

       var fontTitle = $("#fontTitle").val();
       var fontTitleWeight = $("#fontTitleWeight").val();

       console.log(fontTitle);
       console.log(fontTitleWeight);

       $("#fontTitlePreview h2").css("font-family",fontTitle);
       $("#fontTitlePreview h2").css("font-weight",fontTitleWeight);


   });


   


   $(".fontTextPreview").click(function(){

    console.log("show fontText");

    var fontTitle = $("#fontText").val();
    var fontTitleWeight = $("#fontTextWeight").val();

    console.log(fontTitle);
    console.log(fontTitleWeight);

    $("#fontTextPreview p").css("font-family",fontTitle);
    $("#fontTextPreview p").css("font-weight",fontTitleWeight);


});


});

