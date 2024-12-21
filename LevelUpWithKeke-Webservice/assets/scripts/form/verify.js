$(document).ready(function() {
    $('#respond-form').on('click', function(event) {

        let allFilled = true;

        // Check each required input
        $('input[required]').each(function() {
            if (!$(this).val()) {
                allFilled = false;
                $(this).addClass('verify-error');  // Highlight the missing fields
            } else {
                $(this).removeClass('verify-error');  // Reset the style if filled

            }
        });

        // If any required input is not filled, prevent form submission
        if (!allFilled) {

            $('#loader').addClass("hidden");
            $("#verify-error").html('Veuillez remplir toutes les cases du formulaires');

            event.preventDefault();
        }
    });
    
});