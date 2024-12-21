$(document).ready(function () {


    

    var route = $('#panel').data( "route" );
    var id = $('#panel').data( "id" );

    function routing(route,id){

        $.ajax({
            url: '/'+route+'/'+id,
            type : 'post',
            success: function(data) {
             $('#panel').html(data);
            },
            error: function() {
             $('#panel').text('Erreur au niveau du panel');
            }
                 });


    }
    
   // PLUS TARD routing(route,id);


    $(".panel-option").click(function(){
        var route = $(this).closest(".panel-option").data( "route" );
        var id = $(this).closest(".panel-option").data( "id" );

        $("#card").addClass("panel-activated");
        $("#close-panel-button").removeClass("hidden");
        $("#panel-info .closed").removeClass();
        $("#panel-display .closed").removeClass();
        $("#panel-display div").addClass("open");
        $("#panel-info div").addClass("open");

        routing(route,id);

      });


      $("#close-panel-button").click(function(){

        $("#card").removeClass("panel-activated");
        $("#close-panel-button").addClass("hidden");
        $("#panel-info div").addClass("closed");
        $("#panel-display div").addClass("closed");
        $("#panel-display div").removeClass("open");
        $("#panel-info div").removeClass("open");

    });





});

    /*----HOVER MENU -----*/
        


