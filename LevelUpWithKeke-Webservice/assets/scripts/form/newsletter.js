

$('#newsletter-form').submit(function(e){

    var currenturl = window.location.href;

    e.preventDefault();
    $.ajax({
        url: currenturl,
        type: 'post',
        data:$('#newsletter-form').serialize(),
        success: function(data) {
            $('#message-form').html(data);

           },
           error: function() {
            $('#message-form').text('Erreur au niveau du système de réservation');
           }
    });

    this.reset();
});