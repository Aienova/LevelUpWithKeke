
$(document).ready(function() {
    // Fonction pour gérer le défilement en douceur
    $('scroller').on('click', function(event) {
        event.preventDefault();

        var target = $(this.getAttribute('href'));

        if (target.length) {
            $('html, body').stop().animate({
                scrollTop: target.offset().top
            }, 1000);
        }
    });
});