

$(".edit-button").click(function(){

    var action = $(this).closest(".edit-button").data("action");
    var id = $(this).closest(".edit-button").data("id");

    console.log("Lock it");

            $("#editor").removeClass("hidden");

            $.ajax({
                url: '/'+action+'/'+id,
                type : 'POST',
                success: function(data) {
                 $('#editor-form-display').html(data);
                },
                error: function() {
                 $('#editor-form-display').text('Erreur au niveau du subscribe form');
                }
                     });


});

$(".open-editor").click(function(){

    $("#editor").removeClass("hidden");
    var action = $(this).closest(".open-editor").data("action");
    var section = $(this).closest(".open-editor").data("section");
    var id = $(this).closest(".open-editor").data("id");

    $("#editor").removeClass("hidden");

    $.ajax({
        url: '/cuid/confirm/'+action+'/'+section+'/'+id,
        type : 'POST',
        success: function(data) {
         $('#editor-form-display').html(data);
        },
        error: function() {
         $('#editor-form-display').text('Erreur au niveau du subscribe form');
        }
             });

});




$("#close-editor").click(function(){

    $("#editor").addClass("hidden");
    $("#editor-form-display").html("");

});

