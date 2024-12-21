
$(document).ready(function() {
    $('#exportButton').click(function() {
        // Get the table element

                // Get today's date using JavaScript
        var today = new Date();

        // Get the day, month, and year from the date object
        var day = today.getDate();
        var month = today.getMonth() + 1; // Months are zero-indexed
        var year = today.getFullYear();

// Format the date as DD/MM/YYYY
        var formattedDate = day + '-' + month + '-' + year;

        var id = $('#tableToExtract').val();
        var table = document.getElementById('result-'+id);

        // Use SheetJS to convert HTML table to worksheet
        var workbook = XLSX.utils.table_to_book(table);

        // Customize filename here
        var filename = 'table_'+$('#result-'+id).data("name")+'_'+formattedDate+'.xlsx';

        // Write workbook and trigger download
        XLSX.writeFile(workbook, filename);
    });
});
