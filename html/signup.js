$(document).ready(function () {
    $('#signup').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: '../php/signup.php',
            type: 'POST',
            data: {email: $('#signEmail').val(), password: $('#password').val()},
            success: function(response){
                window.location.href = "http://200.3.127.46:8002/~uno/html/log.php";
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        });
    });
});