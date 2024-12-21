            
$(document).ready(function () {



    for(var i=0 ; i<15; i++){

        $('#value-order-'+i).click(function(){
                
            var count = $('input:checkbox:checked').length;
            var valueid = $('#value-order-'+i).attr('data-valueid');
            
            console.log("values selected : "+count);

        if(count <4) {
            
            $(".value").removeClass("locked");


            if($('#value-'+valueid).prop('checked')==true){

                $('#value-order-'+i).removeClass("unselected");
                $('#value-order-'+i).addClass("selected");

            }else{

                $('#value-order-'+i).addClass("unselected");
                $('#value-order-'+i).removeClass("selected");
            }

            $('#valuecount').html(count);

        }else{


            if(count==4) {

                if($('#value-'+valueid).prop('checked')==true){

                    $('#valuecount').html(count);
                    $('#value-order-'+i).removeClass("unselected");
                    $('#value-order-'+i).addClass("selected");
    
                }else{
    
                    $('#value-order-'+i).addClass("unselected");
                    $('#value-order-'+i).removeClass("selected");
                }

            }

            $("#values .unselected").addClass("locked");
            
            console.log("Limit reached !");

        }

        });

    }

});