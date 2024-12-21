

$('#contact-form').submit(function(e){

    var currenturl = window.location.href;

    e.preventDefault();
    $.ajax({
        url: currenturl,
        type: 'post',
        data:$('#contact-form').serialize(),
        success: function(data) {

            $('#loader').addClass("hidden");
            $('#message-form').html(data);

           },
           error: function() {
            $('#message-form').text('Erreur au niveau du système de réservation');
           }
    });

    this.reset();
});