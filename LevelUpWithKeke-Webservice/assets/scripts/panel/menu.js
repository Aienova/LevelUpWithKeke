
$(document).ready(function () {


            $("#tablet-button").click(function(){



                if( $("#tablet-button").hasClass("open-button")){

                    $("header").addClass("open-menu");
                    $("#tablet-button").removeClass("open-button");
                    $("#tablet-button").addClass("close-button");

                }else{

                    $("header").removeClass("open-menu");
                    $("#tablet-button").addClass("open-button");
                    $("#tablet-button").removeClass("close-button");

                }


            });


            $("#tablet-menu-description").click(function(){

                $("#description").show();
                $("#skills").hide();

            });


            $("#tablet-menu-skills").click(function(){

                $("#description").hide();
                $("#skills").show();

            });


            $("#smartphone-menu-identity").click(function(){


                $("#identity").show();
                $("#description").hide();
                $("#skills").hide();

            });


            $("#smartphone-menu-description").click(function(){

                $("#identity").hide();
                $("#description").show();
                $("#skills").hide();

            });


            $("#smartphone-menu-skills").click(function(){

                $("#identity").hide();
                $("#description").hide();
                $("#skills").show();

            });

});


