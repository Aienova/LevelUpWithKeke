

$(".decision-button").click(function(){

    var action = $(this).closest(".decision-button").data("action");

    console.log("Lock it");

            $("#message-form").removeClass("hidden");

            $.ajax({
                url: action,
                type : 'POST',
                success: function(data) {
                 $('#message-form').html(data);
                },
                error: function() {
                 $('#message-form').text('Erreur au niveau du subscribe form');
                }
                     });

});

$("#close-messager").click(function(){

    $('#message-form').html("");
    $("#message-form").addClass("hidden");
});

