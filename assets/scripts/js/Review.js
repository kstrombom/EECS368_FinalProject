$(document).ready(function() {
    $.ajax({
        url: 'php_File_with_php_code.php',
        type: 'GET',
        data: "parameter=some_parameter",
        success: function(data) {
            $("#thisdiv").html(data);
        }
    });
});