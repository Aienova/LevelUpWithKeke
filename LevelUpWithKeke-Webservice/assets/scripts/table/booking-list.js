

            for(let i=1; i<=3; i++){

    

                $("#resa"+i).click(function(){

                    console.log(i);


                    console.log("#table-resa"+i);
                    
                    $(".table-resa").addClass("hidden");
                    $("#table-resa"+i).removeClass("hidden");

                });


            }



