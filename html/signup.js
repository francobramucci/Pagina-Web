$(document).ready(function () {
    $('#signup').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: '../php/signup.php',
            type: 'POST',
            data: {email: $('#signEmail').val(), password: $('#password').val()},
            success: function(response){
                $('#signup').trigger('reset');
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        });
    });
});