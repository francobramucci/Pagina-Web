$(document).ready(function () {
    $('#login').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: '../php/login.php',
            type: 'POST',
            data: {email: $('#logEmail').val(), password: $('#password').val()},
            success: function(response){
                if(response.success){
                    window.location.href = "http://200.3.127.46:8002/~uno/html/formulario.php";
                } else {
                    $('#login').trigger('reset');
                    $('#response-div').html(`<p id="response">${response.message}</p>`);
                }
            },
            error: function(jqXHR, exception){
                console.log(jqXHR);
            }
        });
    });
});