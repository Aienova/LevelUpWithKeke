            
$(document).ready(function () {



    for(let i=0 ; i<18; i++){

        $('#asset-order-'+i).click(function(){
                
            var count = $('input:checkbox:checked').length;
            var assetid = $('#asset-order-'+i).attr('data-assetid');
            
            console.log("Assets selected : "+count);

        if(count <4) {
            
            $(".asset").removeClass("locked");


            if($('#asset-'+assetid).prop('checked')==true){

                $('#asset-order-'+i).removeClass("unselected");
                $('#asset-order-'+i).addClass("selected");

            }else{

                $('#asset-order-'+i).addClass("unselected");
                $('#asset-order-'+i).removeClass("selected");
            }

            $('#assetcount').html(count);

        }else{


            if(count==4) {

                if($('#asset-'+assetid).prop('checked')==true){

                    $('#assetcount').html(count);
                    $('#asset-order-'+i).removeClass("unselected");
                    $('#asset-order-'+i).addClass("selected");
    
                }else{
    
                    $('#asset-order-'+i).addClass("unselected");
                    $('#asset-order-'+i).removeClass("selected");
                }

            }

            $("#assets .unselected").addClass("locked");
            
            console.log("Limit reached !");

        }

        });

    }

});