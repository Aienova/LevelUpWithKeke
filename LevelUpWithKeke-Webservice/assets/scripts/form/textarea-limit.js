
$(document).ready(function() {
    var maxChars = 100; // Change this to your desired character limit

    $('#description').on('input', function() {
        var textLength = $(this).val().length;
        var remainingChars = maxChars - textLength;

        $('#descriptionCount').text(textLength + ' characters');

        if (remainingChars < 0) {
            // Disable further typing
            $(this).val($(this).val().substring(0, maxChars));
            remainingChars = 0;
        }
    });
});
