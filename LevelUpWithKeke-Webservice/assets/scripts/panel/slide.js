


$("#previousorder").click(function(){

    var maxorder = $("#order").data("maxorder");
    var minorder = 1;
    var order = parseInt($("#order").html());

    neworder=order-1;

            if(neworder<minorder){

                neworder=maxorder;
            }
            $("#order").data("currentorder", neworder);
            $("#order").html(neworder);
            $(".slide").addClass("hidden");
            $("#slide-"+neworder).removeClass("hidden");

});


$("#nextorder").click(function(){

    var maxorder = $("#order").data("maxorder");
    var minorder = 1;
    var order = parseInt($("#order").html());


    neworder=order+1;

            if(neworder>maxorder){

                neworder=minorder;
            }

            $("#order").data("currentorder", neworder);
            $("#order").html(neworder);
            $(".slide").addClass("hidden");
            $("#slide-"+neworder).removeClass("hidden");


});


/*---------SLIDER HOMEPAGE---------------*/

var time = 1;

var interval = setInterval(function() { 


    $("#slide"+time).removeClass("active");

    

    if (time >= 3) { time=1;  }else{

        time++;
    }

   $("#slide"+time).addClass("active");

   var maintitle = $("#slide"+time).data("maintitle");
   var secondtitle = $("#slide"+time).data("secondtitle");

   $("#slide-main-title").html(maintitle);
   $("#slide-second-title").html(secondtitle);

   
}, 5000);